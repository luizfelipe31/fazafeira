<?php

namespace App\Http\Controllers;

use App\Cart;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * @param $id
     */
    public function addCart($id, Request $request){

     $cart = Cart::where("product",$id)->where("user",Auth::user()->id)->first();

     $product = Product::where("id", $id)->first();

     if($product->stock==0){
         $request->session()->flash('danger', 'Produto não tem mais no stoque!');
         return redirect()->route('index');
     }

     if(!$cart){
         $createCart = new Cart();
         $createCart->product = $id;
         $createCart->user = Auth::user()->id;
         $createCart->quantity = 1;

         $createCart->save();
     }else{

         $cart->quantity = $cart->quantity + 1;

         $cart->save();
     }

        $request->session()->flash('success', 'Produto adicionado ao carrinho!');
        return redirect()->route('index');
    }

    public function show() {

        $carts = Cart::where("user",Auth::user()->id)->get();

        return view('cart', [
            "title" => "Carrinho",
            "carts" => $carts
        ]);

    }

    public function add($id, Request $request) {
        $cart = Cart::where("id",$id)->first();

        $cart->quantity= $cart->quantity + 1;
        $cart->save();



        $request->session()->flash('success', 'Produto adicionado ao carrinho!');
        return redirect()->route('cart.show');
    }

    public function sub($id, Request $request) {
        $cart = Cart::where("id",$id)->first();

        if(($cart->quantity - 1)==0){
            $cart->delete();
        }else {

            $cart->quantity = $cart->quantity - 1;
            $cart->save();

        }

        $request->session()->flash('success', 'Produto retirado do carrinho!');
        return redirect()->route('cart.show');
    }
}
