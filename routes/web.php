<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;

Route::get('session/login', [SessionController::class, 'createSession']);
Route::get('session/logout', [SessionController::class, 'deleteSession']);

Route::group(['middleware'=>['afterMiddleware']], function () {
	Route::get('/', function () {
		return view('login');
	});
});

Route::group(['middleware'=>['beforeMiddleware']], function () {
	Route::get('dashboard', function () {
		return view('dashboard');
	});
	Route::get('password', function () {
		return view('password');
	});
    Route::get('osp', function () {
        return view('osp');
    });
    Route::get('project/team/{id}', function ($id) {
        return view('team', compact('id'));
    });
    
    Route::group(['middleware'=>['managerMiddleware']], function () {
        Route::get('create/project', function () {
            return view('create-project');
        });
        Route::get('project/{id}', function ($id) {
            return view('edit-project', compact('id'));
        });
	});

    Route::get('project/{id}/{status_id}', function ($id, $status_id) {
        return view('view-project', compact('id', 'status_id'));
    });
    Route::get('project/gamas/{id}/{status_id}', function ($id, $status_id) {
        return view('view-gamas', compact('id', 'status_id'));
    });

    Route::group(['middleware'=>['leaderMiddleware']], function () {
        Route::get('upload/photo/{id}/{status_id}', function ($id, $status_id) {
	        return view('upload-photo', compact('id', 'status_id'));
        });
        Route::get('upload/document/{id}/{status_id}', function ($id, $status_id) {
	        return view('upload-document', compact('id', 'status_id'));
        });
        Route::get('upload/golive/{id}/{status_id}', function ($id, $status_id) {
	        return view('upload-golive', compact('id', 'status_id'));
        });
        Route::get('upload/omzetting/{id}', function ($id) {
            return view('upload-omzetting', compact('id'));
        });

	    Route::get('edit/photo/{id}', function ($id) {
	        return view('edit-photo', compact('id'));
	    });
	    Route::get('edit/document/{id}', function ($id) {
	        return view('edit-document', compact('id'));
	    });
	    Route::get('edit/golive/{id}', function ($id) {
	        return view('edit-golive', compact('id'));
	    });
    });

    Route::get('dokumen/{id}', function ($id) {
        return view('dokumen', compact('id'));
    });

    Route::get('omzetting/{id}', function ($id) {
        return view('omzetting', compact('id'));
    });
});