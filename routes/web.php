<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('user/list', [UserController::class, 'all'])->name('user/list');
Route::post('user/validate', [UserController::class, 'validateAuth'])->name('user/validate');
Route::get('user/logout', [UserController::class, 'logout'])->name('user/logout');
Route::any('user/create', [UserController::class, 'create'])->name('user/create');
Route::any('user/edit/{id}', [UserController::class, 'edit'])->name('user/edit');
Route::get('user/delete/{id}', [UserController::class, 'delete'])->name('user/delete');
Route::get('user/getListCollaborators/{id}', [UserController::class, 'getListCollaborators'])->name('user/getListCollaborators');
Route::get('user/assign/{idUser}/{idUserCollaborator}', [UserController::class, 'saveColaborator'])->name('user/assign');
