<?php
/**
 * @author Rafael Corrêa Gomes <rafaelcgstz@gmail.com>
 *  @copyright Copyright (c) 2018
 *  @license https://opensource.org/licenses/OSL-3.0.php Open Software License 3.0
 */

namespace Rafaelcg\QuickLink\Block;

use Magento\Framework\View\Element\Template;
use Rafaelcg\QuickLink\Helper\Data;

/**
 * Class QuickLink
 *
 * @package Rafaelcg\QuickLink\Block
 */
class QuickLink extends Template
{
    /**
     * Path to check if it's enabled
     */
    const XML_PATH_ACTIVE = 'web/quicklink/active';
    const XML_PATH_TIMEOUT = 'web/quicklink/timeout';
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
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        Data $helper,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->context = $context;
        $this->data = $data;
        $this->helper = $helper;
    }

    /**
     * Initialize the configurations
     *
     * @return string
     */
    public function initConfig()
    {
        $timeout = $this->helper->getTimeout();
        return json_encode(['timeout' => $timeout]);
    }

    /**
     * Render GA tracking scripts
     *
     * @return string
     */
    protected function _toHtml()
    {
        return !$this->helper->isQuicklinkEnabled() ? '' : parent::_toHtml();
    }
}
