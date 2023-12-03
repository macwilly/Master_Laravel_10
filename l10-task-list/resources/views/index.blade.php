@extends('layouts.app')

@section('title', "The list of tasks")

@section('content')
    @forelse($tasks as $task)
        <div>
            {{-- passing in the route function with the name of the route, as well as blade array with the id--}}
            <a href="{{ route('tasks.show', ['id'=>$task->id]) }}">{{ $task->title }}</a>
        </div>
    @empty
        <div>There are no tasks</div>
   @endforelse
@endsection
