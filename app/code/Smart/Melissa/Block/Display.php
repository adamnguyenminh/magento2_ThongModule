<?php
namespace Smart\Melissa\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Thong\HelloWorld\Helper\Data;

class Display extends Template
{
    protected $helperData;

    public function __construct(Context $context, Data $helperData)
    {
        $this->helperData = $helperData;
        parent::__construct($context);
    }

    public function sayHello()
    {
        return __($this->helperData->getGeneralConfig('display_text'));
    }
}
