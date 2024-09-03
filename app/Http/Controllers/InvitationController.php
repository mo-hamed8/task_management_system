<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvitationController extends Controller
{
    //
    public function generate_token(Request $request){
        $request->validate([
            "room_id"=>"required"
        ]);
        $user=Auth::user();
        $room=$user->rooms()->where("room_id",$request->room_id)->first();
        if($room->pivot->role=="admin"){

            $newToken=Str::random(32);
            $expire_date=Carbon::parse(now())->addDay();

            if($room->invitation){
                $inv=$room->invitation;
                $inv->token=$newToken;
                $inv->token_expire=$expire_date;
                $inv->save();
            }
            else{
                $room->invitation()->create([
                    "token"=>$newToken,
                    "token_expire"=>$expire_date
                ]);
            }
        }

        return redirect()->route("index_room_tasks",$request->room_id);
    }
}
