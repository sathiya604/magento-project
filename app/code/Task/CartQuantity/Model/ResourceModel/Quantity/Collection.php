<?php
namespace Task\CartQuantity\Model\ResourceModel\Quantity;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'id';
    protected $_eventPrefix = 'task_cartquantity_collection';
    protected $_eventObject = 'task_collection_cart';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Task\CartQuantity\Model\Quantity', 'Task\CartQuantity\Model\ResourceModel\Quantity');
    }
}
