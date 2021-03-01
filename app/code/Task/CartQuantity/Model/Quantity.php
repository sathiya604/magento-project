<?php
namespace Task\CartQuantity\Model;

class Quantity extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'task_cartQuantity';
    protected $_cacheTag = 'task_cartQuantity';
    protected $_eventPrefix = 'task_cartQuantity';

    protected function _construct()
    {
        $this->_init('Task\CartQuantity\Model\ResourceModel\Quantity');
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
