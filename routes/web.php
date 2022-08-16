<?php

use Illuminate\Support\Facades\Route;

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

    Route::get('/', function () { return view('home');});
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');





    Route::get('/add_branch_form', [App\Http\Controllers\BranchController::class, 'addBranchForm'])->name('add_branch_form');
    Route::post('/add_branch', [App\Http\Controllers\BranchController::class, 'addBranch'])->name('add_branch');


});

Auth::routes();


