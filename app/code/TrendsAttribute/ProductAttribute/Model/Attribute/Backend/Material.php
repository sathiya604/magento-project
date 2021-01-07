<?php
namespace TrendsAttribute\ProductAttribute\Model\Attribute\Backend;

/**
 * Backend validation for attribute
 */
class Material extends \Magento\Eav\Model\Entity\Attribute\Backend\AbstractBackend
{
    /**
     * Validate
     * @param \Magento\Catalog\Model\Product $object
     * @throws \Magento\Framework\Exception\LocalizedException
     * @return bool
     */
    public function validate($object)
    {
        $value = $object->getData($this->getAttribute()->getAttributeCode());
        if (($object->getAttributeSetId() == 4) && ($value == 'wool')) {
            throw new \Magento\Framework\Exception\LocalizedException(
                __('Bottom can not be wool.')
            );
        }
        return true;
    }
}
