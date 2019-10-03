<?php
namespace Thong\HelloWorld\Block;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Thong\HelloWorld\Model\ResourceModel\Article\CollectionFactory;

class ArticleDetail extends Template
{
    protected $_CollectionFactory;

    public function __construct(Context $context,CollectionFactory $CollectionFactory)
    {
        $this->_CollectionFactory = $CollectionFactory;
        parent::__construct($context);
    }

    public function Detail()
    {
        return __('Hello World');
    }

    public function GetIDArticle($id){
        $article = $this->_CollectionFactory->create();
        $a = $article->getItemById($id);
        return $a->getData();
    }
}
