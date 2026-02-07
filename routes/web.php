<?php

use App\Http\Controllers\HelloController;
use App\Http\Controllers\InputController;
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

Route::get('/FAP', function() {
    return 'Hello Fikry Andias Praja';
});

Route::redirect('/youtube', '/FAP');

Route::fallback(function() {
    return "404";
});

Route::view('/hello', 'hello', ['name' => 'Fikry']);

Route::get('/hello-again', function() {
    return view('hello', ['name' => 'Fikry']);
});

Route::get('/hello-world', function() {
    return view('hello.world', ['name' => 'Fikry']);
});

Route::get('/products/{id}', function ($productId) {
    return "Products : " . $productId;
})->name('product.detail');

Route::get('/products/{product}/items/{item}', function($productId, $itemId) {
    return "Products : " . $productId . " Items : " . $itemId;
})->name('product.item.detail');

Route::get('/categories/{id}', function(string $categoryId) {
    return "Categories : " . $categoryId;
})->where('id', '[0-9]+')->name('category.detail');

Route::get('/users/{id?}', function(string $userId = '404'){
    return "Users : " . $userId;
})->name('user.detail');

Route::get('/conflict/{name}', function(string $name) {
    return 'Conflict ' . $name;
});

Route::get('/conflict/fikry', function(string $name) {
    return 'Conflict Fikry Andias Praja';
});


Route::get('/controller/hello', [HelloController::class, 'hello']);

Route::get('/controller/halo/request', [HelloController::class, 'request']);

Route::get('/controller/halo/{name}', [HelloController::class, 'halo']);

Route::get('/input/hello', [InputController::class, 'hello']);
Route::get('/input/hello', [InputController::class, 'hello']);

Route::post('/input/hello/first', [InputController::class, 'helloFirst']);

Route::post('/input/hello/input', [InputController::class, 'helloInput']);

Route::post('/input/type', [InputController::class, 'inputType']);