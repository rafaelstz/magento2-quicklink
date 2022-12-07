<?php

namespace Rafaelcg\Quicklink\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Rafaelcg\Quicklink\Model\Helper\Data;

/**
 * Class Quicklink
 * Provide the data customized by the user via admin
 */
class Quicklink implements ArgumentInterface
{
    /**
     * @var Data
     */
    private $helper;

    /**
     * Quicklink constructor.
     *
     * @param Data $helper
     */
    public function __construct(
        Data $helper
    ) {
        $this->helper = $helper;
    }

    /**
     * Get timeout before cancelling the request
     *
     * @return string
     */
    public function getTimeout()
    {
        $config = $this->helper->getTimeout();
        return $config ? "timeout: {$config}," : "";
    }

    /**
     * Get the maximum number of requests to be made
     *
     * @return string
     */
    public function getLimit()
    {
        $config = $this->helper->getRequestLimit();
        return $config ? "limit: {$config}," : "";
    }

    /**
     * Get the maximum number of requests to be made at the same time
     *
     * @return string
     */
    public function getConcurrencyLimit()
    {
        $config = $this->helper->getConcurrencyLimit();
        return $config ? "throttle: {$config}," : "";
    }

    /**
     * Get the priority of the request
     *
     * @return string
     */
    public function getPriority()
    {
        $config = $this->helper->getPriority();
        return $config ? "priority: {$config}," : "";
    }
}
