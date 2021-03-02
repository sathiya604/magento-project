<?php
namespace TrendsAttribute\Feedback\Model;

class Feedback extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'trendsattribute_feedback_feedback';
    protected $_cacheTag = 'trendsattribute_feedback_feedback';
    protected $_eventPrefix = 'trendsattribute_feedback_feedback';

    protected function _construct()
    {
        $this->_init('TrendsAttribute\Feedback\Model\ResourceModel\Feedback');
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
