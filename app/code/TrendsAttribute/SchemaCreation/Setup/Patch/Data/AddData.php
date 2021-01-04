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
        $this->moduleDataSetup->startSetup();
        $author=$this->authorFactory->create();
        $author->setId(1)->setAuthorName('John')->setAuthorEmail('andrew@email.com')->setAffliation('Andrew Company')->setAge(28);
        $this->authorResource->save($author);
        $this->moduleDataSetup->endSetup();
    }
    public static function getDependencies()
    {
        return [];
    }
    public static function getVersion()
    {
        return '1.0.1';
    }
    public function getAliases()
    {
        return [];
    }
}
