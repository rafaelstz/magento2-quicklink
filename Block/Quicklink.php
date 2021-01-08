<?php
/**
 * @author Rafael Corrêa Gomes <rafaelcgstz@gmail.com>
 * @copyright Copyright (c) 2020.
 */

namespace Rafaelcg\Quicklink\Block;

use Magento\Framework\App\State;
use Magento\Framework\View\Element\Template;
use Rafaelcg\Quicklink\Model\Helper\Data;

/**
 * Class Quicklink
 * Initialize the parameters that must be used to start
 */
class Quicklink extends Template
{

    /**
     * @var Template\Context
     */
    private $context;
    /**
     * @var array
     */
    private $data;
    /**
     * @var Data
     */
    private $helper;

    /**
     * Constructor
     *
     * @param Template\Context $context
     * @param Data $helper
     * @param State $appState
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        Data $helper,
        State $appState,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->context = $context;
        $this->helper = $helper;
        $this->_appState = $appState;
        $this->data = $data;
    }

    /**
     * Initialize the configurations
     *
     * @return array|string
     */
    public function initConfig()
    {
        $initConfig = [];
        $timeout = $this->helper->getTimeout();
        $requestLimit = $this->helper->getRequestLimit();
        $concurrencyLimit = $this->helper->getConcurrencyLimit();
        $priority = $this->helper->getPriority();

        if ($timeout) {
            $initConfig['timeout'] = $timeout;
        }
        if ($requestLimit) {
            $initConfig['limit'] = $requestLimit;
        }
        if ($concurrencyLimit) {
            $initConfig['throttle'] = $concurrencyLimit;
        }
        if ($priority) {
            $initConfig['priority'] = $priority;
        }

        return ($initConfig);
    }

    protected function runInDeveloperMode()
    {
        return $this->helper->getRunInDeveloperMode();
    }

    /**
     * Render GA tracking scripts
     *
     * @return string
     */
    protected function _toHtml()
    {
        $isProductionMode = $this->_appState->getMode() === State::MODE_PRODUCTION;
        $runInDeveloperMode = $this->helper->runInDeveloperMode();
        if (!$this->helper->isQuicklinkEnabled()) {
            if (!$runInDeveloperMode && !$isProductionMode) {
                return '';
            }
        }
        return parent::_toHtml();
    }
}
