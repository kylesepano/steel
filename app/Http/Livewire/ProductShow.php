<?php

namespace App\Http\Livewire;

use App\Models\machine;
use App\Models\product;
use Livewire\Component;

class ProductShow extends Component
{
    public $products = [];
    public $product;
    public $message = "";

    public $name = "";
    public $length_dependent = 0;
    public $purlin = 0;
    public $standard_length = 0;
    public $special_cut = 0;
    public $production_process = 0;
    public $bended_accessory = 0;
    public $uom = "";
    public $color = 0;
    public $product_machines = [];

    public $machine_name = "";
    public $machine_id = "";
    public function mount()
    {
        $this->product = product::first();
    }
    public function render()
    {
        if ($this->length_dependent == null) {
            $this->length_dependent = 0;
        }
        if ($this->purlin == null) {
            $this->purlin = 0;
        }
        if ($this->special_cut == null) {
            $this->special_cut = 0;
        }
        if ($this->production_process == null) {
            $this->production_process = 0;
        }
        if ($this->bended_accessory == null) {
            $this->bended_accessory = 0;
        }
        if ($this->color == null) {
            $this->color = 0;
        }
        $this->product_machines = machine::all();
        $this->dispatchBrowserEvent('data_table');
        $this->products = product::all();
        return view('livewire.product-show');
    }

    public function add()
    {
        $standard_length = 0;
        if ($this->length_dependent == 1) {
            $standard_length = $this->standard_length;
        }
        product::create([
            'name' => $this->name,
            'length_dependent' => $this->length_dependent,
            'purlin' => $this->purlin,
            'standard_length' => $standard_length,
            'special_cut' => $this->special_cut,
            'production_process' => $this->production_process,
            'bended_accessory' => $this->bended_accessory,
            'uom' => $this->uom,
            'color' => $this->color,
            'machine_id' => $this->machine_id,

        ]);

        $this->message = "Product Successfully Created";
        $this->name = "";
        $this->length_dependent = 0;
        $this->purlin = 0;
        $this->standard_length = 0;
        $this->special_cut = 0;
        $this->production_process = 0;
        $this->bended_accessory = 0;
        $this->uom = "";
        $this->color = 0;
    }

    public function edit()
    {
        $standard_length = 0;
        if ($this->length_dependent == 1) {
            $standard_length = $this->standard_length;
        }
        $this->product->name = $this->name;
        $this->product->length_dependent = $this->length_dependent;
        $this->product->purlin = $this->purlin;
        $this->product->standard_length = $standard_length;
        $this->product->special_cut = $this->special_cut;
        $this->product->production_process = $this->production_process;
        $this->product->bended_accessory = $this->bended_accessory;
        $this->product->uom = $this->uom;
        $this->product->color = $this->color;
        $this->product->machine_id = $this->machine_id;
        $this->product->save();
        $this->message = "Product Successfully Updated";
    }
    public function remove()
    {
        $this->product->delete();
        $this->product = product::first();
        $this->message = "Product Successfully Deleted";
        $this->dispatchBrowserEvent('remove_product_hide');
    }
    public function machine()
    {
        machine::create([
            'name' => $this->machine_name
        ]);
        $this->machine_name = "";
        $this->message = "Machine Successfully Created";
    }
    public function add_product()
    {
        $this->name = "";
        $this->length_dependent = 0;
        $this->purlin = 0;
        $this->standard_length = 0;
        $this->special_cut = 0;
        $this->production_process = 0;
        $this->bended_accessory = 0;
        $this->uom = "";
        $this->color = 0;
        $this->message = "";
        $this->machine_id = "";
        $this->dispatchBrowserEvent('add_product');
    }
    public function edit_product($id)
    {
        $this->product = product::find($id);
        $this->name = $this->product->name;
        $this->length_dependent = $this->product->length_dependent;
        $this->purlin = $this->product->purlin;
        $this->standard_length = $this->product->standard_length;
        $this->special_cut = $this->product->special_cut;
        $this->production_process = $this->product->production_process;
        $this->bended_accessory = $this->product->bended_accessory;
        $this->uom = $this->product->uom;
        $this->color = $this->product->color;
        $this->machine_id = $this->product->machine_id;
        $this->message = "";
        $this->dispatchBrowserEvent('edit_product');
    }
    public function remove_product($id)
    {
        $this->product = product::find($id);
        $this->dispatchBrowserEvent('remove_product');
    }
    public function add_machine()
    {
        $this->machine_name = "";
        $this->dispatchBrowserEvent('add_machine');
    }
}
