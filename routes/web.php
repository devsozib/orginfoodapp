<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\MaterialsPurchase;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RawProductController;
use App\Http\Controllers\DistributorController;
use App\Http\Controllers\ShiftProductController;
use App\Http\Controllers\RawMaterialsItemController;

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
    Route::post('/store_admin',[UserController::class, 'storeAdmin'])->name('store_admin');
    Route::post('/store_sr',[UserController::class, 'storeSR'])->name('store_sr');
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

  Route::get('/purchase-materials', [MaterialsPurchase::class, 'purchase'])->name('purchase_materials');
  Route::post('/purchase-raw-materials',[MaterialsPurchase::class, 'store'])->name('purchase_raw_materials');
  Route::get('raw-materials-lists',[MaterialsPurchase::class, 'getList'])->name('materials_list');
  //Purchase Materials Routes end


  //Product route start here
  Route::get('/products', [ProductController::class, 'index'])->name('products');
  Route::get('/add_product', [ProductController::class, 'addProductView'])->name('add_product');
  Route::post('/store_product', [ProductController::class, 'store'])->name('store_product');
  //Product route end here

  //production route start here
  Route::get('/production', [ProductController::class, 'productionList'])->name('production');
  Route::get('/add_production', [ProductController::class, 'addProductionView'])->name('add_production');
  Route::post('/store_production', [ProductController::class, 'storeProduction'])->name('store_production');
  //production route end here


  //Stock Routes start here
   Route::get('stocks', [StockController::class, 'index'])->name('stocks');
   Route::get('add-stock',[StockController::class, 'create'])->name('add_stock');
   Route::post('store-stock',[StockController::class, 'store'])->name('store_stock');
  //Stock Routes emd here


   //Shift Route start here
    Route::get('shift-product', [ShiftProductController::class, 'index'])->name('shift_product');
    Route::get('shift-stock-create',[ShiftProductController::class, 'create'])->name('shift_stock_create');
    Route::post('shift-stock-store', [ShiftProductController::class, 'store'])->name('shift_product_store');
   //Shift Route end here


   //Order Route Start Here

   Route::get('orders',[OrderController::class,'index'])->name('orders');
   Route::get('order-place',[OrderController::class,'create'])->name('order_place');
   Route::post('store-orders',[OrderController::class,'store'])->name('store_orders');


   //Change order status route

   Route::get('change-order-status',[OrderController::class,'ChangeStatus'])->name('change-order-status');

   Route::get('/purchase-history/{id}',[MaterialsPurchase::class, 'purchaseHistory'])->name('purchase_history');

   Route::get('/due-payment/{id}',[MaterialsPurchase::class, 'duePayment'])->name('due_payment');
   Route::post('make-due-payment',[MaterialsPurchase::class, 'makeDuePayment'])->name('make_due_payment');

   //Raw Product Controller
   Route::get('raw-product',[RawProductController::class, 'rawProduct'])->name('raw_product');
   Route::get('add-raw-product',[RawProductController::class, 'addRawProduct'])->name('add_raw_product');
   Route::post('store-raw-product',[RawProductController::class, 'storeRawProduct'])->name('storeRawProduct');

   //Raw materials items
   Route::get('raw-materials-item',[RawMaterialsItemController::class, 'index'])->name('raw_materials_item');
   Route::get('create-raw-materials',[RawMaterialsItemController::class, 'create'])->name('create_raw_materials');
   Route::post('store-raw-materials',[RawMaterialsItemController::class, 'store'])->name('store_raw_materials');
   Route::get('material-stock',[RawMaterialsItemController::class, 'materialsStock'])->name('materials_stock');

});

Auth::routes();


