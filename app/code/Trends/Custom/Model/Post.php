<?php
namespace Trends\Custom\Model;

class Post extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'mageplaza_helloworld_post';

    protected $_cacheTag = 'mageplaza_helloworld_post';

    protected $_eventPrefix = 'mageplaza_helloworld_post';

    protected function _construct()
    {
        $this->_init('Trends\Custom\Model\ResourceModel\Post');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = "This is example for dependency Injection";

        return $values;
    }
}
