<?php
namespace TrendsAttribute\ProductAttribute\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchVersionInterface;

/**
 * Class AddData
 * @package TrendsAttribute\ProductAttribute\Setup\Patch\Data
 */
class AddData implements DataPatchInterface, PatchVersionInterface
{
    /**
     * @var \TrendsAttribute\ProductAttribute\Model\Author
     */
    private $author;
    /**
     * @param \TrendsAttribute\ProductAttribute\Model\Author $author
     */
    public function __construct(\TrendsAttribute\ProductAttribute\Model\Review $author)
    {
        $this->author = $author;
    }

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function apply()
    {
        $authorData = [];
        $authorData['review_id'] = 1;
        $authorData['customer_name'] = "Sathiya";
        $this
            ->author
            ->addData($authorData);
        $this
            ->author
            ->getResource()
            ->save($this->author);
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */

    public static function getVersion()
    {
        return '1.3.0';
    }

    /**
     * {@inheritdoc}
     */

    public function getAliases()
    {
        return [];
    }
}
