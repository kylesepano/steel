<?php

namespace App\Http\Livewire;

use App\Models\inquiry;
use Livewire\Component;

class JopdfShow extends Component
{
    public $inquiry = null;
    public function mount($id)
    {
        $this->inquiry = inquiry::find($id);
    }
    public function render()
    {
        return view('livewire.jopdf-show');
    }
}
