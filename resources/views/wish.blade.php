@extends('master')

@section('content')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{ route('index') }}">Home</a></li>
                    <li class="active">Lista de desejos</li>
                </ol>
            </div>
            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td class="buy">Comprar</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    @php  $total=0; @endphp
                    @foreach($wishs as $wish)
                        <tr>
                            <td class="cart_product">
                                <a href=""><img src="{{ url("storage/{$wish->product()->first()->photo}") }}" height="100" width="100"alt=""></a>
                            </td>
                            <td class="cart_description">
                                <h4><a href="">{{$wish->product()->first()->name}}</a></h4>
                            </td>
                            <td class="cart_price">
                                <p>R${{number_format($wish->product()->first()->price, 2, ',', '.')}}</p>
                            </td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                                    <a class="cart_quantity_up" href="{{ route('wish.addWish', ['product' => $wish->id]) }}"> + </a>
                                    <input class="cart_quantity_input" type="text" name="quantity" value="{{$wish->quantity}}" autocomplete="off" size="2">
                                    <a class="cart_quantity_down" href="{{ route('wish.subWish', ['product' => $wish->id]) }}"> - </a>
                                </div>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">{{number_format(($wish->product()->first()->price*$wish->quantity), 2, ',', '.')}}</p>
                            </td>
                            <td class="cart_buy">
                               <a href="{{ route('cart.addCartWish', ['cart' => $wish->id]) }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Adicionar ao Carrinho</a>
                            </td>
                        </tr>
                        @php
                              $sub_total = ($wish->product()->first()->price*$wish->quantity);
                            $total += $sub_total;
                        @endphp
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section> <!--/#cart_items-->
@endsection
