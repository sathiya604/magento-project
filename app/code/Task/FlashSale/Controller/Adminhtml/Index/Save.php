<?php
namespace Task\FlashSale\Controller\Adminhtml\Index;

class Save extends \Magento\Backend\App\Action
{
    protected $_salesFactory;
    protected $_itemFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Task\FlashSale\Model\SalesFactory $salesFactory,
        \Task\FlashSale\Model\ItemFactory $itemFactory
    ) {
        $this->_salesFactory = $salesFactory;
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
        $record = $this->getRequest()->getParam('dynamic_rows');

        if (!$data) {
            $this->_redirect('flashsale/index/index');
            return;
        }
        try {
            $rowData = $this->_salesFactory->create();
            $rowData->setData('flash_sale_name', $data['flash_sale_name']);
            $rowData->setData('start_date_time', $data['start_date_time']);
            $rowData->setData('end_date_time', $data['end_date_time']);
            $rowData->setData('discount_percent', $data['discount_percent']);
            $rowData->setData('max_discount_amount', $data['maximum_discount_amount']);
            $rowData->save();
            $primaryKey = $rowData->getFlashSaleId();
            if (is_array($record) && !empty($record)) {
                foreach ($record as $records) {
                    $itemData = $this->_itemFactory->create();
                    $itemData->setData('flash_sale_id', $primaryKey);
                    $itemData->setData('sku', $records['sku']);
                    $itemData->setData('qty', $records['qty']);
                    $itemData->setData('qty_left', $records['qty']);
                    $itemData->save();
                }
            } else {
                $this->messageManager->addError(__(print_r($data, true)));
            }
            $this->messageManager->addSuccess(__('Row data has been successfully saved.'));
        } catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }
        $this->_redirect("*/*/");
    }
}
