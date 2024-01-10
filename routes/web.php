<?php

use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\CreateFormController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('Form.FormCreate');
// });
Route::get("/post/create",[CreateFormController::class,"create"])->name("post.create")->middleware("auth");
Route::post("/post",[CreateFormController::class,"store"])->name("post.store");

Route::get("post/list",[CreateFormController::class,"index"])->name("list_item")->middleware("auth");
Route::get("post/{id}",[CreateFormController::class,"show"])->name("show_item");
Route::get("post/edit/{id}",[CreateFormController::class,"edit"])->name("edit_item")->middleware("auth");
Route::post("/post/{id}/update",[CreateFormController::class,"update"])->name("update-item");
Route::delete("/post/{id}",[CreateFormController::class,"destroy"])->name("post_destroy");


// Auth=======>

// View =====>

Route::get("/registration",function (){
return view("Auth.Item.registration");
})->name("registration");

Route::get("/login",function (){
    return view("Auth.Item.login");
    })->name("login");

Route::get("forget",function (){
    return view("Auth.Item.forget");
    })->name("forget");

   

//end view=========>


Route::post("/registration",[UserController::class,"registration"]);
Route::post("/login",[UserController::class,"login"]);
Route::post("/forget",[UserController::class,"forget"]);

Route::post("/logout",[UserController::class,"__invoke"])->name("logout");
