<?php
namespace TrendsAttribute\AdminSales\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Ui\Component\MassAction\Filter;
use TrendsAttribute\AdminSales\Model\ResourceModel\Grid\CollectionFactory;

class MassDelete extends \Magento\Backend\App\Action
{
    protected $_filter;
    protected $serviceFactory;

    public function __construct(
        Context $context,
        Filter $filter,
        \TrendsAttribute\AdminSales\Model\SalesFactory $serviceFactory,
        CollectionFactory $collectionFactory
    ) {
        $this->_filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->serviceFactory = $serviceFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $collection = $this->_filter->getCollection($this->collectionFactory->create());
        $collectionSize = $collection->getSize();
        foreach ($collection as $item) {
            $item = $this->serviceFactory->create()->load($item->getOrderId());
            $item->setChangeStatus('InActive');
        }

        $this->messageManager->addSuccess(__('A total of %1 element(s) have been deleted.', $collectionSize));
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('adminsales/index/index');
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('TrendsAttribute_AdminSales::productsales');
    }
}
