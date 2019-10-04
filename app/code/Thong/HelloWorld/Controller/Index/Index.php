<?php

namespace Thong\HelloWorld\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Thong\HelloWorld\Model\ResourceModel\Article\CollectionFactory;

class Index extends Action
{
    protected $_pageFactory;

    protected $_CollectionFactory;

    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        CollectionFactory $CollectionFactory
    ) {
        $this->_pageFactory = $pageFactory;
        $this->_CollectionFactory = $CollectionFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        $article = $this->_CollectionFactory->create();
        foreach ($article as $item) {
            echo "<pre>";
            print_r($item->getData());
            echo "</pre>";
        }
        exit();
        return $this->_pageFactory->create();
    }
}
