<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\User;

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
// Basic
Route::get('/test', function () {
    return "test";
});

//Default: return view
Route::get('/', function () {
    return view("/Users/welcome");
});

//Parameters
Route::get('/bonjour/{name}', function ($name) {
    return "Nom: " .$name;
});

//Parameters mandatory
Route::get('/user-mandatory/{name}', function ($name = "Louis") {
    return $name;
});


//Validation type
Route::get('/user-bis/{name}', function ($name) {
    return "ici";
})->where('name', '[A-Za-z]+');
//->where('id', '[0-9]+');

//Get
//1 Route= une action
//Route::get('/user', [UserController::class, 'index']);

//Http methods
//get($uri, $callback); (recuperation datas)
//post($uri, $callback); (send datas)
//put($uri, $callback); (modifications datas one)
//patch($uri, $callback); (modifications datas all)
//delete($uri, $callback); (delete datas)
//options($uri, $callback); (get headers spec)

//Allow to generate all actions read/create/delete/update/ des users
Route::resource("users", UserController::class);

//Redirect
Route::redirect("/ici", "/la");
Route::redirect("/test1", "/test", 301);

//Route::permanentRedirect('/test1', '/test');

//Artisans commandes
//List routes
//php artisan route:list

//Routes with name
Route::get('/user/profil', function(){
    return  "profil";
})->name ("profile");

//Redirection with route which have name
Route::get('/test-user', function(){
    return redirect()->route('profile');
});