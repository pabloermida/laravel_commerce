<?php

namespace CodeCommerce\Http\Controllers;

use CodeCommerce\Events\CheckoutEvent;
use CodeCommerce\Http\Requests;
use CodeCommerce\Order;
use CodeCommerce\OrderItem;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use PHPSC\PagSeguro\Items\Item;
use PHPSC\PagSeguro\Requests\Checkout\CheckoutService;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function place(Order $orderModel, OrderItem $orderItem, CheckoutService $checkoutService)
    {
        if (!Session::has('cart')) {
            return false;
        }

        $cart = Session::get('cart');

        if ($cart->getTotal() > 0) {
            $order = $orderModel->create(['user_id'=>Auth::user()->id, 'total'=>$cart->getTotal()]);
            $checkout = $checkoutService->createCheckoutBuilder();

            foreach ($cart->all() as $k => $item) {
                $checkout->addItem(new Item($k, $item['name'], number_format($item['price'], 2, ".", ""), $item['qtd']));
                $order->items()->create(['product_id'=>$k, 'price'=>$item['price'], 'qtd'=>$item['qtd']]);
            }

            $cart->clear();

            event(new CheckoutEvent(Auth::user(), $order));

            //return view('store.checkout', compact('order','cart'));

            $response = $checkoutService->checkout($checkout->getCheckout());
            return redirect($response->getRedirectionUrl());

        }
        return view('store.checkout', ['cart'=>'empty']);
    }

    public function test(CheckoutService $checkoutService)
    {

        $checkout = $checkoutService->createCheckoutBuilder()
            ->addItem(new Item(1, 'Televisão LED 500', 8999.99))
            ->addItem(new Item(2, 'Video-game mega ultra blaster', 799.99))
            ->getCheckout();

        $response = $checkoutService->checkout($checkout);

        return redirect($response->getRedirectionUrl());

    }
}
