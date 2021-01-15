<?php
namespace TrendsAttribute\CustomConfiguration\Model;

use TrendsAttribute\CustomConfiguration\Helper\Data;

class Demo implements \TrendsAttribute\CustomConfiguration\Api\DemoInterface
{
    /**
    *@inheritDoc
    */
    public $helperData;

    public function __construct(Data $helperData)
    {
        $this->helperData = $helperData;
    }
    public function getConfiguration()
    {
        $value = [];
        $value["enable"] = $this->helperData->getGeneralConfig('enable');
        $value["country"] = $this->helperData->getGeneralConfig('country');
        $value["display text"] = $this->helperData->getGeneralConfig('display_text');

        return json_encode($value);
    }
}
