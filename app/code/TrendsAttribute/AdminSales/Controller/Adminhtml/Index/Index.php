<?php
namespace TrendsAttribute\AdminSales\Controller\Adminhtml\Index;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory
    ) {
        $this->_pageFactory = $pageFactory;

        return parent::__construct($context);
    }

    public function execute()
    {
        $resultPage = $this->_pageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__('Custom Sales using UI Component'));
        $resultPage->addBreadCrumb(__('AdminSales'), __('Sales Order'));

        return $resultPage;
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('TrendsAttribute_AdminSales::productsales');
    }
}
