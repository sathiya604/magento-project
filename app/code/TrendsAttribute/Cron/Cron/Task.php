<?php
namespace TrendsAttribute\Cron\Cron;

use Psr\Log\LoggerInterface;

class Task
{
    protected $logger;
    private $orderRepository;
    public $coreRegistry;

    public function __construct(
        LoggerInterface $logger,
        \TrendsAttribute\AdminSales\Model\ResourceModel\Grid\CollectionFactory $orderRepository,
        \TrendsAttribute\Cron\Model\SalesFactory $customFactory,
        \TrendsAttribute\Cron\Model\OrderFactory $salesFactory,
        \Magento\Framework\Registry $coreRegistry
    ) {
        $this->coreRegistry = $coreRegistry;
        $this->logger = $logger;
        $this->orderRepository = $orderRepository;
        $this->customFactory = $customFactory;
        $this->salesFactory = $salesFactory;
    }

    /**
      * Write to system.log
      *
      * @return void
    */

    public function execute()
    {
        $values = $this->orderRepository->create()->addFieldToFilter('export', ['eq' => 0]);
        foreach ($values as $key => $value) {
            $sales = $this->customFactory->create();
            try {
                $sales->addData([
                    "item_id" => $value['item_id'],
                    "increment_id" => $value['increment_id'],
                    "customer_email" => $value['customer_email'],
                    "sku" => $value['sku'],
                    "clothing_material" => $value['clothing_material'],
                    "change_status" => $value['change_status'],
              ]);

                $saveData = $sales->save();
                if ($saveData) {
                    $order = $this->salesFactory->create()->load($value['entity_id']);
                    $order->setData('export', 1)->save();
                    $this->logger->info('Inserted Record Successfully !');
                }
            } catch (\Exception $e) {
                $this->logger->info($e);
            }
        }
    }
}
