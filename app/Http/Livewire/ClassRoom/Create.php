<?php

namespace App\Http\Livewire\ClassRoom;

use Livewire\Component;

class Create extends Component
{
    protected $listeners = ['increment' => 'increment'];

    public $any = 0;

    public function render()
    {
        return view('livewire.class-room.create');
    }

    public function increment(): void
    {
        $this->any = $this->any + 1;
    }
}
