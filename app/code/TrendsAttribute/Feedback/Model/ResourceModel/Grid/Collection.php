<?php
namespace TrendsAttribute\Feedback\Model\ResourceModel\Grid;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'id';
    protected $_eventPrefix = 'trendsattribute_feedback_collection';
    protected $_eventObject = 'feedback_collection_ui';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('TrendsAttribute\Feedback\Model\Feedback', 'TrendsAttribute\Feedback\Model\ResourceModel\Feedback');
    }
}
