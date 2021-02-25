<?php
namespace Task\CartQuantity\Observer;

use Magento\Catalog\Model\Product;
use Magento\Checkout\Model\Cart;
use Magento\Framework\App\Http\Context as customerSession;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\Response\RedirectInterface;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Message\ManagerInterface;

class CartAddRestrict implements ObserverInterface
{
    protected $cart;
    protected $messageManager;
    protected $redirect;
    protected $request;
    protected $product;
    protected $customerSession;
    public function __construct(
        RedirectInterface $redirect,
        Cart $cart,
        ManagerInterface $messageManager,
        RequestInterface $request,
        Product $product,
        customerSession $session
    ) {
        $this->redirect = $redirect;
        $this->cart = $cart;
        $this->messageManager = $messageManager;
        $this->request = $request;
        $this->product = $product;
        $this->customerSession = $session;
    }
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $postValues = $this->request->getPostValue();
        $qty = $postValues['qty'];
        if ($qty >= 2) {
            $observer->getRequest()->setParam('product', false);
            $this->messageManager->addErrorMessage(__('Sorry!! You cannot add More than 1 Item to Cart'));
        }

        return $this;
    }
}
