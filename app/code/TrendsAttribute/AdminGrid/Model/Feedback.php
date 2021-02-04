<?php
namespace TrendsAttribute\AdminGrid\Model;

class Feedback extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'trendsattribute_admingrid_feedback';
    protected $_cacheTag = 'trendsattribute_admingrid_feedback';
    protected $_eventPrefix = 'trendsattribute_admingrid_feedback';

    protected function _construct()
    {
        $this->_init('TrendsAttribute\AdminGrid\Model\ResourceModel\Feedback');
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
