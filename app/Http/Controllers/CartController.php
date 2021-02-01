<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Wish;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * @param $id
     */
    public function addCart($id, Request $request){

     $id = filter_var($id, FILTER_SANITIZE_STRIPPED);
        
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
        
        $id = filter_var($id, FILTER_SANITIZE_STRIPPED);
        
        $cart = Cart::where("id",$id)->first();

        $cart->quantity= $cart->quantity + 1;
        $cart->save();



        $request->session()->flash('success', 'Produto adicionado ao carrinho!');
        return redirect()->route('cart.show');
    }

    public function sub($id, Request $request) {
        
        $id = filter_var($id, FILTER_SANITIZE_STRIPPED);
        
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
    
    public function wish() {

        $wish = Wish::where("user",Auth::user()->id)->get();
        
        return view('wish', [
            "title" => "Lista de Desejo",
            "wishs" => $wish
        ]);

    }
    
    /**
     * @param $id
     */
    public function addNewWish($id, Request $request){

     $id = filter_var($id, FILTER_SANITIZE_STRIPPED);
        
     $wish = Wish::where("product",$id)->where("user",Auth::user()->id)->first();

     if(!$wish){
         $createWish = new Wish();
         $createWish->product = $id;
         $createWish->user = Auth::user()->id;
         $createWish->quantity = 1;

         $createWish->save();
     }else{

         $wish->quantity = $wish->quantity + 1;

         $wish->save();
     }

        $request->session()->flash('success', 'Produto adicionado a lista de desejo!');
        return redirect()->route('index');
    }
    
    public function addWish($id, Request $request) {
        
        $id = filter_var($id, FILTER_SANITIZE_STRIPPED);
        
        $wish = Wish::where("id",$id)->first();

        $wish->quantity= $wish->quantity + 1;
        $wish->save();

        $request->session()->flash('success', 'Produto adicionado a lista de desejo!');
        return redirect()->route('wish.wish');
    }

    public function subWish($id, Request $request) {
        
        $id = filter_var($id, FILTER_SANITIZE_STRIPPED);
        
        $wish = Wish::where("id",$id)->first();

        if(($wish->quantity - 1)==0){
            $wish->delete();
        }else {

            $wish->quantity = $wish->quantity - 1;
            $wish->save();

        }

        $request->session()->flash('success', 'Produto retirado da lista de desejo!');
        return redirect()->route('wish.wish');
    }
    
    public function addCartWish($id, Request $request) {
        
        $id = filter_var($id, FILTER_SANITIZE_STRIPPED);
        
        $wish = Wish::where("id",$id)->first();
        
        $cart = Cart::where("product",$wish->product)->where("user",Auth::user()->id)->first();
        
        $product = Product::where("id", $wish->product)->first();

        if($product->stock==0){
            $request->session()->flash('danger', 'Produto não tem mais no stoque!');
            return redirect()->route('wish.wish');
        }

        
        if(!$cart){
            $createCart = new Cart();
            $createCart->product = $wish->product;
            $createCart->user = Auth::user()->id;
            $createCart->quantity = $wish->quantity;

            $createCart->save();
        }else{

            $cart->quantity = $cart->quantity + $wish->quantity;

            $cart->save();
        }
        
        $wish->delete();
        
        $request->session()->flash('success', 'Produto adicionado ao carrinho!');
        return redirect()->route('wish.wish');
    }
    
     public function adminWish() {
         
        $wish = (new Wish)->get();
        
        return view('admin.admin-wish', [
            "title" => "Lista de Desejo",
            "wishs" => $wish
        ]);
         
     }
    
}
