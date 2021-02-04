<?php
namespace TrendsAttribute\SchemaCreation\Model;

class Author extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'trendsattribute_schemacreation_author';
    protected $_cacheTag = 'trendsattribute_schemacreation_author';
    protected $_eventPrefix = 'trendsattribute_schemacreation_author';

    protected function _construct()
    {
        $this->_init('TrendsAttribute\SchemaCreation\Model\ResourceModel\Author');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }
}
