@extends('admin.master-admin')

@section('content')
    <div class="container">
        <div class="bg">
            <div class="row">
                <div class="col-sm-12">
                    <div class="contact-form">
                        <h2 class="title text-center">Editar Marca</h2>
                        <form  action="{{ route('brand.update', ['brand' => $brand->id]) }}" method="post" autocomplete="off">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ $brand->id }}">
                            <div class="form-group col-md-6">
                                <label>Nome da Marca</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') ?? $brand->name }}"  required="required" placeholder="Nome da Marca">
                            </div>
                            <div class="form-group col-md-12">
                                <label>Ativo:</label>
                                <input type="checkbox" name="status"  {{ (old('status') == 'on' || old('status') == "1" ? 'checked' : ($brand->status == "1" ? 'checked' : '')) }} value="1">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="submit" name="submit" class="btn btn-primary pull-left" value="Editar">
                            </div>
                            <div class="form-group col-md-6">
                                <a href="{{ route('admin.brand.destroy', ['brand' => $brand->id]) }}" class="btn btn-danger pull-right" onclick="return confirm('Tem certeza que deseja excluir essa marca?')">Excluir</a>
                            </div>
                        </form>
                    </div><!--contact-form-->
                </div><!--col-sm-12-->
            </div><!--row-->
        </div><!--bg-->
    </div><!--container-->
@endsection
