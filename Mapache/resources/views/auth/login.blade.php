@extends('layouts.app')

@section('content')

<div class="login-wrap card">
    <div class="login-html card-body">
        <div class="row justify-content-center">
            <img  width="20%" src="{{ asset('img/mapache.png') }}" alt="Thumbnail image">
        </div>

		<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Iniciar Sesión</label>
		<input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Registrarse</label>
		<div class="login-form">
           <form method="POST" class="justify-content-center " action="{{ route('login') }}">
            @csrf
			<div class="sign-in-htm">
				<div class="group for-group {{ $errors->has('username') ? 'text-danger' : '' }}">
					<label for="username" class="label">Nombre de Usuario</label>
					<input id="username" name="username" type="text" class="input">
                    {!! $errors->first('username', '<span class="help-block">:message</span>')!!}
				</div>
				<div class="group for-group {{ $errors->has('password') ? 'has-error' : '' }}">
					<label for="password" class="label">Password</label>
					<input id="password" name="password" type="password" class="input" data-type="password">
                    {!! $errors->first('password', '<span class="help-block">:message</span>')!!}
				</div>
				<div class="group">
					<input id="check" type="checkbox" class="check" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
					<label for="check"><span class="icon"></span>{{ __('Recordarme') }}</label>
				</div>
				<div class="group">
           
					<input type="submit" class="button  btn btn-dark" value="Iniciar">
				</div>
				<div class="hr"></div>
				<div class="foot-lnk">
                @if (Route::has('password.request'))
                 <a class="btn btn-outline-dark" href="{{ route('password.request') }}">
                     {{ __('¿Ovidaste tu contraseña?') }}
                 </a>
                 @endif
				</div>
                </form>
            </div>
            
			<div class="sign-up-htm">
              <form method="POST" action="{{ route('register') }}">
              @csrf
				<div class="group">
					<label for="username" class="label">Usuario</label>
					<input id="username" name="username" type="text" class="input form-control @error('username') is-invalid @enderror" required>
                    @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
				</div>
				<div class="group">
					<label for="password" class="label">Contraseña</label>
					<input id="password" name="password" type="password" class="input form-control @error('password') is-invalid @enderror" data-type="password" required>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
				</div>
				<div class="group">
					<label for="password-confirm" class="label">Confirmar Contraseña</label>
					<input id="password-confirm" name="password_confirmation" type="password" class="input form-control" data-type="password" required autocomplete="new-password">
				</div>
				<div class="group">
					<label for="email" class="label">Email</label>
					<input id="email" name="email" type="email" class="input form-control @error('email') is-invalid @enderror">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
				</div>
				<div class="group">
                    <button type="submit" class="btn btn-dark">
                                    {{ __('Registrarse') }}
                                </button>
				
				</div>
                </form>
				<div class="hr"></div>
				<div class="foot-lnk">
					<label for="tab-1">¿Ya eres miembro?</a>
				</div>
            </div>
            
            
            </form>
		</div>
	</div>
</div>

@endsection
