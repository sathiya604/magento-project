<?php
namespace Task\FlashSale\Controller\Adminhtml\Index;

class EditSave extends \Magento\Backend\App\Action
{
    protected $_salesFactory;
    protected $_itemFactory;
    protected $flashSaleCollectionFactory;
    protected $_salesCollectionFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Task\FlashSale\Model\SalesFactory $salesFactory,
        \Task\FlashSale\Model\ItemFactory $itemFactory,
        \Task\FlashSale\Model\ResourceModel\Grid\SalesCollectionFactory $salesCollectionFactory,
        \Task\FlashSale\Model\ResourceModel\Grid\CollectionFactory $flashSaleCollectionFactory
    ) {
        $this->_salesFactory = $salesFactory;
        $this->_salesCollectionFactory = $salesCollectionFactory;
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
        try {
            if ($this->getRequest()->getParam('flash_sale_id')) {
                $data = $this->getRequest()->getPostValue();
                $record = $this->getRequest()->getParam('dynamic_rows');
                $itemData = $this->flashSaleCollectionFactory->create()->addFieldToFilter('second_table.flash_sale_id', ['eq', $data['flash_sale_id']]);

                foreach ($itemData as $value) {
                    $dbArray[] = $value['flash_sale_item_id'] . "<br>";
                }
                foreach ($record as $value) {
                    if (isset($value['flash_sale_item_id'])) {
                        $postArray[] = $value['flash_sale_item_id'] . "<br>";
                    }
                }
                $result=array_diff($dbArray, $postArray);
                foreach ($result as $value) {
                    $rowData = $this->_itemFactory->create()->load($value);     //detele row set qty to 0
                    $rowData->setQtyLeft(0)->save();
                }
                if (isset($value['flash_sale_item_id'])) {
                    foreach ($record as $value) {
                        $update = $this->_itemFactory->create()->load($value['flash_sale_item_id']);            //update qty
                        $update->setQtyLeft($value['qty_left'])->save();
                    }
                }

                //flash sale edit
                $collection = $this->_salesCollectionFactory->create()
                                  ->addFieldToFilter('start_datetime', ['lteq' => $data['end_datetime']])
                                  ->addFieldToFilter('end_datetime', ['gteq' => $data['start_datetime']])
                                  ->addFieldToFilter('flash_sale_id', ['neq' => $this->getRequest()->getParam('flash_sale_id')]);

                if (!empty($collection)) {
                    foreach ($collection as $value) {
                        if ($value['is_active'] == 1) {
                            $message = $value['flash_sale_name'] . " Already Exists In The Given Time!! Disable the " . $value['flash_sale_name'] . " Flash Sale and try again";
                            throw new \Magento\Framework\Exception\LocalizedException(__($message));
                        }
                    }
                }
                $rowData = $this->_salesFactory->create()->load($data['flash_sale_id']);   //flash sale edit
                $rowData->setData($data)->save();

                $record = $this->getRequest()->getParam('dynamic_rows');   //add new sku
                foreach ($record as $value) {
                    if (empty($value['flash_sale_id'])) {
                        $collection = $this->flashSalesCollectionFactory->create()
                                        ->addFieldToFilter('sku', ['eq' => $value['sku']])
                                        ->addFieldToFilter('second_table.flash_sale_id', ['eq' => $this->getRequest()->getParam('flash_sale_id')]);
                        foreach ($collection as $value) {
                            $sku = $value['sku'];
                        }
                        if (empty($sku)) {
                            $itemData = $this->_itemFactory->create();
                            $itemData->setFlashSaleId($this->getRequest()->getParam('flash_sale_id'));
                            $itemData->addData($value)->save();
                        } else {
                            throw new \Magento\Framework\Exception\LocalizedException(__($sku . " Already Exists !! Kindly update the quantity"));
                        }
                    }
                }

                $this->messageManager->addSuccess(__('Row data has been successfully saved.'));
            }
        } catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }
        $this->_redirect('*/*/edit/flash_sale_id/' . $this->getRequest()->getParam('flash_sale_id'));
    }
}
