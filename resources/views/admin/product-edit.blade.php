@extends('admin.master-admin')

@section('content')
    <div class="container">
        <div class="bg">
            <div class="row">
                <div class="col-sm-12">
                    <div class="contact-form">
                        <h2 class="title text-center">Editar Produto</h2>
                        <form  action="{{ route('product.update', ['product' => $product->id]) }}" method="post" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <div class="form-group col-md-12">
                              <a href=""><img src="{{ url("storage/{$product->photo}") }}" height="100" width="100" alt=""></a>
                            </div>
                            <div class="form-group col-md-6">
                            <label>Nome do Produto</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') ?? $product->name }}"  required="required" placeholder="Nome do produto">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Marca</label>
                                <select class="form-control" name="brand" required>
                                    <option value="">--Selecione--</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}" @if(old('brand')) selected @else @if($brand->id==$product->brand) selected  @endif @endif>{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Preço</label>
                                <input type="text" name="price" value="{{ old('price') ?? number_format($product->price, 2, ',', '.') }}" class="form-control mask-money" value="{{ old('price') }}" required="required" >
                            </div>
                            <div class="form-group col-md-6">
                                <label>Qtd. Estoque</label>
                                <input type="number" name="stock" class="form-control" value="{{ old('stock') ?? $product->stock }}" required="required" placeholder="Qtd. Estoque">
                            </div>
                            <div class="form-group col-md-12">
                                <label>Foto:</label>
                                <input type="file" name="photo" class="form-control" value="{{ old('photo') }}" accept="image/png, image/jpeg" >
                            </div>
                            <div class="form-group col-md-12">
                                <label>Ativo:</label>
                                <input type="checkbox" name="status"  {{ (old('status') == 'on' || old('status') == "1" ? 'checked' : ($product->status == "1" ? 'checked' : '')) }} value="1">
                            </div>
                            <div class="form-group col-md-12">
                                <label>Criado por:</label>
                                {{$product->user_name->name}}
                            </div>
                            <div class="form-group col-md-6">
                                <input type="submit" name="submit" class="btn btn-primary pull-left" value="Editar">
                            </div>
                            <div class="form-group col-md-6">
                                <a href="{{ route('admin.product.destroy', ['product' => $product->id]) }}" class="btn btn-danger pull-right" onclick="return confirm('Tem certeza que deseja excluir esse produto?')">Excluir</a>
                            </div>
                        </form>
                    </div><!--contact-form-->
                </div><!--col-sm-12-->
            </div><!--row-->
        </div><!--bg-->
    </div><!--container-->
@endsection
