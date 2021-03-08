<?php
namespace Task\FlashSale\Controller\Adminhtml\Index;

class Save extends \Magento\Backend\App\Action
{
    protected $_salesFactory;
    protected $_itemFactory;
    protected $flashSaleCollectionFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Task\FlashSale\Model\SalesFactory $salesFactory,
        \Task\FlashSale\Model\ItemFactory $itemFactory,
        \Task\FlashSale\Model\ResourceModel\Grid\CollectionFactory $flashSaleCollectionFactory
    ) {
        $this->_salesFactory = $salesFactory;
        $this->_itemFactory = $itemFactory;
        $this->flashSaleCollectionFactory = $flashSaleCollectionFactory;
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
            $collection = $this->flashSaleCollectionFactory->create()
                            ->addFieldToFilter('start_datetime', ['lteq' => $data['end_datetime']])
                            ->addFieldToFilter('end_datetime', ['gteq' => $data['start_datetime']]);

            if (!empty($collection)) {
                foreach ($collection as $value) {
                    if ($value['is_active'] == 1) {
                        $message = $value['flash_sale_name'] . " Already Exists In The Given Time";
                        throw new \Magento\Framework\Exception\LocalizedException(__($message));
                    }
                }
            }

            $rowData = $this->_salesFactory->create();
            $rowData->setData('flash_sale_name', $data['flash_sale_name']);
            $rowData->setData('start_datetime', $data['start_datetime']);
            $rowData->setData('end_datetime', $data['end_datetime']);
            $rowData->setData('discount_percent', $data['discount_percent']);
            $rowData->setData('max_discount_amount', $data['max_discount_amount']);
            $rowData->save();
            $primaryKey = $rowData->getFlashSaleId();
            if (is_array($record) && !empty($record)) {
                foreach ($record as $records) {
                    $itemData = $this->_itemFactory->create();
                    $itemData->setData('flash_sale_id', $primaryKey);
                    $itemData->setData('sku', $records['sku']);
                    $itemData->setData('qty_left', $records['qty_left']);
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
