<?php

namespace App\Http\Livewire;

use App\Models\inquiry;
use Livewire\Component;
use NumberFormatter;

class SalesShow extends Component
{
    public $inquiry = [];
    public $words = "";
    public function mount($id)
    {

        $this->inquiry = inquiry::find($id);
        $this->words = new NumberFormatter('en', NumberFormatter::SPELLOUT);
        $this->words = $this->words->format(round($this->inquiry->grand_total()));
    }
    public function render()
    {
        return view('livewire.sales-show');
    }
}
