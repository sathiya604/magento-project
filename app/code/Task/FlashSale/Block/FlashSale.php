<?php
namespace Task\FlashSale\Block;

class FlashSale extends \Magento\Framework\View\Element\Template
{
    protected $salesCollectionFactory;
    protected $flashSaleCollectionFactory;
    protected $itemCollectionFactory;
    protected $dateTime;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Task\FlashSale\Model\ResourceModel\Grid\CollectionFactory $flashSaleCollectionFactory,
        \Task\FlashSale\Model\ResourceModel\Grid\ItemCollectionFactory $itemCollectionFactory,
        \Task\FlashSale\Model\ResourceModel\Grid\SalesCollectionFactory $salesCollectionFactory,
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $dateTime
    ) {
        $this->salesCollectionFactory = $salesCollectionFactory;
        $this->itemCollectionFactory = $itemCollectionFactory;
        $this->flashSaleCollectionFactory = $flashSaleCollectionFactory;
        $this->dateTime = $dateTime;
        parent::__construct($context);
    }

    public function flashSaleDetails()
    {
        $collection = $this->salesCollectionFactory->create()
                            ->addFieldToFilter('start_datetime', ['lteq' => $this->dateTime->date()->format('Y-m-d H:i:s')])
                            ->addFieldToFilter('end_datetime', ['gteq' => $this->dateTime->date()->format('Y-m-d H:i:s')])
                            ->addFieldToFilter('is_active', ['eq' => 1]);
        $flashSale = $collection->getData();

        return $flashSale;
    }

    public function flashSaleItems()
    {
        $collection = $this->flashSaleCollectionFactory->create()
                          ->addFieldToFilter('start_datetime', ['lteq' => $this->dateTime->date()->format('Y-m-d H:i:s')])
                          ->addFieldToFilter('end_datetime', ['gteq' => $this->dateTime->date()->format('Y-m-d H:i:s')])
                          ->addFieldToFilter('is_active', ['eq' => 1]);
        $flashSale = $collection->getData();

        return $flashSale;
    }

    public function flashSaleRemainingTime()
    {
        $collection = $this->salesCollectionFactory->create()
                          ->addFieldToFilter('start_datetime', ['lteq' => $this->dateTime->date()->format('Y-m-d H:i:s')])
                          ->addFieldToFilter('end_datetime', ['gteq' => $this->dateTime->date()->format('Y-m-d H:i:s')])
                          ->addFieldToFilter('is_active', ['eq' => 1]);
        $flashSale = $collection->getData();

        $endTime =  strtotime($flashSale[0]['end_datetime']);
        $currentTime = strtotime($this->dateTime->date()->format('Y-m-d H:i:s'));

        return ceil(($endTime - $currentTime)/60);
    }
}
