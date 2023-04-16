<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ClassRoomController extends Controller
{
    public function index(): View
    {
        return view('livewire.class-room.index');
    }
}
