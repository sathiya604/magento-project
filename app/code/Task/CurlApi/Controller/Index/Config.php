<?php
namespace Task\CurlApi\Controller\Index;

class Config extends \Magento\Framework\App\Action\Action
{
    protected $helperData;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Task\CurlApi\Helper\Inventory $data
    ) {
        $this->data = $data;
        return parent::__construct($context);
    }

    public function execute()
    {
        var_dump($this->data->makeACurlRequest());
    }
}
