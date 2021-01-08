<?php
namespace TrendsAttribute\PageDetail\ViewModel;

use Magento\Cms\Api\PageRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;

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

    public function __construct(
        PageRepositoryInterface $pageRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->pageRepository = $pageRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
    * @return \Magento\Cms\Api\Data\PageInterface[]
    **/
    public function getItems()
    {
        $searchCriteria = $this->searchCriteriaBuilder->create();
        $pageSearchResult = $this->pageRepository->getList($searchCriteria);

        return $pageSearchResult->getItems();
    }
}
