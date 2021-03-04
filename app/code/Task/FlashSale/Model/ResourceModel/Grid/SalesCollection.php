<?php
namespace Task\FlashSale\Model\ResourceModel\Grid;

class SalesCollection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'flash_sale_id';
    protected $_eventPrefix = 'task_sales_collection';
    protected $_eventObject = 'flashsale_collection_ui';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Task\FlashSale\Model\Sales', 'Task\FlashSale\Model\ResourceModel\Sales');
    }
}
