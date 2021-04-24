@extends('layouts/app')

@section('title','Team Project')

@section('content')
	<div class="container container-compose">
		<h5 class="pb-2">Team Project</h5>
		<div class="card card-custom none" id="data">
			<div class="table-custom">
				<div class="table-responsive">
					<table class="table table-middle mb-0">
						<thead class="thead-blue">
							<tr>
								<th class="text-truncate">No.</th>
								<th class="text-truncate">Nama</th>
								<th class="text-truncate">Role</th>
								<th class="text-truncate"></th>
							</tr>
						</thead>
						<tbody id="table"></tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="compose">
			<div class="btn btn-sm btn-primary d-flex align-items-center shadow" data-toggle="modal" data-target="#modal-leader">
				<i class="mdi mdi-plus mdi-18px"></i> Tambah Leader
			</div>
		</div>
		<div class="none" id="empty">
			<div class="d-flex flex-column justify-content-center align-items-center state">
				<i class="mdi mdi-account-group-outline mdi-48px pr-0"></i>
				<h5>Belum ada Team Project</h5>
				<p class="text-secondary">Tambah Leader untuk menambah Leader baru</p>
			</div>
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
	<div class="modal fade" id="modal-leader" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header border-bottom-0">
					<h6 class="modal-title text-capitalize">Cari Leader</h6>
					<div role="button" class="close" data-dismiss="modal" aria-label="Close" data-toggle="modal">
						<i class="mdi mdi-close mdi-18px pr-0"></i>
					</div>
				</div>
				<div class="modal-body py-0">
					<div class="form-group">
						<input class="form-control" id="search-leader" placeholder="Cari..." autocomplete="off">
					</div>
					<div id="leader" class="overflow-auto hide" style="height:235px"></div>
					<div class="d-flex flex-column justify-content-center align-items-center" id="state-leader" style="height:235px">
						<i class="mdi mdi-magnify mdi-48px"></i>
						<h5>Cari Leader</h5>
						<p class="text-secondary">Masukkan nama leader</p>
					</div>
					<div class="d-flex flex-column justify-content-center align-items-center hide" id="empty-leader" style="height:235px">
						<i class="mdi mdi-close-circle mdi-48px"></i>
						<h5>Leader tidak ditemukan</h5>
						<p class="text-secondary">Masukkan nama leader dengan benar</p>
					</div>
					<div class="d-flex flex-column justify-content-center align-items-center hide" id="loading-leader" style="height:235px">
						<div class="loader">
							<svg class="circular" viewBox="25 25 50 50">
								<circle class="path-primary" cx="50" cy="50" r="20" fill="none" stroke-width="5" stroke-miterlimit="10"/>
							</svg>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-sm btn-link px-4" data-dismiss="modal" data-toggle="modal">Batal</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="modal-accept" tabindex="-1" aria-hidden="true">
		<div class="modal-sm modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header border-bottom-0">
					<h5 class="modal-title">Tambah Leader</h5>
					<div role="button" class="close" data-dismiss="modal" aria-label="Close">
						<i class="mdi mdi-close mdi-18px pr-0"></i>
					</div>
				</div>
				<div class="modal-body py-0">Anda yakin ingin tambah <b class="leader"></b> sebagai leader?</div>
				<div class="modal-footer border-top-0">
					<div class="btn btn-sm btn-link" data-dismiss="modal" id="back">Kembali</div>
					<button class="btn btn-sm btn-primary" id="accept">Tambah</button>
				</div>
			</div>
		</div>
	</div>
	<!-- <div class="modal fade" id="modal-delete" tabindex="-1" aria-hidden="true">
		<div class="modal-sm modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header border-bottom-0">
					<h5 class="modal-title">Hapus Project</h5>
					<div role="button" class="close" data-dismiss="modal" aria-label="Close">
						<i class="mdi mdi-close mdi-18px pr-0"></i>
					</div>
				</div>
				<div class="modal-body py-0">Anda yakin ingin menghapus project <b class="project"></b>?</div>
				<div class="modal-footer border-top-0">
					<div class="btn btn-sm btn-link" data-dismiss="modal">Batal</div>
					<button class="btn btn-sm btn-primary" id="delete">Hapus</button>
				</div>
			</div>
		</div>
	</div> -->
@endsection

@section('script')
	<script>const id = {{$id}}</script>
	<script src="{{asset('api/team.js')}}"></script>
@endsection