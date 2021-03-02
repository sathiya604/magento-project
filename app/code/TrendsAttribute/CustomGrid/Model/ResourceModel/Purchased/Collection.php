<?php
namespace TrendsAttribute\CustomGrid\Model\ResourceModel\Purchased;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'item_id';
    public function _construct()
    {
        $this->_init('TrendsAttribute\CustomGrid\Model\Purchased', 'TrendsAttribute\CustomGrid\Model\ResourceModel\Purchased');
    }
}
