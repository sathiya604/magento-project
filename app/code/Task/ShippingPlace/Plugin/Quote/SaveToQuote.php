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
        $this->logger->info($extAttributes->getShippingTo());
        $this->logger->info($cartId);

        $this->logger->info($ext->getShippingTo());
        $quote->setShippingTo($extAttributes->getShippingTo());
    }
}
