@extends('layouts/app')

@section('title','Dashboard')

@section('content')
	<div class="container">
		<h5 class="pb-2">Dashboard</h5>
        <div class="row mb-3">
			<div class="col-6 col-md-4 mb-4">
				<a href="{{url('osp')}}">
					<div class="card card-custom card-height">
						<div class="card-body">
							<h6>OSP</h6>
							<div class="d-flex justify-content-between align-items-center position-relative">
								<i class="mdi mdi-clipboard-text-outline mdi-36px"></i>
								<h4 class="mb-0">
									<div class="loader loader-sm btn-loading hide">
										<svg class="circular" viewBox="25 25 50 50">
											<circle class="pathd" cx="50" cy="50" r="20" fill="none" stroke-width="6" stroke-miterlimit="1"/>
										</svg>
									</div>
								</h4>
								<div class="notification none"></div>
							</div>
						</div>
					</div>
				</a>
			</div>
        </div>
	</div>
@endsection

@section('script')
	<!-- <script src="{{asset('assets/js/number.js')}}"></script> -->
	<script src="{{asset('api/dashboard.js')}}"></script>
@endsection