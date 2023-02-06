<?php

namespace App\Http\Livewire;

use App\Models\inquiry;
use App\Models\inquiry_product;
use App\Models\job_order;
use App\Models\machine;
use App\Models\product;
use App\Models\raw_material;
use Livewire\Component;

class JomachineShow extends Component
{
    public $machines = [];
    public $machine = "";
    public $inquiry_products = [];
    public $inquiry_selected;
    public $message = "";
    public $raw_materials = [];
    public $raw_material_id;
    public $produced = 0;
    public $scrap_weight = 0;
    public $total_length_used = 0;
    public function mount()
    {
    }
    public function render()
    {
        $this->raw_materials = raw_material::all();
        $this->dispatchBrowserEvent('data_table');
        if ($machine = "") {
            $this->inquiry_products = inquiry_product::where(function ($e) {
                $e->where('status', 4)->orWhere('status', 5);
            })->get();
        } else {
            $this->inquiry_products = inquiry_product::where(function ($e) {
                $e->where('status', 4)->orWhere('status', 5);
            })->whereIn('product_id', product::where('machine_id', $this->machine)->pluck('id'))->get();
        }
        $this->inquiry_products = inquiry_product::all();
        $this->machines = machine::all();
        return view('livewire.jomachine-show');
    }

    public function record($id)
    {
        $this->inquiry_selected = inquiry_product::find($id);
        $this->dispatchBrowserEvent('record');
    }

    public function record_production()
    {
        job_order::create([
            'inquiry_product_id' => $this->inquiry_selected->id,
            'machine_id' => $this->inquiry_selected->product->machine_id,
            'raw_material_id' => $this->raw_material_id,
            'produced' => $this->produced,
            'scrap_weight' => $this->scrap_weight,
        ]);
        $this->inquiry_selected = inquiry_product::find($this->inquiry_selected->id);
        if ($this->inquiry_selected->remaining() > 0) {
            $this->inquiry_selected->status = 5;
        } else {
            $this->inquiry_selected->status = 6;
        }
        $this->inquiry_selected->save();

        $inquiry = inquiry::find($this->inquiry_selected->inquiry_id);

        if ($inquiry->status = 4) {
            $inquiry->status = 5;
        }
        $checker = 0;
        foreach ($inquiry->inquiry_products as $i) {
            if ($i->remaining() > 0) {
                $checker = 1;
            }
        }
        if ($checker = 0) {
            $inquiry->status = 6;
        }
        $inquiry->save();
        $this->raw_material_id = "";
        $this->produced = 0;
        $this->scrap_weight = 0;

        $this->message = "JO Record Save";
    }
}
