<?php
namespace TrendsAttribute\Cron\Observer;

use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;

class Orderplaceafter implements ObserverInterface
{
    protected $logger;
    public $coreRegistry;

    public function __construct(
        LoggerInterface $logger,
        \Magento\Framework\Registry $coreRegistry
    ) {
        $this->logger = $logger;
        $this->coreRegistry = $coreRegistry;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        try {
            $order = $observer->getEvent()->getOrder();
            $this->coreRegistry->register('orderId', $order->getIncrementId());
            $this->logger->info("Log from observer");
            $this->logger->info($this->coreRegistry->registry('orderId'));
        } catch (\Exception $e) {
            $this->logger->info($e->getMessage());
        }
    }
}
