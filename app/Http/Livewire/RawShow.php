<?php

namespace App\Http\Livewire;

use App\Models\raw_material;
use App\Models\raw_material_note;
use Livewire\Component;

class RawShow extends Component
{
    public $raws = [];
    public $raw;
    public $message = "";

    public $raw_material = "";
    public $coil_type = "";
    public $bl_number = "";
    public $j_code = "";
    public $l_code = "";
    public $width = "";
    public $thickness = "";
    public $beginning_weight = "";
    public $beginning_length = "";
    public $type = "";
    public $color = "";

    public $notes = "";
    public function mount()
    {
        $this->raw = raw_material::first();
    }
    public function render()
    {
        $this->dispatchBrowserEvent('data_table');
        $this->raws = raw_material::all();
        return view('livewire.raw-show');
    }

    public function add()
    {
        raw_material::create([
            'raw_material' => $this->raw_material,
            'coil_type' => $this->coil_type,
            'bl_number' => $this->bl_number,
            'j_code' => $this->j_code,
            'l_code' => $this->l_code,
            'width' => $this->width,
            'thickness' => $this->thickness,
            'beginning_weight' => $this->beginning_weight,
            'beginning_length' => $this->beginning_length,
            'type' => $this->type,
            'color' => $this->color,
        ]);

        $notes =  preg_split("/\\r\\n|\\r|\\n/", $this->notes);
        $raw = raw_material::latest()->first();
        foreach ($notes as $n) {
            raw_material_note::create([
                'raw_material_id' => $raw->id,
                'notes' => $n
            ]);
        }

        $this->message = "Raw Material Successfully Created";
        $this->raw_material = "";
        $this->coil_type = "";
        $this->bl_number = "";
        $this->j_code = "";
        $this->l_code = "";
        $this->width = "";
        $this->thickness = "";
        $this->beginning_weight = "";
        $this->beginning_length = "";
        $this->type = "";
        $this->color = "";
        $this->notes = "";
    }

    public function edit()
    {
        $this->raw->raw_material = $this->raw_material;
        $this->raw->coil_type = $this->coil_type;
        $this->raw->bl_number = $this->bl_number;
        $this->raw->j_code = $this->j_code;
        $this->raw->l_code = $this->l_code;
        $this->raw->width = $this->width;
        $this->raw->thickness = $this->thickness;
        $this->raw->beginning_weight = $this->beginning_weight;
        $this->raw->beginning_length = $this->beginning_length;
        $this->raw->type = $this->type;
        $this->raw->color = $this->color;
        $this->raw->save();

        $notes = raw_material_note::where('raw_material_id', $this->raw->id)->get();
        foreach ($notes as $n) {
            $n->delete();
        }
        $notes =  preg_split("/\\r\\n|\\r|\\n/", $this->notes);
        foreach ($notes as $n) {
            raw_material_note::create([
                'raw_material_id' =>  $this->raw->id,
                'notes' => $n
            ]);
        }
        $this->message = "Raw Material Successfully Updated";
    }
    public function remove()
    {
        $notes = raw_material_note::where('raw_material_id', $this->raw->id)->get();
        foreach ($notes as $n) {
            $n->delete();
        }
        $this->dispatchBrowserEvent('remove_raw_hide');
        $this->raw->delete();
        $this->raw = raw_material::first();
        $this->message = "Raw Material Successfully Deleted";
    }
    public function add_raw()
    {
        $this->raw_material = "";
        $this->coil_type = "";
        $this->bl_number = "";
        $this->j_code = "";
        $this->l_code = "";
        $this->width = "";
        $this->thickness = "";
        $this->beginning_weight = "";
        $this->beginning_length = "";
        $this->type = "";
        $this->color = "";
        $this->notes = "";
        $this->dispatchBrowserEvent('add_raw');
    }
    public function edit_raw($id)
    {
        $this->raw = raw_material::find($id);
        $this->raw_material = $this->raw->raw_material;
        $this->coil_type = $this->raw->coil_type;
        $this->bl_number = $this->raw->bl_number;
        $this->j_code = $this->raw->j_code;
        $this->l_code = $this->raw->l_code;
        $this->width = $this->raw->width;
        $this->thickness = $this->raw->thickness;
        $this->beginning_weight = $this->raw->beginning_weight;
        $this->beginning_length = $this->raw->beginning_length;
        $this->type = $this->raw->type;
        $this->color = $this->raw->color;
        $this->notes = "";
        $index = 0;
        $notes = raw_material_note::where('raw_material_id', $this->raw->id)->get();
        foreach ($notes as $n) {
            if ($index != 0) {
                $this->notes .= "\n";
            }
            $this->notes .=  $n->notes;
            $index += 1;
        }
        $this->message = "";
        $this->dispatchBrowserEvent('edit_raw');
    }
    public function remove_raw($id)
    {
        $this->raw = raw_material::find($id);
        $this->dispatchBrowserEvent('remove_raw');
    }
    public function notes_raw($id)
    {
        $this->raw = raw_material::find($id);
        $this->dispatchBrowserEvent('notes_raw');
    }
}
