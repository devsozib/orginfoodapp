<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\MaterialsPurchase;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DistributorController;
use App\Http\Controllers\ShiftProductController;

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


   //Distributors Routes Start Here
   Route::get('/distributors', [DistributorController::class, 'index'])->name('distributors');
   Route::get('/create-distributors', [DistributorController::class, 'create'])->name('create_distributors');
   Route::post('/store-distributors',[DistributorController::class, 'store'])->name('store_distributors');
   //Distributors Routes end Here

  //Vendors Routes Start Here
  Route::get("/all-vendors", [VendorController::class, 'index'])->name('vendors');
  Route::get('/create_vendors', [VendorController::class, 'create'])->name('create_vendors');
  Route::post('/store-vendors', [VendorController::class, 'store'])->name('store_vendors');
  //Vendors Routes End Here you may


  //Purchase Materials Routes Start

  Route::get('/purchase_materials', [MaterialsPurchase::class, 'purchase'])->name('purchase_materials');
  Route::post('/store_raw_materials',[MaterialsPurchase::class, 'store'])->name('store_raw_materials');
  Route::get('raw-materials-lists',[MaterialsPurchase::class, 'getList'])->name('materials_list');

  //Product route start here
  Route::get('/products', [ProductController::class, 'index'])->name('products');
  Route::get('/add_product', [ProductController::class, 'addProductView'])->name('add_product');
  Route::post('/store_product', [ProductController::class, 'store'])->name('store_product');

  //production route start here
  Route::get('/production', [ProductController::class, 'productionList'])->name('production');
  Route::get('/add_production', [ProductController::class, 'addProductionView'])->name('add_production');
  Route::post('/store_production', [ProductController::class, 'storeProduction'])->name('store_production');



  //Stock Routes start here
   Route::get('stocks', [StockController::class, 'index'])->name('stocks');
   Route::get('add-stock',[StockController::class, 'create'])->name('add_stock');
   Route::post('store-stock',[StockController::class, 'store'])->name('store_stock');



   //Shift Route start here
    Route::get('shift-product', [ShiftProductController::class, 'index'])->name('shift_product');
    Route::get('shift-stock-create',[ShiftProductController::class, 'create'])->name('shift_stock_create');
    Route::post('shift-stock-store', [ShiftProductController::class, 'store'])->name('shift_product_store');



});

Auth::routes();


