<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\RiderController;
use App\Http\Controllers\ApiController;
use Spatie\FlareClient\Api;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});
Route::get('/ops-blitz-ops', [ProductController::class, 'index'])->middleware('admin');
Route::get('/product', function () {
    return redirect('/login');
});
Route::post('/product', [ProductController::class, 'import'])->name('product.import')->middleware('admin');
Route::get('/ops-blitz-ops/export', [ProductController::class, "export"]);
    //GET DATA
Route::get('/data', [ProductController::class, 'getData']);
    //REGISTER FOR RIDER
Route::get('/register', function(){
    return view("register");
});
Route::post('/register', [RiderController::class, "register"]);
Route::get('/login', [RiderController::class, "getLogin"]);
Route::post('/login', [RiderController::class, "login"]);
Route::get("/delivery", [RiderController::class, "delivery"])->name('dashboard');;
Route::get('/store', function () {
    return redirect('/login');
});
Route::post('/store', [RiderController::class, 'store'])->middleware('from.submit');
Route::get("send-otp", [MailController::class, "index"])->middleware('from.submit');;
