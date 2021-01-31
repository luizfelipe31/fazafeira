@extends('master')

@section('content')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{ route('index') }}">Home</a></li>
                    <li class="active">Carrinho</li>
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
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    @php  $total=0; @endphp
                    @foreach($carts as $cart)
                        <tr>
                            <td class="cart_product">
                                <a href=""><img src="{{ url("storage/{$cart->product()->first()->photo}") }}" height="100" width="100"alt=""></a>
                            </td>
                            <td class="cart_description">
                                <h4><a href="">{{$cart->product()->first()->name}}</a></h4>
                            </td>
                            <td class="cart_price">
                                <p>R${{number_format($cart->product()->first()->price, 2, ',', '.')}}</p>
                            </td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                                    <a class="cart_quantity_up" href="{{ route('cart.add', ['product' => $cart->id]) }}"> + </a>
                                    <input class="cart_quantity_input" type="text" name="quantity" value="{{$cart->quantity}}" autocomplete="off" size="2">
                                    <a class="cart_quantity_down" href="{{ route('cart.sub', ['product' => $cart->id]) }}"> - </a>
                                </div>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">{{number_format(($cart->product()->first()->price*$cart->quantity), 2, ',', '.')}}</p>
                            </td>
                            <td class="cart_delete">
                                <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                        @php
                              $sub_total = ($cart->product()->first()->price*$cart->quantity);
                            $total += $sub_total;
                        @endphp
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section> <!--/#cart_items-->
    <form action="{{ route('sale.addSale') }}" method="post" autocomplete="off">
        @csrf
        <section id="do_action">
            <div class="container">
                <div class="heading">
                    <h3>Escolha a forma de pagamento</h3>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="chose_area">
                            <ul class="user_option">
                                <li>
                                    <input type="radio" name="payment" value="credit card" checked>
                                    <label>Cartão de Crédito</label>
                                </li>
                                <li>
                                    <input type="radio" name="payment" value="bank transference">
                                    <label>Transferência Bancária</label>
                                </li>
                                <li>
                                    <input type="radio" name="payment" value="bank slip">
                                    <label>Boleto Bancário</label>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="total_area">
                            <ul>
                                <li>Sub Total <span>R$ {{number_format($total, 2, ',', '.')}}</span></li>
                                <li>Frete <span>Free</span></li>
                                <li>Total <span>R$ {{number_format($total, 2, ',', '.')}}</span></li>
                            </ul>
                            @if($total!=0)
                            <button type="submit" class="btn btn-default check_out" href="">Comprar</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section><!--/#do_action-->
    </form>
@endsection
