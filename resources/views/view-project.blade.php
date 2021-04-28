@extends('layouts/app')

@section('title','Project')

@section('content')
	<div class="container container-compose">
		<div class="none" id="data">
            <div class="d-md-flex align-items-center justify-content-between pb-2">
                <h5 id="name"></h5>
                <div class="text-right">
                    <a class="btn btn-sm btn-outline-primary" id="edit_project">Edit Project</a>
                    <a class="btn btn-sm btn-outline-primary" id="team_project">Team Project</a>
                    <div class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#modal-history">History</div>
                    <div class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-accept" id="btn-accept">Selesai</div>
                </div>
            </div>
			<div class="row">
				<div class="col-xl-4 col-lg-5">
					<div class="card card-custom mb-3">
						<div class="card-body">
							<h6 class="text-secondary mb-0" data-toggle="collapse" href="#status" role="button" aria-expanded="false" aria-controls="status">Status</h6>
							<div class="collapse show" id="status">
								<ul class="nav nav-pills flex-column text-secondary mt-3" id="status_project"></ul>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-8 col-lg-7">
					<div class="card card-custom" id="card">
						<div class="table-custom">
							<div class="table-responsive">
								<table class="table mb-0">
									<thead class="thead-blue not_omzetting">
                                        <tr>
											<th class="text-truncate">No.</th>
											<th class="text-truncate">Nama File</th>
											<th class="text-truncate">File</th>
											<th class="text-truncate">Tipe File</th>
											<th class="text-truncate">Keterangan</th>
											<th class="text-truncate"></th>
										</tr>
                                    </thead>
									<thead class="thead-blue omzetting">
										<tr>
											<th class="text-truncate">No.</th>
											<th class="text-truncate">ID Valins</th>
											<th class="text-truncate">Label ODP</th>
											<th class="text-truncate">Internet Number</th>
											<th class="text-truncate"></th>
										</tr>
									</thead>
									<tbody id="table"></tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="none" id="empty">
						<div class="d-flex flex-column justify-content-center align-items-center state">
							<i class="mdi mdi-48px pr-0" id="icon-empty"></i>
							<h5 class="text-capitalize" id="title-empty"> Kosong</h5>
							<p class="text-secondary">Upload Dokumen untuk membuat Dokumen baru</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="compose">
			<a href="{{url('upload')}}/{{$id}}/{{$status_id}}" class="btn btn-sm btn-primary d-flex align-items-center shadow">
				<i class="mdi mdi-plus mdi-18px"></i> Upload Dokumen
			</a>
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
	<div class="modal fade" id="modal-history" tabindex="-1" aria-hidden="true">
		<div class="modal-sm modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
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
				<div class="modal-body py-0">Anda yakin ingin selesaikan <b id="project"></b>?</div>
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
				<div class="modal-body py-0">Anda yakin ingin menghapus dokumen <b id="body-delete"></b>?</div>
				<div class="modal-footer border-top-0">
					<div class="btn btn-sm btn-link" data-dismiss="modal">Batal</div>
					<button class="btn btn-sm btn-primary" id="delete">Hapus</button>
				</div>
			</div>
		</div>
    </div>
	<div class="modal fade omzetting" id="modal-omzetting" tabindex="-1" aria-hidden="true">
		<div class="modal-sm modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header border-bottom-0">
					<h5 class="modal-title">Hapus Omzetting</h5>
					<div role="button" class="close" data-dismiss="modal" aria-label="Close">
						<i class="mdi mdi-close mdi-18px pr-0"></i>
					</div>
				</div>
				<div class="modal-body py-0">Anda yakin ingin menghapus ID Valins <b id="body-omzetting"></b>?</div>
				<div class="modal-footer border-top-0">
					<div class="btn btn-sm btn-link" data-dismiss="modal">Batal</div>
					<button class="btn btn-sm btn-primary" id="delete-omzetting">Hapus</button>
				</div>
			</div>
		</div>
    </div>
@endsection

@section('script')
	<script>const id = {{$id}}</script>
	<script>const status_id = {{$status_id}}</script>
	<script src="{{asset('api/view-project.js')}}"></script>
@endsection