<?php
namespace Task\ShippingPlace\Api\Data;

/**
 * ExtensionInterface class for @see \Magento\Checkout\Api\Data\ShippingInformationInterface
 */
interface ShippingInformationExtensionInterface extends \Magento\Framework\Api\ExtensionAttributesInterface
{
    /**
     * @return string|null
     */
    public function getShippingTo();

    /**
     * @param string $shippingTo
     * @return $this
     */
    public function setShippingTo($shippingTo);
}
