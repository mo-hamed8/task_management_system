<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Room extends Model
{
    use HasFactory;
    protected $table="room";
    protected $guarded=[];


    public function users():BelongsToMany{
        return $this->belongsToMany(User::class,"member");
    }

    public function tasks(){
        return $this->hasMany(Task::class);
    }

    public function invitation(){
        return $this->hasOne(Invitation::class);
    }
}
