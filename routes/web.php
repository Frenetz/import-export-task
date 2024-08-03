<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\MenuController;

Route::get('/', function () {
    return redirect()->route("menu");
});

Route::get("/menu", [MenuController::class, 'showMenu'])->name("menu");

Route::get("/import", [ImportController::class, 'showForm'])->name("import.form");
Route::post("/import", [ImportController::class, 'import'])->name("import.process");

Route::get("/product-card/{id}", [ProductController::class, 'showProductCard'])->name("product.card");

Route::get("/products", [ProductController::class, 'showProducts'])->name("product.list");
Route::get('/delete-all-products', [ProductController::class, 'deleteAllProducts'])->name('delete.all.products');