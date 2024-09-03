<?php

use App\Http\Controllers\InvitationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\TaskController;
use App\Mail\ReminderEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get("test",function(){
        return view("test");
    });
    
    Route::resource("task",TaskController::class)->except("show","edit","create","update")->middleware("auth");
    Route::post("task/{id}",[TaskController::class,"done"])->name("task.done");
    Route::get("task/room/{id}",[TaskController::class,"index_room_tasks"])->name("index_room_tasks");
    
    Route::get("room/enter",[RoomController::class,"enter"])->name("room.enter");
    Route::post("room/enter",[RoomController::class,"enterStore"])->name("room.enterStore");
    Route::resource("room",RoomController::class);
    Route::post("invitation/generate",[InvitationController::class,"generate_token"])->name("invitation.generate");
});



require __DIR__.'/auth.php';
