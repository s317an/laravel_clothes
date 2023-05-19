<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Cart;

class CartController extends Controller
{
    public function index(){
        $cart_id = Session::get('cart');
        $cart = Cart::find($cart_id);

        $total_price = 0;
        foreach($cart-> products as $product){
            $total_price += $product->price * $product->pivot->quantity;
        }

        return view('cart.index')
            -> with('line_ltems',$cart->products)
            -> with('total_price',$total_price);
    }


    public function checkout(){
        $cart_id = Session::get('cart');
        $cart = Cart::find($cart_id);

        $line_ltems = [];
        foreach($cart->products as $product){
            $line_ltem = [
                'price_data' => [
                    'currency' => 'jpy',
                    'unit_amount' => $product->price,
                    'product_data' => [
                        'name' => $product->name,
                        'description' => $product->description],
                    ],
                'quantity' => $product->pivot->quantity,
                ];
            array_push($line_ltems,$line_ltem);
        }

        \Stripe\Stripe::setApikey(env('STRIPE_SECRET_KEY'));

        $session =\Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items'           => [$line_ltems],
            'success_url'          => [route('product.index')],
            'cancel_url'           => [route('cart.index')],
            'mode'                 => ['payment'],
        ]);

        return view('cart.checkout',[
            'session'   => $session,
            'publicKey' => env('STRIPE_PUBLIC_KEY'),
        ]);
    }
}
