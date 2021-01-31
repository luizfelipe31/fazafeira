<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Brand as BrandRequest;

class BrandController extends Controller
{
    public function index(Request $request) {

        if(Auth::user()->admin==0){
            return redirect()->route('index');
        }

        $brands = Brand::orderBy('name')->simplePaginate('10');

        return view('admin.brand', [
            "title" => "Admin | Marca",
            "brands" => $brands,
        ]);
    }

    public function create()
    {
        if(Auth::user()->admin==0){
            return redirect()->route('index');
        }

        return view('admin.brand-new', [
            "title" => "Admin | Marcas",
        ]);
    }

    public function store(BrandRequest $request) {

        if(Auth::user()->admin==0){
            return redirect()->route('index');
        }

        Brand::create($request->all());

        $request->session()->flash('success', 'Marca cadastrado com sucesso!');
        return redirect()->route('admin.brand.create');
    }

    public function edit($id, Request $request)
    {
        if(Auth::user()->admin==0){
            return redirect()->route('index');
        }

        $brand = Brand::where("id", $id)->first();

        if(!$brand){
            $request->session()->flash('danger', 'Essa marca não existe!');
            return redirect()->route('admin.brand');
        }

        return view('admin.brand-edit', [
            "title" => "Admin | Editar Marca",
            "brand" => $brand
        ]);
    }

    public function update(Request $request,$id)
    {
        if(Auth::user()->admin==0){
            return redirect()->route('index');
        }

        $brand = Brand::where("id", $id)->first();

        if(!$brand){
            $request->session()->flash('danger', 'Essa marca não existe!');
            return redirect()->route('admin');
        }

        $brand->name = $request->name;
        $brand->status = ($request->status == '1' ? 1 : 0);

        if(!$brand->save()){
            $request->session()->flash('danger', 'Erro ao editar, confira todos os dados!');
            return redirect()->route('admin.brand.edit', ['product' => $id]);
        }

        $request->session()->flash('success', 'Produto editado com sucesso!');
        return redirect()->route('admin.brand.edit', ['brand' => $id]);
    }

    /**
     * @param $id
     */
    public function destroy($id, Request $request)
    {
        if(Auth::user()->admin==0){
            return redirect()->route('index');
        }

        $brand = Brand::where("id", $id)->first();

        if(!$brand){
            $request->session()->flash('danger', 'Essa marca não existe!');
            return redirect()->route('admin.brand');
        }

        $product = Product::where("brand", $id)->first();

        if($product){
            $request->session()->flash('danger', 'Essa marca não pode ser excluída pois já está vinculada a um produto!');
            return redirect()->route('admin.brand.edit', ['brand' => $id]);
        }

        $brand->delete();

        $request->session()->flash('success', 'Marca excluído com sucesso!');
        return redirect()->route('admin.brand');
    }
}

