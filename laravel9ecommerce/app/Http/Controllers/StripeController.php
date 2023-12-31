<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;

class StripeController extends Controller
{
    public function index()
    {
        return redirect()->route('shop.cart');
    }

    public function checkout()
    {
        \Stripe\Stripe::setApiKey(config('stripe.sk'));

        $session = \Stripe\Checkout\Session::create([
            'line_items'  => [
                [
                    'price_data' => [
                        'currency'     => 'gbp',
                        'product_data' => [
                            'name' => 'gimme money!!!!',
                        ],
                        'unit_amount'  => 500,
                    ],
                    'quantity'   => 1,
                ],
            ],
            'mode'        => 'payment',
            'success_url' => route('success'),
            'cancel_url'  => route('cart'),
        ]);

        return redirect()->away($session->url);
    }

    public function success()
    {
        Cart::instance('cart')->destroy();
        return redirect()->route('shop.cart');
    }
}
