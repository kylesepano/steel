<?php

namespace App\Http\Livewire;

use App\Models\product;
use App\Models\product_variation;
use Livewire\Component;

class VariationShow extends Component
{
    public $products = [];
    public $variations = [];
    public $variation;
    public $message = "";

    public $product_id = "";
    public $length = 0;
    public $length_uom = "";
    public $width = 0;
    public $width_uom = "";
    public $height = 0;
    public $height_uom = "";
    public $thickness = 0;
    public $thickness_uom = "";
    public $weight_pc = 0;
    public $weight_meter = 0;

    public function mount()
    {
        $this->products = product::all();
        $this->variation = product_variation::first();
    }
    public function render()
    {

        $this->dispatchBrowserEvent('data_table');
        $this->variations = product_variation::all();
        return view('livewire.variation-show');
    }

    public function add()
    {
        product_variation::create([
            'product_id' => $this->product_id,
            'length' => $this->length,
            'length_uom' => $this->length_uom,
            'width' => $this->width,
            'width_uom' => $this->width_uom,
            'height' => $this->height,
            'height_uom' => $this->height_uom,
            'thickness' => $this->thickness,
            'thickness_uom' => $this->thickness_uom,
            'weight_pc' => $this->weight_pc,
            'weight_meter' => $this->weight_meter,

        ]);

        $this->message = "Product Variation Successfully Created";
        $this->product_id = "";
        $this->length = 0;
        $this->length_uom = "";
        $this->width = 0;
        $this->width_uom = "";
        $this->height = 0;
        $this->height_uom = "";
        $this->thickness = 0;
        $this->thickness_uom = "";
        $this->weight_pc = 0;
        $this->weight_meter = 0;
    }

    public function edit()
    {
        $this->variation->product_id = $this->product_id;
        $this->variation->length = $this->length;
        $this->variation->length_uom = $this->length_uom;
        $this->variation->width = $this->width;
        $this->variation->width_uom = $this->width_uom;
        $this->variation->height = $this->height;
        $this->variation->height_uom = $this->height_uom;
        $this->variation->thickness = $this->thickness;
        $this->variation->thickness_uom = $this->thickness_uom;
        $this->variation->weight_pc = $this->weight_pc;
        $this->variation->weight_meter = $this->weight_meter;
        $this->variation->save();
        $this->message = "Product Variation Successfully Updated";
    }
    public function remove()
    {
        $this->variation->delete();
        $this->variation = product_variation::first();
        $this->message = "Product Variation Successfully Deleted";
        $this->dispatchBrowserEvent('remove_variation_hide');
    }
    public function add_variation()
    {
        $this->product_id = "";
        $this->length = 0;
        $this->length_uom = "";
        $this->width = 0;
        $this->width_uom = "";
        $this->height = 0;
        $this->height_uom = "";
        $this->thickness = 0;
        $this->thickness_uom = "";
        $this->weight_pc = 0;
        $this->weight_meter = 0;
        $this->message = "";
        $this->dispatchBrowserEvent('add_variation');
    }
    public function edit_variation($id)
    {
        $this->variation = product_variation::find($id);
        $this->product_id = $this->variation->product_id;
        $this->length = $this->variation->length;
        $this->length_uom = $this->variation->length_uom;
        $this->width = $this->variation->width;
        $this->width_uom = $this->variation->width_uom;
        $this->height = $this->variation->height;
        $this->height_uom = $this->variation->height_uom;
        $this->thickness = $this->variation->thickness;
        $this->thickness_uom = $this->variation->thickness_uom;
        $this->weight_pc = $this->variation->weight_pc;
        $this->weight_meter = $this->variation->weight_meter;
        $this->message = "";
        $this->dispatchBrowserEvent('edit_variation');
    }
    public function remove_variation($id)
    {
        $this->variation = product_variation::find($id);
        $this->dispatchBrowserEvent('remove_variation');
    }
}
