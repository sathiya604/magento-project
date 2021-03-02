<?php
namespace TrendsAttribute\CustomConfiguration\Model;

use TrendsAttribute\CustomConfiguration\Helper\Data;

class Demo implements \TrendsAttribute\CustomConfiguration\Api\DemoInterface
{
    /**
    *@inheritDoc
    */
    public $helperData;

    protected $_enc;

    public function __construct(
        \Magento\Framework\Encryption\EncryptorInterface $enc,
        Data $helperData
    ) {
        $this->helperData = $helperData;
        $this->_enc = $enc;
    }

    public function getConfiguration()
    {
        $value = [];
        $value["enable"] = sprintf("enable : %s", $this->helperData->getGeneralConfig('enable'));
        $value["country"] = sprintf("Country : %s", $this->helperData->getGeneralConfig('country'));
        $value["display text"] = sprintf("text : %s", $this->helperData->getGeneralConfig('display_text'));
        $password = $this->helperData->getGeneralConfig('password');
        $value["password"] = sprintf("Password : %s", $this->_enc->decrypt($password));

        return $value;
    }
}
