<?php

namespace App\Http\Livewire;

use App\Models\bank_account;
use App\Models\inquiry;
use Livewire\Component;

class QuotationShow extends Component
{
    public $inquiry = null;
    public $bank_accounts =  [];
    public function mount($id)
    {
        $this->bank_accounts = bank_account::all();
        $this->inquiry = inquiry::find($id);
    }
    public function render()
    {
        return view('livewire.quotation-show');
    }
}
