<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Menu extends Component
{
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.task.menu'); //->Layout('layouts.app');
    }
}
