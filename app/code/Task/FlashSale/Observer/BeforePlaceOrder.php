<?php
namespace Task\FlashSale\Observer;

use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;

class BeforePlaceOrder implements ObserverInterface
{
    protected $logger;
    protected $collectionFactory;
    private $messageManager;
    protected $salesCollectionFactory;
    protected $itemCollectionFactory;

    public function __construct(
        \Magento\Framework\Message\ManagerInterface $messageManager,
        LoggerInterface $logger,
        \Task\FlashSale\Model\ResourceModel\Grid\SalesCollectionFactory $salesCollectionFactory,
        \Task\FlashSale\Model\ResourceModel\Grid\ItemCollectionFactory $itemCollectionFactory,
        \Task\FlashSale\Model\ResourceModel\Grid\CollectionFactory $collectionFactory,
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $dateTime
    ) {
        $this->logger = $logger;
        $this->collectionFactory = $collectionFactory;
        $this->salesCollectionFactory = $salesCollectionFactory;
        $this->itemCollectionFactory = $itemCollectionFactory;
        $this->messageManager = $messageManager;
        $this->dateTime = $dateTime;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $collection = $this->salesCollectionFactory->create()
                        ->addFieldToFilter('start_datetime', ['lteq' => $this->dateTime->date()->format('Y-m-d H:i:s')])
                        ->addFieldToFilter('end_datetime', ['gteq' => $this->dateTime->date()->format('Y-m-d H:i:s')])
                        ->addFieldToFilter('is_active', ['eq' => 1]);
        foreach ($collection as $value) {
            $activeFlashSale = $value['flash_sale_id'];
        }
        if (!empty($activeFlashSale) && isset($activeFlashSale)) {
            $product = $observer->getEvent()->getProduct();
            $sku = $product->getSku();
            $itemCollection = $this->itemCollectionFactory->create()
                            ->addFieldToFilter('flash_sale_id', ['eq' => $activeFlashSale])
                            ->addFieldToFilter('sku', ['eq' => $sku]);
            foreach ($itemCollection as $value) {
                $sku = $value['sku'];
            }
            if (!empty($sku) && isset($sku)) {
                $order = $observer->getEvent()->getOrder();
                $order->setIsFlashsale(1);
                $order->save();
            }
        }
    }
}
