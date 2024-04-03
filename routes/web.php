<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxUploadController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/ajax_upload', 'AjaxUploadController@index');
// Route::post('/ajax_upload/action', 'AjaxUploadController@action')->name('ajaxupload.action');
 

Route::get('/ajax_upload', [AjaxUploadController::class, 'index']);
Route::post('/ajax_upload/action', [AjaxUploadController::class, 'action'])->name('ajaxupload.action');