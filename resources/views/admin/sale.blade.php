@extends('admin.master-admin')

@section('content')
    <div  class="container">
        <div class="bg">
            <div class="row">
                <h2 class="title text-center">Vendas</h2>
                <div class="col-sm-12">
                    <section id="cart_items">
                        <div class="container">

                            <div class="table-responsive cart_info">
                                <table class="table table-condensed">
                                    <thead>
                                    <tr class="cart_menu">
                                        <td class="description">Produto</td>
                                        <td class="description">Valor</td>
                                        <td class="description">Quantidade</td>
                                        <td class="description">Modo de pagamento</td>
                                        <td class="description">Cliente</td>
                                        <td class="description">Data</td>
                                        <td></td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php  $total=0; @endphp
                                    @foreach($sales as $sale)
                                        <tr>
                                            <td class="cart_description">
                                                <h4>{{$sale->product()->first()->name}}</h4>
                                            </td>
                                            <td class="cart_description">
                                                <h4>{{number_format($sale->price, 2, ',', '.')}}</h4>
                                            </td>
                                            <td class="cart_description">
                                                <h4>{{$sale->quantity}}</h4>
                                            </td>
                                            <td class="cart_description">
                                                <h4>@if($sale->payment=="credit card") Cartão de Crédito @endif @if($sale->payment=="bank transference") Transferência Bancária @endif @if($sale->payment=="bank slip") Boleto Bancário @endif</h4>
                                            </td>
                                            <td class="cart_description">
                                                <h4>{{$sale->user()->first()->name}}</h4>
                                            </td>
                                            <td class="cart_description">
                                                <h4>{{date('d/m/Y H:i:s', strtotime($sale->created_at))}}</h4>
                                            </td>
                                        </tr>
                                        @php
                                            $sub_total = $sale->price;
                                          $total += $sub_total;
                                        @endphp
                                    @endforeach
                                    </tbody>
                                </table>
                                <div align="center"><b>TOTAL EM VENDAS:R$ {{number_format($total, 2, ',', '.')}}</b></div>
                            </div>
                        </div>
                    </section>
                </div><!--/#col-sm-12-->

            </div><!--/#row-->
        </div><!--/#bg-->
    </div><!--/#container-->
@endsection
