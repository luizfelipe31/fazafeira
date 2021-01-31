@extends('admin.master-admin')

@section('content')
    <div  class="container">
        <div class="bg">
            <div class="row">
                <h2 class="title text-center">Mensagens</h2>
                <div class="col-sm-12">
                    <section id="cart_items">
                        <div class="container">

                            <div class="table-responsive cart_info">
                                <table class="table table-condensed">
                                    <thead>
                                    <tr class="cart_menu">
                                        <td class="description">Nome</td>
                                        <td class="description">E-mail</td>
                                        <td class="description">Assunto</td>
                                        <td class="description">Mensagem</td>
                                        <td class="description">Data</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($contacts as $contact)
                                        <tr>
                                            <td class="cart_description">
                                                <h4>{{$contact->name}}</h4>
                                            </td>
                                            <td class="cart_description">
                                                <h4>{{$contact->email}}</h4>
                                            </td>
                                            <td class="cart_description">
                                                <h4>{{$contact->subject}}</h4>
                                            </td>
                                            <td class="cart_description">
                                                <h4>{{$contact->message}}</h4>
                                            </td>
                                            <td class="cart_description">
                                                <h4>{{date('d/m/Y H:i:s', strtotime($contact->created_at))}}</h4>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div align="center">
                                    {{ $contacts->links() }}
                                </div>
                            </div>
                        </div>
                    </section>
                </div><!--/#col-sm-12-->

            </div><!--/#row-->
        </div><!--/#bg-->
    </div><!--/#container-->
@endsection

