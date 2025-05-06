@extends('layouts.my')

@section('content')
<div class="row d-flex justify-content-center">			
	<div class="col-md-3">
		<div class="card">
			<div class="card-body login-card-body">
				<div class="row d-flex justify-content-center">
					<img src="{{ asset('./img/logo.png') }}" width="80">
				</div>

				<div class="row d-flex justify-content-center">
					<p>Sign in to start your session</p>
				</div>

				<!--
				<div class="row d-flex justify-content-center">
					<p>
					@if(session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
					@if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
					</p>
				</div>

				<form method="POST" action="{{ route('login') }}">
					@csrf
					
					<div class="input-group mb-3">
						<input 
							type="text" 
							id="username" 
							name="username" 
							placeholder="Username"
							class="form-control @error('username') is-invalid @enderror" 
							value="{{ old('username') }}" 
							autocomplete="username" 
							autofocus
						>
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-user"></span>
							</div>
						</div>

						@error('username')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>					

					<div class="input-group mb-3">
						<input 
							type="password" 
							id="password"
							name="password"
							placeholder="Password" 
							class="form-control @error('password') is-invalid @enderror" 
							value="{{ old('password') }}" 
							autocomplete="current-password"
						>
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-lock"></span>
							</div>
						</div>

						@error('password')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>

					

					<div class="form-group row">
						<div class="col-md-6">
							<div class="form-check">
								<input class="form-check-input" type="checkbox" name="remember" id="remember" >

								<label class="form-check-label" for="remember">
									Remember Me
								</label>
							</div>
						</div>
					</div>

					<div class="row d-flex justify-content-center">
						<p></p>
					</div>

					<div class="form-group row mb-0">
						<div class="col-md-12">                               
							<a class="btn btn-link" href="#">
								Forgot Your Password?
							</a>
							
							<button type="submit" class="btn btn-primary float-right">
								Login
							</button>
						</div>
					</div>
					-->
					<div class="social-auth-links text-center mb-3">
                        <!--
                        <p>- OR -</p>
                        <a href="#" class="btn btn-block btn-primary">
                        <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                        </a>
                        
                        <a href="{{ url('/auth/google') }}" class="btn btn-block btn-success">
                        <i class="fab fa-google mr-2"></i> Sign in using Google
                        </a>
                        -->

                        <a href="{{ url('/auth/google') }}" class="google-btn">
							<img src="https://developers.google.com/identity/images/g-logo.png" alt="Google Logo" width="10%">
							Sign in with DepEd GMail
						</a>
                        <br>
                        <br>
                        
                        @if (session('not_reg'))
							<div class="alert alert-warning">
								<strong>{{ session('not_reg') }}</strong>
								<!--<a href="./rms/register">Register?</a>-->
							</div>
							<br>
						@endif
						@if (session('not_deped'))
							<div class="alert alert-warning">
								<strong>{{ session('not_deped') }}</strong>										
                            </div>
                            <br>
						@endif

                        
                        Forgot your DepEd GMail/Microsoft password? <br>
						Request for reset
						<a href="https://hrms.depedbohol.org/help/reset" target="_blank" class="google-btn">here</a>.
                    </div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
