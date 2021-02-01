<?php
namespace TrendsAttribute\AdminSales\Ui\Component\Listing\Column;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use TrendsAttribute\AdminSales\Block\Adminhtml\Module\Grid\Renderer\Action\UrlBuilder;

class Actions extends Column
{
    /** Url path */
    const URL_PATH_EDIT = 'adminsales/index/edit';
    /** @var UrlBuilder */
    protected $actionUrlBuilder;
    /** @var UrlInterface */
    protected $urlBuilder;
    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlBuilder $actionUrlBuilder
     * @param UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     */
    public function __construct(ContextInterface $context, UiComponentFactory $uiComponentFactory, UrlBuilder $actionUrlBuilder, UrlInterface $urlBuilder, array $components = [], array $data = [])
    {
        $this->urlBuilder = $urlBuilder;
        $this->actionUrlBuilder = $actionUrlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }
    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $name = $this->getData('name');
                if (isset($item['item_id'])) {
                    $item[$name]['edit'] = ['href' => $this->urlBuilder->getUrl(self::URL_PATH_EDIT, ['item_id' => $item['item_id']]), 'label' => __('Edit') ];
                }
            }
        }
        return $dataSource;
    }
}
