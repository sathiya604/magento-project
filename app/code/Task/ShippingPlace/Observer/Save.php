<?php
namespace Task\ShippingPlace\Observer;

class Save implements \Magento\Framework\Event\ObserverInterface
{
    protected $logger;

    public function __construct(\Psr\Log\LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();
        $quote = $observer->getEvent()->getQuote();
        $this->logger->info("from shipping observer");
        $this->logger->info($quote->getShippingTo());
        $order->setShippingTo('Work');

        return $this;
    }
}
