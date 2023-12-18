<?php
use App\Http\Requests\TaskRequest;
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
         "tasks"=> Task::latest()->paginate(10)
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

Route::post('/tasks', function(TaskRequest $request){
    // From the new TaskRequest class validated() will get all the data that is valid
    // if the data is not valid it will act as it did before.
    $task = Task::create($request->validated());

    return redirect()->route('tasks.show', ['task'=>$task->id])
        ->with('success', 'Task created successfully!');
})->name('tasks.store');

Route::put('/tasks/{id}/toggle-complete', function (Task $task){
    //calling method from Task Model Class
    $task->toggleComplete();

    return redirect()->back()->with('success', 'Task updated successfully!');
})->name('tasks.complete');

Route::put('/tasks/{task}', function(Task $task, TaskRequest $request){

    $task->update($request->validated());

    return redirect()->route('tasks.show', ['task'=>$task->id])
        ->with('success', 'Task updated successfully!');
})->name('tasks.update');

//With the model binding if we cannot find a task we get a 404
// else we go into the body
Route::delete('/tasks/{task}', function(Task $task){
    $task->delete();

    return redirect()->route('tasks.index')
        ->with('success', 'Task deleted successfully!');
})->name('tasks.destroy');

Route::fallback(function (){
    return "Still got somewhere!";
});
