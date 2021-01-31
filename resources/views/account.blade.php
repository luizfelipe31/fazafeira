@extends('master')

@section('content')
    <div class="container">
        <div class="bg">
            <div class="row">
                <div class="col-sm-12">
                    <div class="contact-form">
                        <h2 class="title text-center">Editar Meus Dados</h2>
                        <form action="{{ route('user.update', ['user' => $user->id]) }}" method="post" autocomplete="off">
                            @csrf
                            @method('PUT')
                            <div class="form-group col-md-6">
                                <label>Nome</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') ?? $user->name }}"  required="required" placeholder="Nome">
                            </div>
                            <div class="form-group col-md-6">
                                <label>E-mail</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email') ?? $user->email }}"  required="required" placeholder="E-mail">
                            </div>
                            <div class="form-group col-md-6">
                                <label>CPF</label>
                                <input type="text" class="form-control mask-doc" name="document" value="{{ old('document') ?? $user->document }}"  placeholder="CPF" required/>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Mudar Senha</label>
                                <input type="password" name="password" class="form-control" value="{{ old('password') }}" placeholder="Senha">
                            </div>
                            <input type="hidden" name="status" value="1">
                            <div class="form-group col-md-6">
                                <input type="submit" name="submit" class="btn btn-primary pull-left" value="Editar">
                            </div>
                        </form>
                    </div><!--contact-form-->
                </div><!--col-sm-12-->
            </div><!--row-->
        </div><!--bg-->
    </div><!--container-->
    <div  class="container">
        <div class="bg">
            <div class="row">
                <h2 class="title text-center">Minhas Compras</h2>
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
