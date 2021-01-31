@extends('admin.master-admin')

@section('content')
    <div class="container">
        <div class="bg">
            <div class="row">
                <div class="col-sm-12">
                    <div class="contact-form">
                        <h2 class="title text-center">Cadastrar Produto</h2>
                        <form action="{{ route('product.store') }}" method="post" autocomplete="off" enctype="multipart/form-data">
                        @csrf
                            <div class="form-group col-md-6">
                            <label>Nome do Produto</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required="required" placeholder="Nome do produto">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Marca</label>
                                <select class="form-control" name="brand" required>
                                    <option value="">--Selecione--</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}" @if(old('brand')) selected @endif>{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Preço</label>
                                <input type="text" name="price" class="form-control mask-money" value="{{ old('price') }}" required="required" >
                            </div>
                            <div class="form-group col-md-6">
                                <label>Qtd. Estoque</label>
                                <input type="number" name="stock" class="form-control" value="{{ old('stock') }}" required="required" placeholder="Qtd. Estoque">
                            </div>
                            <div class="form-group col-md-12">
                                <label>Foto:</label>
                                <input type="file" name="photo" class="form-control" value="{{ old('photo') }}" accept="image/png, image/jpeg" required="required" >
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
