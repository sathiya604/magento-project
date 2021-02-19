<?php
namespace Task\ShippingPlace\Plugin\Quote;

use Magento\Quote\Model\QuoteRepository;

class SaveToQuote
{
    protected $quoteRepository;

    public function __construct(\Psr\Log\LoggerInterface $logger, QuoteRepository $quoteRepository)
    {
        $this->quoteRepository = $quoteRepository;
        $this->logger = $logger;
    }

    public function beforeSaveAddressInformation(
        \Magento\Checkout\Model\ShippingInformationManagement $subject,
        $cartId,
        \Magento\Checkout\Api\Data\ShippingInformationInterface $addressInformation
    ) {
        if (!$extAttributes = $addressInformation->getExtensionAttributes()) {
            return;
        }

        $quote = $this->quoteRepository->getActive($cartId);
        $ext = $addressInformation->getExtensionAttributes();
        $value = $addressInformation->getShippingAddress();
        $ship = $value->getCustomAttributes(); // giving empty array but payload has value , Able to access other values like firstName ..
        if (is_array($ship)) {
            $this->logger->info(print_r($ship, true));
        } else {
            $this->logger->info("No ");
        }

        $this->logger->info("address info ");
        $this->logger->info($addressInformation->getFirstName());
        $this->logger->info($cartId);
        $quote->setData('shipping_to', $extAttributes->getShippingTo());
        $this->quoteRepository->save($quote);
        $this->logger->info('saved');
        $this->logger->info($quote->getShippingTo());
    }
}
