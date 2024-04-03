<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxUploadController;
use App\Http\Controllers\CustomerController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/ajax_upload', [AjaxUploadController::class, 'index'])->name('ajaxupload.index');
Route::post('/ajax_upload/action', [AjaxUploadController::class, 'action'])->name('ajaxupload.action');

Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
Route::delete('/customers/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');
Route::post('/customers/store', [CustomerController::class, 'store'])->name('customers.store');


 