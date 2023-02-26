<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

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



Route::get('/home', [TodoController::class, 'index'])->middleware('auth');
Route::post('/store', [TodoController::class,'store']);
Route::post('/update', [TodoController::class,'update']);
Route::post('/delete', [TodoController::class,'delete']);
Route::get('/indexFind', [TodoController::class, 'indexFind']);
Route::post('/find', [TodoController::class, 'find']);

Route::get('/', function () {
    return view('welcome');
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


Route::get('/auth', [TodoController::class,'check']);
Route::post('/auth', [TodoController::class,'checkUser']);
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

