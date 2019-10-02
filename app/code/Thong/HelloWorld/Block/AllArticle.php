<?php
namespace Thong\HelloWorld\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Thong\HelloWorld\Model\ResourceModel\Article\CollectionFactory;

class AllArticle extends Template
{
    protected $_CollectionFactory;

    public function __construct(Context $context,CollectionFactory $CollectionFactory)
    {
        $this->_CollectionFactory = $CollectionFactory;
        parent::__construct($context);
    }

    public function LoadAllArticle()
    {
        return __('All Article');
    }

    public function GetCollection()
    {
        $article = $this->_CollectionFactory->create();
        return $article;
    }

}
