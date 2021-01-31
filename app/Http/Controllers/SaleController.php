<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use App\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->admin == 0) {
            return redirect()->route('index');
        }

        $sales = Sale::orderBy('created_at','desc')->get();

        return view('admin.sale', [
            "title" => "Admin | Vendas",
            "sales" => $sales,
        ]);
    }


    public function addSale (Request $request){

        $carts = Cart::where("user",Auth::user()->id)->get();


        foreach($carts as $cart) {

            $product = Product::where("id", $cart->product)->first();

            if ($product->stock < $cart->quantity) {
                $request->session()->flash('danger', 'Quantidade insuficiente do produto no estoque!');
                return redirect()->route('index');
            }
        }

        foreach($carts as $cart){
            $product = Product::where("id", $cart->product)->first();

            $product->stock= $product->stock - $cart->quantity;

            $product->save();

            $sale = new Sale();
            $sale->product=$cart->product;
            $sale->user=$cart->user;
            $sale->quantity=$cart->quantity;
            $sale->price=$cart->product()->first()->price * $cart->quantity;
            $sale->payment=$request->payment;
            $sale->save();
            $cart->delete();
        }

        $request->session()->flash('success', 'Compra realizada com sucesso, em breve seu pedido será entregue!');
        return redirect()->route('index');
    }
}
