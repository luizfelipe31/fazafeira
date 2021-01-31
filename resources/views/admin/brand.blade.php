@extends('admin.master-admin')

@section('content')
    <div  class="container">
        <div class="bg">
            <div class="row">
                <h2 class="title text-center">Marcas</h2>
                <div class="form-group col-md-12">
                    <a href="{{ route('admin.brand.create') }}" class="btn btn-primary pull-left">Nova Marca</a>
                </div>
                <div class="col-sm-12">
                    <section id="cart_items">
                        <div class="container">

                            <div class="table-responsive cart_info">
                                <table class="table table-condensed">
                                    <thead>
                                    <tr class="cart_menu">
                                        <td class="brand">Marca</td>
                                        <td class="quantity">Status</td>
                                        <td class="total">Alterar</td>
                                        <td></td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($brands as $brand)
                                        <tr>
                                            <td class="cart_description">
                                                <h4>{{$brand->name}}</h4>
                                            </td>
                                            <td class="cart_description">
                                                <h4>@if($brand->status==1) Ativo @else Inativo @endif</h4>
                                            </td>
                                            <td class="cart_description">
                                                <a href="{{ route('admin.brand.edit', ['brand' => $brand->id]) }}"><i class="fa fa-edit"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div align="center">
                                    {{ $brands->links() }}
                                </div>
                            </div>
                        </div>
                    </section>
                </div><!--/#col-sm-12-->

            </div><!--/#row-->
        </div><!--/#bg-->
    </div><!--/#container-->
@endsection
