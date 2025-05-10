<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;

Route::middleware(['web'])->group(function(){
    Route::get('/',[ProductsController::class, 'CPanelProducts'])->name('cpanel.products');
    Route::get('/product',[ProductsController::class, 'CadProduct'])->name('cad.product');
    Route::get('/product/{product}',[ProductsController::class, 'EditProduct'])->name('edit.product');
    Route::put('/product/do',[ProductsController::class,'ProductDo'])->name('product.do');
    Route::put('/product/delete/do',[ProductsController::class, 'DelProductDo'])->name('del.product.do');
    Route::post('/product/info',[ProductsController::class,'ProductInfo'])->name('product.info');
});
