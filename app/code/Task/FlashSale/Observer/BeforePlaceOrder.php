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
    protected $_itemFactory;

    public function __construct(
        \Magento\Framework\Message\ManagerInterface $messageManager,
        LoggerInterface $logger,
        \Task\FlashSale\Model\ResourceModel\Grid\SalesCollectionFactory $salesCollectionFactory,
        \Task\FlashSale\Model\ResourceModel\Grid\ItemCollectionFactory $itemCollectionFactory,
        \Task\FlashSale\Model\ResourceModel\Grid\CollectionFactory $collectionFactory,
        \Task\FlashSale\Model\ItemFactory $itemFactory,
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $dateTime
    ) {
        $this->logger = $logger;
        $this->collectionFactory = $collectionFactory;
        $this->salesCollectionFactory = $salesCollectionFactory;
        $this->itemCollectionFactory = $itemCollectionFactory;
        $this->messageManager = $messageManager;
        $this->dateTime = $dateTime;
        $this->_itemFactory = $itemFactory;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();
        $collection = $this->salesCollectionFactory->create()
                        ->addFieldToFilter('start_datetime', ['lteq' => $this->dateTime->date()->format('Y-m-d H:i:s')])
                        ->addFieldToFilter('end_datetime', ['gteq' => $this->dateTime->date()->format('Y-m-d H:i:s')])
                        ->addFieldToFilter('is_active', ['eq' => 1]);
        foreach ($collection as $value) {
            $activeFlashSale = $value['flash_sale_id'];
            $discountPercent = $value['discount_percent'];
            $maxDiscount = $value['max_discount_amount'];
            $this->logger->info($value['flash_sale_id']);
        }

        foreach ($order->getAllItems() as $item) {
            $itemCollection = $this->itemCollectionFactory->create()
                            ->addFieldToFilter('flash_sale_id', ['eq' => $activeFlashSale])
                            ->addFieldToFilter('sku', ['eq' => $item->getSku()]);
            foreach ($itemCollection as $value) {
                $flashSaleItemId = $value['flash_sale_item_id'];
                $qtyLeft = $value['qty_left'];
                $qtyOrdered = $value['qty_ordered'];
                $orderSku = $value['sku'];
                $this->logger->info($value['sku']);
                $this->logger->info($value['qty_left']);
            }

            if (!empty($activeFlashSale) && isset($activeFlashSale) && !empty($orderSku) && isset($orderSku)) {
                $rowData = $this->_itemFactory->create()->load($flashSaleItemId);
                $rowData->setQtyLeft($qtyLeft - $item->getQtyOrdered())->save();
                $rowData->setQtyOrdered($qtyOrdered + $item->getQtyOrdered())->save();
                $order->setIsFlashsale(1);
                $order->save();
            }
        }
    }
}
