<?php
namespace TrendsAttribute\PageDetail\ViewModel;

use Magento\Cms\Api\PageRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SortOrderBuilder;

class Page implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    /**
    * @var PageRepositoryInterface
    */
    private $pageRepository;
    /**
    * @var SearchCriteriaBuilder
    */
    private $searchCriteriaBuilder;
    private $sortOrderBuilder;

    public function __construct(
        PageRepositoryInterface $pageRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        SortOrderBuilder $sortOrderBuilder
    ) {
        $this->pageRepository = $pageRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->sortOrderBuilder = $sortOrderBuilder;
    }

    /**
    * @return \Magento\Cms\Api\Data\PageInterface[]
    **/
    public function getItems()
    {
        $sortOrder = $this->sortOrderBuilder->setField('title')->setDirection('ASC')->create();
        $searchCriteria = $this->searchCriteriaBuilder->setSortOrders([$sortOrder])->setPageSize(2)->create();
        $someCollection = $this->pageRepository->getList($searchCriteria);

        return $someCollection->getItems();
    }
}
