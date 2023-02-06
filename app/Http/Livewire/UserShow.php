<?php

namespace App\Http\Livewire;

use App\Models\branch;
use App\Models\user;
use App\Models\user_credential;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class UserShow extends Component
{
    use WithFileUploads;
    public $branches = [];
    public $users = [];
    public $user;
    public $message = "";

    public $name = "";
    public $branch_id = "";
    public $first_name = "";
    public $last_name = "";
    public $email_address = "";
    public $department = "";
    public $position = "";
    public $contact_number = "";
    public $signature;
    public function mount()
    {
        $this->user = user::first();
        $this->branches = branch::all();
    }
    public function render()
    {
        $this->dispatchBrowserEvent('data_table');
        $this->users = user::all();
        return view('livewire.user-show');
    }

    public function add()
    {
        $this->validate([
            'signature' => 'image',
        ]);
        $name = $this->last_name . '_' . $this->first_name . '.png';
        $this->signature->storeAs('/', $name, $disk = 'asset');
        user::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email_address' => $this->email_address,
            'department' => $this->department,
            'position' => $this->position,
            'contact_number' => $this->contact_number,
            'branch_id' => $this->branch_id,
            'signature' => $name,
            'status' => "Active",
        ]);
        $user = user::latest()->first();
        user_credential::create([
            'user_id' => $user->id,
            'username' => strtolower($this->first_name . '.' . $this->last_name),
            'password' => Hash::make(strtolower($this->first_name . '.' . $this->last_name)),
        ]);
        $this->message = "";
        $this->first_name = "";
        $this->last_name = "";
        $this->email_address = "";
        $this->department = "";
        $this->position = "";
        $this->branch_id = "";
        $this->contact_number = "";
        $this->signature = null;
        $this->message = "User Successfully Created";

        $this->user = user::first();
    }

    public function edit()
    {
        $name = $this->last_name . '_' . $this->first_name . '.png';
        if ($this->signature != $this->user->signature) {
            $this->signature->storeAs('/', $name, $disk = 'asset');
        } else {
            $name = $this->user->signature;
        }
        $this->user->first_name = $this->first_name;
        $this->user->last_name = $this->last_name;
        $this->user->email_address = $this->email_address;
        $this->user->department = $this->department;
        $this->user->position = $this->position;
        $this->user->branch_id = $this->branch_id;
        $this->user->contact_number = $this->contact_number;
        $this->user->signature = $name;
        $this->user->save();
        $this->message = "User Successfully Updated";
    }
    public function remove()
    {
        $this->user->status = "Inactive";
        $this->user->save();
        $this->user = user::first();
        $this->message = "User Successfully Deleted";
        $this->dispatchBrowserEvent('remove_user');
    }
    public function active()
    {
        $this->user->status = "Active";
        $this->user->save();
        $this->user = user::first();
        $this->message = "User Successfully Activated";
        $this->dispatchBrowserEvent('active_user');
    }
    public function add_user()
    {
        $this->message = "";
        $this->first_name = "";
        $this->last_name = "";
        $this->email_address = "";
        $this->department = "";
        $this->position = "";
        $this->branch_id = "";
        $this->contact_number = "";
        $this->signature = null;
        $this->dispatchBrowserEvent('add_user');
    }
    public function edit_user($id)
    {
        $this->user = user::find($id);
        $this->first_name = $this->user->first_name;
        $this->last_name = $this->user->last_name;
        $this->email_address = $this->user->email_address;
        $this->department = $this->user->department;
        $this->position = $this->user->position;
        $this->branch_id = $this->user->branch_id;
        $this->contact_number = $this->user->contact_number;
        $this->signature = $this->user->signature;
        $this->message = "";
        $this->dispatchBrowserEvent('edit_user');
    }
    public function remove_user($id)
    {
        $this->user = user::find($id);
        $this->signature = null;
        $this->dispatchBrowserEvent('remove_user');
    }
    public function signature_user($id)
    {
        $this->user = user::find($id);
        $this->signature = $this->user->signature;
        $this->dispatchBrowserEvent('signature_user');
    }
    public function active_user($id)
    {
        $this->user = user::find($id);
        $this->signature = null;
        $this->dispatchBrowserEvent('active_user');
    }
}
