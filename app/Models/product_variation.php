<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_variation extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'length',
        'length_uom',
        'width',
        'width_uom',
        'height',
        'height_uom',
        'thickness',
        'thickness_uom',
        'weight_pc',
        'weight_meter',
    ];

    public function product()
    {
        return $this->belongsTo(product::class, 'product_id');
    }

    public function variation()
    {

        $name = '';
        if ($this->length != 0 && $this->length != null) {
            $name .= $this->length . $this->length_uom;
        }
        if ($this->width != 0 && $this->width != null) {
            if ($name != '') {
                $name .= 'x' . $this->width . $this->width_uom;
            } else {
                $name .= $this->width . $this->width_uom;
            }
        }
        if ($this->height != 0 && $this->height != null) {
            if ($name != '') {
                $name .= 'x' . $this->height . $this->height_uom;
            } else {
                $name .= $this->height . $this->height_uom;
            }
        }
        if ($this->thickness != 0 && $this->thickness != null) {
            if ($name != '') {
                $name .= '@' . $this->thickness . $this->thickness_uom;
            } else {
                $name .= $this->thickness . $this->thickness_uom;
            }
        }
        return $name;
    }
}
