<?php
namespace TrendsAttribute\CustomSales\Model\ResourceModel\Post;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'id';
    protected $_eventPrefix = 'trendsattribute_customsales_collection';
    protected $_eventObject = 'salesorder_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('TrendsAttribute\CustomSales\Model\Post', 'Magento\Sales\Model\ResourceModel\Order');
    }

    protected function _initSelect()
    {
        parent::_initSelect();

        $this->getSelect()->join(
            ['second_table' => $this->getTable('sales_order_item')],
            'second_table.order_id = main_table.entity_id',
            ['sku' => 'sku']
        );
        return $this;
    }
}
