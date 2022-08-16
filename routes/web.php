<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BranchController;

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


Route::middleware(['auth'])->group(function (){
    //Route::get('/', function () { return view('home');});

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('/');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    //Users Routes Start Here
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/create-users', [UserController::class, 'create'])->name('create_user');
    Route::post('/store-user',[UserController::class, 'store'])->name('store_user');
   //Users Routes End Here
    //Branch Routes Start
    Route::get("/all-branches", [BranchController::class, 'index'])->name('branches');
    Route::get('/add_branch_form', [BranchController::class, 'addBranchForm'])->name('add_branch_form');
    Route::post('/add_branch', [BranchController::class, 'addBranch'])->name('add_branch');
   //Branch End Start

});

Auth::routes();


