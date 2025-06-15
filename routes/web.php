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

Route::get('/products/{id}', function ($productId) {
   return "product : ". $productId;
});

Route::get('/products/{productId}/items/{itemId}', function ($productId, $itemId) {
    return "product : ". $productId . ' items : '. $itemId;
});

Route::get('/categories/{id}', function ($id) {
    return "Category : " . $id;
})->where('id', '[0-9]+');

Route::get('/users/{userId?}', function ($userId = null) {
    return "User : " . $userId;
});

Route::fallback(function () {
    return '404 Not Found';
});
