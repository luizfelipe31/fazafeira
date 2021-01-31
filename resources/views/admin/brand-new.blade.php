@extends('admin.master-admin')

@section('content')
    <div class="container">
        <div class="bg">
            <div class="row">
                <div class="col-sm-12">
                    <div class="contact-form">
                        <h2 class="title text-center">Cadastrar Marca</h2>
                        <form action="{{ route('brand.store') }}" method="post" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group col-md-6">
                                <label>Nome da Marca</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required="required" placeholder="Nome da Marca">
                            </div>
                            <div class="form-group col-md-12">
                                <label>Ativo:</label>
                                <input type="checkbox" name="status" checked {{ (old('status') == 'on' || old('status') == true ? 'checked' : '') }} value="1">
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
