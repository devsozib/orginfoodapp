<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\MaterialsPurchase;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ConsumerController;
use App\Http\Controllers\RawProductController;
use App\Http\Controllers\DistributorController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ShiftProductController;
use App\Http\Controllers\MaterialsStockController;
use App\Http\Controllers\RawProductSalesController;
use App\Http\Controllers\RawMaterialsItemController;



Route::middleware(['auth'])->group(function (){

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('/');
    //Route::get('/', function () { return view('home');});
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::middleware(['IsNotSr'])->group(function (){
        //Vendors Routes Start Here
        Route::get("/all-vendors", [VendorController::class, 'index'])->name('vendors');

        //Purchase Materials Routes Start
        Route::get('raw-materials-lists',[MaterialsPurchase::class, 'getList'])->name('materials_list');
        Route::get('/search-data',[MaterialsPurchase::class,'searchItem']);

        //production route start here
        Route::get('/production', [ProductController::class, 'productionList'])->name('production');
        Route::get('/search-production',[ProductController::class,'searchItem']);
        //production route end here

        //RawProductStock
        Route::get('raw-product-stocks',[StockController::class, 'rawProductStock'])->name('raw_product_stocks');
        //Raw Product Controller
        Route::get('raw-product',[RawProductController::class, 'rawProduct'])->name('raw_product');
        Route::get('add-raw-product',[RawProductController::class, 'addRawProduct'])->name('add_raw_product');
        Route::post('store-raw-product',[RawProductController::class, 'storeRawProduct'])->name('storeRawProduct');

        //Raw materials items
        Route::get('material-stock',[MaterialsStockController::class, 'materialsStock'])->name('materials_stock');

        //Consumer
        Route::get('consumers',[ConsumerController::class, 'index'])->name('consumers');
        Route::get('create-consumers',[ConsumerController::class, 'create'])->name('create_consumer');
        Route::post('store-consumer',[ConsumerController::class, 'store'])->name('store_consumer');
        Route::get('consumer-payment-history/{id}',[ConsumerController::class, 'paymentHistory'])->name('consumer_payment_history');
        Route::get('consumer-sales-history/{id}',[ConsumerController::class,'salesHistroy'])->name('consumer_sales_history');


        //Raw product sales
        Route::get('raw-product-sale',[RawProductSalesController::class,'index'])->name('raw_product_sale');
        Route::get('raw-product-sale-create',[RawProductSalesController::class,'create'])->name('raw_product_sale_create');
        Route::post('raw-product-sale-store',[RawProductSalesController::class,'store'])->name('raw_product_sale_store');
        Route::get('collect-due-payment/{id}',[RawProductSalesController::class,'collectPayment'])->name('collect_due_payment');
        Route::post('makeCollectionPayment',[RawProductSalesController::class,'makeCollectionPayment'])->name('makeCollectionPayment');

        //Vendors
        Route::get('/create_vendors', [VendorController::class, 'create'])->name('create_vendors');
        Route::post('/store-vendors', [VendorController::class, 'store'])->name('store_vendors');



        //Super Admin Route
        Route::middleware(['checkSuperAdmin'])->group(function (){
            //Users Routes Start Here
            Route::get('/users', [UserController::class, 'index'])->name('users');
            Route::get('/all-admin', [UserController::class, 'allAdmin'])->name('all_admin');
            Route::get('/all-srs', [UserController::class, 'allSrs'])->name('all_srs');
            Route::get('/create-users', [UserController::class, 'create'])->name('create_user');
            Route::post('/store_admin',[UserController::class, 'storeAdmin'])->name('store_admin');
            Route::post('/store_sr',[UserController::class, 'storeSR'])->name('store_sr');
            Route::get('user-edit/{id}',[UserController::class, 'editUser'])->name('userEdit');
            Route::patch('update-admin/{id}',[UserController::class, 'updateAdmin'])->name('updateAdmin');
            Route::patch('update-sr/{id}',[UserController::class, 'updateSr'])->name('updateSr');
            //Users Routes End Here


            //Branch Routes Start
            Route::get("/all-branches", [BranchController::class, 'index'])->name('branches');
            Route::get('/add_branch_form', [BranchController::class, 'addBranchForm'])->name('add_branch_form');
            Route::post('/add_branch', [BranchController::class, 'addBranch'])->name('add_branch');
            Route::get('edit-branch/{id}', [BranchController::class, 'editBranch'])->name('branchEdit');
            Route::patch('update-branch/{id}', [BranchController::class, 'updateBranch'])->name('updateBranch');
            //Branch End Start

        });


        Route::middleware(['checkAdmin'])->group(function(){

            Route::get('/due-payment/{id}',[MaterialsPurchase::class, 'duePayment'])->name('due_payment');
            Route::post('make-due-payment',[MaterialsPurchase::class, 'makeDuePayment'])->name('make_due_payment');

            //Purchase Materials Routes Start

            Route::get('/purchase-materials', [MaterialsPurchase::class, 'purchase'])->name('purchase_materials');
            Route::post('/purchase-raw-materials',[MaterialsPurchase::class, 'store'])->name('purchase_raw_materials');

            //productions Routes Start

            Route::get('/add_production', [ProductController::class, 'addProductionView'])->name('add_production');
            Route::post('/store_production', [ProductController::class, 'storeProduction'])->name('store_production');

            Route::get('raw-materials-item',[RawMaterialsItemController::class, 'index'])->name('raw_materials_item');
            Route::get('create-raw-materials',[RawMaterialsItemController::class, 'create'])->name('create_raw_materials');
            Route::post('store-raw-materials',[RawMaterialsItemController::class, 'store'])->name('store_raw_materials');
            //Study Route
            Route::get('testing',[TestController::class, 'index'])->name('testing');
            Route::post('upload',[TestController::class, 'upload'])->name('upload');
            Route::get('get-image',[TestController::class, 'getImage']);

            Route::get('consumer-pdf',[ConsumerController::class,'consumerPdf'])->name('consumer-pdf');

        });



    });


    //Product route start here
    Route::get('/products', [ProductController::class, 'index'])->name('products');
    Route::get('/add_product', [ProductController::class, 'addProductView'])->name('add_product');
    Route::post('/store_product', [ProductController::class, 'store'])->name('store_product');
    Route::get('product_grade',[GradeController::class, 'index'])->name('product_grade');
    Route::get('create/product_grade',[GradeController::class, 'create'])->name('create_product_grade');
    Route::post('store/grade',[GradeController::class, 'store'])->name('store_grade');
    //Product route end here

    //Distributors Routes Start Here
    Route::get('/distributors', [DistributorController::class, 'index'])->name('distributors');
    Route::get('/create-distributors', [DistributorController::class, 'create'])->name('create_distributors');
    Route::post('/store-distributors',[DistributorController::class, 'store'])->name('store_distributors');
    //Distributors Routes end Here

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



   //product request route start here
    Route::get('request-product',[NotificationController::class, 'index'])->name('request_product');
    Route::get('for-notification-data',[NotificationController::class, 'forNotificationData']);
    Route::post('send-notification',[NotificationController::class, 'sendNotification']);
    Route::get('sending-request',[NotificationController::class, 'seeYourSendingRequest'])->name('your_sending_request');
    Route::get('add-stock-for-request/{id}',[NotificationController::class, 'addStockForRequest'])->name('add_stock_for_request');
    Route::post('stock-for-sr-request',[StockController::class, 'stockForSrRequest'])->name('stock_for_sr_request');
    Route::get('distributor-payment-history/{id}',[DistributorController::class, 'paymentHistory'])->name('distributor_payment_history');

   //Change order status route
   Route::get('change-order-status',[OrderController::class,'ChangeStatus'])->name('change-order-status');
   Route::get('/payment-history/{id}',[MaterialsPurchase::class, 'payment_history'])->name('payment_history');
   Route::get('purchase-history/{id}',[MaterialsPurchase::class, 'purchase_history'])->name('purchase_history');
   //session testing function

   Route::get('collect-payment/{id}',[OrderController::class, 'collectPayment'])->name('collect_payment');
   Route::get('get-payment/{id}',[OrderController::class, 'getPayment'])->name('get_payment');

   Route::post('collect-entry',[OrderController::class, 'collectEntry'])->name('collect_entry');
   Route::post('get-entry',[OrderController::class, 'getEntry'])->name('get_entry');


   Route::get('get-srs', [OrderController::class, 'getSRs'])->name('get_srs');
   Route::get('get-distributors', [OrderController::class, 'getDistributors'])->name('get_distributors');
   Route::get('sales-history', [OrderController::class, 'salesHistory'])->name('sales_history');
   Route::get('sales-history-table', [OrderController::class, 'salesHistoryTable'])->name('sales_history_table');

   Route::get('purchase-history', [ProductController::class, 'purchaseHistory'])->name('purchase_history');
   Route::get('purchase-history-table', [ProductController::class, 'purchaseHistoryTable'])->name('purchase_history_table');

   Route::get('payment-history', [OrderController::class, 'paymentHistory'])->name('payment_history');
   Route::get('payment-history-table', [OrderController::class, 'paymentHistoryTable'])->name('payment_history_table');









});

Auth::routes();


