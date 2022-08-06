<?php

use App\Http\Controllers\LoginController;
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
Route::get('login',[LoginController::class,'login']);
Route::post('login',[LoginController::class,'auth']);
Route::get('logout', [LoginController::class,'logout']);

Route::middleware(['pakguard', 'role:admin'])->prefix('/staff')->group(function(){

    Route::get('/list',[StaffController::class,'list'] );
    Route::get('/create',[StaffController::class,'create'] );
    //on submit form for insert or update
    Route::post('/store',[StaffController::class,'store'] );
    Route::get('/edit/{staff_id}',[StaffController::class,'edit'] );
    Route::get('/delete/{staff_id}',[StaffController::class,'delete'] );
    Route::get('/image',[StaffController::class,'image'] );

});

Route::get('/', function () {
    return view('welcome');
});
