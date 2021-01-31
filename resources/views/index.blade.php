@extends('master')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">

                        <div class="brands_products"><!--brands_products-->
                            <h2>Marcas</h2>
                            <div class="brands-name">
                                <ul class="nav nav-pills nav-stacked">
                                    <li><a href="{{ route('index.search', ['q'=>$product_name,'brand' => '']) }}" @if($brand_name=="") style="background-color:#FE980F;color:white" @endif> <span class="pull-right">({{$qtd_product}})</span>Todos</a></li>
                                    @foreach($brands as $brand)
                                        <li><a href="{{ route('index.search', ['q'=>$product_name,'brand' => $brand->brand]) }}" @if($brand_name==$brand->brand) style="background-color:#FE980F;color:white" @endif> <span class="pull-right">({{$brand->sum_product}})</span>{{$brand->brand}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div><!--/brands_products-->
                        <form action="">
                            <div class="price-range"><!--price-range-->
                                <h2>Busca</h2>
                                <div class="well text-center">
                                    <div class="form-group col-md-12">
                                        <label>Produto</label>
                                        <input type="text" name="q" class="form-control" value="{{$product_name}}"/>
                                        <input type="hidden" name="brand" value="{{$brand_name}}">
                                    </div>
                                    <!--label>Valor</label>
                                    <input type="text" class="span2" value="" data-slider-min="1" data-slider-max="600" data-slider-step="5" data-slider-value="[1,600]" id="sl2" ><br />
                                    <b class="pull-left">R$ 1</b> <b class="pull-right">R$ 600</b-->
                                    <button class="btn btn-default get">Procurar</button>
                                </div>
                            </div><!--/price-range-->
                        </form>


                    </div>
                </div>

                <div class="col-sm-9 padding-right">
                    <div class="features_items"><!--features_items-->
                        <h2 class="title text-center">Produtos</h2>
                        @foreach($products as $product)
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="{{ url("storage/{$product->photo}") }}" alt="" />
                                            <h2>R${{number_format($product->price, 2, ',', '.')}}</h2>
                                            <p>{{$product->product_name}} - {{$product->brand}}</p>
                                        </div>
                                        <div class="product-overlay">
                                            <div class="overlay-content">
                                                <h2>R${{number_format($product->price, 2, ',', '.')}}</h2>
                                                <p>{{$product->product_name}} - {{$product->brand}}</p>
                                                @if(Auth::user())
                                                    @if($product->stock>=1)
                                                        <a href="{{ route('cart.addCart', ['cart' => $product->id]) }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Adicionar ao Carrinho</a>
                                                    @else
                                                        PRODUTO ESGOTADO
                                                    @endif
                                                @else
                                                    <a href="#" onclick="alert('É necessário está logado para adicionar um produto ao carrinho')" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Adicionar ao Carrinho</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div><!--features_items-->
                    <div align="center">
                        {{ $products->appends(['q' => isset($product_name) ? $product_name : '','brand' => isset($brand_name) ? $brand_name : ''])->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
