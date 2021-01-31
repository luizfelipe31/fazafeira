@extends('admin.master-admin')

@section('content')
    <div  class="container">
        <div class="bg">
            <div class="row">
                <h2 class="title text-center">Usuários Administradores</h2>
                <div class="form-group col-md-12">
                    <a href="{{ route('admin.user.create') }}" class="btn btn-primary pull-left">Novo Usuário</a>
                </div>
                <div class="col-sm-12">
                    <section id="cart_items">
                        <div class="container">

                            <div class="table-responsive cart_info">
                                <table class="table table-condensed">
                                    <thead>
                                    <tr class="cart_menu">
                                        <td class="description">Nome</td>
                                        <td class="description">E-mail</td>
                                        <td class="description">Status</td>
                                        <td class="description">Alterar</td>
                                        <td></td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td class="cart_description">
                                                <h4>{{$user->name}}</h4>
                                            </td>
                                            <td class="cart_description">
                                                <h4>{{$user->email}}</h4>
                                            </td>
                                            <td class="cart_description">
                                                <h4>@if($user->status==1) Ativo @else Inativo @endif</h4>
                                            </td>
                                            <td class="cart_description">
                                                <a href="{{ route('admin.user.edit', ['user' => $user->id]) }}"><i class="fa fa-edit"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div align="center">
                                    {{ $users->links() }}
                                </div>
                            </div>
                        </div>
                    </section>
                </div><!--/#col-sm-12-->

            </div><!--/#row-->
        </div><!--/#bg-->
    </div><!--/#container-->
@endsection
