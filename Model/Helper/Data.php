<?php
/**
 * @author Rafael Corrêa Gomes <rafaelcgstz@gmail.com>
 * @copyright Copyright (c) 2023.
 */

namespace Rafaelcg\Quicklink\Model\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

/**
 * Class Data
 * Get configurations from admin panel
 */
class Data extends AbstractHelper
{
    /**
     * Config paths for using throughout the code
     */
    public const XML_PATH_ACTIVE = 'quicklink/general/active';
    public const XML_PATH_TIMEOUT = 'quicklink/general/timeout';
    public const XML_PATH_REQUEST_LIMIT = 'quicklink/general/request_limit';
    public const XML_PATH_CONCURRENCY_LIMIT = 'quicklink/general/concurrency_limit';
    public const XML_PATH_PRIORITY = 'quicklink/general/priority';
    public const XML_PATH_DEVELOPER_MODE = 'quicklink/general/developer_mode';

    /**
     * Get config
     *
     * @param  string $path
     * @param  null   $scopeCode
     * @return mixed
     */
    public function getConfig($path, $scopeCode = null): mixed
    {
        $config = $this->scopeConfig->getValue($path, ScopeInterface::SCOPE_STORE, $scopeCode);
        return !empty($config) ? $config : false;
    }

    /**
     * Get timeout
     *
     * @return int|mixed
     */
    public function getTimeout(): mixed
    {
        return $this->getConfig(self::XML_PATH_TIMEOUT);
    }

    /**
     * Get request limit
     *
     * @return int|mixed
     */
    public function getRequestLimit(): mixed
    {
        return $this->getConfig(self::XML_PATH_REQUEST_LIMIT);
    }

    /**
     * Get concurrency limit
     *
     * @return int|mixed
     */
    public function getConcurrencyLimit(): mixed
    {
        return $this->getConfig(self::XML_PATH_CONCURRENCY_LIMIT);
    }

    /**
     * Get the priority
     *
     * @return int|mixed
     */
    public function getPriority(): mixed
    {
        return $this->getConfig(self::XML_PATH_PRIORITY);
    }

    /**
     * Whether Quicklink is ready to use
     *
     * @param int|string|null $store
     * @return bool
     * @deprecated 2.2.0
     * @see Rafaelcg/Quicklink/view/frontend/layout/default.xml
     */
    public function isQuicklinkEnabled(int|string $store = null): bool
    {
        return $this->scopeConfig->isSetFlag(self::XML_PATH_ACTIVE, ScopeInterface::SCOPE_STORE, $store);
    }

    /**
     * Check if you can run it in developer mode
     *
     * @param int|string|null $store
     * @return bool
     */
    public function runInDeveloperMode(int|string $store = null): bool
    {
        return $this->scopeConfig->isSetFlag(self::XML_PATH_DEVELOPER_MODE, ScopeInterface::SCOPE_STORE, $store);
    }
}
