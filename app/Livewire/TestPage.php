<?php

namespace App\Livewire;

use Livewire\Component;

class TestPage extends Component
{
    public function render()
    {
        // return view('livewire.test-page');
        return view('livewire.test-page')->layout('admin.layout.layout');
    }
}
