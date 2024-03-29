<?php
namespace Thong\HelloWorld\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Thong\HelloWorld\Model\ResourceModel\Article\CollectionFactory;
use Thong\HelloWorld\Helper\Data;

class AllArticle extends Template
{
    protected $_CollectionFactory;

    public function __construct(Context $context,CollectionFactory $CollectionFactory,Data $helperData)
    {
        $this->helperData = $helperData;
        $this->_CollectionFactory = $CollectionFactory;
        parent::__construct($context);
    }

    public function _prepareLayout(){
        $this->pageConfig->getTitle()->set(__('Simple Pagination'));
        if ($this->GetCollection()) {
            $pager = $this->getLayout()->createBlock(
                'Magento\Theme\Block\Html\Pager',
                'thong.helloworld.pager'
            )->setAvailableLimit(array(2=>2,4=>4))->setShowPerPage(true)->setCollection(
                $this->getCollection()
            );
            $this->setChild('pager', $pager);
            $this->getCollection()->load();
        }
        return parent::_prepareLayout();
    }

    public function LoadAllArticle()
    {
        return __($this->helperData->getGeneralConfig('display_text'));
    }

    public function GetCollection()
    {
        $article = $this->_CollectionFactory->create();
        $page = ($this->getRequest()->getParam('p')) ? $this->getRequest()->getParam('p') : 1;
        $pageSize = ($this->getRequest()->getParam('limit')) ? $this->getRequest()->getParam('limit') : 2;
        $articleCollection = $article;
        $articleCollection->setOrder('article_id');
        $articleCollection->setPageSize($pageSize);
        $articleCollection->setCurPage($page);
        return $articleCollection;
    }

    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }

}
