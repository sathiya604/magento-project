<?php
namespace TrendsAttribute\SchemaCreation\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchVersionInterface;
use TrendsAttribute\SchemaCreation\Model\AuthorFactory;
use TrendsAttribute\SchemaCreation\Model\ResourceModel\Author;

class AddData implements DataPatchInterface, PatchVersionInterface
{
    private $authorFactory;
    private $authorResource;
    private $moduleDataSetup;
    public function __construct(
        AuthorFactory $authorFactory,
        Author $authorResource,
        ModuleDataSetupInterface $moduleDataSetup
    ) {
        $this->authorFactory = $authorFactory;
        $this->authorResource = $authorResource;
        $this->moduleDataSetup=$moduleDataSetup;
    }
    public function apply()
    {
        //Install data row into contact_details table
        $this->moduleDataSetup->startSetup();
        $contactDTO=$this->authorFactory->create();
        $contactDTO->setId(7)->setAuthorName('saro')->setAuthorEmail('saro123@gmail.com')->setAge(21)->setSex('female');
        $this->authorResource->save($contactDTO);
        $contactDTO=$this->authorFactory->create();
        $contactDTO->setAuthorName('sat')->setAuthorEmail('sat123@gmail.com')->setAge(12)->setSex('female');
        $this->authorResource->save($contactDTO);
        $this->moduleDataSetup->endSetup();
    }
    public static function getDependencies()
    {
        return [];
    }
    public static function getVersion()
    {
        return '3.6.0';
    }
    public function getAliases()
    {
        return [];
    }
}
