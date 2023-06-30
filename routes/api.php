<?php


use App\Http\Controllers\API\AuthUserController;
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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return auth()->user();
});

Route::post('/register', [AuthUserController::class, 'register'])
    ->middleware('guest')
    ->name('register');

Route::post('/login', [AuthUserController::class, 'login'])
    ->middleware('guest')
    ->name('login');


Route::post('/logout', [AuthUserController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

    Route::get('products/trashed', [ProductController::class, 'deleted_index'])->name('products.trashed');
    Route::get('products/restore/{id}', [ProductController::class, 'restore'])->name('products.restore');
    Route::delete('products/forceDelete/{id}', [ProductController::class, 'forceDelete'])->name('products.forceDelete');
