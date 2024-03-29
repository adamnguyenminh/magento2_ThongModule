<?php

namespace Thong\HelloWorld\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Thong\HelloWorld\Helper\Data;

class AllArticle extends Action
{
    protected $_pageFactory;

    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        Data $helperData

    ) {
        $this->helperData = $helperData;
        $this->_pageFactory = $pageFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        $isTrue = $this->helperData->getGeneralConfig('enable');
//        echo $this->helperData->getGeneralConfig('display_text');
        if (!$isTrue) {
            $this->_redirect('/');
        }
        return $this->_pageFactory->create();
    }

}
