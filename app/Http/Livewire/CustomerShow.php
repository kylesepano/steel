<?php

namespace App\Http\Livewire;

use App\Models\customer;
use App\Models\refbrgy;
use App\Models\refcitymun;
use App\Models\refprovince;
use Livewire\Component;

class CustomerShow extends Component
{
    public $provinces = [];
    public $citymun_home = [];
    public $brangay_home = [];
    public $citymun_com = [];
    public $barangay_com = [];

    public $customers = [];
    public $customer = null;

    public $message = "";
    public $type = "";
    public $first_name = "";
    public $middle_name = "";
    public $last_name = "";
    public $home_address = "";
    public $home_province = "";
    public $home_city_municipality = "";
    public $home_barangay = "";
    public $company_name = "";
    public $company_address_line = "";
    public $company_province = "";
    public $company_city_municipality = "";
    public $company_barangay = "";
    public $mobile_number = "";
    public $phone_number = "";
    public $email_address = "";

    public function mount()
    {
        $this->provinces = refprovince::all();
        $this->customer = customer::first();
    }
    public function render()
    {
        $this->customers = customer::all();

        $this->citymun_home = refcitymun::where('provCode', $this->home_province)->get();
        $this->brangay_home = refbrgy::where('citymunCode', $this->home_city_municipality)->get();

        $this->citymun_com = refcitymun::where('provCode', $this->company_province)->get();
        $this->barangay_com = refbrgy::where('citymunCode', $this->company_city_municipality)->get();

        $this->dispatchBrowserEvent('data_table');
        return view('livewire.customer-show');
    }

    public function add()
    {
        customer::create([
            'type' => $this->type,
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->last_name,
            'home_address' => $this->home_address,
            'home_province' => $this->home_province,
            'home_city_municipality' => $this->home_city_municipality,
            'home_barangay' => $this->home_barangay,
            'company_name' => $this->company_name,
            'company_address_line' => $this->company_address_line,
            'company_province' => $this->company_province,
            'company_city_municipality' => $this->company_city_municipality,
            'company_barangay' => $this->company_barangay,
            'mobile_number' => $this->mobile_number,
            'phone_number' => $this->phone_number,
            'email_address' => $this->email_address,
        ]);
        $this->message = "Customer Successfully Created";
        $this->type = "";
        $this->first_name = "";
        $this->middle_name = "";
        $this->last_name = "";
        $this->home_address = "";
        $this->home_province = "";
        $this->home_city_municipality = "";
        $this->home_barangay = "";
        $this->company_name = "";
        $this->company_address_line = "";
        $this->company_province = "";
        $this->company_city_municipality = "";
        $this->company_barangay = "";
        $this->mobile_number = "";
        $this->phone_number = "";
        $this->email_address = "";
    }

    public function edit()
    {
        $this->customer->type = $this->type;
        $this->customer->first_name = $this->first_name;
        $this->customer->middle_name = $this->middle_name;
        $this->customer->last_name = $this->last_name;
        $this->customer->home_address = $this->home_address;
        $this->customer->home_province = $this->home_province;
        $this->customer->home_city_municipality = $this->home_city_municipality;
        $this->customer->home_barangay = $this->home_barangay;
        $this->customer->company_name = $this->company_name;
        $this->customer->company_address_line = $this->company_address_line;
        $this->customer->company_province = $this->company_province;
        $this->customer->company_city_municipality = $this->company_city_municipality;
        $this->customer->company_barangay = $this->company_barangay;
        $this->customer->mobile_number = $this->mobile_number;
        $this->customer->phone_number = $this->phone_number;
        $this->customer->email_address = $this->email_address;
        $this->customer->save();
        $this->message = "Customer Successfully Updated";
    }
    public function remove()
    {
        $this->customer->delete();
        $this->customer = customer::first();
        $this->message = "Customer Successfully Deleted";
        $this->dispatchBrowserEvent('remove_customer_hide');
    }
    public function add_customer()
    {
        $this->type = "";
        $this->first_name = "";
        $this->middle_name = "";
        $this->last_name = "";
        $this->home_address = "";
        $this->home_province = "";
        $this->home_city_municipality = "";
        $this->home_barangay = "";
        $this->company_name = "";
        $this->company_address_line = "";
        $this->company_province = "";
        $this->company_city_municipality = "";
        $this->company_barangay = "";
        $this->mobile_number = "";
        $this->phone_number = "";
        $this->email_address = "";
        $this->message = "";
        $this->dispatchBrowserEvent('add_customer');
    }
    public function edit_customer($id)
    {
        $this->customer = customer::find($id);
        $this->type = $this->customer->type;
        $this->first_name =  $this->customer->first_name;
        $this->middle_name =    $this->customer->middle_name;
        $this->last_name =   $this->customer->last_name;
        $this->home_address =    $this->customer->home_address;
        $this->home_province =    $this->customer->home_province;
        $this->home_city_municipality =    $this->customer->home_city_municipality;
        $this->home_barangay =    $this->customer->home_barangay;
        $this->company_name =    $this->customer->company_name;
        $this->company_address_line =    $this->customer->company_address_line;
        $this->company_province =    $this->customer->company_province;
        $this->company_city_municipality =    $this->customer->company_city_municipality;
        $this->company_barangay =    $this->customer->company_barangay;
        $this->mobile_number =    $this->customer->mobile_number;
        $this->phone_number =    $this->customer->phone_number;
        $this->email_address =    $this->customer->email_address;
        $this->message =   "";

        $this->dispatchBrowserEvent('edit_customer');
    }
    public function remove_customer($id)
    {
        $this->customer = customer::find($id);
        $this->dispatchBrowserEvent('remove_customer');
    }
}
