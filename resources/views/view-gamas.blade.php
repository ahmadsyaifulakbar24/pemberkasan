@extends('layouts/app')

@section('title','Buat Project')

@section('content')
	<div class="container container-compose">
		<div class="none" id="data">
            <div class="d-md-flex align-items-center justify-content-between pb-2">
                <h5 class="project"></h5>
                <div class="text-right">
                    <a class="btn btn-sm btn-outline-primary hide" id="btn-edit">Edit Project</a>
                    <a class="btn btn-sm btn-outline-primary" id="btn-project">Team Project</a>
                    <div class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#modal-history">History</div>
                    <div class="btn btn-sm btn-primary hide" data-toggle="modal" data-target="#modal-accept" id="btn-accept">Selesai</div>
                </div>
            </div>

			<div id="card">
				<div class="row" id="select-type">
					<div class="col-xl-4 col-md-6">
						<select class="custom-select mb-3" role="button">
							<option value="photo">Foto</option>
							<option value="document">Dokumen</option>
						</select>
					</div>
				</div>
				<div id="photo">
					<div class="row"></div>
					<div class="none" id="photo-empty">
						<div class="d-flex flex-column justify-content-center align-items-center state">
							<h5 class="text-capitalize">Foto Kosong</h5>
						</div>
					</div>
				</div>
				<div class="none" id="mapping">
					<div class="row"></div>
					<div class="none" id="mapping-empty">
						<div class="d-flex flex-column justify-content-center align-items-center state">
							<h5 class="text-capitalize">Mapping Kosong</h5>
						</div>
					</div>
				</div>
				<div class="none" id="document">
		            <div class="card card-custom">
		                <div class="table-custom">
		                    <div class="table-responsive">
		                        <table class="table table-middle mb-0">
		                            <thead class="thead-blue manager">
		                                <tr>
		                                    <th class="text-truncate">No.</th>
		                                    <th class="text-truncate">Nama File</th>
		                                    <th class="text-truncate">File</th>
		                                    <th class="text-truncate">Keterangan</th>
		                                    <th class="text-truncate">Sembunyikan</th>
		                                    <th class="text-truncate"></th>
		                                </tr>
		                            </thead>
									<thead class="thead-blue directur">
                                        <tr>
											<th class="text-truncate">No.</th>
											<th class="text-truncate">Nama File</th>
											<th class="text-truncate">File</th>
											<th class="text-truncate">Keterangan</th>
											<th class="text-truncate"></th>
										</tr>
                                    </thead>
		                            <tbody id="table"></tbody>
		                        </table>
		                    </div>
		                </div>
					</div>
					<div class="none" id="document-empty">
						<div class="d-flex flex-column justify-content-center align-items-center state">
							<h5 class="text-capitalize">Dokumen Kosong</h5>
						</div>
					</div>
				</div>
			</div>
            <div class="none" id="empty">
                <div class="d-flex flex-column justify-content-center align-items-center state">
                    <i class="mdi mdi-close-circle-outline mdi-48px pr-0"></i>
                    <h5 class="text-capitalize">Gamas Kosong</h5>
                </div>
            </div>
		</div>
		<div class="compose mb-5" id="btn-photo">
			<a href="{{url('upload/photo')}}/{{$id}}/{{$status_id}}" class="btn btn-sm btn-primary d-flex align-items-center shadow">
				<i class="mdi mdi-plus mdi-18px"></i> Upload Foto
			</a>
		</div>
		<div class="compose" id="btn-document">
			<a href="{{url('upload/document')}}/{{$id}}/{{$status_id}}" class="btn btn-sm btn-primary d-flex align-items-center shadow">
				<i class="mdi mdi-plus mdi-18px"></i> Upload Dokumen
			</a>
		</div>
		<div class="compose none" id="btn-mapping">
			<button class="btn btn-sm btn-primary d-flex align-items-center shadow">
				<i class="mdi mdi-download mdi-18px"></i> Unduh PDF
			</button>
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
	<div class="none" id="content-mapping">
		<div class="container">
			<h5 class="project pb-4"></h5>
			<h6 class="text-center pb-2">Before</h6>
			<div class="row" id="before"></div>
	    	<div class="html2pdf__page-break"></div>
			<h6 class="text-center pb-2">After</h6>
			<div class="row" id="after"></div>
		</div>
	</div>
	<div class="modal fade" id="modal-history" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
			<div class="modal-content">
				<div class="modal-header border-bottom-0">
					<h5 class="modal-title">History</h5>
					<div role="button" class="close" data-dismiss="modal" aria-label="Close">
						<i class="mdi mdi-close mdi-18px pr-0"></i>
					</div>
				</div>
				<div class="modal-body py-0" id="history"></div>
				<div class="modal-footer border-top-0">
					<div class="btn btn-sm btn-link" data-dismiss="modal">Tutup</div>
				</div>
			</div>
		</div>
    </div>
	<div class="modal fade" id="modal-accept" tabindex="-1" aria-hidden="true">
		<div class="modal-sm modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header border-bottom-0">
					<h5 class="modal-title">Selesai Project</h5>
					<div role="button" class="close" data-dismiss="modal" aria-label="Close">
						<i class="mdi mdi-close mdi-18px pr-0"></i>
					</div>
				</div>
				<div class="modal-body py-0">Anda yakin ingin selesaikan <b>Project Gamas</b>?</div>
				<div class="modal-footer border-top-0">
					<div class="btn btn-sm btn-link" data-dismiss="modal">Batal</div>
					<button class="btn btn-sm btn-primary" id="accept">Selesai</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade not_omzetting" id="modal-delete" tabindex="-1" aria-hidden="true">
		<div class="modal-sm modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header border-bottom-0">
					<h5 class="modal-title">Hapus Dokumen</h5>
					<div role="button" class="close" data-dismiss="modal" aria-label="Close">
						<i class="mdi mdi-close mdi-18px pr-0"></i>
					</div>
				</div>
				<div class="modal-body py-0">Anda yakin ingin menghapus <span id="body-delete"></span>?</div>
				<div class="modal-footer border-top-0">
					<div class="btn btn-sm btn-link" data-dismiss="modal">Batal</div>
					<button class="btn btn-sm btn-primary" id="delete">Hapus</button>
				</div>
			</div>
		</div>
    </div>
	<div class="modal" id="modal-photo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content bg-transparent border-0 d-block text-center">
				<img class="img-fluid mb-3 photo" data-dismiss="modal">
			</div>
		</div>
	</div>
@endsection

@section('script')
	<script>const id = {{$id}}</script>
	<script>const status_id = {{$status_id}}</script>
	<script src="{{asset('assets/js/html2pdf.min.js')}}"></script>
	<script src="{{asset('api/view-gamas.js')}}"></script>
@endsection