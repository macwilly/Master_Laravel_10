<?php

use Illuminate\Http\Response;
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

Route::get('/', function (){
   return redirect()->route('tasks.index');
});

//Dynamically taking the name from the URL argument
Route::get('/tasks', function ()  {
    return view('index', [
         "tasks"=> \App\Models\Task::latest()->where('completed',true)->get()
    ]);
})->name('tasks.index');

Route::get('/tasks/{id}', function ($id) {
    return view('show', [
        'task'=>\App\Models\Task::findOrFail($id)
    ]);
})->name('tasks.show');

//Route::get('/hello', function (){
//   return  "<h1>Hello</h1>";
//})->name('hello');
//
//Route::get('/greet/{name}', function ($name){
//    return "Hello $name!";
//});
//
//Route::get('/hallo', function () {
//    return  redirect()->route('hello');
//});
//
//Route::get('welcome', function() {
//    return view('welcome');
//});

Route::fallback(function (){
    return "Still got somewhere!";
});
