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
        foreach ($ext as $key => $value) {
            $this->logger->info($value);
        }

        $quote->setData('shipping_to', $extAttributes->getShippingTo());
        $this->quoteRepository->save($quote);
        $this->logger->info('saved');
        $this->logger->info($quote->getShippingTo());
    }
}
