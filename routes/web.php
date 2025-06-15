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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return 'Hello World!';
});

Route::redirect('/redirect', '/test');

Route::get('/hello', function () {
    return view('hello.world', ['name' => 'Tri']);
});

Route::get('/products/{productId}', function ($productId) {
   return "product : ". $productId;
})->name('products');

Route::get('/products/{productId}/items/{itemId}', function ($productId, $itemId) {
    return "product : ". $productId . ' items : '. $itemId;
})->name('product.item');

Route::get('/categories/{id}', function ($id) {
    return "Category : " . $id;
})->where('id', '[0-9]+')->name('category');

Route::get('/users/{userId?}', function ($userId = null) {
    return "User : " . $userId;
})->name('users');


Route::get('/product/{id}', function ($id) {
    $link =  route('products', ['productId' => $id]);
    return "Link $link";
});

Route::get('/product-redirect/{id}', function ($id) {
     return redirect()->route('products', ['productId' => $id]);
});

Route::fallback(function () {
    return '404 Not Found';
})->name('not-found');
