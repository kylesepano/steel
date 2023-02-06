<?php

namespace App\Http\Livewire;

use App\Models\bank_account;
use App\Models\branch;
use App\Models\customer;
use App\Models\inquiry;
use App\Models\inquiry_product;
use App\Models\payment;
use App\Models\product;
use App\Models\product_variation;
use App\Models\sales_confirmation;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class DashboardShow extends Component
{
    public $inquiries = [];
    public $inquiry = null;

    public $customers = [];
    public $users = [];
    public $branches = [];
    public $customer = null;
    public $products = [];
    public $product_variations = [];
    public $product_selected = [];
    public $variation_selected = [];

    public $customer_id = "";
    public $user_id = "";
    public $purpose = "";
    public $branch_id = "";
    public $discount_type = 0;
    public $discount_amount = 0;
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
    public $inquiry_product_id = [];

    public $inquiry_product = null;

    public $bank_accounts = [];

    public $message = "";
    public $type = "";

    public $amount_paid;
    public $date_received;
    public $payment_mode = 1;
    public $bank_id = "";
    public $bank = "";
    public $check_number = "";

    public function mount()
    {
        $this->products = product::all();
        $this->customers = customer::all();
        $this->branches = branch::all();
        $this->bank_accounts = bank_account::all();
    }
    public function render()
    {

        $this->dispatchBrowserEvent('data_table');
        $this->customer = customer::find($this->customer_id);
        $this->inquiries = inquiry::all();

        foreach ($this->product_id as  $k => $id) {
            $this->product_variations[$k] = product_variation::where('product_id', $id)->get();
            $this->product_selected[$k] = product::find($id);
        }
        foreach ($this->product_variation_id as  $k => $id) {
            $this->variation_selected[$k] = product_variation::find($id);
        }

        return view('livewire.dashboard-show');
    }
    public function add_row()
    {
        $this->row += 1;
    }
    public function add()
    {
        if (count($this->price_piece) != 0) {
            inquiry::create([
                'customer_id' => $this->customer_id,
                'user_id' => auth()->user()->user->id,
                'purpose' => $this->purpose,
                'branch_id' => $this->branch_id,
                'discount_type' => $this->discount_type,
                'discount_amount' => $this->discount_amount,
                'status' => 1,
                'notes' => $this->notes,
            ]);
            $inquiry = inquiry::latest()->first();
            foreach ($this->price_piece as $key => $val) {
                if ($val != 0) {
                    $color = "";
                    $quan = 1;
                    if (array_key_exists($key, $this->color)) {
                        $color = $this->color[$key];
                    }
                    if (array_key_exists($key, $this->quantity)) {
                        $quan = $this->quantity[$key];
                    }

                    inquiry_product::create([
                        'inquiry_id' => $inquiry->id,
                        'product_id' => $this->product_id[$key],
                        'product_variation_id' => $this->product_variation_id[$key],
                        'length' => $this->length[$key],
                        'color' => $color,
                        'quantity' => $quan,
                        'price_piece' => $this->price_piece[$key],
                        'status' => 1,
                    ]);
                }
            }
            $this->clear();

            $this->message = "Inquiry Added Successfully";
        } else {
            $this->message = "No Product Inquiry Found";
        }
    }
    public function edit()
    {
        $this->inquiry->purpose = $this->purpose;
        $this->inquiry->branch_id = $this->branch_id;
        $this->inquiry->discount_type = $this->discount_type;
        $this->inquiry->discount_amount = $this->discount_amount;
        $this->inquiry->notes = $this->notes;
        $inq_prod = inquiry_product::where('inquiry_id', $this->inquiry->id)->get();
        foreach ($inq_prod as $q) {
            $q->delete();
        }
        foreach ($this->price_piece as $key => $val) {
            if ($val != 0) {
                $color = "";
                $quan = 1;
                if (array_key_exists($key, $this->color)) {
                    $color = $this->color[$key];
                }
                if (array_key_exists($key, $this->quantity)) {
                    $quan = $this->quantity[$key];
                }
                inquiry_product::create([
                    'inquiry_id' => $this->inquiry->id,
                    'product_id' => $this->product_id[$key],
                    'product_variation_id' => $this->product_variation_id[$key],
                    'length' => $this->length[$key],
                    'color' => $color,
                    'quantity' => $quan,
                    'price_piece' => $this->price_piece[$key],
                    'status' => 1,
                ]);
            }
        }
        $this->inquiry->save();
        $this->inquiry = inquiry::find($this->inquiry->id);
        $this->ref();
        $this->message = "Inquiry Updated Successfully";
    }

    public function clear()
    {
        $this->customer_id = "";
        $this->purpose = "";
        $this->branch_id = "";
        $this->discount_type = 0;
        $this->discount_amount = 0;
        $this->notes = "";
        $this->row = 5;
        $this->product_id = [];
        $this->product_variation_id = [];
        $this->length = [];
        $this->color = [];
        $this->quantity = [];
        $this->price_piece = [];
        $this->statuses = [];
        $this->inquiry_product_id = [];

        $this->product_variations = [];
        $this->product_selected = [];
        $this->variation_selected = [];
        $this->message = "";
        $this->type = "";

        $this->amount_paid = null;
        $this->date_received = null;
        $this->payment_mode = 1;
    }
    public function add_inquiry()
    {
        $this->clear();
        $this->dispatchBrowserEvent('add_inquiry');
    }

    public function edit_inquiry($id)
    {
        $this->inquiry = inquiry::find($id);
        $this->ref();
        $this->type = "Edit";
        $this->dispatchBrowserEvent('edit_inquiry');
    }

    public function ref()
    {
        $this->clear();
        $this->customer_id = $this->inquiry->customer_id;
        $this->purpose = $this->inquiry->purpose;
        $this->branch_id = $this->inquiry->branch_id;
        $this->discount_type = $this->inquiry->discount_type;
        $this->discount_amount = $this->inquiry->discount_amount;
        $this->notes = $this->inquiry->notes;

        $this->row = $this->inquiry->inquiry_products->count();
        $x = 0;
        foreach ($this->inquiry->inquiry_products as $p) {
            $this->product_id[$x] = $p->product_id;
            $this->product_variation_id[$x] = $p->product_variation_id;
            $this->length[$x] = $p->length;
            $this->color[$x] = $p->color;
            $this->quantity[$x] = $p->quantity;
            $this->price_piece[$x] = $p->price_piece;
            $this->inquiry_product_id[$x] = $p->id;
            $x += 1;
        }
    }
    public function delete_product($id)
    {
        $this->inquiry_product = inquiry_product::find($id);
        $this->dispatchBrowserEvent('delete_product');
    }
    public function close_delete()
    {
        $this->dispatchBrowserEvent('delete_product');
    }
    public function delete()
    {
        $this->inquiry_product->delete();
        $this->inquiry = inquiry::find($this->inquiry->id);
        $this->ref();
        $this->message = "Inquiry Product Remove From The Inquiry";
        $this->dispatchBrowserEvent('delete_product');
        $this->inquiry_product = null;
    }
    public function view_inquiry($id)
    {
        $this->inquiry = inquiry::find($id);
        $this->ref();
        $this->type = "View";
        $this->dispatchBrowserEvent('view_inquiry');
    }
    public function payment($id)
    {
        $this->inquiry = inquiry::find($id);
        $this->ref();
        $this->type = "Payment";
        $this->dispatchBrowserEvent('payment');
    }
    public function confirm($id)
    {
        $this->inquiry = inquiry::find($id);
        $this->ref();
        $this->type = "Confirm";
        $this->dispatchBrowserEvent('confirm');
    }
    public function prod_change($i)
    {
        $this->product_variation_id[$i] = "";
    }
    public function confirm_payment()
    {
        $remaining = $this->inquiry->remaining_due() - $this->amount_paid;
        payment::create([
            'sales_confirmation_id' => $this->inquiry->sales_confirmations->id,
            'date_received' => $this->date_received,
            'amount_paid' => $this->amount_paid,
            'remaining_payable' => $remaining,
            'mode' => $this->payment_mode,
            'bank_id' => $this->bank_id,
            'bank' => $this->bank,
            'check_number' => $this->check_number,
        ]);
        if ($remaining > 0) {
            $this->inquiry->status = 3;
        } else {
            $this->inquiry->status = 4;
        }
        $this->inquiry->save();
        $this->inquiry = inquiry::find($this->inquiry->id);
        $this->message = "Payment Added Successfully";
        $this->ref();
        $this->type = "Confirm";
    }
    public function payment_send()
    {
        $this->inquiry->status = 2;
        $this->inquiry->save();
        foreach ($this->inquiry->inquiry_products as $i) {
            $i->status = 2;
            $i->save();
        }
        $this->inquiry = inquiry::find($this->inquiry->id);
        $this->ref();
        $this->message = "Inquiry Successfully Sent To Accounting For Payment Confirmation";
        $number = 1;
        $holder = sales_confirmation::latest()->first();
        if ($holder != null) {
            $number = $holder->id + 1;
        }
        $sc_number = "CSC-SC-" .  strval(sprintf("%04s", $number));
        sales_confirmation::create([
            'inquiry_id' => $this->inquiry->id,
            'sc_number' => $sc_number,
        ]);
        $this->dispatchBrowserEvent('payment');
    }
    public function discount()
    {
        $this->discount_amount = 0;
    }
}
