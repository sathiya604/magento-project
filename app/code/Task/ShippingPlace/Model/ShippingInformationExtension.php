<?php
namespace Task\ShippingPlace\Model;

use Task\ShippingPlace\Api\Data\ShippingInformationExtensionInterface;

/**
 * Extension class for @see \Magento\Checkout\Api\Data\ShippingInformationInterface
 */
class ShippingInformationExtension extends \Magento\Framework\Api\AbstractSimpleObject implements ShippingInformationExtensionInterface
{
    /**
     * @return string|null
     */
    public function getShippingTo()
    {
        return $this->_get('shipping_to');
    }

    /**
     * @param string $shippingTo
     * @return $this
     */
    public function setShippingTo($shippingTo)
    {
        $this->setData('shipping_to', $shippingTo);
        return $this;
    }
}
