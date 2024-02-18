<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CsvImportController;
use App\Http\Controllers\BoxController;
use Illuminate\Support\Facades\Route;
use Dcblogdev\Box\Facades\Box;

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
    return view('welcome');
});
Route::group(['middleware' => 'basicauth'], function() {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('application', [ApplicationController::class, 'index'])->name('application.index');

require __DIR__.'/auth.php';

Route::get('import-csv', [CsvImportController::class,'show'])->name('import-csv.show');
Route::post('import-csv',  [CsvImportController::class,'import']);

Route::get('box', function() {

    //if no box token exists then redirect
    Box::getAccessToken();

    //box authenticated now box:: can be used freely.

    //example of getting the authenticated users details
    return Box::get('/users/me');

});

Route::get('box/oauth', function() {
    return Box::connect();
});

Route::get('box', [BoxController::class,'index'])->name('box.index');
