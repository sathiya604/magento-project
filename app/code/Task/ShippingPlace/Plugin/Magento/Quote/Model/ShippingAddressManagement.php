<?php
declare(strict_types=1);

namespace Task\ShippingPlace\Plugin\Magento\Quote\Model;

use Magento\Quote\Api\Data\AddressInterface;
use Task\ShippingPlace\Helper\Data;

class ShippingAddressManagement
{
    /**
     * @var Data
     */
    protected $helper;

    /**
     * ShippingAddressManagement constructor.
     *
     * @param Data $helper
     */
    public function __construct(
        Data $helper
    ) {
        $this->helper = $helper;
    }

    /**
     * @param \Magento\Quote\Model\ShippingAddressManagement $subject
     * @param $cartId
     * @param AddressInterface $address
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function beforeAssign(
        \Magento\Quote\Model\ShippingAddressManagement $subject,
        $cartId,
        AddressInterface $address
    ) {
        $extAttributes = $address->getExtensionAttributes();

        if (!empty($extAttributes)) {
            $this->helper->transportFieldsFromExtensionAttributesToObject(
                $extAttributes,
                $address,
                'extra_checkout_shipping_address_fields'
            );
        }
    }
}
