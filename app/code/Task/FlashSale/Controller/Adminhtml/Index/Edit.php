<?php
namespace Task\FlashSale\Controller\Adminhtml\Index;

use Magento\Framework\Controller\ResultFactory;
use Task\FlashSale\Model\ResourceModel\Grid\CollectionFactory;
use Task\FlashSale\Model\ResourceModel\Grid\ItemCollectionFactory;

class Edit extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\Registry
     */
    private $coreRegistry;
    protected $value;
    protected $_itemFactory;
    protected $itemCollectionFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry,
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Task\FlashSale\Model\ItemFactory $itemFactory,
        CollectionFactory $collectionFactory,
        \Task\FlashSale\Model\Data $value,
        ItemCollectionFactory $itemCollectionFactory
    ) {
        parent::__construct($context);
        $this->coreRegistry = $coreRegistry;
        $this->_itemFactory = $itemFactory;
        $this->value = $value;
        $this->itemCollectionFactory = $itemCollectionFactory;
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * Mapped Grid List page.
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $title = "Edit Flash Sale";
        $resultPage->getConfig()->getTitle()->prepend($title);

        return $resultPage;
    }
}
