@extends('master')

@section('content')
<div id="contact-page" class="container">
    <div class="bg">
        <div class="row">
            <div class="col-sm-12">
                <div class="contact-form">
                    <h2 class="title text-center">Fale Conosco</h2>
                    <form action="{{ route('contact.store') }}" method="post" autocomplete="off">
                        @csrf
                        <div class="form-group col-md-6">
                            <input type="text" name="name" class="form-control" <?php if (Auth::user()): ?> value="{{ old('name') ?? Auth::user()->name }}" <?php else: ?> value="{{ old('name') }}" <?php endif; ?> required="required" placeholder="Seu Nome">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="email" name="email" class="form-control" <?php if (Auth::user()): ?> value="{{ old('email') ?? Auth::user()->email }}" <?php else: ?> value="{{ old('email') }}" <?php endif; ?> required="required" placeholder="E-mail">
                        </div>
                        <div class="form-group col-md-12">
                            <input type="text" name="subject" class="form-control" value="{{ old('subject') }}" required="required" placeholder="Assunto">
                        </div>
                        <div class="form-group col-md-12">
                            <textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Deixe sua mensagem aqui">{{ old('message') }}</textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <input type="submit" name="submit" class="btn btn-primary pull-right" value="Enviar">
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div><!--/#contact-page-->
@endsection
