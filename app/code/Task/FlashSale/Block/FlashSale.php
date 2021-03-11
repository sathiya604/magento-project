<?php
namespace Task\FlashSale\Block;

class FlashSale extends \Magento\Framework\View\Element\Template
{
    protected $salesCollectionFactory;
    protected $flashSaleCollectionFactory;
    protected $itemCollectionFactory;
    protected $dateTime;
    protected $registry;
    public $flashSale;
    protected $_productloader;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Task\FlashSale\Model\ResourceModel\Grid\CollectionFactory $flashSaleCollectionFactory,
        \Task\FlashSale\Model\ResourceModel\Grid\ItemCollectionFactory $itemCollectionFactory,
        \Task\FlashSale\Model\ResourceModel\Grid\SalesCollectionFactory $salesCollectionFactory,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $dateTime,
        \Magento\Catalog\Model\ProductFactory $_productloader
    ) {
        $this->salesCollectionFactory = $salesCollectionFactory;
        $this->itemCollectionFactory = $itemCollectionFactory;
        $this->flashSaleCollectionFactory = $flashSaleCollectionFactory;
        $this->dateTime = $dateTime;
        $this->registry = $registry;
        $this->_productloader = $_productloader;
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
        $this->flashSale = $collection->getData();

        return $this->flashSale;
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

        return ceil(($endTime - $currentTime));
    }

    /**
    * @return \Magento\Catalog\Model\Product
    */
    public function getCurrentProduct()
    {
        return $this->registry->registry('current_product');
    }

    public function getLoadProduct($id)
    {
        return $this->_productloader->create()->load($id);
    }

    public function getConfigurableProduct()
    {
        $product = $this->getCurrentProduct();
        $i =0;
        if ($product->getTypeId() == "configurable") {
            $productTypeInstance = $product->getTypeInstance();
            $usedProducts = $productTypeInstance->getUsedProducts($product);
            foreach ($usedProducts as  $value) {
                foreach ($this->flashSaleItems() as $flashSku) {
                    if ($value->getSku() == $flashSku['sku']) {
                        $sku[$i]['sku'] = $value->getSku();
                        $sku[$i]['finalprice'] = $value->getFinalPrice();
                    }
                }
                $i++;
            }
        }

        return $sku;
    }

    public function getGroupedProduct()
    {
        $i = 0;
        $product = $this->getCurrentProduct();
        if ($product->getTypeId() == "grouped") {
            $products = $product->getTypeInstance()->getAssociatedProducts($product);
            foreach ($products as $value) {
                foreach ($this->flashSaleItems() as $flashSku) {
                    if ($value->getSku() == $flashSku['sku']) {
                        $sku[$i]['sku'] = $value->getSku();
                        $sku[$i]['finalprice'] = $value->getFinalPrice();
                    }
                }
                $i++;
            }
        }

        return $sku;
    }

    public function getBundleProduct()
    {
        $i = 0;
        $product = $this->getCurrentProduct();
        if ($product->getTypeId() == "bundle") {
            $products = $product->getTypeInstance()->getChildrenIds($product->getId());
            foreach ($products as $key => $value) {
                foreach ($value as $value) {
                    $product=$this->getLoadProduct($value);
                    foreach ($this->flashSaleItems() as $flashSku) {
                        if ($product->getSku() == $flashSku['sku']) {
                            $sku[$i]['sku'] = $product->getSku();
                            $sku[$i]['finalprice'] = $product->getFinalPrice();
                        }
                    }
                    $i++;
                }
            }

            return $sku;
        }
    }
}
