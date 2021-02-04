<?php
namespace TrendsAttribute\AdminGrid\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchVersionInterface;
use TrendsAttribute\AdminGrid\Model\FeedbackFactory;
use TrendsAttribute\AdminGrid\Model\ResourceModel\Feedback;

class AddData implements DataPatchInterface, PatchVersionInterface
{
    private $feedbackFactory;
    private $feedbackResource;
    private $moduleDataSetup;

    public function __construct(
        FeedbackFactory $feedbackFactory,
        Feedback $feedbackResource,
        ModuleDataSetupInterface $moduleDataSetup
    ) {
        $this->feedbackFactory = $feedbackFactory;
        $this->feedbackResource = $feedbackResource;
        $this->moduleDataSetup = $moduleDataSetup;
    }

    public function apply()
    {
        $this->moduleDataSetup->startSetup();
        $feedback = $this->feedbackFactory->create();
        $feedback->setId(4)->setName('rama')->setEmail('rama123@gmail.com')->setFeedback('satisfied');
        $this->feedbackResource->save($feedback);
        $feedback = $this->feedbackFactory->create();
        $feedback->setId(5);
        $this->feedbackResource->delete($feedback);
        $this->moduleDataSetup->endSetup();
    }

    public static function getDependencies()
    {
        return [];
    }

    public static function getVersion()
    {
        return '1.32.0';
    }

    public function getAliases()
    {
        return [];
    }
}
