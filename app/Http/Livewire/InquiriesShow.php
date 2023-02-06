<?php

namespace App\Http\Livewire;

use App\Models\customer;
use App\Models\inquiry;
use Livewire\Component;

class InquiriesShow extends Component
{
    public $inquiries = [];
    public $inquiry = null;

    public $customers = [];
    public $users = [];
    public $branches = [];
    public $customer = null;

    public $customer_id = "";
    public $user_id = "";
    public $purpose = "";
    public $branch = "";
    public $discount_type = 0;
    public $status = "";
    public $notes = "";

    public $row = 5;

    public $product_id = [];
    public $product_variation_id = [];
    public $length = [];
    public $color = [];
    public $quantity = [];
    public $price_piece = [];
    public $statuses = [];

    public $message = "";
    public function mount()
    {
    }
    public function render()
    {
        $this->customer = customer::find($this->customer_id);
        $this->inquiries = inquiry::all();
        return view('livewire.inquiries-show');
    }
    public function add()
    {
    }
    public function edit()
    {
    }
    public function add_inquiry()
    {

        $this->dispatchBrowserEvent('add_inquiry');
    }
    public function view_inquiry($id)
    {
        $this->inquiry = inquiry::find($id);

        $this->dispatchBrowserEvent('view_inquiry');
    }
    public function edit_inquiry($id)
    {
        $this->inquiry = inquiry::find($id);
        $this->dispatchBrowserEvent('edit_inquiry');
    }
}
