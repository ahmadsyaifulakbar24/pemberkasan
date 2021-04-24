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
    
    Route::group(['middleware'=>['managerMiddleware']], function () {
        Route::get('create/project', function () {
            return view('create-project');
        });
        Route::get('project/{id}', function ($id) {
            return view('edit-project', compact('id'));
        })->where(['id' => '[0-9]+']);
	});

    Route::get('project/{id}/{status_id}', function ($id, $status_id) {
        return view('view-project', compact('id', 'status_id'));
    })->where(['id' => '[0-9]+', 'status_id' => '[0-9]+']);
    
    Route::get('project/gamas/{id}/{status_id}', function ($id, $status_id) {
        return view('view-gamas', compact('id', 'status_id'));
    })->where(['id' => '[0-9]+', 'status_id' => '[0-9]+']);

    Route::group(['middleware'=>['leaderMiddleware']], function () {
        Route::get('upload/{id}/{status_id}', function ($id, $status_id) {
        return view('upload', compact('id', 'status_id'));
        })->where(['id' => '[0-9]+', 'status_id' => '[0-9]+']);
        
        Route::get('upload/omzetting/{id}', function ($id) {
            return view('upload-omzetting', compact('id'));
        })->where(['id' => '[0-9]+']);
    });

    Route::get('dokumen/{id}/', function ($id) {
        return view('dokumen', compact('id'));
    })->where(['id' => '[0-9]+']);
    
    Route::get('omzetting/{id}', function ($id) {
        return view('omzetting', compact('id'));
    })->where(['id' => '[0-9]+']);
    
    Route::get('project/team/{id}', function ($id) {
        return view('team', compact('id'));
    })->where(['id' => '[0-9]+']);
});