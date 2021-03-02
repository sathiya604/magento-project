<?php
namespace Task\CartQuantity\Observer;

use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;

class Orderplaceafter implements ObserverInterface
{
    protected $logger;
    protected $collectionFactory;
    private $messageManager;

    public function __construct(
        \Magento\Framework\Message\ManagerInterface $messageManager,
        LoggerInterface $logger,
        \Task\CartQuantity\Model\QuantityFactory $collectionFactory
    ) {
        $this->logger = $logger;
        $this->collectionFactory = $collectionFactory;
        $this->messageManager = $messageManager;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();

        foreach ($order->getAllItems() as $item) {
            $sku = $item->getSku();
            $this->logger->info($item->getSku());

            $collect = $this->collectionFactory->create();
            $product = $collect->getCollection()->addFieldToFilter('sku', ['eq' => $sku]);

            foreach ($product as $value) {
                $qty = $value['qty'];
                if ($qty > 0 && $item->getQtyOrdered() > $qty) {
                    $message = "Only " . $qty . " is allowed quantity for the Product " . $item->getSku() . " Please change the quantity and try again later.";

                    throw new \Magento\Framework\Exception\LocalizedException(__($message));
                }
            }
        }
    }
}
