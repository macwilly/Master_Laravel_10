<?php
use App\Models\Task;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
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
         "tasks"=> Task::latest()->get()
    ]);
})->name('tasks.index');

Route::view('/tasks/create', 'create')
->name('tasks.create');

Route::get('/tasks/{task}/edit', function (Task $task) {
    return view('edit', [
        'task'=> $task
    ]);
})->name('tasks.edit');

Route::get('/tasks/{task}', function (Task $task) {
    return view('show', [
        'task'=>$task
    ]);
})->name('tasks.show');

Route::post('/tasks', function(Request $request){
    $data = $request->validate([
        'title'            => 'required|max:255',
        'description'      => 'required',
        'long_description' => 'required'
    ]);

    $task = new Task;
    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_description = $data['long_description'];

    $task->save();

    return redirect()->route('tasks.show', ['id'=>$task->id])
        ->with('success', 'Task created successfully!');
})->name('tasks.store');

Route::put('/tasks/{task}', function(Task $task, Request $request){
    $data = $request->validate([
        'title'            => 'required|max:255',
        'description'      => 'required',
        'long_description' => 'required'
    ]);

    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_description = $data['long_description'];

    $task->save();

    return redirect()->route('tasks.show', ['id'=>$task->id])
        ->with('success', 'Task updated successfully!');
})->name('tasks.update');

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
