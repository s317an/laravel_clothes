<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\LineLtem;

class LineltemController extends Controller
{
    public function create(Request $request){
        $cart_id = Session::get('cart');
        $line_ltem = LineLtem::where('cart_id',$cart_id)
            -> where('product_id',$request->input('id'))
            ->first();

        if($line_ltem){
            $line_ltem->quantity += $request->input('quantity');
            $line_ltem->save();
        } else{
            LineLtem::create([
                'cart_id' => $cart_id,
                'product_id' => $request->input('id'),
                'quantity' => $request->input('quantity'),
            ]);
        }

        return redirect(route('cart.index'));
    }

    public function delete(Request $request){
        LineLtem::destroy($request->input('id'));

        return redirect(route('cart.index'));
    }
}
