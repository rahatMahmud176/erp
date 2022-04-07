<?php


use Illuminate\Support\Facades\Route; 


Route::group(['middleware'=>'logout'], function(){
    Route::get('/admin-register',[
        'uses'  => 'App\Http\Controllers\AuthController@registerPage',
        'as'    => 'admin-register',
        
    ]);
    Route::post('/admin-register-info',[
        'uses'  => 'App\Http\Controllers\AuthController@adminRegisterInfo',
        'as'    => 'admin-register-info'
    ]);
    
    Route::get('/admin-login',[
        'uses'  => 'App\Http\Controllers\AuthController@loginPage',
        'as'    => 'admin-login', 
    ]);
    Route::post('/login-info-submit',[
        'uses'  => 'App\Http\Controllers\AuthController@loginInfoSubmit',
        'as'    => 'login-info-submit',
    ]); 

});//logoutMiddleware

Route::get('/',[
    'uses'  => 'App\Http\Controllers\DashbordController@dashbord',
    'as'    => 'dashbord',
]);
Route::group(['middleware'=>'logined'], function(){
   
    Route::get('/logout',[
        'uses'  => 'App\Http\Controllers\AuthController@logout',
        'as'    => 'logout',
    ]);


Route::resource('category', App\Http\Controllers\CategoryController::class);
Route::get('catetgory/update-category-status/{id}', [
    'uses' => 'App\Http\Controllers\CategoryController@updateCategoryStatus',
    'as' => 'updateCategoryStatus',
]);
Route::get('category.delete.alart/{id}', [
    'uses'    => 'App\Http\Controllers\CategoryController@categoryDeleteAlert',
    'as'      => 'category.delete.alart'
]); 
Route::get('category-delete/{id}', [
        'uses'    => 'App\Http\Controllers\CategoryController@categoryDelete',
        'as'      => 'category-delete'
    ]);


Route::resource('sub_category', App\Http\Controllers\SubCategoryController::class);
Route::get('sub-catetgory/update-subcategory-status/{id}', [
    'uses' => 'App\Http\Controllers\SubCategoryController@updateSubCategoryStatus',
    'as' => 'updateSubCategoryStatus',
]);
Route::get('sub-category.delete.alart/{id}', [
    'uses'    => 'App\Http\Controllers\SubCategoryController@subCategoryDeleteAlert',
    'as'      => 'sub-category.delete.alart'
]); 
Route::get('sub-category-delete/{id}', [
        'uses'    => 'App\Http\Controllers\SubCategoryController@subCategoryDelete',
        'as'      => 'sub-category-delete'
]);


Route::resource('brand', App\Http\Controllers\BrandController::class);
Route::get('brand/update-brand-status/{id}', [
    'uses' => 'App\Http\Controllers\BrandController@updateBrandStatus',
    'as' => 'updateBrandStatus',
]);
Route::get('brand.delete.alart/{id}', [
    'uses'    => 'App\Http\Controllers\BrandController@brandDeleteAlert',
    'as'      => 'brand.delete.alart'
]); 
Route::get('brand-delete/{id}', [
        'uses'    => 'App\Http\Controllers\BrandController@brandDelete',
        'as'      => 'brand-delete'
]);


Route::resource('color', App\Http\Controllers\ColorController::class);
Route::get('color/update-color-status/{id}', [
    'uses' => 'App\Http\Controllers\ColorController@updateColorStatus',
    'as' => 'updateColorStatus',
]);
Route::get('color.delete.alart/{id}', [
    'uses'    => 'App\Http\Controllers\ColorController@colorDeleteAlert',
    'as'      => 'color.delete.alart'
]); 
Route::get('color-delete/{id}', [
        'uses'    => 'App\Http\Controllers\ColorController@colorDelete',
        'as'      => 'color-delete'
]);



Route::resource('size', App\Http\Controllers\SizeController::class);
Route::get('size/update-size-status/{id}', [
    'uses' => 'App\Http\Controllers\SizeController@updateSizeStatus',
    'as' => 'updateSizeStatus',
]);
Route::get('size.delete.alart/{id}', [
    'uses'    => 'App\Http\Controllers\SizeController@sizeDeleteAlert',
    'as'      => 'size.delete.alart'
]); 
Route::get('size-delete/{id}', [
        'uses'    => 'App\Http\Controllers\SizeController@sizeDelete',
        'as'      => 'size-delete'
]);


Route::resource('item', App\Http\Controllers\ItemController::class);
Route::get('/item-manage', [
    'uses' => 'App\Http\Controllers\ItemController@itemManage',
    'as' => 'item-manage',
]);
Route::get('item/update-item-status/{id}', [
    'uses' => 'App\Http\Controllers\ItemController@updateItemStatus',
    'as' => 'updateItemStatus',
]);
Route::get('item/update-item-status/{id}', [
    'uses' => 'App\Http\Controllers\ItemController@updateItemStatus',
    'as' => 'updateItemStatus',
]);
Route::get('item.delete.alart/{id}', [
    'uses'    => 'App\Http\Controllers\ItemController@itemDeleteAlert',
    'as'      => 'item.delete.alart'
]); 
Route::get('item-delete/{id}', [
        'uses'    => 'App\Http\Controllers\ItemController@itemDelete',
        'as'      => 'item-delete'
]); 



Route::resource('supplier', App\Http\Controllers\SupplierController::class);
Route::get('supplier/update-supplier-status/{id}', [
    'uses' => 'App\Http\Controllers\SupplierController@updateSupplierStatus',
    'as' => 'updateSupplierStatus',
]);
Route::get('supplier.delete.alart/{id}', [
    'uses'    => 'App\Http\Controllers\SupplierController@supplierDeleteAlert',
    'as'      => 'supplier.delete.alart'
]); 
Route::get('supplier-delete/{id}', [
        'uses'    => 'App\Http\Controllers\SupplierController@supplierDelete',
        'as'      => 'supplier-delete'
]);


Route::resource('stock', App\Http\Controllers\StockController::class);
Route::get('stock-info-by-item-id',[
    'uses' => 'App\Http\Controllers\StockController@stockInfoByItemId',
    'as'   => 'stock-info-by-item-id',
]);
Route::get('all-stock-info',[
    'uses' => 'App\Http\Controllers\StockController@allStockInfo',
    'as'   => 'all-stock-info',
]);
Route::get('stock.delete.alart/{id}', [
    'uses'    => 'App\Http\Controllers\StockController@stockDeleteAlert',
    'as'      => 'stock.delete.alart'
]); 
Route::get('in-stock/stock-delete/{id}', [
        'uses'    => 'App\Http\Controllers\StockController@stockDelete',
        'as'      => 'stock-delete'
]);
 


Route::resource('sell', App\Http\Controllers\SellController::class);
Route::get('all-sell-info',[
    'uses' => 'App\Http\Controllers\SellController@allSellInfo',
    'as'   => 'all-sell-info',
]);
Route::get('sell-info-by-item-id',[
    'uses' => 'App\Http\Controllers\SellController@sellInfoByItemId',
    'as'   => 'sell-info-by-item-id',
]);

Route::get('size-color-wais-stock',[
    'uses' => 'App\Http\Controllers\SellController@sellInfoBySizeColor',
    'as'   => 'size-color-wais-stock',
]);

Route::get('sell.delete.alart/{id}', [
    'uses'    => 'App\Http\Controllers\SellController@sellDeleteAlert',
    'as'      => 'sell.delete.alart'
]); 
Route::get('sell-delete/{id}', [
        'uses'    => 'App\Http\Controllers\SellController@sellDelete',
        'as'      => 'sell-delete'
]);




Route::resource('return', App\Http\Controllers\ReturnController::class);

Route::resource('deliveriAgent', App\Http\Controllers\DeliveriAgentController::class);
Route::get('deliveriAgent/update-deliveriAgent-status/{id}', [
    'uses' => 'App\Http\Controllers\DeliveriAgentController@updateDeliveriAgentStatus',
    'as' => 'updateDeliveriAgentStatus',
]);
Route::get('deliveriAgent.delete.alart/{id}', [
    'uses'    => 'App\Http\Controllers\DeliveriAgentController@deliveriAgentDeleteAlert',
    'as'      => 'deliveriAgent.delete.alart'
]); 
Route::get('deliveriagent-delete/{id}', [
        'uses'    => 'App\Http\Controllers\DeliveriAgentController@deliveriAgentDelete',
        'as'      => 'deliveriAgent-delete'
]); 
Route::get('deliveriAgent.manage-payment', [
        'uses'    => 'App\Http\Controllers\DeliveriAgentController@managePayments',
        'as'      => 'deliveriAgent.manage-payment'
]);
 
Route::get('agent-payment-details/{id}', [
        'uses'    => 'App\Http\Controllers\DeliveriAgentController@agentPaymentDetails',
        'as'      => 'agent-payment-details'
]); 
Route::get('received-payment/{id}', [
        'uses'    => 'App\Http\Controllers\DeliveriAgentController@receivedPayment',
        'as'      => 'received-payment'
]);



Route::resource('cash', App\Http\Controllers\CashController::class);
Route::get('cash.delete.alart/{id}', [
    'uses'    => 'App\Http\Controllers\CashController@cashDeleteAlert',
    'as'      => 'cash.delete.alart'
]); 
Route::get('cash-delete/{id}', [
        'uses'    => 'App\Http\Controllers\CashController@cashDelete',
        'as'      => 'cash-delete'
]); 
Route::get('cash.payment', [
        'uses'    => 'App\Http\Controllers\CashController@cashPayment',
        'as'      => 'cash.payment'
]); 
Route::post('cash.payment.save', [
        'uses'    => 'App\Http\Controllers\CashController@cashPaymentSave',
        'as'      => 'cash.payment.save'
]);
Route::get('payment.delete.alart/{id}', [
    'uses'    => 'App\Http\Controllers\CashController@paymentDeleteAlert',
    'as'      => 'payment.delete.alart'
]); 
Route::get('payment-delete/{id}', [
        'uses'    => 'App\Http\Controllers\CashController@paymentDelete',
        'as'      => 'payment-delete'
]); 



Route::resource('account', App\Http\Controllers\AccountController::class);
Route::get('account/update-account-status/{id}', [
    'uses' => 'App\Http\Controllers\AccountController@updateAccountStatus',
    'as' => 'updateAccountStatus',
]);
Route::get('account.delete.alart/{id}', [
    'uses'    => 'App\Http\Controllers\AccountController@accountDeleteAlert',
    'as'      => 'account.delete.alart'
]); 
Route::get('account-delete/{id}', [
        'uses'    => 'App\Http\Controllers\AccountController@accountDelete',
        'as'      => 'account-delete'
]); 
Route::get('account.manage-payment', [
    'uses'    => 'App\Http\Controllers\AccountController@manageAccounts',
    'as'      => 'account.manage-payment'
]);
 
Route::get('accounts-for-product-buy-page', [
    'uses'    => 'App\Http\Controllers\AccountController@accountsInfoForProductBuyPage',
    'as'      => 'accounts-for-product-buy-page'
]);



Route::resource('report', App\Http\Controllers\ReportController::class);
Route::get('in-stock/report',[
    'uses' => 'App\Http\Controllers\ReportController@inStock',
    'as'   => 'in-stock',
]);
Route::get('in-today/report',[
    'uses' => 'App\Http\Controllers\ReportController@inToday',
    'as'   => 'in-today',
]);
Route::get('stock-details-report/report/{id}',[
    'uses' => 'App\Http\Controllers\ReportController@stockDetailsReport',
    'as'   => 'stock-details-report',
]);
Route::get('sell-report',[
    'uses' => 'App\Http\Controllers\ReportController@sellReport',
    'as'   => 'sell-report',
]); 
Route::get('sell-details-report/{id}',[
    'uses' => 'App\Http\Controllers\ReportController@sellDetails',
    'as'   => 'sell-details-report',
]);
Route::get('report.cash',[
    'uses' => 'App\Http\Controllers\ReportController@cashReport',
    'as'   => 'report.cash',
]);








});//logInMiddleware

