<?php
namespace TrendsAttribue\ViewModel\Model\ResourceModel\Author;

/**
 * Class Collection
 * @package TrendsAttribue\ViewModel\Model\ResourceModel\Author
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     *
     * @see \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection::_construct()
     */
    protected function _construct()
    {
        $this->_init('TrendsAttribue\ViewModel\Model\Review', 'TrendsAttribue\ViewModel\Model\ResourceModel\Review');
    }
}
