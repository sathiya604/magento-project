<?php
namespace Trends\Custom\Controller\Page;

class Example extends \Magento\Framework\App\Action\Action
{
    private $objManager;
    private $value;

    public function __construct(
        \Magento\Framework\ObjectManager\ObjectManager $objManager,
        \Magento\Framework\App\Action\Context $context,
        \Trends\Custom\Model\Example $value
    ) {
        $this->value = $value;
        $this->objManager = $objManager;
        parent::__construct($context);
    }

    public function execute()
    {
        echo "Using Object Manager<br>";
        $example = $this->objManager->create('\Trends\Custom\Model\Example');
        $example->check = 10;
        echo $example->check,"<br>";

        $example1 = $this->objManager->get('\Trends\Custom\Model\Example');
        $example1->check = 10;
        echo $example1->check,"<br>";
        $example2 = $this->objManager->get('\Trends\Custom\Model\Example');//object is not created
        echo $example2->check,"<br>";
        $example = new \Trends\Custom\Model\Example();  //normal function call without DI
        echo "<br> Dependency Injection";
        $this->value->check = 10;
        echo "<br>",$this->value->check;
    }
}
