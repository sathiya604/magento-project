<?php
namespace TrendsAttribute\AdminGrid\Model\ResourceModel\Collection;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'id';
    protected $_eventPrefix = 'trendsattribute_admingrid_collection';
    protected $_eventObject = 'feedback_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('TrendsAttribute\AdminGrid\Model\Feedback', 'TrendsAttribute\AdminGrid\Model\ResourceModel\Feedback');
    }
}
