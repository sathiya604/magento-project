<?php
namespace Task\FlashSale\Controller\Adminhtml\Index;

class EditSave extends \Magento\Backend\App\Action
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
            echo '<pre>' . print_r($result, true) . '</pre>';
            echo '<pre>' . print_r($dbArray, true) . '</pre>';
            echo '<pre>' . print_r($postArray, true) . '</pre>';
            echo '<pre>' . print_r($data, true) . '</pre>';
            exit();
            $rowData = $this->_salesFactory->create()->load($data['flash_sale_id']);
            $rowData->setIsActive($data['is_active'])->save();

            $record = $this->getRequest()->getParam('dynamic_rows');
            foreach ($record as $value) {
                if (empty($value['flash_sale_id'])) {
                    $itemData = $this->_itemFactory->create();
                    $itemData->setFlashSaleId($this->getRequest()->getParam('flash_sale_id'));
                    $itemData->setQtyLeft($value['qty']);
                    $itemData->addData($value)->save();
                }
            }

            $this->messageManager->addSuccess(__('Row data has been successfully saved.'));
            $this->_redirect('*/*/');
        }
    }
}
