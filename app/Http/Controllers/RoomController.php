<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmail;
use App\Models\Invitation;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

    }

    public function enter(){
        return view("room.enter");
    }
    public function enterStore(Request $request){
        $roomToken=$request->validate([
            "room_token"=>"required"
        ]);

        $user=Auth::user();

        $inv=Invitation::where("token",$roomToken)->first();

        // Check if it has not been added before.
        $check=!$user->rooms()->where("room_id",$inv->room->id)->exists();
        
        if($inv && $inv->token_expire>now() && $check){
            $room=$inv->room;
            $user->rooms()->attach($room->id);
        }
        else{
            return redirect()->back()->withErrors(["error"=>"The token is invalid or has expired."]);
        }

        return redirect()->route("task.index");

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("room.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        $request->validate([
            "name"=>"required"
        ]);
        $user=Auth::user();
        $new_room=$user->rooms()->create([
            "name"=>$request->name
        ]);
        $user->rooms()->updateExistingPivot($new_room->id,["role"=>"admin"]);
        return redirect()->route("task.index");

    }

    /**
     * Display the specified resource.
     */

    // show tasks for room
    public function show(string $id)
    {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
