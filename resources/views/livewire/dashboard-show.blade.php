<div>
    @if ($message != '')
        <h4 class="bg-success">{{ $message }}</h4>
    @endif
    @if (auth()->user()->user->department === 'Sales')
        <button class="btn btn-success" wire:click="add_inquiry">ADD INQUIRY</button>
    @endif
    <div wire:ignore.self class="modal fade" id="add_inquiry" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" style="max-width:80%">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ADD INQUIRY</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="add">
                    <div class="modal-body">
                        @csrf
                        <div style="height: 800px; overflow-y: auto;  overflow-x: hidden;  ">
                            @if ($message != '')
                                <h5 class="bg-success">{{ $message }}</h5>
                            @endif
                            <div class="row">
                                <div class="col-md-2">
                                    <h5>Customer Name</h5>
                                </div>
                                <div class="col-md-3">
                                    <select wire:model="customer_id" class="form-control" required>
                                        <option value="">Select Customer</option>
                                        @foreach ($customers as $c)
                                            <option value="{{ $c->id }}">{{ $c->fullname() }} -
                                                {{ $c->company_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-7 p-0"></div>
                                <div class="col-md-2">
                                    <h5>Type of Customer</h5>
                                </div>
                                <div class="col-md-3">
                                    @if ($customer != null)
                                        {{ $customer->type }}
                                    @endif
                                </div>
                                <div class="col-md-7 p-0"></div>
                                <div class="col-md-2">
                                    <h5>Branch</h5>
                                </div>
                                <div class="col-md-3">
                                    <select wire:model="branch_id" class="form-control" required>
                                        <option value="">Select Branch</option>
                                        @foreach ($branches as $b)
                                            <option value="{{ $b->id }}">{{ $b->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-7 p-0"></div>
                                <div class="col-md-2">
                                    <h5>Purpose</h5>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" wire:model="purpose" class="form-control">
                                </div>
                                <div class="col-md-7 p-0"></div>
                                <div class="col-md-2">
                                    <h5>Discount</h5>
                                    <div class="d-flex justify-content-center">
                                        <input type="radio" wire:model="discount_type" value="0" class=" mb-3"
                                            wire:click="discount">
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <input type="radio" wire:model="discount_type" value="1" class=" mb-3"
                                            wire:click="discount">
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <input type="radio" wire:model="discount_type" value="2" class=" mb-3"
                                            wire:click="discount">
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <input type="radio" wire:model="discount_type" value="3" class=" mb-3"
                                            wire:click="discount">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <br>
                                    <div class="pt-4">
                                        <label>NO DISCOUNT</label>
                                        <br>
                                        <label>Less % per item</label>
                                        <label>Less % on overall total</label>
                                        <label>Less specific amount on total</label>
                                    </div>
                                </div>
                                @if ($discount_type == 0)
                                    <div class="col-md-7"></div>
                                @else
                                    <div class="col-md-2 mt-4 pt-4">
                                        @if ($discount_type == 1)
                                        @elseif($discount_type == 2)
                                            <br>
                                        @else
                                            <br>
                                            <br>
                                            <br>
                                        @endif
                                        <input type="number" step="any" class="form-control mt-2"
                                            wire:model="discount_amount" min="0"
                                            @if ($discount_type != 3) max="100" @endif>
                                    </div>

                                    <div class="col-md-5 p-0"></div>
                                @endif

                                <div class="col-md-2">
                                    <h5>ITEM</h5>
                                </div>
                                <div class="col-md-6 "></div>
                                <div class="col-md-2 d-flex justify-content-center">
                                    <h5>Selling Price</h5>
                                </div>
                                <div class="col-md-2 p-0">

                                </div>
                                <div class="col-md-2">
                                    <h5>Name</h5>
                                </div>
                                <div class="col-md-2">
                                    <h5>Variation</h5>
                                </div>
                                <div class="col-md-1">
                                    <h5>Length</h5>
                                </div>
                                <div class="col-md-2">
                                    <h5>Color</h5>
                                </div>
                                <div class="col-md-1">
                                    <h5>Quantity</h5>
                                </div>
                                <div class="col-md-1 d-flex justify-content-end">
                                    <h5 class="text-danger">Per Piece</h5>
                                </div>
                                <div class="col-md-1 ">
                                    <h5>Total</h5>
                                </div>
                                @if ($discount_type != 1)
                                    <div class="col-md-2 p-0">

                                    </div>
                                @else
                                    <div class="col-md-2 p-0">
                                        <h5>Discounted</h5>
                                    </div>
                                @endif
                                @php
                                    $total = 0;
                                    $discount_total = 0;
                                @endphp
                                @for ($x = 0; $x < $row; $x++)
                                    <div class="col-md-2">
                                        <select wire:model="product_id.{{ $x }}" class="form-control"
                                            wire:change="prod_change({{ $x }})">
                                            <option value="" selected>Select Product</option>
                                            @foreach ($products as $p)
                                                <option value="{{ $p->id }}">{{ $p->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <select wire:model="product_variation_id.{{ $x }}"
                                            class="form-control">
                                            <option value="" selected>Select Variation</option>
                                            @if (array_key_exists($x, $product_variations))
                                                @foreach ($product_variations[$x] as $v)
                                                    @php
                                                        $name = '';
                                                        if ($v->length != 0 && $v->length != null) {
                                                            $name .= $v->length . $v->length_uom;
                                                        }
                                                        if ($v->width != 0 && $v->width != null) {
                                                            if ($name != '') {
                                                                $name .= 'x' . $v->width . $v->width_uom;
                                                            } else {
                                                                $name .= $v->width . $v->width_uom;
                                                            }
                                                        }
                                                        if ($v->height != 0 && $v->height != null) {
                                                            if ($name != '') {
                                                                $name .= 'x' . $v->height . $v->height_uom;
                                                            } else {
                                                                $name .= $v->height . $v->height_uom;
                                                            }
                                                        }
                                                        if ($v->thickness != 0 && $v->thickness != null) {
                                                            if ($name != '') {
                                                                $name .= '@' . $v->thickness . $v->thickness_uom;
                                                            } else {
                                                                $name .= $v->thickness . $v->thickness_uom;
                                                            }
                                                        }
                                                    @endphp
                                                    <option value="{{ $v->id }}">{{ $name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-md-1">
                                        <input type="number" step="any" wire:model="length.{{ $x }}"
                                            class="form-control" value="0">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" wire:model="color.{{ $x }}"
                                            class="form-control">
                                    </div>
                                    <div class="col-md-1">
                                        <input type="text" wire:model="quantity.{{ $x }}"
                                            class="form-control" min="0">
                                    </div>
                                    @php
                                        $per_piece = 0;
                                    @endphp
                                    <div class="col-md-1 d-flex justify-content-end">
                                        <h5 class="text-bold">
                                            @if (array_key_exists($x, $product_selected))
                                                @if ($customer != null)
                                                    @if ($product_selected[$x] != null)
                                                        @if ($product_selected[$x]->price() != null)
                                                            @if (array_key_exists($x, $variation_selected))
                                                                @if (array_key_exists($x, $length))
                                                                    @if ($length[$x] != null)
                                                                        @if ($variation_selected[$x] != null)
                                                                            @if ($product_selected[$x]->purlin == 1)
                                                                                @if ($length[$x] === $product_selected[$x]->standard_length)
                                                                                    @if ($customer->type === 'End User')
                                                                                        @php
                                                                                            $per_piece += $product_selected[$x]->price()->end_user * $variation_selected[$x]->weight_meter * $product_selected[$x]->standard_length;
                                                                                        @endphp
                                                                                    @elseif($customer->type === 'Dealer')
                                                                                        @php
                                                                                            $per_piece += $product_selected[$x]->price()->dealer * $variation_selected[$x]->weight_meter * $product_selected[$x]->standard_length;
                                                                                        @endphp
                                                                                    @else
                                                                                        @php
                                                                                            $per_piece += $product_selected[$x]->price()->contractor * $variation_selected[$x]->weight_meter * $product_selected[$x]->standard_length;
                                                                                        @endphp
                                                                                    @endif
                                                                                @else
                                                                                    @if ($customer->type === 'End User')
                                                                                        @php
                                                                                            $per_piece += $product_selected[$x]->price()->end_user * $variation_selected[$x]->weight_meter * $length[$x];
                                                                                        @endphp
                                                                                    @elseif($customer->type === 'Dealer')
                                                                                        @php
                                                                                            $per_piece += $product_selected[$x]->price()->dealer * $variation_selected[$x]->weight_meter * $length[$x];
                                                                                        @endphp
                                                                                    @else
                                                                                        @php
                                                                                            $per_piece += $product_selected[$x]->price()->contractor * $variation_selected[$x]->weight_meter * $length[$x];
                                                                                        @endphp
                                                                                    @endif
                                                                                @endif
                                                                            @elseif($product_selected[$x]->purlin == 0 && $product_selected[$x]->length_dependent == 0)
                                                                                @if ($customer->type === 'End User')
                                                                                    @php
                                                                                        $per_piece += $product_selected[$x]->price()->end_user * $length[$x];
                                                                                    @endphp
                                                                                @elseif($customer->type === 'Dealer')
                                                                                    @php
                                                                                        $per_piece += $product_selected[$x]->price()->dealer * $length[$x];
                                                                                    @endphp
                                                                                @else
                                                                                    @php
                                                                                        $per_piece += $product_selected[$x]->price()->contractor * $length[$x];
                                                                                    @endphp
                                                                                @endif
                                                                            @elseif($product_selected[$x]->purlin == 0 && $product_selected[$x]->special_cut == 0)
                                                                                @if ($customer->type === 'End User')
                                                                                    @php
                                                                                        $per_piece += $product_selected[$x]->price()->end_user * $length[$x];
                                                                                    @endphp
                                                                                @elseif($customer->type === 'Dealer')
                                                                                    @php
                                                                                        $per_piece += $product_selected[$x]->price()->dealer * $length[$x];
                                                                                    @endphp
                                                                                @else
                                                                                    @php
                                                                                        $per_piece += $product_selected[$x]->price()->contractor * $length[$x];
                                                                                    @endphp
                                                                                @endif
                                                                            @elseif($product_selected[$x]->production_process == 0)
                                                                                @if ($customer->type === 'End User')
                                                                                    @php
                                                                                        $per_piece += $product_selected[$x]->price()->end_user;
                                                                                    @endphp
                                                                                @elseif($customer->type === 'Dealer')
                                                                                    @php
                                                                                        $per_piece += $product_selected[$x]->price()->dealer;
                                                                                    @endphp
                                                                                @else
                                                                                    @php
                                                                                        $per_piece += $product_selected[$x]->price()->contractor;
                                                                                    @endphp
                                                                                @endif
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        @endif
                                                    @endif
                                                @endif
                                            @endif
                                            {{ $per_piece }}
                                        </h5>
                                    </div>
                                    <div class="col-md-1 ">
                                        @if (array_key_exists($x, $quantity))
                                            @if ($quantity[$x] != null)
                                                @php
                                                    $this->price_piece[$x] = $per_piece;
                                                    $per_piece = $per_piece * $quantity[$x];
                                                @endphp
                                            @endif
                                        @endif
                                        <h5>  {{ $per_piece }}</h5>
                                      
                                        @php
                                            $total += $per_piece;
                                        @endphp
                                    </div>
                                    @if ($discount_type != 1)
                                        <div class="col-md-2 p-0">

                                        </div>
                                    @else
                                        <div class="col-md-2 p-0">
                                            @php
                                                $discounted_perpiece = floatval($per_piece) - floatval($per_piece) * (floatval($discount_amount) / 100);
                                                $discount_total += $discounted_perpiece;
                                            @endphp
                                            <h5>
                                                {{ $discounted_perpiece }}
                                            </h5>
                                        </div>
                                    @endif
                                @endfor

                                <div class="col-md-2">
                                    <button type="button" class="btn btn-success btn-block" wire:click="add_row">ADD
                                        ROW</button>
                                </div>
                                <div class="col-md-6"></div>
                                <div class="col-md-1 d-flex justify-content-end">
                                    <h5>TOTAL</h5>
                                </div>
                                @if ($discount_type != 1)
                                    <div class="col-md-1">
                                        <h5>{{ $total }}</h5>
                                    </div>
                                    <div class="col-md-2 p-0">

                                    </div>
                                @else
                                    <div class="col-md-1">

                                    </div>
                                    <div class="col-md-2 p-0">
                                        <h5>{{ $total }}</h5>
                                    </div>
                                @endif

                                @if ($discount_type != 0)
                                    <div class="col-md-8">
                                    </div>
                                    @if ($discount_type != 1)
                                        <div class="col-md-1  d-flex justify-content-end">
                                            <h5 for="">Discount </h5>
                                        </div>
                                        <div class="col-md-1">
                                            <h5 for="">(
                                                @if ($discount_type == 2)
                                                    @php
                                                        $discount_total = $total * ($discount_amount / 100);
                                                    @endphp
                                                @else
                                                    @php
                                                        $discount_total = $total - $discount_amount;
                                                    @endphp
                                                @endif
                                                {{ $discount_total }})
                                            </h5>
                                        </div>
                                        <div class="col-md-2 p-0">

                                        </div>
                                    @else
                                        <div class="col-md-1 d-flex justify-content-end">
                                            <h5 for="">Discount </h5>
                                        </div>
                                        <div class="col-md-1">

                                        </div>
                                        <div class="col-md-1">
                                            <h5 for=""> ( {{ $total - $discount_total }} )</h5>
                                        </div>
                                        <div class="col-md-1 p-0">

                                        </div>
                                    @endif
                                @else
                                    <div class="col-md-12 mb-4"></div>
                                @endif
                                <div class="col-md-2">
                                    <label for="">Notes: </label>
                                </div>
                                <div class="col-md-6">
                                </div>
                                @if ($discount_type != 1)
                                    <div class="col-md-1  d-flex justify-content-end">
                                        <h6 for="">Grand Total </h6>
                                    </div>
                                    <div class="col-md-1">
                                        <h5 for="">{{ $total - $discount_total }} </h5>
                                    </div>
                                    <div class="col-md-2 p-0">

                                    </div>
                                @else
                                    <div class="col-md-1  d-flex justify-content-end">
                                        <h6 for="">Grand Total </h6>
                                    </div>
                                    <div class="col-md-1">

                                    </div>
                                    <div class="col-md-1">
                                        <h5 for="">{{ $total - ($total - $discount_total) }}</h5>
                                    </div>
                                    <div class="col-md-1 p-0">

                                    </div>
                                @endif

                                <div class="col-md-4">
                                    <textarea wire:model="notes" class="form-control" rows="2"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                            <button type="submit" class="btn btn-success">ADD INQUIRY</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <table class="table" id="inquiries">
        <thead class="thead-dark">
            <tr>
                <th>DATE</th>
                <th>CUSTOMER</th>
                <th>SALES OFFICER</th>
                <th>STATUS</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($inquiries as $i)
                <tr>
                    <td>{{ date('M d, Y', strtotime($i->created_at)) }}</td>
                    <td>{{ $i->customer->fullname() }}</td>
                    <td>{{ $i->user->fullname() }}</td>
                    <td>
                        @if ($i->status == 1)
                            Inquiry
                        @elseif($i->status == 2)
                            For Payment
                        @elseif($i->status == 3)
                            Partially Paid
                        @elseif($i->status == 4)
                            Production Pending
                        @elseif($i->status == 5)
                            Partially Produced
                        @else
                            Production Done
                        @endif
                    </td>
                    <td>
                        @if (auth()->user()->user->department === 'Sales' && $i->status == 1)
                            <button class="btn " style="background-color: #476839;"
                                wire:click="edit_inquiry({{ $i->id }})" data-toggle="tooltip"
                                data-placement="top" title="Edit "><i class="nc-icon nc-tag-content"></i> </button>
                        @endif
                        <button class="btn "
                            style="background-color: #2c4b74;"wire:click="view_inquiry({{ $i->id }})"
                            data-toggle="tooltip" data-placement="top" title="View "><i
                                class="nc-icon nc-glasses-2"></i> </button>
                        <a href="{{ route('download_pdf', $i->id) }}"> <button class="btn "
                                style="background-color: #4a575c;" data-toggle="tooltip" data-placement="top"
                                title="Download Quotation"><i class="nc-icon nc-single-copy-04"></i> </button></a>

                        <button class="btn "
                            style="background-color: #64202c;"wire:click="view_inquiry({{ $i->id }})"
                            data-toggle="tooltip" data-placement="top" title="Send Quotation to Customer Email"><i
                                class="nc-icon nc-email-85"></i> </button>

                        @if (auth()->user()->user->department === 'Sales' && $i->status == 1)
                            <button class="btn "
                                style="background-color: #19310f;"wire:click="payment({{ $i->id }})"
                                data-toggle="tooltip" data-placement="top" title="Send for Payment Confirmation"><i
                                    class="nc-icon nc-button-play"></i> </button>
                        @endif
                        @if (auth()->user()->user->department === 'Accounting' && ($i->status == 2 || $i->status == 3))
                            <button class="btn "
                                style="background-color: #757a72;"wire:click="confirm({{ $i->id }})"
                                data-toggle="tooltip" data-placement="top" title="Confirm Payment "><i
                                    class="nc-icon nc-bank"></i> </button>
                        @endif
                        @if ($i->status == 3 || $i->status == 4)
                            <a href="{{ route('sales_pdf', $i->id) }}"> <button class="btn "
                                    style="background-color: #af6a49;" data-toggle="tooltip" data-placement="top"
                                    title="Print Sales Confirmation"><i class="nc-icon nc-paper"></i> </button></a>
                        @endif
                        @if ($i->status == 4)
                            <a href="{{ route('jopdf', $i->id) }}">
                                <button class="btn " style="background-color: #0e8b62;" data-toggle="tooltip"
                                    data-placement="top" title="Download Job Order"><i
                                        class="nc-icon nc-settings"></i>
                                </button></a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div id="inquiries"></div>
    @if ($inquiry != null)
        <div wire:ignore.self class="modal fade" id="edit_inquiry" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document" style="max-width:80%">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">EDIT INQUIRY</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form wire:submit.prevent="edit">

                        @csrf
                        <div class="modal-body">
                            @csrf
                            <div style="height: 800px; overflow-y: auto;  overflow-x: hidden; ">
                                @if ($message != '')
                                    <h5 class="bg-success">{{ $message }}</h5>
                                @endif
                                <div class="row">
                                    <div class="col-md-2">
                                        <h5>Customer Name</h5>
                                    </div>
                                    <div class="col-md-3">
                                        @if ($customer != null)
                                            {{ $customer->fullname() }}
                                        @endif
                                    </div>
                                    <div class="col-md-7 p-0"></div>
                                    <div class="col-md-2">
                                        <h5>Type of Customer</h5>
                                    </div>
                                    <div class="col-md-3">
                                        @if ($customer != null)
                                            {{ $customer->type }}
                                        @endif
                                    </div>
                                    <div class="col-md-7 p-0"></div>
                                    <div class="col-md-2">
                                        <h5>Branch</h5>
                                    </div>
                                    <div class="col-md-3">
                                        <select wire:model="branch_id" class="form-control" required>
                                            <option value="">Select Branch</option>
                                            @foreach ($branches as $b)
                                                <option value="{{ $b->id }}">{{ $b->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-7 p-0"></div>
                                    <div class="col-md-2">
                                        <h5>Purpose</h5>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" wire:model="purpose" class="form-control">
                                    </div>
                                    <div class="col-md-7 p-0"></div>
                                    <div class="col-md-2">
                                        <h5>Discount</h5>
                                        <div class="d-flex justify-content-center">
                                            <input type="radio" wire:model="discount_type" value="0"
                                                class=" mb-3" wire:click="discount">
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <input type="radio" wire:model="discount_type" value="1"
                                                class=" mb-3" wire:click="discount">
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <input type="radio" wire:model="discount_type" value="2"
                                                class=" mb-3" wire:click="discount">
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <input type="radio" wire:model="discount_type" value="3"
                                                class=" mb-3" wire:click="discount">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <br>
                                        <div class="pt-2">
                                            <label>NO DISCOUNT</label>
                                            <br>
                                            <label>Less % per item</label>
                                            <label>Less % on overall total</label>
                                            <label>Less specific amount on total</label>
                                        </div>
                                    </div>
                                    @if ($discount_type == 0)
                                        <div class="col-md-7"></div>
                                    @else
                                        <div class="col-md-2 mt-4 pt-4">
                                            @if ($discount_type == 1)
                                            @elseif($discount_type == 2)
                                                <br>
                                            @else
                                                <br>
                                                <br>
                                                <br>
                                            @endif
                                            <input type="number" step="any" class="form-control mt-2"
                                                wire:model="discount_amount" min="0"
                                                @if ($discount_type != 3) max="100" @endif>
                                        </div>

                                        <div class="col-md-5 p-0"></div>
                                    @endif

                                    <div class="col-md-2">
                                        <h5>ITEM</h5>
                                    </div>
                                    <div class="col-md-6 "></div>
                                    <div class="col-md-2 d-flex justify-content-center">
                                        <h5>Selling Price</h5>
                                    </div>
                                    <div class="col-md-2 p-0">

                                    </div>
                                    <div class="col-md-2">
                                        <h5>Name</h5>
                                    </div>
                                    <div class="col-md-2">
                                        <h5>Variation</h5>
                                    </div>
                                    <div class="col-md-1">
                                        <h5>Length</h5>
                                    </div>
                                    <div class="col-md-2">
                                        <h5>Color</h5>
                                    </div>
                                    <div class="col-md-1">
                                        <h5>Quantity</h5>
                                    </div>
                                    <div class="col-md-1 d-flex justify-content-end">
                                        <h5 class="text-danger">Per Piece</h5>
                                    </div>
                                    <div class="col-md-1 ">
                                        <h5>Total</h5>
                                    </div>
                                    @if ($discount_type != 1)
                                        <div class="col-md-1 p-0">
                                            <h5>Action</h5>
                                        </div>
                                        <div class="col-md-1 p-0">

                                        </div>
                                    @else
                                        <div class="col-md-1 p-0">
                                            <h5>Discounted</h5>
                                        </div>
                                        <div class="col-md-1 p-0">
                                            <h5>Action</h5>
                                        </div>
                                    @endif

                                    @php
                                        $total = 0;
                                        $discount_total = 0;
                                    @endphp
                                    @for ($x = 0; $x < $row; $x++)
                                        <div class="col-md-2">
                                            <select wire:model="product_id.{{ $x }}" class="form-control"
                                                wire:change="prod_change({{ $x }})">
                                                <option value="" selected>Select Product</option>
                                                @foreach ($products as $p)
                                                    <option value="{{ $p->id }}">{{ $p->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <select wire:model="product_variation_id.{{ $x }}"
                                                class="form-control">
                                                <option value="" selected>Select Variation</option>
                                                @if (array_key_exists($x, $product_variations))
                                                    @foreach ($product_variations[$x] as $v)
                                                        <option value="{{ $v->id }}">{{ $v->variation() }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="number" step="any"
                                                wire:model="length.{{ $x }}" class="form-control"
                                                value="0">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" wire:model="color.{{ $x }}"
                                                class="form-control">
                                        </div>
                                        <div class="col-md-1">
                                            <input type="text" wire:model="quantity.{{ $x }}"
                                                class="form-control" min="0">
                                        </div>
                                        @php
                                            $per_piece = 0;
                                        @endphp
                                        <div class="col-md-1 d-flex justify-content-end">
                                            <h5 class="text-bold">
                                                @if (array_key_exists($x, $product_selected))
                                                    @if ($customer != null)
                                                        @if ($product_selected[$x] != null)
                                                            @if ($product_selected[$x]->price() != null)
                                                                @if (array_key_exists($x, $variation_selected))
                                                                    @if (array_key_exists($x, $length))
                                                                        @if ($length[$x] != null)
                                                                            @if ($variation_selected[$x] != null)
                                                                                @if ($product_selected[$x]->purlin == 1)
                                                                                    @if ($length[$x] === $product_selected[$x]->standard_length)
                                                                                        @if ($customer->type === 'End User')
                                                                                            @php
                                                                                                $per_piece += $product_selected[$x]->price()->end_user * $variation_selected[$x]->weight_meter * $product_selected[$x]->standard_length;
                                                                                            @endphp
                                                                                        @elseif($customer->type === 'Dealer')
                                                                                            @php
                                                                                                $per_piece += $product_selected[$x]->price()->dealer * $variation_selected[$x]->weight_meter * $product_selected[$x]->standard_length;
                                                                                            @endphp
                                                                                        @else
                                                                                            @php
                                                                                                $per_piece += $product_selected[$x]->price()->contractor * $variation_selected[$x]->weight_meter * $product_selected[$x]->standard_length;
                                                                                            @endphp
                                                                                        @endif
                                                                                    @else
                                                                                        @if ($customer->type === 'End User')
                                                                                            @php
                                                                                                $per_piece += $product_selected[$x]->price()->end_user * $variation_selected[$x]->weight_meter * $length[$x];
                                                                                            @endphp
                                                                                        @elseif($customer->type === 'Dealer')
                                                                                            @php
                                                                                                $per_piece += $product_selected[$x]->price()->dealer * $variation_selected[$x]->weight_meter * $length[$x];
                                                                                            @endphp
                                                                                        @else
                                                                                            @php
                                                                                                $per_piece += $product_selected[$x]->price()->contractor * $variation_selected[$x]->weight_meter * $length[$x];
                                                                                            @endphp
                                                                                        @endif
                                                                                    @endif
                                                                                @elseif($product_selected[$x]->purlin == 0 && $product_selected[$x]->length_dependent == 0)
                                                                                    @if ($customer->type === 'End User')
                                                                                        @php
                                                                                            $per_piece += $product_selected[$x]->price()->end_user * $length[$x];
                                                                                        @endphp
                                                                                    @elseif($customer->type === 'Dealer')
                                                                                        @php
                                                                                            $per_piece += $product_selected[$x]->price()->dealer * $length[$x];
                                                                                        @endphp
                                                                                    @else
                                                                                        @php
                                                                                            $per_piece += $product_selected[$x]->price()->contractor * $length[$x];
                                                                                        @endphp
                                                                                    @endif
                                                                                @elseif($product_selected[$x]->purlin == 0 && $product_selected[$x]->special_cut == 0)
                                                                                    @if ($customer->type === 'End User')
                                                                                        @php
                                                                                            $per_piece += $product_selected[$x]->price()->end_user * $length[$x];
                                                                                        @endphp
                                                                                    @elseif($customer->type === 'Dealer')
                                                                                        @php
                                                                                            $per_piece += $product_selected[$x]->price()->dealer * $length[$x];
                                                                                        @endphp
                                                                                    @else
                                                                                        @php
                                                                                            $per_piece += $product_selected[$x]->price()->contractor * $length[$x];
                                                                                        @endphp
                                                                                    @endif
                                                                                @elseif($product_selected[$x]->production_process == 0)
                                                                                    @if ($customer->type === 'End User')
                                                                                        @php
                                                                                            $per_piece += $product_selected[$x]->price()->end_user;
                                                                                        @endphp
                                                                                    @elseif($customer->type === 'Dealer')
                                                                                        @php
                                                                                            $per_piece += $product_selected[$x]->price()->dealer;
                                                                                        @endphp
                                                                                    @else
                                                                                        @php
                                                                                            $per_piece += $product_selected[$x]->price()->contractor;
                                                                                        @endphp
                                                                                    @endif
                                                                                @endif
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        @endif
                                                    @endif
                                                @endif
                                                {{ $per_piece }}
                                            </h5>
                                        </div>
                                        <div class="col-md-1 ">
                                            @if (array_key_exists($x, $quantity))
                                                @if ($quantity[$x] != null)
                                                    @php
                                                        $this->price_piece[$x] = $per_piece;
                                                        $per_piece = $per_piece * $quantity[$x];
                                                    @endphp
                                                @endif
                                            @endif
                                            {{ $per_piece }}
                                            @php
                                                $total += $per_piece;
                                            @endphp
                                        </div>
                                        @if ($discount_type != 1)
                                            <div class="col-md-1 p-0">
                                                @if (array_key_exists($x, $inquiry_product_id))
                                                    <button type="button" class="btn btn-danger mt-0 "
                                                        wire:click="delete_product({{ $inquiry_product_id[$x] }})">-</button>
                                                @endif
                                            </div>
                                            <div class="col-md-1 p-0">

                                            </div>
                                        @else
                                            <div class="col-md-1 p-0">
                                                @php
                                                    $discounted_perpiece = floatval($per_piece) - floatval($per_piece) * (floatval($discount_amount) / 100);
                                                    $discount_total += $discounted_perpiece;
                                                @endphp
                                                <h5>
                                                    {{ $discounted_perpiece }}
                                                </h5>
                                            </div>
                                            <div class="col-md-1 p-0 m-0">

                                                @if (array_key_exists($x, $inquiry_product_id))
                                                    <button type="button" class="btn btn-danger mt-0 "
                                                        wire:click="delete_product({{ $inquiry_product_id[$x] }})">-</button>
                                                @endif
                                            </div>
                                        @endif

                                    @endfor
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-success btn-block"
                                            wire:click="add_row">ADD
                                            ROW</button>
                                    </div>
                                    <div class="col-md-6"></div>
                                    <div class="col-md-1 d-flex justify-content-end">
                                        <h5>TOTAL</h5>
                                    </div>
                                    @if ($discount_type != 1)
                                        <div class="col-md-1">
                                            <h5>{{ $total }}</h5>
                                        </div>
                                        <div class="col-md-2 p-0">

                                        </div>
                                    @else
                                        <div class="col-md-1">

                                        </div>
                                        <div class="col-md-2 p-0">
                                            <h5>{{ $total }}</h5>
                                        </div>
                                    @endif

                                    @if ($discount_type != 0)
                                        <div class="col-md-8">
                                        </div>
                                        @if ($discount_type != 1)
                                            <div class="col-md-1  d-flex justify-content-end">
                                                <h5 for="">Discount </h5>
                                            </div>
                                            <div class="col-md-1">
                                                <h5 for="">(
                                                    @if ($discount_type == 2)
                                                        @php
                                                            $discount_total = $total * ($discount_amount / 100);
                                                        @endphp
                                                    @else
                                                        @php
                                                            $discount_total = $total - $discount_amount;
                                                        @endphp
                                                    @endif
                                                    {{ $discount_total }})
                                                </h5>
                                            </div>
                                            <div class="col-md-2 p-0">

                                            </div>
                                        @else
                                            <div class="col-md-1 d-flex justify-content-end">
                                                <h5 for="">Discount </h5>
                                            </div>
                                            <div class="col-md-1">

                                            </div>
                                            <div class="col-md-1">
                                                <h5 for=""> ( {{ $total - $discount_total }} )</h5>
                                            </div>
                                            <div class="col-md-1 p-0">

                                            </div>
                                        @endif
                                    @else
                                        <div class="col-md-12 mb-4"></div>
                                    @endif
                                    <div class="col-md-2">
                                        <label for="">Notes: </label>
                                    </div>
                                    <div class="col-md-6">
                                    </div>
                                    @if ($discount_type != 1)
                                        <div class="col-md-1  d-flex justify-content-end">
                                            <h6 for="">Grand Total </h6>
                                        </div>
                                        <div class="col-md-1">
                                            <h5 for="">{{ $total - $discount_total }} </h5>
                                        </div>
                                        <div class="col-md-2 p-0">

                                        </div>
                                    @else
                                        <div class="col-md-1  d-flex justify-content-end">
                                            <h6 for="">Grand Total </h6>
                                        </div>
                                        <div class="col-md-1">

                                        </div>
                                        <div class="col-md-1">
                                            <h5 for="">{{ $total - ($total - $discount_total) }}</h5>
                                        </div>
                                        <div class="col-md-1 p-0">

                                        </div>
                                    @endif

                                    <div class="col-md-4">
                                        <textarea wire:model="notes" class="form-control" rows="2"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                                <button type="submit" class="btn btn-success">EDIT INQUIRY</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div wire:ignore.self class="modal fade" id="delete_product" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered " role="document" style="max-width: 50%">
                <div class="modal-content bg-warning">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">VIEW INQUIRY</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        @csrf
                        @if ($inquiry_product != null)
                            <h4 class="text-bold "
                                style="font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif"> Are
                                you sure you want to delete product inquiry
                                {{ $inquiry_product->product->name }}
                                --
                                {{ $inquiry_product->product_variation->variation() }} ?</h4>
                        @endif
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                wire:click="close_delete()">CLOSE</button>
                            <button wire:click="delete" class="btn btn-danger">DELETE PRODUCT INQUIRY</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div wire:ignore.self class="modal fade" id="view_inquiry" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog " role="document" style="max-width:80%">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">VIEW INQUIRY</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        @if ($type === 'View')
                            <div style="height: 800px; overflow-y: auto;  overflow-x: hidden;  %">
                                @if ($message != '')
                                    <h5 class="bg-success">{{ $message }}</h5>
                                @endif
                                <div class="row">
                                    <div class="col-md-2">
                                        <h5>Customer Name</h5>
                                    </div>
                                    <div class="col-md-3">
                                        @if ($customer != null)
                                            {{ $customer->fullname() }}
                                        @endif
                                    </div>
                                    <div class="col-md-7 p-0"></div>
                                    <div class="col-md-2">
                                        <h5>Type of Customer</h5>
                                    </div>
                                    <div class="col-md-3">
                                        @if ($customer != null)
                                            {{ $customer->type }}
                                        @endif
                                    </div>
                                    <div class="col-md-7 p-0"></div>
                                    <div class="col-md-2">
                                        <h5>Branch</h5>
                                    </div>
                                    <div class="col-md-3">
                                        {{ $inquiry->branch->name }}
                                    </div>
                                    <div class="col-md-7 p-0"></div>
                                    <div class="col-md-2">
                                        <h5>Purpose</h5>
                                    </div>
                                    <div class="col-md-3">
                                        <h5>{{ $purpose }}</h5>
                                    </div>
                                    <div class="col-md-7 p-0"></div>
                                    <div class="col-md-2">
                                        <h5>Discount</h5>
                                    </div>
                                    <div class="col-md-2">
                                        <h5>
                                            @if ($discount_type == 0)
                                                NO DISCOUNT
                                            @elseif($discount_type == 1)
                                                Less % per item
                                            @elseif($discount_type == 2)
                                                Less % on overall total
                                            @elseif($discount_type == 3)
                                                Less specific amount on total
                                            @endif
                                        </h5>
                                    </div>
                                    @if ($discount_type == 0)
                                        <div class="col-md-7"></div>
                                    @else
                                        <div class="col-md-2">
                                            <h5>
                                                @if ($discount_type != 3)
                                                    {{ $discount_amount }}%
                                                @else
                                                    PHP {{ $discount_amount }}
                                                @endif
                                            </h5>
                                        </div>
                                        <div class="col-md-5 p-0"></div>
                                    @endif
                                    <div class="col-md-2">
                                        <h5>ITEM</h5>
                                    </div>
                                    <div class="col-md-6 "></div>
                                    <div class="col-md-2 d-flex justify-content-center">
                                        <h5>Selling Price</h5>
                                    </div>
                                    <div class="col-md-2 p-0">

                                    </div>
                                    <div class="col-md-2">
                                        <h5>Name</h5>
                                    </div>
                                    <div class="col-md-2">
                                        <h5>Variation</h5>
                                    </div>
                                    <div class="col-md-1">
                                        <h5>Length</h5>
                                    </div>
                                    <div class="col-md-2">
                                        <h5>Color</h5>
                                    </div>
                                    <div class="col-md-1">
                                        <h5>Quantity</h5>
                                    </div>
                                    <div class="col-md-1 d-flex justify-content-end">
                                        <h5 class="text-danger">Per Piece</h5>
                                    </div>
                                    <div class="col-md-1 ">
                                        <h5>Total</h5>
                                    </div>
                                    @if ($discount_type != 1)
                                        <div class="col-md-2 p-0">

                                        </div>
                                    @else
                                        <div class="col-md-2 p-0">
                                            <h5>Discounted</h5>
                                        </div>
                                    @endif

                                    @php
                                        $total = 0;
                                        $discount_total = 0;
                                    @endphp
                                    @for ($x = 0; $x < $row; $x++)
                                        <div class="col-md-2">
                                            <h5>{{ $product_selected[$x]->name }}</h5>
                                        </div>
                                        <div class="col-md-2">
                                            <h5>{{ $variation_selected[$x]->variation() }}</h5>
                                        </div>
                                        <div class="col-md-1">
                                            <h5>{{ $length[$x] }}</h5>
                                        </div>
                                        <div class="col-md-2">
                                            <h5>{{ $color[$x] }}</h5>
                                        </div>
                                        <div class="col-md-1">
                                            <h5>{{ $quantity[$x] }}</h5>
                                        </div>
                                        @php
                                            $per_piece = 0;
                                        @endphp
                                        <div class="col-md-1 d-flex justify-content-end">
                                            <h5 class="text-bold">
                                                @if ($product_selected[$x]->purlin == 1)
                                                    @if ($length[$x] === $product_selected[$x]->standard_length)
                                                        @if ($customer->type === 'End User')
                                                            @php
                                                                $per_piece += $product_selected[$x]->price()->end_user * $variation_selected[$x]->weight_meter * $product_selected[$x]->standard_length;
                                                            @endphp
                                                        @elseif($customer->type === 'Dealer')
                                                            @php
                                                                $per_piece += $product_selected[$x]->price()->dealer * $variation_selected[$x]->weight_meter * $product_selected[$x]->standard_length;
                                                            @endphp
                                                        @else
                                                            @php
                                                                $per_piece += $product_selected[$x]->price()->contractor * $variation_selected[$x]->weight_meter * $product_selected[$x]->standard_length;
                                                            @endphp
                                                        @endif
                                                    @else
                                                        @if ($customer->type === 'End User')
                                                            @php
                                                                $per_piece += $product_selected[$x]->price()->end_user * $variation_selected[$x]->weight_meter * $length[$x];
                                                            @endphp
                                                        @elseif($customer->type === 'Dealer')
                                                            @php
                                                                $per_piece += $product_selected[$x]->price()->dealer * $variation_selected[$x]->weight_meter * $length[$x];
                                                            @endphp
                                                        @else
                                                            @php
                                                                $per_piece += $product_selected[$x]->price()->contractor * $variation_selected[$x]->weight_meter * $length[$x];
                                                            @endphp
                                                        @endif
                                                    @endif
                                                @elseif($product_selected[$x]->purlin == 0 && $product_selected[$x]->length_dependent == 0)
                                                    @if ($customer->type === 'End User')
                                                        @php
                                                            $per_piece += $product_selected[$x]->price()->end_user * $length[$x];
                                                        @endphp
                                                    @elseif($customer->type === 'Dealer')
                                                        @php
                                                            $per_piece += $product_selected[$x]->price()->dealer * $length[$x];
                                                        @endphp
                                                    @else
                                                        @php
                                                            $per_piece += $product_selected[$x]->price()->contractor * $length[$x];
                                                        @endphp
                                                    @endif
                                                @elseif($product_selected[$x]->purlin == 0 && $product_selected[$x]->special_cut == 0)
                                                    @if ($customer->type === 'End User')
                                                        @php
                                                            $per_piece += $product_selected[$x]->price()->end_user * $length[$x];
                                                        @endphp
                                                    @elseif($customer->type === 'Dealer')
                                                        @php
                                                            $per_piece += $product_selected[$x]->price()->dealer * $length[$x];
                                                        @endphp
                                                    @else
                                                        @php
                                                            $per_piece += $product_selected[$x]->price()->contractor * $length[$x];
                                                        @endphp
                                                    @endif
                                                @elseif($product_selected[$x]->production_process == 0)
                                                    @if ($customer->type === 'End User')
                                                        @php
                                                            $per_piece += $product_selected[$x]->price()->end_user;
                                                        @endphp
                                                    @elseif($customer->type === 'Dealer')
                                                        @php
                                                            $per_piece += $product_selected[$x]->price()->dealer;
                                                        @endphp
                                                    @else
                                                        @php
                                                            $per_piece += $product_selected[$x]->price()->contractor;
                                                        @endphp
                                                    @endif
                                                @endif
                                                {{ $per_piece }}
                                            </h5>
                                        </div>
                                        <div class="col-md-1 ">
                                            @if (array_key_exists($x, $quantity))
                                                @if ($quantity[$x] != null)
                                                    @php
                                                        $this->price_piece[$x] = $per_piece;
                                                        $per_piece = $per_piece * $quantity[$x];
                                                    @endphp
                                                @endif
                                            @endif
                                            <h5> {{ $per_piece }}</h5>

                                            @php
                                                $total += $per_piece;
                                            @endphp
                                        </div>
                                        @if ($discount_type != 1)
                                            <div class="col-md-2 p-0"></div>
                                        @else
                                            <div class="col-md-2 p-0">
                                                @php
                                                    $discounted_perpiece = floatval($per_piece) - floatval($per_piece) * (floatval($discount_amount) / 100);
                                                    $discount_total += $discounted_perpiece;
                                                @endphp
                                                <h5>
                                                    {{ $discounted_perpiece }}
                                                </h5>
                                            </div>
                                        @endif
                                    @endfor
                                    <br>
                                    <br>
                                    <br>
                                    <div class="col-md-2">

                                    </div>
                                    <div class="col-md-6"></div>
                                    <div class="col-md-1 d-flex justify-content-end">
                                        <h5>TOTAL</h5>
                                    </div>
                                    @if ($discount_type != 1)
                                        <div class="col-md-1">
                                            <h5>{{ $total }}</h5>
                                        </div>
                                        <div class="col-md-2 p-0">

                                        </div>
                                    @else
                                        <div class="col-md-1">

                                        </div>
                                        <div class="col-md-2 p-0">
                                            <h5>{{ $total }}</h5>
                                        </div>
                                    @endif
                                    @if ($discount_type != 0)
                                        <div class="col-md-8">
                                        </div>
                                        @if ($discount_type != 1)
                                            <div class="col-md-1  d-flex justify-content-end">
                                                <h5 for="">Discount </h5>
                                            </div>
                                            <div class="col-md-1">
                                                <h5 for="">(
                                                    @if ($discount_type == 2)
                                                        @php
                                                            $discount_total = $total * ($discount_amount / 100);
                                                        @endphp
                                                    @else
                                                        @php
                                                            $discount_total = $total - $discount_amount;
                                                        @endphp
                                                    @endif
                                                    {{ $discount_total }})
                                                </h5>
                                            </div>
                                            <div class="col-md-2 p-0">

                                            </div>
                                        @else
                                            <div class="col-md-1 d-flex justify-content-end">
                                                <h5 for="">Discount </h5>
                                            </div>
                                            <div class="col-md-1">

                                            </div>
                                            <div class="col-md-1  p-0">
                                                <h5 for=""> ( {{ $total - $discount_total }} )</h5>
                                            </div>
                                            <div class="col-md-1  p-0">

                                            </div>
                                        @endif
                                    @else
                                        <div class="col-md-12 mb-4"></div>
                                    @endif
                                    <div class="col-md-2">
                                        <label for="">Notes: </label>
                                    </div>
                                    <div class="col-md-6">
                                    </div>
                                    @if ($discount_type != 1)
                                        <div class="col-md-1  d-flex justify-content-end">
                                            <h6 for="">Grand Total </h6>
                                        </div>
                                        <div class="col-md-1">
                                            <h5 for="">{{ $total - $discount_total }} </h5>
                                        </div>
                                        <div class="col-md-2 p-0">

                                        </div>
                                    @else
                                        <div class="col-md-1  d-flex justify-content-end">
                                            <h6 for="">Grand Total </h6>
                                        </div>
                                        <div class="col-md-1">

                                        </div>
                                        <div class="col-md-1  p-0">
                                            <h5 for="">{{ $total - ($total - $discount_total) }}</h5>
                                        </div>
                                        <div class="col-md-1 p-0">

                                        </div>
                                    @endif

                                    <div class="col-md-4">
                                        <h5>{{ $notes }}</h5>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div wire:ignore.self class="modal fade" id="payment" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog " role="document" style="max-width:80%">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">SEND INQUIRY FOR CONFIRMATION</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form wire:submit.prevent="payment_send">
                        <div class="modal-body">
                            @csrf
                            @if ($type === 'Payment')
                                <div style="height: 800px; overflow-y: auto;  overflow-x: hidden; ">
                                    <h2>The following items will be forwarded to Accounting for payment confirmation
                                    </h2>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <h5>Name:</h5>
                                        </div>
                                        <div class="col-md-3">
                                            @if ($customer != null)
                                                {{ $customer->fullname() }}
                                            @endif
                                        </div>
                                        <div class="col-md-7 p-0"></div>

                                        <div class="col-md-2">
                                            <h5>Discount:</h5>
                                        </div>
                                        <div class="col-md-3">
                                            <h5>
                                                @if ($discount_type == 0)
                                                    NO DISCOUNT
                                                @elseif($discount_type == 1)
                                                    {{ $discount_amount }}% per item
                                                @elseif($discount_type == 2)
                                                    {{ $discount_amount }}% on overall total
                                                @elseif($discount_type == 3)
                                                    Less {{ $discount_amount }} on total
                                                @endif
                                            </h5>
                                        </div>

                                        <div class="col-md-7"></div>
                                        <br>
                                        <br>
                                        <br>
                                        <div class="col-md-9" style="text-align: center">
                                            <h5>ITEM</h5>
                                        </div>
                                        <div class="col-md-1" style="text-align: right">
                                            <h5>PRICE</h5>
                                        </div>
                                        <div class="col-md-1" style="text-align: right">
                                            <h5>TOTAL</h5>
                                        </div>
                                        <div class="col-md-1 p-0" style="text-align: left">
                                            @if ($discount_type === 1)
                                                <h5>Discount</h5>
                                            @endif
                                        </div>
                                        @php
                                            $total = 0;
                                            $discount_total = 0;
                                        @endphp
                                        @for ($x = 0; $x < $row; $x++)
                                            <div class="col-md-1">
                                                <h5>{{ $quantity[$x] }} pcs</h5>
                                            </div>
                                            <div class="col-md-2">
                                                <h5>{{ $product_selected[$x]->name }}</h5>
                                            </div>
                                            <div class="col-md-2">
                                                <h5>{{ $variation_selected[$x]->variation() }}</h5>
                                            </div>
                                            <div class="col-md-1">
                                                @if ($length[$x] != 0 && $length[$x] != null)
                                                    <h5>x</h5>
                                                @endif

                                            </div>
                                            <div class="col-md-1">
                                                @if ($length[$x] != 0 && $length[$x] != null)
                                                    <h5>{{ $length[$x] }} M</h5>
                                                @endif
                                            </div>
                                            <div class="col-md-2">
                                                <h5>{{ $color[$x] }}</h5>
                                            </div>
                                            @php
                                                $per_piece = 0;
                                            @endphp
                                            <div class="col-md-1 d-flex justify-content-end">
                                                <h5 class="text-bold">
                                                    @if ($product_selected[$x]->purlin == 1)
                                                        @if ($length[$x] === $product_selected[$x]->standard_length)
                                                            @if ($customer->type === 'End User')
                                                                @php
                                                                    $per_piece += $product_selected[$x]->price()->end_user * $variation_selected[$x]->weight_meter * $product_selected[$x]->standard_length;
                                                                @endphp
                                                            @elseif($customer->type === 'Dealer')
                                                                @php
                                                                    $per_piece += $product_selected[$x]->price()->dealer * $variation_selected[$x]->weight_meter * $product_selected[$x]->standard_length;
                                                                @endphp
                                                            @else
                                                                @php
                                                                    $per_piece += $product_selected[$x]->price()->contractor * $variation_selected[$x]->weight_meter * $product_selected[$x]->standard_length;
                                                                @endphp
                                                            @endif
                                                        @else
                                                            @if ($customer->type === 'End User')
                                                                @php
                                                                    $per_piece += $product_selected[$x]->price()->end_user * $variation_selected[$x]->weight_meter * $length[$x];
                                                                @endphp
                                                            @elseif($customer->type === 'Dealer')
                                                                @php
                                                                    $per_piece += $product_selected[$x]->price()->dealer * $variation_selected[$x]->weight_meter * $length[$x];
                                                                @endphp
                                                            @else
                                                                @php
                                                                    $per_piece += $product_selected[$x]->price()->contractor * $variation_selected[$x]->weight_meter * $length[$x];
                                                                @endphp
                                                            @endif
                                                        @endif
                                                    @elseif($product_selected[$x]->purlin == 0 && $product_selected[$x]->length_dependent == 0)
                                                        @if ($customer->type === 'End User')
                                                            @php
                                                                $per_piece += $product_selected[$x]->price()->end_user * $length[$x];
                                                            @endphp
                                                        @elseif($customer->type === 'Dealer')
                                                            @php
                                                                $per_piece += $product_selected[$x]->price()->dealer * $length[$x];
                                                            @endphp
                                                        @else
                                                            @php
                                                                $per_piece += $product_selected[$x]->price()->contractor * $length[$x];
                                                            @endphp
                                                        @endif
                                                    @elseif($product_selected[$x]->purlin == 0 && $product_selected[$x]->special_cut == 0)
                                                        @if ($customer->type === 'End User')
                                                            @php
                                                                $per_piece += $product_selected[$x]->price()->end_user * $length[$x];
                                                            @endphp
                                                        @elseif($customer->type === 'Dealer')
                                                            @php
                                                                $per_piece += $product_selected[$x]->price()->dealer * $length[$x];
                                                            @endphp
                                                        @else
                                                            @php
                                                                $per_piece += $product_selected[$x]->price()->contractor * $length[$x];
                                                            @endphp
                                                        @endif
                                                    @elseif($product_selected[$x]->production_process == 0)
                                                        @if ($customer->type === 'End User')
                                                            @php
                                                                $per_piece += $product_selected[$x]->price()->end_user;
                                                            @endphp
                                                        @elseif($customer->type === 'Dealer')
                                                            @php
                                                                $per_piece += $product_selected[$x]->price()->dealer;
                                                            @endphp
                                                        @else
                                                            @php
                                                                $per_piece += $product_selected[$x]->price()->contractor;
                                                            @endphp
                                                        @endif
                                                    @endif
                                                    {{ $per_piece }}
                                                </h5>
                                            </div>
                                            <div class="col-md-1 " style="text-align: right">
                                                @if (array_key_exists($x, $quantity))
                                                    @if ($quantity[$x] != null)
                                                        @php
                                                            $this->price_piece[$x] = $per_piece;
                                                            $per_piece = $per_piece * $quantity[$x];
                                                        @endphp
                                                    @endif
                                                @endif
                                                <h5> {{ $per_piece }}</h5>

                                                @php
                                                    $total += $per_piece;
                                                @endphp
                                            </div>
                                            @if ($discount_type != 1)
                                                <div class="col-md-1 p-0"></div>
                                            @else
                                                <div class="col-md-1 p-0" style="text-align: left">
                                                    @php
                                                        $discounted_perpiece = floatval($per_piece) - floatval($per_piece) * (floatval($discount_amount) / 100);
                                                        $discount_total += $discounted_perpiece;
                                                    @endphp
                                                    <h5>
                                                        {{ $discounted_perpiece }}
                                                    </h5>
                                                </div>
                                            @endif
                                        @endfor
                                        <br>
                                        <br>
                                        <br>
                                        <div class="col-md-9"></div>
                                        <div class="col-md-1 d-flex justify-content-end">
                                            <h5>TOTAL</h5>
                                        </div>
                                        @if ($discount_type != 1)
                                            <div class="col-md-1" style="text-align: right">
                                                <h5>{{ $total }}</h5>
                                            </div>
                                            <div class="col-md-1 p-0">

                                            </div>
                                        @else
                                            <div class="col-md-1">

                                            </div>
                                            <div class="col-md-1 p-0" style="text-align: left">
                                                <h5>{{ $total }}</h5>
                                            </div>
                                        @endif
                                        @if ($discount_type != 0)
                                            <div class="col-md-9">
                                            </div>
                                            @if ($discount_type != 1)
                                                <div class="col-md-1  d-flex justify-content-end">
                                                    <h5 for="">Discount </h5>
                                                </div>
                                                <div class="col-md-1" style="text-align: right">
                                                    <h5 for="">(
                                                        @if ($discount_type == 2)
                                                            @php
                                                                $discount_total = $total * ($discount_amount / 100);
                                                            @endphp
                                                        @else
                                                            @php
                                                                $discount_total = $total - $discount_amount;
                                                            @endphp
                                                        @endif
                                                        {{ $discount_total }})
                                                    </h5>
                                                </div>
                                                <div class="col-md-1 p-0">
                                                </div>
                                            @else
                                                <div class="col-md-1 d-flex justify-content-end">
                                                    <h5 for="">Discount </h5>
                                                </div>
                                                <div class="col-md-1">

                                                </div>
                                                <div class="col-md-1  p-0" style="text-align: left">
                                                    <h5 for=""> ( {{ $total - $discount_total }} )</h5>
                                                </div>
                                            @endif
                                        @else
                                            <div class="col-md-12 mb-4"></div>
                                        @endif

                                        <div class="col-md-9">
                                        </div>
                                        @if ($discount_type != 1)
                                            <div class="col-md-1  p-0">
                                                <h6 for="">Overall Total </h6>
                                            </div>
                                            <div class="col-md-1" style="text-align: right">
                                                <h5 for="">{{ $total - $discount_total }} </h5>
                                            </div>
                                            <div class="col-md-1 p-0">

                                            </div>
                                        @else
                                            <div class="col-md-1 p-0">
                                                <h6 for="">Overall Total </h6>
                                            </div>
                                            <div class="col-md-1">

                                            </div>
                                            <div class="col-md-1  p-0" style="text-align: left">
                                                <h5 for="">{{ $total - ($total - $discount_total) }}</h5>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                                <button type="submit" class="btn btn-primary">SEND</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div wire:ignore.self class="modal fade" id="confirm" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog " role="document" style="max-width:80%">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">CONFIRM PAYMENT</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form wire:submit.prevent="confirm_payment">
                        <div class="modal-body">
                            @csrf
                            @if ($type === 'Confirm')
                                <div style="height: 800px; overflow-y: auto;  overflow-x: hidden; ">
                                    <h2>Confirm payment of Customer for items below:
                                    </h2>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <h5>Name:</h5>
                                        </div>
                                        <div class="col-md-3">
                                            @if ($customer != null)
                                                {{ $customer->fullname() }}
                                            @endif
                                        </div>
                                        <div class="col-md-7 p-0"></div>

                                        <div class="col-md-2">
                                            <h5>Discount:</h5>
                                        </div>
                                        <div class="col-md-3">
                                            <h5>
                                                @if ($discount_type == 0)
                                                    NO DISCOUNT
                                                @elseif($discount_type == 1)
                                                    {{ $discount_amount }}% per item
                                                @elseif($discount_type == 2)
                                                    {{ $discount_amount }}% on overall total
                                                @elseif($discount_type == 3)
                                                    Less {{ $discount_amount }} on total
                                                @endif
                                            </h5>
                                        </div>

                                        <div class="col-md-7"></div>
                                        <br>
                                        <br>
                                        <br>
                                        <div class="col-md-9" style="text-align: center">
                                            <h5>ITEM</h5>
                                        </div>
                                        <div class="col-md-1" style="text-align: right">
                                            <h5>PRICE</h5>
                                        </div>
                                        <div class="col-md-1" style="text-align: right">
                                            <h5>TOTAL</h5>
                                        </div>
                                        <div class="col-md-1 p-0" style="text-align: left">
                                            @if ($discount_type === 1)
                                                <h5>Discount</h5>
                                            @endif
                                        </div>
                                        @php
                                            $total = 0;
                                            $discount_total = 0;
                                        @endphp
                                        @for ($x = 0; $x < $row; $x++)
                                            <div class="col-md-1">
                                                <h5>{{ $quantity[$x] }} pcs</h5>
                                            </div>
                                            <div class="col-md-2">
                                                <h5>{{ $product_selected[$x]->name }}</h5>
                                            </div>
                                            <div class="col-md-2">
                                                <h5>{{ $variation_selected[$x]->variation() }}</h5>
                                            </div>
                                            <div class="col-md-1">
                                                @if ($length[$x] != 0 && $length[$x] != null)
                                                    <h5>x</h5>
                                                @endif

                                            </div>
                                            <div class="col-md-1">
                                                @if ($length[$x] != 0 && $length[$x] != null)
                                                    <h5>{{ $length[$x] }} M</h5>
                                                @endif
                                            </div>
                                            <div class="col-md-2">
                                                <h5>{{ $color[$x] }}</h5>
                                            </div>
                                            @php
                                                $per_piece = 0;
                                            @endphp
                                            <div class="col-md-1 d-flex justify-content-end">
                                                <h5 class="text-bold">
                                                    @if ($product_selected[$x]->purlin == 1)
                                                        @if ($length[$x] === $product_selected[$x]->standard_length)
                                                            @if ($customer->type === 'End User')
                                                                @php
                                                                    $per_piece += $product_selected[$x]->price()->end_user * $variation_selected[$x]->weight_meter * $product_selected[$x]->standard_length;
                                                                @endphp
                                                            @elseif($customer->type === 'Dealer')
                                                                @php
                                                                    $per_piece += $product_selected[$x]->price()->dealer * $variation_selected[$x]->weight_meter * $product_selected[$x]->standard_length;
                                                                @endphp
                                                            @else
                                                                @php
                                                                    $per_piece += $product_selected[$x]->price()->contractor * $variation_selected[$x]->weight_meter * $product_selected[$x]->standard_length;
                                                                @endphp
                                                            @endif
                                                        @else
                                                            @if ($customer->type === 'End User')
                                                                @php
                                                                    $per_piece += $product_selected[$x]->price()->end_user * $variation_selected[$x]->weight_meter * $length[$x];
                                                                @endphp
                                                            @elseif($customer->type === 'Dealer')
                                                                @php
                                                                    $per_piece += $product_selected[$x]->price()->dealer * $variation_selected[$x]->weight_meter * $length[$x];
                                                                @endphp
                                                            @else
                                                                @php
                                                                    $per_piece += $product_selected[$x]->price()->contractor * $variation_selected[$x]->weight_meter * $length[$x];
                                                                @endphp
                                                            @endif
                                                        @endif
                                                    @elseif($product_selected[$x]->purlin == 0 && $product_selected[$x]->length_dependent == 0)
                                                        @if ($customer->type === 'End User')
                                                            @php
                                                                $per_piece += $product_selected[$x]->price()->end_user * $length[$x];
                                                            @endphp
                                                        @elseif($customer->type === 'Dealer')
                                                            @php
                                                                $per_piece += $product_selected[$x]->price()->dealer * $length[$x];
                                                            @endphp
                                                        @else
                                                            @php
                                                                $per_piece += $product_selected[$x]->price()->contractor * $length[$x];
                                                            @endphp
                                                        @endif
                                                    @elseif($product_selected[$x]->purlin == 0 && $product_selected[$x]->special_cut == 0)
                                                        @if ($customer->type === 'End User')
                                                            @php
                                                                $per_piece += $product_selected[$x]->price()->end_user * $length[$x];
                                                            @endphp
                                                        @elseif($customer->type === 'Dealer')
                                                            @php
                                                                $per_piece += $product_selected[$x]->price()->dealer * $length[$x];
                                                            @endphp
                                                        @else
                                                            @php
                                                                $per_piece += $product_selected[$x]->price()->contractor * $length[$x];
                                                            @endphp
                                                        @endif
                                                    @elseif($product_selected[$x]->production_process == 0)
                                                        @if ($customer->type === 'End User')
                                                            @php
                                                                $per_piece += $product_selected[$x]->price()->end_user;
                                                            @endphp
                                                        @elseif($customer->type === 'Dealer')
                                                            @php
                                                                $per_piece += $product_selected[$x]->price()->dealer;
                                                            @endphp
                                                        @else
                                                            @php
                                                                $per_piece += $product_selected[$x]->price()->contractor;
                                                            @endphp
                                                        @endif
                                                    @endif
                                                    {{ $per_piece }}
                                                </h5>
                                            </div>
                                            <div class="col-md-1 " style="text-align: right">
                                                @if (array_key_exists($x, $quantity))
                                                    @if ($quantity[$x] != null)
                                                        @php
                                                            $this->price_piece[$x] = $per_piece;
                                                            $per_piece = $per_piece * $quantity[$x];
                                                        @endphp
                                                    @endif
                                                @endif
                                                <h5> {{ $per_piece }}</h5>

                                                @php
                                                    $total += $per_piece;
                                                @endphp
                                            </div>
                                            @if ($discount_type != 1)
                                                <div class="col-md-1 p-0"></div>
                                            @else
                                                <div class="col-md-1 p-0" style="text-align: left">
                                                    @php
                                                        $discounted_perpiece = floatval($per_piece) - floatval($per_piece) * (floatval($discount_amount) / 100);
                                                        $discount_total += $discounted_perpiece;
                                                    @endphp
                                                    <h5>
                                                        {{ $discounted_perpiece }}
                                                    </h5>
                                                </div>
                                            @endif
                                        @endfor
                                        <br>
                                        <br>
                                        <br>
                                        <div class="col-md-9"></div>
                                        <div class="col-md-1 d-flex justify-content-end">
                                            <h5>TOTAL</h5>
                                        </div>
                                        @if ($discount_type != 1)
                                            <div class="col-md-1" style="text-align: right">
                                                <h5>{{ $total }}</h5>
                                            </div>
                                            <div class="col-md-1 p-0">

                                            </div>
                                        @else
                                            <div class="col-md-1">

                                            </div>
                                            <div class="col-md-1 p-0" style="text-align: left">
                                                <h5>{{ $total }}</h5>
                                            </div>
                                        @endif
                                        @if ($discount_type != 0)
                                            <div class="col-md-9">
                                            </div>
                                            @if ($discount_type != 1)
                                                <div class="col-md-1  d-flex justify-content-end">
                                                    <h5 for="">Discount </h5>
                                                </div>
                                                <div class="col-md-1" style="text-align: right">
                                                    <h5 for="">(
                                                        @if ($discount_type == 2)
                                                            @php
                                                                $discount_total = $total * ($discount_amount / 100);
                                                            @endphp
                                                        @else
                                                            @php
                                                                $discount_total = $total - $discount_amount;
                                                            @endphp
                                                        @endif
                                                        {{ $discount_total }})
                                                    </h5>
                                                </div>
                                                <div class="col-md-1 p-0">
                                                </div>
                                            @else
                                                <div class="col-md-1 d-flex justify-content-end">
                                                    <h5 for="">Discount </h5>
                                                </div>
                                                <div class="col-md-1">

                                                </div>
                                                <div class="col-md-1  p-0" style="text-align: left">
                                                    <h5 for=""> ( {{ $total - $discount_total }} )</h5>
                                                </div>
                                            @endif
                                        @else
                                            <div class="col-md-12 mb-4"></div>
                                        @endif

                                        <div class="col-md-9">
                                        </div>
                                        @if ($discount_type != 1)
                                            <div class="col-md-1  p-0">
                                                <h6 for="">Overall Total </h6>
                                            </div>
                                            <div class="col-md-1" style="text-align: right">
                                                <h5 for="">{{ $total - $discount_total }} </h5>
                                            </div>
                                            <div class="col-md-1 p-0">

                                            </div>
                                        @else
                                            <div class="col-md-1 p-0">
                                                <h6 for="">Overall Total </h6>
                                            </div>
                                            <div class="col-md-1">

                                            </div>
                                            <div class="col-md-1  p-0" style="text-align: left">
                                                <h5 for="">{{ $total - ($total - $discount_total) }}</h5>
                                            </div>
                                        @endif


                                        <div class="col-md-8 mt-2 mb-2 pb-2 pt-2"></div>

                                        <div class="col-md-2  mt-2 mb-2 pb-2 pt-2">
                                            <p>Date: </p>
                                            <p>Amount: </p>
                                            <p>Payment Mode: </p>
                                            @if ($payment_mode == 2)
                                                <p>Bank Account: </p>
                                            @endif
                                            @if ($payment_mode == 3)
                                                <p>Bank: </p>
                                                <p>Check #: </p>
                                            @endif
                                        </div>
                                        <div class="col-md-2  mt-2 mb-2 pb-2 pt-2">
                                            <input wire:model="date_received" type="date"
                                                class="form-control mb-1" required>
                                            <input wire:model="amount_paid" type="number" class="form-control mb-1"
                                                step="any" required>
                                            <select wire:model="payment_mode" class="form-control mb-1">
                                                <option value="1" selected>Cash</option>
                                                <option value="2" selected>Bank Deposit</option>
                                                <option value="3" selected>Check</option>
                                            </select>

                                            @if ($payment_mode == 2)
                                                <select wire:model="bank_id" class="form-control mb-1" required>
                                                    <option value="">Please Select Bank Account</option>
                                                    @foreach ($bank_accounts as $ac)
                                                        <option value="{{ $ac->id }}">{{ $ac->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            @endif
                                            @if ($payment_mode == 3)
                                                <input type="text" wire:model="bank" class="form-control mb-1"
                                                    placeholder="Bank" required>
                                                <input type="text" wire:model="check_number"
                                                    class="form-control mb-1" placeholder="Check #" required>
                                            @endif
                                        </div>
                                        <div class="col-md-8"></div>

                                        <div class="col-md-2">
                                            <h5>Remaining Payable</h5>
                                        </div>
                                        <div class="col-md-2" style="text-align: right">
                                            <h5>{{ $inquiry->remaining_due() }}</h5>
                                        </div>

                                    </div>


                                </div>
                            @endif
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                                <button type="submit" class="btn btn-primary">SEND</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>

<script>
    $('#inquiries').DataTable({
        destroy: true,
        pageLength: 5,
    });
    window.addEventListener('add_inquiry', event => {
        $("#add_inquiry").modal('toggle');
    })

    window.addEventListener('edit_inquiry', event => {
        $("#edit_inquiry").modal('toggle');
    })

    window.addEventListener('view_inquiry', event => {
        $("#view_inquiry").modal('toggle');
    })
    window.addEventListener('delete_product', event => {
        $("#delete_product").modal('toggle');

    })
    window.addEventListener('payment', event => {
        $("#payment").modal('toggle');

    })
    window.addEventListener('confirm', event => {
        $("#confirm").modal('toggle');
    })
    window.addEventListener('data_table', event => {
        $('#inquiries').DataTable({
            destroy: true,
            pageLength: 10,
        });
    })
</script>
