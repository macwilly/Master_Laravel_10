<?php

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
//----------------------------------------- 1
// http Verbs
// GET to fetch the data
// POST create something on the server
// PUT modify and existing thing
// DELETE will remove data
//----------------------------------------- 2
// This is a more static way of passing in the data to the blade array
//Route::get('/', function () {
//    return view('index', [
//        "name"=>"Mackenzie"
//    ]);
//});

//Dynamically taking the name from the URL argument
Route::get('/{name}', function ($name) {
    return view('index', [
         "name"=>$name
    ]);
});

Route::get('/hello', function (){
   return  "<h1>Hello</h1>";
})->name('hello');

Route::get('/greet/{name}', function ($name){
    return "Hello $name!";
});

Route::get('/hallo', function () {
    return  redirect()->route('hello');
});

Route::get('welcome', function() {
    return view('welcome');
});

Route::fallback(function (){
    return "Still got somewhere!";
});
