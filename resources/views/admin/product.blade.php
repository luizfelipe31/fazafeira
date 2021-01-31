@extends('admin.master-admin')

@section('content')
    <div  class="container">
        <div class="bg">
            <div class="row">
                <h2 class="title text-center">Produtos</h2>
                <div class="form-group col-md-12">
                    <a href="{{ route('admin.product.create') }}" class="btn btn-primary pull-left">Novo Produto</a>
                </div>
                <div class="col-sm-12">
                    <section id="cart_items">
                        <div class="container">
                            <!--form action="{{ route('admin') }}" method="get" autocomplete="off" -->
                                <form action="">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <input type="text" name="q" class="form-control" @if(isset($product_name)) value="{{$product_name}}" @endif placeholder="Produto"/>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="text" name="brand" class="form-control" @if(isset($brand)) value="{{$brand}}" @endif placeholder="Marca"/>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <button class="btn btn-primary">Filtrar</button>
                                        <!--input type="submit" name="submit" class="btn btn-primary" value="Procurar"-->
                                    </div>
                                </div>
                            </form>

                            <div class="table-responsive cart_info">
                                <table class="table table-condensed">
                                    <thead>
                                    <tr class="cart_menu">
                                        <td class="image">Item</td>
                                        <td class="description">Produto</td>
                                        <td class="brand">Marca</td>
                                        <td class="price">Price</td>
                                        <td class="quantity">Status</td>
                                        <td class="total">Alterar</td>
                                        <td></td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $product)
                                    <tr>
                                        <td class="cart_product">
                                            <a href=""><img src="{{ url("storage/{$product->photo}") }}" height="100" width="100" alt=""></a>
                                        </td>
                                        <td class="cart_description">
                                            <h4>{{$product->product_name}}</h4>
                                        </td>
                                        <td class="cart_description">
                                            <h4>{{$product->brand}}</h4>
                                        </td>
                                        <td class="cart_description">
                                            <h4>R${{number_format($product->price, 2, ',', '.')}}</h4>
                                        </td>
                                        <td class="cart_description">
                                            <h4>@if($product->status==1) Ativo @else Inativo @endif</h4>
                                        </td>
                                        <td class="cart_description">
                                            <a href="{{ route('admin.product.edit', ['product' => $product->id]) }}"><i class="fa fa-edit"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div align="center">
                                    {{ $products->appends(['q' => isset($product_name) ? $product_name : '','brand' => isset($brand) ? $brand : ''])->links() }}
                                </div>
                            </div>
                        </div>
                    </section>
                </div><!--/#col-sm-12-->

            </div><!--/#row-->
        </div><!--/#bg-->
    </div><!--/#container-->
@endsection
