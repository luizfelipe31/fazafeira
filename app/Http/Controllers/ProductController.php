<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Brand;
use App\Product;
use App\User;
use App\Http\Requests\Product as ProdutcRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function admin(Request $request) {

        if(Auth::user()->admin==0){
            return redirect()->route('index');
        }

        if($request->q!="" || $request->brand!=""){

            if($request->user){
                $products = DB::table('products')
                ->select('products.id as id','products.name as product_name','brands.name as brand','price','photo','products.status','users.name as user_name')
                ->join('brands','brand','=','brands.id')
                ->join('users','user','=','users.id')
                ->where('products.name','LIKE','%'.$request->q.'%')
                ->Where('brands.name','LIKE','%'.$request->brand.'%')
                ->Where('user',$request->user)
                ->orderBy('products.name')->simplePaginate('5');    
            }else{
                $products = DB::table('products')
                ->select('products.id as id','products.name as product_name','brands.name as brand','price','photo','products.status','users.name as user_name')
                ->join('brands','brand','=','brands.id')
                ->join('users','user','=','users.id')
                ->where('products.name','LIKE','%'.$request->q.'%')
                ->Where('brands.name','LIKE','%'.$request->brand.'%')
                ->orderBy('products.name')->simplePaginate('5');
            }


        }else {

            $products = DB::table('products')
            ->select('products.id as id','products.name as product_name','brands.name as brand','price','photo','products.status','users.name as user_name')
            ->join('brands','brand','=','brands.id')
            ->join('users','user','=','users.id')
            ->orderBy('products.name')->simplePaginate('5');

        }

        $users = User::where('admin',1)->orderBy('name')->get();
        
        return view('admin.product', [
            "title" => "Admin | Produto",
            "products" => $products,
            "product_name" => $request->q,
            "brand" => $request->brand,
            "user_choice" => $request->user,
            "users" => $users
        ]);
    }

    public function create()
    {
        $brands = Brand::where('status',1)->orderBy('name')->get();

        if(Auth::user()->admin==0){
            return redirect()->route('index');
        }

        return view('admin.product-new', [
            "title" => "Admin | Cadastrar Produto",
            "brands" => $brands
        ]);
    }

    public function store(ProdutcRequest $request) {

        if(Auth::user()->admin==0){
            return redirect()->route('index');
        }

        $product = Product::create($request->all());
        
        $validator = Validator::make($request->only('files'), ['files.*' => 'image']);

        if($validator->fails() === true) {
            $request->session()->flash('danger', 'Todas as imagens devem ser do tipo jpg, jpeg ou png.');
            return redirect()->back();
        }

        if ($request->hasFile('photo')) {
            $product->photo = $request->file('photo')->store('products');
            $product->save();
        }

        $request->session()->flash('success', 'Produto cadastrado com sucesso!');
        return redirect()->route('admin.product.create');
    }


    public function edit($id, Request $request) {

        if(Auth::user()->admin==0){
            return redirect()->route('index');
        }

        $product = Product::where("id", $id)->first();

        if(!$product){
            $request->session()->flash('danger', 'Esse produto não existe!');
            return redirect()->route('admin');
        }

        $brands = Brand::where('status',1)->orderBy('name')->get();
        
        return view('admin.product-edit', [
            "title" => "Admin | Editar Produto",
            "product" => $product,
            "brands" => $brands
        ]);
    }

    public function update(Request $request,$id)
    {
        if(Auth::user()->admin==0){
            return redirect()->route('index');
        }

        $product = Product::where("id", $id)->first();

        if(!$product){
            $request->session()->flash('danger', 'Esse produto não existe!');
            return redirect()->route('admin');
        }

        $validator = Validator::make($request->only('files'), ['files.*' => 'image']);

        if($validator->fails() === true) {
            $request->session()->flash('danger', 'Todas as imagens devem ser do tipo jpg, jpeg ou png.');
            return redirect()->back();
        }

        if(!empty($request->file('photo'))) {
            Storage::delete($product->photo);
        }

        $product->fill($request->all());

        if(!empty($request->file('photo'))){
            $product->photo = $request->file('photo')->store('products');
        }

        $product->name = $request->name;
        $product->brand = $request->brand;
        $product->price = str_replace(['.', ','], ['','.'], $request->price);
        $product->stock = $request->stock;
        $product->status = ($request->status == '1' ? 1 : 0);

        if(!$product->save()){
            $request->session()->flash('danger', 'Erro ao editar, confira todos os dados!');
            return redirect()->route('admin.product.edit', ['product' => $id]);
        }

        $request->session()->flash('success', 'Produto editado com sucesso!');
        return redirect()->route('admin.product.edit', ['product' => $id]);
    }
    /**
     * @param $id
     */
    public function destroy($id, Request $request)
    {
        if(Auth::user()->admin==0){
            return redirect()->route('index');
        }

        $product = Product::where("id", $id)->first();

        $cart = Cart::where("product",$id)->first();
        $sale = Sale::where("product",$id)->first();

        if($cart || $sale){
            $request->session()->flash('danger', 'Esse produto não pode ser excluído!');
            return redirect()->route('admin');
        }

        if(!$product){
            $request->session()->flash('danger', 'Esse produto não existe!');
            return redirect()->route('admin');
        }

        $product->delete();

        $request->session()->flash('success', 'Produto excluído com sucesso!');
        return redirect()->route('admin');
    }
}
