<?php
/**
 * Copyright © Experius B.V. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Task\ShippingPlace\Plugin\Magento\Checkout\Model;

use Magento\Quote\Api\Data\AddressInterface;
use Magento\Quote\Api\Data\PaymentInterface;
use Task\ShippingPlace\Helper\Data;

class PaymentInformationManagement
{
    /**
     * @var Data
     */
    protected $helper;

    /**
     * PaymentInformationManagement constructor.
     *
     * @param Data $helper
     */
    public function __construct(
        Data $helper
    ) {
        $this->helper = $helper;
    }

    /**
     * @param \Magento\Checkout\Model\PaymentInformationManagement $subject
     * @param $cartId
     * @param PaymentInterface $paymentMethod
     * @param AddressInterface $address
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function beforeSavePaymentInformation(
        \Magento\Checkout\Model\PaymentInformationManagement $subject,
        $cartId,
        PaymentInterface $paymentMethod,
        AddressInterface $address
    ) {
        $extAttributes = $address->getExtensionAttributes();
        if (!empty($extAttributes)) {
            $this->helper->transportFieldsFromExtensionAttributesToObject(
                $extAttributes,
                $address,
                'extra_checkout_billing_address_fields'
            );
        }
    }
}
