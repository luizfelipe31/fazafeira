@extends('master')

@section('content')
	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Acessar Conta</h2>
                        <form name="login" action="{{ route('doLogin') }}" method="post" class="login" autocomplete="off">
							<input type="email" class="form-control" name="email" placeholder="E-mail" />
							<input type="password" class="form-control" name="password_check" placeholder="Password" />
							<button type="submit" class="btn btn-default">Login</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OU</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>Novo(a) por aqui? Cadastre-se</h2>
						<form action="{{ route('register') }}" method="post" autocomplete="off">
                            @csrf
							<input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Name" required/>
							<input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="E-mail" required/>
                            <input type="text" class="form-control mask-doc" name="document" value="{{ old('document') }}" placeholder="CPF" required/>
							<input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Senha" required/>
							<button type="submit" class="btn btn-default">Cadastrar</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->

@endsection
@section('js')
<script src="{{url(mix('backend/assets/js/login.js'))}}"></script>
@endsection
