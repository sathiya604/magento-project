<?php
namespace TrendsAttribute\Cron\Model\ResourceModel\Sales;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'item_id';
    protected $_eventPrefix = 'trendsattribute_cron_collection';
    protected $_eventObject = 'cron_collection_ui';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('TrendsAttribute\Cron\Model\Sales', 'TrendsAttribute\Cron\Model\ResourceModel\Sales');
    }
}
