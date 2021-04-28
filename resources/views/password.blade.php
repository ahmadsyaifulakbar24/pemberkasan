@extends('layouts/app')

@section('title','Ubah Password')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-xl-8 col-lg-10 offset-xl-2 offset-lg-1">
				<h4 class="pb-2">Ubah Password</h4>
				<div class="card card-custom">
					<form id="form" class="card-body">
						<div class="form-group row">
							<label for="password" class="col-lg-4 col-md-5 col-form-label text-secondary">Password lama</label>
							<div class="col-lg-8 col-md-7">
								<input type="password" id="password" class="form-control pr-5">
								<!-- <i class="password mdi mdi-eye-off mdi-18px" data-id="password"></i> -->
								<div id="password-feedback" class="invalid-feedback"></div>
							</div>
						</div>
						<div class="form-group row">
							<label for="npassword" class="col-lg-4 col-md-5 col-form-label text-secondary">Password baru</label>
							<div class="col-lg-8 col-md-7">
								<input type="password" id="npassword" class="form-control pr-5">
								<div id="npassword-feedback" class="invalid-feedback"></div>
								<!-- <i class="password mdi mdi-eye-off mdi-18px" data-id="npassword"></i> -->
							</div>
						</div>
						<div class="form-group row">
							<label for="cpassword" class="col-lg-4 col-md-5 col-form-label text-secondary">Konfirmasi password</label>
							<div class="col-lg-8 col-md-7">
								<input type="password" id="cpassword" class="form-control pr-5">
								<div id="cpassword-feedback" class="invalid-feedback"></div>
								<!-- <i class="password mdi mdi-eye-off mdi-18px" data-id="cpassword"></i> -->
							</div>
						</div>
						<div class="form-group row pt-3">
							<div class="offset-lg-4 offset-md-5 col-lg-8 col-md-7">
								<button class="btn btn-block btn-primary px-3" id="submit">Ubah Password</button>
							</div>
						</div>
					</form>
				</div>
			</div>
	    </div>
	</div>
@endsection

@section('script')
	<script src="{{asset('api/password.js')}}"></script>
@endsection