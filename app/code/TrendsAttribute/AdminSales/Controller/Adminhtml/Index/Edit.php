<?php
namespace TrendsAttribute\AdminSales\Controller\Adminhtml\Index;

use Magento\Framework\Controller\ResultFactory;

use TrendsAttribute\AdminSales\Model\ResourceModel\Grid\CollectionFactory;

class Edit extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\Registry
     */
    private $coreRegistry;

    protected $_itemFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry,
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \TrendsAttribute\AdminSales\Model\ItemFactory $itemFactory,
        CollectionFactory $collectionFactory
    ) {
        parent::__construct($context);
        $this->coreRegistry = $coreRegistry;
        $this->_itemFactory = $itemFactory;
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * Mapped Grid List page.
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $rowId = (int) $this->getRequest()->getParam('item_id');
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        if ($rowId) {
            $collection =$this->collectionFactory->create()->addFieldToFilter('item_id', ['eq' => $rowId]);
            $collectionSize = $collection->getSize();
            foreach ($collection as $item) {
                $rowData = $item;
            }
            if (!$rowData->getId()) {
                $this->messageManager->addError(__('row data no longer exist.'));
                $this->_redirect('adminsales/index');
                return;
            }
        }

        $this->coreRegistry->register('row_data', $rowData);
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $title = $rowId ? __('Edit Row Data ') : __('Add Row Data');
        $resultPage->getConfig()->getTitle()->prepend($title);
        return $resultPage;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('TrendsAttribute_AdminSales::productsales');
    }
}
