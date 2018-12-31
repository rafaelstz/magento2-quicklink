<?php
/**
 * @author Rafael Corrêa Gomes <rafaelcgstz@gmail.com>
 *  @copyright Copyright (c) 2018
 *  @license https://opensource.org/licenses/OSL-3.0.php Open Software License 3.0
 */

namespace Rafaelcg\QuickLink\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

/**
 * Class Data
 *
 * @package Rafaelcg\QuickLink\Helper
 */
class Data extends AbstractHelper
{
    /**
     * Config paths for using throughout the code
     */
    const XML_PATH_ACTIVE = 'web/quicklink/active';

    const XML_PATH_TIMEOUT = 'web/quicklink/timeout';

    const XML_PATH_URLs = 'web/quicklink/urls';

    const XML_PATH_PRIORITY = 'web/quicklink/priority';


    /**
     * Get config
     *
     * @param string $path
     * @return mixed
     */
    public function getConfig($path)
    {
        return $this->scopeConfig->getValue($path, ScopeInterface::SCOPE_STORE);
    }

    /**
     * @return int|mixed
     */
    public function getTimeout(){
        $configTimeout = $this->getConfig(self::XML_PATH_TIMEOUT);
        $timeout = !empty($configTimeout) ? $configTimeout : 4000;
        return $timeout;
    }

    /**
     * Whether Quicklink is ready to use
     *
     * @param string $store
     * @return bool
     */
    public function isQuicklinkEnabled($store = null)
    {
        return $this->scopeConfig->isSetFlag(self::XML_PATH_ACTIVE, ScopeInterface::SCOPE_STORE, $store);
    }
}
