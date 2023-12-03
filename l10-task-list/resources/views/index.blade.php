<h1>
    The list of tasks
</h1>

<div>

        @forelse($tasks as $task)
            <div>
                {{-- passing in the route function with the name of the route, as well as blade array with the id--}}
                <a href="{{ route('tasks.show', ['id'=>$task->id]) }}">{{ $task->title }}</a>
            </div>
        @empty
            <div>There are no tasks</div>
       @endforelse

</div>
