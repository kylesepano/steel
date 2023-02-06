<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'first_name',
        'middle_name',
        'last_name',
        'home_address',
        'home_province',
        'home_city_municipality',
        'home_barangay',
        'company_name',
        'company_address_line',
        'company_province',
        'company_city_municipality',
        'company_barangay',
        'mobile_number',
        'phone_number',
        'email_address',
    ];

    public function fullname()
    {
        return $this->last_name . ', ' . $this->first_name . ' ' . $this->middle_name;
    }

    public function home_province_loc()
    {

        return refprovince::where('provCode', $this->home_province)->first()->provDesc;
    }
    public function home_city_municipality_loc()
    {
        return refcitymun::where('citymunCode', $this->home_city_municipality)->first()->citymunDesc;
    }
    public function home_barangay_loc()
    {
        return refbrgy::where('brgyCode', $this->home_barangay)->first()->brgyDesc;
    }
    public function company_province_loc()
    {
        if ($this->company_province != null && $this->company_province != "") {
            return refprovince::where('provCode', $this->company_province)->first()->provDesc;
        } else {
            return "N/A";
        }
    }
    public function company_city_municipality_loc()
    {
        if ($this->company_city_municipality != null && $this->company_city_municipality != "") {
            return refcitymun::where('citymunCode', $this->company_city_municipality)->first()->citymunDesc;
        } else {
            return "N/A";
        }
    }
    public function company_barangay_loc()
    {
        if ($this->company_barangay != null && $this->company_barangay != "") {
            return refbrgy::where('brgyCode', $this->company_barangay)->first()->brgyDesc;
        } else {
            return "N/A";
        }
    }
}
