@extends('layouts.app')

@section('title', "The list of tasks")

@section('content')
    <div>
        <a href="{{ route('tasks.create') }}">To the create form!</a>
    </div>
    @forelse($tasks as $task)
        <div>
            {{-- passing in the route function with the name of the route, as well as blade array with the id--}}
            <a href="{{ route('tasks.show', ['task'=>$task->id]) }}">{{ $task->title }}</a>
        </div>
    @empty
        <div>There are no tasks</div>
   @endforelse
    @if($tasks->count())
        <nav>
            {{ $tasks->links() }}
        </nav>
    @endif
@endsection
