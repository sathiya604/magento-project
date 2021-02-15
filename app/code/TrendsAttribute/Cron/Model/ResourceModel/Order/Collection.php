<?php
namespace TrendsAttribute\Cron\Model\ResourceModel\Order;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'entity_id';
    protected $_eventPrefix = 'trendsattribute_order_collection';
    protected $_eventObject = 'cron_collection_order';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('TrendsAttribute\Cron\Model\Order', 'TrendsAttribute\Cron\Model\ResourceModel\Order');
    }
}
