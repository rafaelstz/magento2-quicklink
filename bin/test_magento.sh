#!/usr/bin/env bash

set -e
trap '>&2 echo Error: Command \`$BASH_COMMAND\` on line $LINENO failed with exit code $?' ERR

# Prepare a full Magento2 project with proper version.
cd ..

# If no stability configured, do nothing and keep installing the given Magento2 version.
if [[ -z "${MAGENTO_STABILITY}" ]]; then
  STABILITY="--stability=stable"
  VERSION="$MAGENTO_VERSION"
else
  # Else, switch explicit version to closest one, and set composer to prefer given stability.
  # Eg. if we want to test 2.3.0 which is in beta, composer will not be able to install it with magento/project-community-edition=2.3.0
  # Proper syntax for installing would be : magento/project-community-edition=2.3.* --stability=beta
  # That's the purpose of the 2 following lines.
  STABILITY="--stability=$MAGENTO_STABILITY"
  VERSION="${MAGENTO_VERSION%.*}.*"
fi

echo "==> Copying Magento2 repository credentials here."
cp "$TRAVIS_BUILD_DIR/auth.json" .

echo "==> Installing Magento 2 $MAGENTO_EDITION (Version $VERSION) ..."
echo "composer create-project --repository-url=https://repo.magento.com magento/project-$MAGENTO_EDITION-edition=$VERSION $STABILITY magento"
composer create-project --repository-url=https://repo.magento.com magento/project-$MAGENTO_EDITION-edition=$VERSION $STABILITY magento --quiet

cd "magento"

# Require the extension to make it usable (autoloading)
echo "==> Requiring extension from the $TRAVIS_BRANCH-dev branch"
composer require --dev "rafaelcg/magento2-quicklink:$TRAVIS_BRANCH-dev" --quiet

echo "==> Installing Magento 2"
mysql -uroot -e 'CREATE DATABASE magento2;'
php bin/magento setup:install -q --admin-user="admin" --admin-password="admin123" --admin-email="admin@example.com" --admin-firstname="Admin" --admin-lastname="User" --db-name="magento2"

echo "==> Process upgrade and try to compile..."
php bin/magento setup:upgrade -q
php bin/magento cache:flush
php bin/magento setup:static-content:deploy
php bin/magento setup:di:compile

echo "==> Enable Apache configuration"
sudo sed -e "s?%TRAVIS_BUILD_DIR%?$(pwd)?g" --in-place /etc/apache2/sites-available/000-default.conf
sudo service apache2 restart
sleep 2
