@extends('layouts/app')

@section('title','Upload Foto')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-xl-8 col-lg-10 offset-xl-2 offset-lg-1">
				<h5 class="pb-2">Upload Foto</h5>
				<div class="card card-custom none" id="card">
					<form id="form" class="card-body">
						<div class="form-group form-file row">
							<label for="file" class="col-lg-4 col-sm-5 col-form-label text-secondary">File</label>
							<div id="form-file" class="col-lg-8 col-md-7">
								<div class="file-group">
									<div class="custom-file">
										<input type="file" class="custom-file-input" id="file" role="button" accept="image/*">
										<label class="custom-file-label">Pilih File</label>
										<div id="file-feedback" class="invalid-feedback"></div>
									</div>
								</div>
							</div>
							<div class="invalid-feedback" id="file-feedback"></div>
						</div>
						<div class="row">
							<div class="offset-lg-4 offset-md-5 col-lg-8 col-md-7 mt-3">
								<div class="form-group">
									<button class="btn btn-block btn-primary px-3" id="submit">Upload Foto</button>
								</div>
							</div>
						</div>
					</form>
				</div>
                <div id="loading">
                    <div class="d-flex flex-column justify-content-center align-items-center state">
                        <div class="loader">
                            <svg class="circular" viewBox="25 25 50 50">
                                <circle class="path-primary" cx="50" cy="50" r="20" fill="none" stroke-width="5" stroke-miterlimit="10"/>
                            </svg>
                        </div>
                    </div>
                </div>
			</div>
	    </div>
	</div>
@endsection

@section('script')
	<script>const id = {{$id}}</script>
	<script>const status_id = {{$status_id}}</script>
	<script src="{{asset('assets/js/file.js')}}"></script>
	<script src="{{asset('api/upload-photo.js')}}"></script>
@endsection