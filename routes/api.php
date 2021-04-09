<?php

use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\LogoutController;
use App\Http\Controllers\API\Auth\ResetPasswordController;
use App\Http\Controllers\API\Omzetting\CreateOmzettingController;
use App\Http\Controllers\API\Project\AcceptStatusProjectController;
use App\Http\Controllers\API\Project\CreateProjectController;
use App\Http\Controllers\API\Project\DeleteProjectController;
use App\Http\Controllers\API\Project\GetProjectController;
use App\Http\Controllers\API\Project\UpdateProjectController;
use Illuminate\Auth\Events\Logout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', LoginController::class);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', LogoutController::class);
    Route::post('reset_password', ResetPasswordController::class);

    Route::prefix('project')->group(function () {
        Route::get('{project_id?}', GetProjectController::class);
        Route::post('create', CreateProjectController::class);
        Route::patch('{project:id}/update/', UpdateProjectController::class);
        Route::patch('{project:id}/accept_status/', AcceptStatusProjectController::class);
        Route::delete('{project:id}/delete/', DeleteProjectController::class);
    });

    Route::prefix('omzetting')->group(function () {
        Route::post('{project:id}/create', CreateOmzettingController::class);
    });
});

