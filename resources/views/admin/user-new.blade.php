@extends('admin.master-admin')

@section('content')
<div class="container">
    <div class="bg">
        <div class="row">
            <div class="col-sm-12">
                <div class="contact-form">
                    <h2 class="title text-center">Cadastrar Usuário</h2>
                    <form action="{{ route('user.store') }}" method="post" autocomplete="off">
                        @csrf
                        <div class="form-group col-md-6">
                            <label>Nome</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required="required" placeholder="Nome">
                        </div>
                        <div class="form-group col-md-6">
                            <label>E-mail</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required="required" placeholder="E-mail">
                        </div>
                        <div class="form-group col-md-6">
                            <label>CPF</label>
                            <input type="text" class="form-control mask-doc" name="document" value="{{ old('document') }}" placeholder="CPF" required/>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Senha</label>
                            <input type="password" name="password" class="form-control" value="{{ old('password') }}" required="required" placeholder="Senha">
                        </div>
                        <div class="form-group col-md-12">
                            <label>Ativo:</label>
                            <input type="checkbox" name="status" checked {{ (old('status') == 'on' || old('status') == true ? 'checked' : '') }} value="1">
                        </div>
                        <div class="form-group col-md-12">
                            <label>Administrador:</label>
                            <input type="checkbox" disabled name="status" checked >
                        </div>
                        <div class="form-group col-md-12">
                            <input type="submit" name="submit" class="btn btn-primary pull-left" value="Cadastrar">
                        </div>
                    </form>
                </div><!--contact-form-->
            </div><!--col-sm-12-->
        </div><!--row-->
    </div><!--bg-->
</div><!--container-->
@endsection
