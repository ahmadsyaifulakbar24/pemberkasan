<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login - Pemberkasan</title>
	<link rel="stylesheet" href="{{asset('assets/vendors/bootstrap/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/vendors/mdi/css/materialdesignicons.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/auth.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/loader.css')}}">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>
	<div class="auth">
		<div class="card rounded shadow">
			<div class="card-head text-center px-4 pt-4">
				<!-- <img src="{{asset('assets/images/eoffice.png')}}" width="120"> -->
				<h2 class="pt-4">Pemberkasan</h2>
				<p class="text-secondary">PT. Karl Wig Abadi</p>
			</div>
			<div class="card-body">
				<form id="form">
					<div class="alert alert-danger none" role="alert">
						<i class="mdi mdi-close-circle"></i>Username atau Password salah
					</div>
					@if(isset($_GET['timeout']))
					<div class="alert alert-warning" role="alert">
						<i class="mdi mdi-information-outline"></i>Sesi Anda telah berakhir
					</div>
					@endif
					<div class="form-group">
						<label for="username">Username</label>
						<input type="text" id="username" class="form-control" autofocus="autofocus">
					</div>
					<div class="form-group position-relative">
						<label for="password">Password</label>
						<input type="password" id="password" class="form-control pr-5" maxlength="32" autocomplete="on">
						<i class="password mdi mdi-eye-off mdi-18px" data-id="password"></i>
					</div>
					<div class="form-group mt-5">
						<button class="btn btn-primary btn-block mb-4" id="submit">
							<span id="text">Login</span>
							<div class="loader loader-sm none" id="load">
								<svg class="circular" viewBox="25 25 50 50">
									<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="5" stroke-miterlimit="10"/>
								</svg>
							</div>
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	@include('layouts.partials.script')
	<script src="{{asset('api/login.js')}}"></script>
</body>
</html>