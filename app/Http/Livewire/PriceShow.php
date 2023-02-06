<?php

namespace App\Http\Livewire;

use App\Models\branch;
use App\Models\product;
use App\Models\product_price;
use Livewire\Component;

class PriceShow extends Component
{
    public $products = [];
    public $product = null;
    public $branches = [];
    public $prices = [];
    public $price;
    public $message = "";

    public $product_id = "";
    public $start_date = "";
    public $end_date = "";
    public $end_user = 0;
    public $dealer = 0;
    public $contractor = 0;
    public $branch_id = "";
    public $additional_special_cut = 0;

    public function mount()
    {
        $this->branches = branch::all();
        $this->products = product::all();
        $this->price = product_price::first();
    }
    public function render()
    {
        $this->product = product::find($this->product_id);
        $this->dispatchBrowserEvent('data_table');
        $this->prices = product_price::all();
        return view('livewire.price-show');
    }

    public function add()
    {
        $special_cut = 0;
        if ($this->product != null) {
            if ($this->product->special_cut == 1) {
                $special_cut  = $this->additional_special_cut;
            }
        }
        product_price::create([
            'product_id' => $this->product_id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'end_user' => $this->end_user,
            'dealer' => $this->dealer,
            'contractor' => $this->contractor,
            'branch_id' => $this->branch_id,
            'additional_special_cut' => $special_cut,
        ]);
        $this->message = "Product Price Successfully Created";
        $this->product_id = "";
        $this->start_date = "";
        $this->end_date = "";
        $this->end_user = 0;
        $this->dealer = 0;
        $this->contractor = 0;
        $this->branch_id = "";
        $this->additional_special_cut = "";
    }

    public function edit()
    {
        $special_cut = 0;
        if ($this->product != null) {
            if ($this->product->special_cut == 1) {
                $special_cut  = $this->additional_special_cut;
            }
        }
        $this->price->product_id = $this->product_id;
        $this->price->start_date = $this->start_date;
        $this->price->end_date = $this->end_date;
        $this->price->end_user = $this->end_user;
        $this->price->dealer = $this->dealer;
        $this->price->contractor = $this->contractor;
        $this->price->branch_id = $this->branch_id;
        $this->price->additional_special_cut = $special_cut;
        $this->price->save();
        $this->message = "Product Price Successfully Updated";
    }
    public function remove()
    {
        $this->price->delete();
        $this->price = product_price::first();
        $this->message = "Product Price Successfully Deleted";
        $this->dispatchBrowserEvent('remove_price_hide');
    }
    public function add_price()
    {
        $this->product_id = "";
        $this->start_date = "";
        $this->end_date = "";
        $this->end_user = 0;
        $this->dealer = 0;
        $this->contractor = 0;
        $this->branch_id = "";;
        $this->message = "";
        $this->dispatchBrowserEvent('add_price');
    }
    public function edit_price($id)
    {
        $this->price = product_price::find($id);
        $this->product_id = $this->price->product_id;
        $this->start_date = $this->price->start_date;
        $this->end_date =  $this->price->end_date;
        $this->end_user = $this->price->end_user;
        $this->dealer = $this->price->dealer;
        $this->contractor =   $this->price->contractor;
        $this->branch_id = $this->price->branch_id;
        $this->message = "";
        $this->dispatchBrowserEvent('edit_price');
    }
    public function remove_price($id)
    {
        $this->price = product_price::find($id);
        $this->dispatchBrowserEvent('remove_price');
    }
}
