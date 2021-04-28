<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>@yield('title') - Pemberkasan</title>
	<link rel="stylesheet" href="{{asset('assets/vendors/bootstrap/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/vendors/mdi/css/materialdesignicons.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/loader.css')}}">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
	@yield('style')
</head>
<body>
    <nav class="navbar navbar-expand-sm navbar-light bg-white border-bottom {{Request::is('logout')?'none':''}}">
        <div class="form-inline">
            <i class="mdi mdi-menu mdi-24px d-block d-lg-none pointer text-dark mr-2" id="menu"></i>
            <a class="navbar-brand d-none d-lg-block" href="{{url('dashboard')}}">
				<!-- <img src="{{asset('assets/images/eoffice.png')}}" width="30" class="d-inline-block align-top mr-2" alt="" loading="lazy"> -->
            	Pemberkasan
            </a>
        </div>
        <div class="dropdown ml-auto">
            <a id="dropdownMenu" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            	<img src="{{asset('assets/images/user.jpg')}}" class="avatar rounded-circle" width="25">
            </a>
            <div class="dropdown-menu dropdown-menu-right rounded border-0" aria-labelledby="dropdownMenu">
            	<!-- <div class="text-center my-3 px-3 text-break">
	            	<img src="{{asset('assets/images/photo.png')}}" class="avatar rounded-circle" width="75">
	            	<h6 class="name text-truncate pt-3 mb-0"></h6>
	            	<small class="level text-secondary"></small>
	            </div> -->
            	<div class="dropdown-item d-flex align-items-center">
	            	<img src="{{asset('assets/images/user.jpg')}}" class="avatar rounded-circle align-self-center" width="50">
	            	<div class="ml-3 text-truncate">
		            	<h6 class="name text-truncate mb-1"></h6>
		            </div>
	            </div>
	            <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{url('password')}}">
                    <i class="mdi mdi-18px mdi-lock-outline"></i><span>Ubah Password</span>
                </a>
                <a class="dropdown-item" href="javascript:void(0)" onclick="return logout()" data-toggle="modal" data-target="#modal-logout">
                    <i class="mdi mdi-18px mdi-login-variant"></i><span>Logout</span>
                </a>
            </div>
        </div>
    </nav>
	<div class="sidebar {{Request::is('logout')?'none':''}}">
		<div class="py-2 pl-3 border-bottom">
			<!-- <img src="{{asset('assets/images/logo.png')}}" width="30" class="d-inline-block align-top mr-2 mt-1" alt="Logo" loading="lazy"> -->
			<span class="navbar-brand mb-0">Pemberkasan</span>
		</div>
		<small class="text-secondary text-uppercase font-weight-bold">Menu</small>
		<a href="{{url('dashboard')}}" class="{{Request::is('dashboard')?'active':''}}">
			<i class="mdi mdi-apps mdi-18px"></i><span>Dashboard</span>
		</a>
		<a href="{{url('osp')}}" class="{{Request::is('osp')?'active':''}}">
			<i class="mdi mdi-clipboard-text-outline mdi-18px"></i><span>OSP</span>
		</a>
		<small class="text-secondary" style="position:absolute;bottom:5px">2021 &copy; PT. Karl Wig Abadi</small>
	</div>
	<div class="modal" id="modal-logout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content bg-transparent border-0">
				<div class="d-flex flex-column justify-content-center align-items-center">
					<div class="loader">
						<svg class="circular" viewBox="25 25 50 50">
							<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="5" stroke-miterlimit="10"/>
						</svg>
					</div>
					<h6 class="text-light mt-3">Logout...</h6>
				</div>
			</div>
		</div>
	</div>
	<div class="overlay"></div>
	<div class="main">@yield('content')</div>
	<div class="customAlert d-flex align-items-center small"></div>
	@include('layouts.partials.script')
	@yield('script')
</body>
</html>