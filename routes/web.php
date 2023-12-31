<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/google-map', [MapController::class, 'index']);

Route::get('/', function () {
    return view('welcome');
});
Route::get('/changeLang/{lang}', function (string $locale) {
    if (!in_array($locale, ['en', 'ar'])) {
        abort(400);
    }
    App::setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
})->name("changeLang");

Route::get('/dashboard', function () {
    return view('posts.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    //Route::get('/',[PostController::class,'index'])
//    ->name('posts');

    Route::get('/carts', [PostController::class, 'carts'])->name('posts');

//Route::get('/categories',[CategoryController::class,'index'])
//->name('categories.index');
//
//Route::get('/categories/{id}',[CategoryController::class,'show']);
//
//Route::get('/categories/create',[CategoryController::class,'create']);
//
//Route::get('/categories/{id}/edit',[CategoryController::class,'edit']);
//Route::post('/categories/store',[CategoryController::class,'store']);
//
//Route::put('/categories/{id}/update',[CategoryController::class,'update']);
//
//Route::delete('/categories/{id}',[CategoryController::class,'destroy']);

    Route::resource('categories',
        CategoryController::class);

    Route::resource('brands',
        BrandController::class);

    Route::resource('users',
        UserController::class);

    Route::resource('products',
        ProductController::class);
    Route::resource('roles',
        RoleController::class);
});

require __DIR__ . '/auth.php';
