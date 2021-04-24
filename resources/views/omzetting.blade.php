@extends('layouts/app')

@section('title','Edit Omzetting')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-xl-8 col-lg-10 offset-xl-2 offset-lg-1">
				<h5 class="pb-2">Edit Omzetting</h5>
				<div class="card card-custom none" id="card">
					<form id="form" class="card-body">
						<div class="form-group row">
							<label for="id_valins" class="col-lg-4 col-sm-5 col-form-label text-secondary">Id Valins</label>
							<div class="col-lg-8 col-sm-7">
								<input class="form-control" id="id_valins">
								<div class="invalid-feedback" id="id_valins-feedback">Masukkan id valins</div>
							</div>
						</div>
						<div class="form-group row">
							<label for="label_odp" class="col-lg-4 col-sm-5 col-form-label text-secondary">Label ODP</label>
							<div class="col-lg-8 col-sm-7">
								<input class="form-control" id="label_odp">
								<div class="invalid-feedback" id="label_odp-feedback">Masukkan label odp</div>
							</div>
						</div>
                        <div id="data"></div>
						<div class="row">
							<div class="offset-lg-4 offset-md-5 col-lg-8 col-md-7 mt-3">
								<div class="form-group">
									<div class="btn btn-md btn-block btn-outline-primary position-relative" id="add">
										<i class="position-absolute mdi mdi-plus mdi-18px" style="left:10px;top:5px"></i>Tambah Internet Number
									</div>
									<button class="btn btn-block btn-primary px-3" id="submit">Simpan</button>
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
	<script src="{{asset('api/omzetting.js')}}"></script>
@endsection