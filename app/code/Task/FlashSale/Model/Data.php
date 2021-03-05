<?php
namespace Task\FlashSale\Model;

use Task\FlashSale\Model\ResourceModel\Grid\CollectionFactory;
use Task\FlashSale\Model\ResourceModel\Grid\ItemCollectionFactory;
use Task\FlashSale\Model\ResourceModel\Grid\SalesCollectionFactory;

class Data extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    protected $_loadedData;
    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $flashSaleCollectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        SalesCollectionFactory $salesCollectionFactory,
        ItemCollectionFactory $flashSaleCollectionFactory,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->scollection = $flashSaleCollectionFactory->create();
        $this->collection = $salesCollectionFactory->create();
        $this->icollection = $collectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->_loadedData)) {
            return $this->_loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $flashsale) {
            $this->_loadedData[$flashsale->getId()]= $flashsale->getData();
            $value = $this->scollection->getItems();
            foreach ($value as $value) {
                if ($flashsale->getFlashSaleId() == $value->getFlashSaleId()) {
                    $this->_loadedData[$flashsale->getId()]['dynamic_rows'][] = $value->getData();
                }
            }
        }

        return $this->_loadedData;
    }
}
