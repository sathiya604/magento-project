<?php
namespace TrendsAttribute\SchemaCreation\Model\ResourceModel\Author;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'id';
    protected $_eventPrefix = 'trendsattribute_schemacreation_collection';
    protected $_eventObject = 'author_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('TrendsAttribute\SchemaCreation\Model\Author', 'TrendsAttribute\SchemaCreation\Model\ResourceModel\Author');
    }
}
