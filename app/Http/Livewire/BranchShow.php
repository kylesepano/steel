<?php

namespace App\Http\Livewire;

use App\Models\branch;
use Livewire\Component;

class BranchShow extends Component
{
    public $branches = [];
    public $name = "";
    public $message = "";
    public $branch;
    public function mount()
    {
        $this->branch = branch::first();
    }
    public function render()
    {
        $this->dispatchBrowserEvent('data_table');
        $this->branches = branch::all();
        return view('livewire.branch-show');
    }

    public function add()
    {
        branch::create([
            'name' => $this->name
        ]);
        $this->name = "";
        $this->message = "Branch Successfuly Created";
    }

    public function add_branch()
    {
        $this->message = "";
        $this->name = "";
        $this->dispatchBrowserEvent('add_branch');
    }
    public function edit_branch($id)
    {
        $this->branch = branch::find($id);
        $this->name = $this->branch->name;
        $this->message = "";
        $this->dispatchBrowserEvent('edit_branch');
    }

    public function edit()
    {
        $this->branch->name = $this->name;
        $this->branch->save();
        $this->message = "Branch Successfuly Updated";
    }
}
