<?php

namespace App\Http\Livewire\ClassRoom;

use App\School\Common\Dto\PaginationParamsDto;
use App\School\Secretary\Actions\ClassRoomActions;
use Livewire\Component;

class Index extends Component
{
    protected $listeners = ['increment' => 'change'];

    public function render()
    {
        return view('livewire.class-room.index');
    }

    public function change(): void
    {
        dd('ok');
    }
}
