<?php
/**
 * @author Rafael Corrêa Gomes <rafaelcgstz@gmail.com>
 * @copyright Copyright (c) 2023.
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
    private Template\Context $context;

    /**
     * @var array
     */
    private array $data;

    /**
     * @var Data
     */
    private Data $helper;

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
        $this->helper = $helper;
        $this->_appState = $appState;
    }

    /**
     * Render Quicklink script
     *
     * @return string
     */
    protected function _toHtml(): string
    {
        $isProductionMode = $this->_appState->getMode() === State::MODE_PRODUCTION;
        $runInDeveloperMode = $this->helper->runInDeveloperMode();
        if (!$this->helper->isQuicklinkEnabled() ||
            (!$runInDeveloperMode && !$isProductionMode)) {
            return '';
        }
        return parent::_toHtml();
    }
}
