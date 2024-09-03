<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmail;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user=Auth::user();
        $tasks=$user->tasks()->where("status","!=","done")->get();
        return view("task.index",["tasks"=>$tasks]);
    }


    public function index_room_tasks(String $id){
        $room=Auth::user()->rooms()->where("room_id",$id)->first();

        Gate::authorize('index_room_tasks',[Task::class,$room]);

        $tasks=$room->tasks()->where("status","!=","done")->get();

        $isAdmin=false;
        $invitation=null;
        if($room->pivot->role=='admin'){
            $isAdmin=true;
            $invitation=$room->invitation;
        }

        return view("room.show",["tasks"=>$tasks,"room_id"=>$room->id,"isAdmin"=>$isAdmin,"invitation"=>$invitation]);
    
    }

    /**
     * Show the form for creating a new resource.
     */
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        //
        $user=Auth::user();

        $in=$request->validate([
            "task"=>"required",
            "due_date"=>"required | date"
        ]);

        $room_id=null;
        if($request->room_id){
            $room_id=$request->room_id;
        }
        
        $new=$user->tasks()->create([
            "task"=>$request->task,
            "due_date"=>$request->due_date,
            "status"=>"new",
            "room_id"=>$room_id
        ]);
        $this->SendEmail($request->due_date,$user,$new->id);
        
        return redirect()->route("task.index");
    }

    private function SendEmail($due_date,$user,$task_id){
        $dueDate = Carbon::parse($due_date);
        $sendDate=$dueDate->subDay();
        $delay=$sendDate->diffInSeconds(now());

        SendEmail::dispatch($user,$task_id);
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */

    /**
     * Update the specified resource in storage.
     */
    public function done( string $id)
    {
        //
        $task=Task::find($id);
        Gate::authorize("done",$task);
        if($task){
            $task->status="done";
            $task->save();
        }
        return redirect()->route("task.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $task=Task::find($id);
        Gate::authorize("delete",$task);
        if($task){
            $task->delete();
        }
        return redirect()->route("task.index");
    }
}
