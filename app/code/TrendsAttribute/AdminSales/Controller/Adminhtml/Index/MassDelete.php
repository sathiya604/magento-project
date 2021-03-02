<?php
namespace TrendsAttribute\AdminSales\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use TrendsAttribute\AdminSales\Model\ResourceModel\Grid\CollectionFactory;

class MassDelete extends \Magento\Backend\App\Action
{
    protected $_filter;
    protected $serviceFactory;

    public function __construct(
        Context $context,
        Filter $filter,
        \TrendsAttribute\AdminSales\Model\Item $serviceFactory,
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
            $row = $this->serviceFactory->load($item->getItemId());
            if ($item->getChangeStatus() == 'Active') {
                $row->setData("change_status", 'Inactive');
                $row->save();
            } elseif ($item->getChangeStatus() == 'Inactive') {
                $row->setData("change_status", 'Active');
                $row->save();
            }
        }

        $this->messageManager->addSuccess(__('A total of %1 element(s) have been Activated/Deactivated.', $collectionSize));
        $this->_redirect("*/*/");
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('TrendsAttribute_AdminSales::productsales');
    }
}
