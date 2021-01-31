@extends('admin.master-admin')

@section('content')
    <div class="container">
        <div class="bg">
            <div class="row">
                <div class="col-sm-12">
                    <div class="contact-form">
                        <h2 class="title text-center">Editar Usuário</h2>
                        <form action="{{ route('admin.user.updateAdmin', ['user' => $user->id]) }}" method="post" autocomplete="off">
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
                                <input type="password" name="password" class="form-control" value="{{ old('password') }}"  placeholder="Senha">
                            </div>
                            <div class="form-group col-md-12">
                                <label>Ativo:</label>
                                <input type="checkbox" @if($user->id==1) disabled @endif name="status" checked {{ (old('status') == 'on' || old('status') == "1" ? 'checked' : ($user->status == "1" ? 'checked' : '')) }} value="1">
                            </div>
                            <div class="form-group col-md-12">
                                <label>Administrador:</label>
                                <input type="checkbox" disabled name="status" checked >
                            </div>
                            <div class="form-group col-md-6">
                                <input type="submit" name="submit" class="btn btn-primary pull-left" value="Editar">
                            </div>
                            @if($user->id!=1)
                            <div class="form-group col-md-6">
                                <a href="{{ route('admin.user.destroy', ['user' => $user->id]) }}" class="btn btn-danger pull-right" onclick="return confirm('Tem certeza que deseja excluir esse usuário?')">Excluir</a>
                            </div>
                            @endif
                        </form>
                    </div><!--contact-form-->
                </div><!--col-sm-12-->
            </div><!--row-->
        </div><!--bg-->
    </div><!--container-->
@endsection
