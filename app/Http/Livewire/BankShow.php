<?php

namespace App\Http\Livewire;

use App\Models\bank_account;
use App\Models\branch;
use Livewire\Component;

class BankShow extends Component
{
    public $branches = [];
    public $banks = [];
    public $bank;
    public $message = "";

    public $name = "";
    public $branch_id = "";
    public $account_name = "";
    public $account_number = "";
    public function mount()
    {
        $this->bank = bank_account::first();
        $this->branches = branch::all();
    }
    public function render()
    {
        $this->dispatchBrowserEvent('data_table');
        $this->banks = bank_account::all();
        return view('livewire.bank-show');
    }

    public function add()
    {
        bank_account::create([
            'name' => $this->name,
            'branch_id' => $this->branch_id,
            'account_name' => $this->account_name,
            'account_number' => $this->account_number,
        ]);
        $this->message = "Bank Account Successfully Created";
        $this->message = "";
        $this->name = "";
        $this->branch_id = "";
        $this->account_name = "";
        $this->account_number = "";
    }

    public function edit()
    {
        $this->bank->name = $this->name;
        $this->bank->branch_id = $this->branch_id;
        $this->bank->account_number = $this->account_number;
        $this->bank->account_name = $this->account_name;
        $this->bank->save();
        $this->message = "Bank Account Successfully Updated";
    }
    public function remove()
    {
        $this->bank->delete();
        $this->bank = bank_account::first();
        $this->message = "Bank Account Successfully Deleted";
        $this->dispatchBrowserEvent('remove_bank');
    }
    public function add_bank()
    {
        $this->message = "";
        $this->name = "";
        $this->branch_id = "";
        $this->account_name = "";
        $this->account_number = "";
        $this->dispatchBrowserEvent('add_bank');
    }
    public function edit_bank($id)
    {
        $this->bank = bank_account::find($id);
        $this->name = $this->bank->name;
        $this->account_name = $this->bank->account_name;
        $this->branch_id = $this->bank->branch_id;
        $this->account_number = $this->bank->account_number;
        $this->message = "";
        $this->dispatchBrowserEvent('edit_bank');
    }
    public function remove_bank($id)
    {
        $this->bank = bank_account::find($id);
        $this->dispatchBrowserEvent('remove_bank');
    }
}
