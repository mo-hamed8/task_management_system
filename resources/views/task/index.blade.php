<x-layout>
    <div class=" bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h1 class="text-2xl font-bold mb-4 text-center text-gray-700">To-Do List</h1>

        <!-- Add Task -->
        <div class="mb-4">
            <form action="{{route("task.store")}}" method="POST">
            @csrf
            <input name="task" id="taskInput" type="text" placeholder="Add a new task" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 mb-2">
            <input name="due_date" id="dueDateInput" type="date" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
            <br>
            <br>
            <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors">Add Task</button>
        </form>
        </div>

        <!-- Task List -->
        <ul id="taskList" class="mt-6 space-y-2">
            <!-- Example Task Item -->
            @foreach ($tasks as $item)
            <?php 
            $color="gray";
            if($item->room!=null){
                $color="green";
            }
            ?>
            <li class="flex justify-between items-start bg-{{$color}}-200 p-2 rounded-lg">
                <div class="flex flex-col">
                    <span class="text-gray-700 break-words">{{$item->task}}</span>
                    <span class="text-gray-500 text-sm">Due: {{$item->due_date}}</span>
                </div>
                <div class="flex items-center">
                    <form action="{{route("task.done",$item->id)}}" method="POST">
                        @csrf
                        <button class="text-green-500 hover:text-green-600 ml-4" >Done</button>
                    </form>
                    <form action="{{route("task.destroy",$item->id)}}" method="POST">
                        @method("delete")
                        @csrf
                        <button class="text-red-500 hover:text-red-600 ml-4" >Delete</button>
                    </form>
                </div>
            </li>
                
            @endforeach
        </ul>
    </div>

</x-layout>