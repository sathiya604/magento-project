<?php
namespace Task\FlashSale\Model;

use Task\FlashSale\Model\ResourceModel\Grid\CollectionFactory;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
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
        CollectionFactory $flashSaleCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $flashSaleCollectionFactory->create();
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
            $this->_loadedData[$flashsale->getFlashSaleId()] = $flashsale->getData();
        }

        return $this->_loadedData;
    }
}
