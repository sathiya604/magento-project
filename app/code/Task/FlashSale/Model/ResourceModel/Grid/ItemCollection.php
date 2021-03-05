<?php
namespace Task\FlashSale\Model\ResourceModel\Grid;

class ItemCollection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'flash_sale_item_id';
    protected $_eventPrefix = 'task_sales_item_collection';
    protected $_eventObject = 'flashsale_item_collection_ui';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Task\FlashSale\Model\Item', 'Task\FlashSale\Model\ResourceModel\Item');
    }
}
