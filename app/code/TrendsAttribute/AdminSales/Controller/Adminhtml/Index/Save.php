<?php
namespace TrendsAttribute\AdminSales\Controller\Adminhtml\Index;

class Save extends \Magento\Backend\App\Action
{
    protected $_itemFactory;
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \TrendsAttribute\AdminSales\Model\ItemFactory $itemFactory
    ) {
        $this->_itemFactory = $itemFactory;
        parent::__construct($context);
    }
    /**
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();

        if (!$data) {
            $this->_redirect('adminsales/index/index');
            return;
        }
        try {
            $rowData = $this->_itemFactory->create()->load($data['item_id']);

            if (!$rowData->getId()) {
                $this->messageManager->addError(__('row data no longer exist.'));
                $this->_redirect('adminsales/index/index');
                return;
            }
            $rowData->setData('change_status', $data['change_status']);
            $rowData->save();
            $this->messageManager->addSuccess(__('Row data has been successfully saved.'));
        } catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }
        $this->_redirect('adminsales/index');
    }
}
