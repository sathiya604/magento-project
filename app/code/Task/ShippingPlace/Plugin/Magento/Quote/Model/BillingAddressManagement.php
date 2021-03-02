<?php
/**
 * Copyright © Experius B.V. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Task\ShippingPlace\Plugin\Magento\Quote\Model;

use Magento\Quote\Api\Data\AddressInterface;

class BillingAddressManagement
{
    /**
     * @var \Task\ShippingPlace\Helper\Data
     */
    protected $helper;

    /**
     * BillingAddressManagement constructor.
     *
     * @param \Task\ShippingPlace\Helper\Data $helper
     */
    public function __construct(
        \Task\ShippingPlace\Helper\Data $helper
    ) {
        $this->helper = $helper;
        $this->logger = $logger;
    }

    /**
     * @param \Magento\Quote\Model\BillingAddressManagement $subject
     * @param $cartId
     * @param AddressInterface $address
     * @param false $useForShipping
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function beforeAssign(
        \Magento\Quote\Model\BillingAddressManagement $subject,
        $cartId,
        AddressInterface $address
    ) {
        $extAttributes = $address->getExtensionAttributes();
        $this->logger->info($extAttributes->getShipTo());
        if (!empty($extAttributes)) {
            $this->helper->transportFieldsFromExtensionAttributesToObject(
                $extAttributes,
                $address,
                'extra_checkout_billing_address_fields'
            );
        }
    }
}
