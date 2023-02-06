<?php

use App\Http\Controllers\PagesController;
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

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('pages.home');
    })->name('home');
    Route::get('/dashboard', function () {
        return view('pages.dashboard');
    })->name('dashboard');
    Route::get('/branch', function () {
        return view('pages.branch');
    })->name('branch');
    Route::get('/bankaccount', function () {
        return view('pages.bankaccount');
    })->name('bankaccount');
    Route::get('/users', function () {
        return view('pages.user');
    })->name('user');
    Route::get('/raw', function () {
        return view('pages.raw');
    })->name('raw');
    Route::get('/product', function () {
        return view('pages.product');
    })->name('product');
    Route::get('/variation', function () {
        return view('pages.variation');
    })->name('variation');
    Route::get('/price', function () {
        return view('pages.price');
    })->name('price');
    Route::get('/customer', function () {
        return view('pages.customer');
    })->name('customer');
    Route::get('/inquiries', function () {
        return view('pages.inquiries');
    })->name('inquiries');
    Route::get('/jomachine', function () {
        return view('pages.jomachine');
    })->name('jomachine');
    Route::get('/logout', [PagesController::class, 'logout'])->name('logout');
    Route::get('/download/quotation/{id}', [PagesController::class, 'download_pdf'])->name('download_pdf');
    Route::get('/download/sales/{id}', [PagesController::class, 'sales_pdf'])->name('sales_pdf');
    Route::get('/download/jo/{id}', [PagesController::class, 'jopdf'])->name('jopdf');
});



Route::get('/login', function () {
    return view('pages.login');
})->name('login');

Route::post('/log', [PagesController::class, 'log'])->name('log');
