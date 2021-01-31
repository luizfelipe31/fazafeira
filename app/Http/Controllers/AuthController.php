<?php

namespace App\Http\Controllers;


use App\Brand;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{

    public function index(Request $request) {

        if($request->q!="" || $request->brand!=""){
            $products = DB::table('products')
                ->select('products.id as id', 'products.name as product_name', 'brands.name as brand', 'price', 'photo',
                    'products.status','stock')
                ->join('brands', 'brand', '=', 'brands.id')
                ->where("products.status", "=", "1")
                ->where('products.name','LIKE','%'.$request->q.'%')
                ->where('brands.name','LIKE','%'.$request->brand.'%')
                ->orderBy('products.name')->simplePaginate('6');
        }else {
            $products = DB::table('products')
                ->select('products.id as id', 'products.name as product_name', 'brands.name as brand', 'price', 'photo',
                    'products.status','stock')
                ->join('brands', 'brand', '=', 'brands.id')
                ->where("products.status", "=", "1")
                ->orderBy('products.name')->simplePaginate('6');
        }

        $brands = DB::table('brands')
            ->select('brands.id','brands.name as brand',DB::raw("count(products.id) as sum_product"))
            ->join('products','brand','=','brands.id')
            ->where("brands.status","=","1")
            ->where("products.status","=","1")
            ->groupBy('brands.id','brands.name')
            ->orderBy('brands.name')->get();

        $qtd_product = Product::where('status',1)->count();

        return view('index', [
            "title" => "Home",
            "products" => $products,
            "brands" => $brands,
            "qtd_product" => $qtd_product,
            "product_name" => $request->q,
            "brand_name" => $request->brand
        ]);
    }

    public function login() {

        if(Auth::check() === true){
            return redirect()->route('index');
        }
        return view('login',[
            "title" => "Login"
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function doLogin(Request $request) {

        if (in_array('', $request->only("email", "password"))) {
            $json['message'] = $this->message->error("Ooops, informe todos os dados para efetuar o login")->render();
            return response()->json($json);
        }

        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            $json['message'] = $this->message->error("Ooops, informe um e-mail válido")->render();
            return response()->json($json);
        }

        $credencial = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (!Auth::attempt($credencial)) {
            $json['message'] = $this->message->error("Ooops, usuário e senha não conferem")->render();
            return response()->json($json);
        }

        if(Auth::user()->status==0){
            Auth::logout();
            $request->session()->flash('danger', 'Este usuário está desativado, entrar em contato para mais informações!');
            $json['redirect'] = route('index');
            return response()->json($json);
        }

        $request->session()->flash('success', 'Login realizado com sucesso, aproveite nossas ofertas!');
        $json['redirect'] = route('index');
        return response()->json($json);
    }


    public function logout(){
        Auth::logout();
        return redirect()->route('index');
    }
}
