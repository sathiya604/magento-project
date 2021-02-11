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
        \Magento\Framework\Registry $coreRegistry
    ) {
        $this->coreRegistry = $coreRegistry;
        $this->logger = $logger;
        $this->orderRepository = $orderRepository;
        $this->customFactory = $customFactory;
    }

    /**
      * Write to system.log
      *
      * @return void
    */

    public function execute()
    {
        $id = $this->coreRegistry->registry('orderId');
        $this->logger->info('log from cron');
        $this->logger->info($id);
        exit();
        $values = $this->orderRepository->create()->addFieldToFilter('increment_id', ['eq' => '000000173']);
        foreach ($values as $key => $value) {
            $sales = $this->customFactory->create();
            $sales->addData([
                  "increment_id" => $value['increment_id'],
                  "customer_email" => $value['customer_email'],
                  "sku" => $value['sku'],
                  "clothing_material" => $value['clothing_material'],
                  "change_status" => $value['change_status'],
            ]);

            $saveData = $sales->save();
            if ($saveData) {
                $this->logger->info('Inserted Record Successfully !');
            }
        }
    }
}
