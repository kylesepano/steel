<div class="container">
    <div class="row">
        <div style="text-align: center">
            <h1>C-ONE STEEL CORPORATION</h1>
        </div>
    </div>
    <div class="row">
        <div style="text-align: center">
            <label style="color:gray">Zone 1, Brgy. Taytay, El Salvador, Misamis Oriental</label>
        </div>
    </div>
    <div class="row">
        <div style="text-align: center">
            <label style="color:gray">Tel. No. 088 858 2663</label>
        </div>
    </div>
    <div class="row" style="text-align: center; margin-top:2%; margin-bottom:2%">
        <h4>SALES CONFIRMATION #: {{ $this->inquiry->sales_confirmations->sc_number }}</h4>
    </div>
    <div class="row">
        <div class="column4">
            <h2>CUSTOMER: </h2>
        </div>
        <div class="column40">
            <h2>
                {{ $inquiry->customer->fullname() }}</h2>
        </div>
        <div class="column5">
            <h4 style="  padding-left: 50%;">DATE:
            </h4>
        </div>
        <div class="column5">
            <h4>
                {{ date('M d, Y', strtotime($inquiry->created_at)) }}</h4>
        </div>
    </div>
    <div class="row">
        <div class="column4">
            <h4>ADDRESS: </h4>
        </div>
        <div class="column2">
            <h4>
                {{ $inquiry->customer->home_address }}</h4>
        </div>
    </div>
    <div class="row">
        <div class="column4">
            <h4>CONTACT NUMBER: </h4>
        </div>
        <div class="column2">
            <h4>
                {{ $inquiry->customer->contact_number }}</h4>
        </div>
    </div>

    <div class="row" style="margin-top: 2%">
        <div class="column10">
            <h4>QTY</h4>
        </div>
        <div class="column70" style="text-align: center">
            <h4>ITEMS</h4>
        </div>
        <div class="column10" style="text-align: right">
            <h4>PRICE</h4>
        </div>
        <div class="column10" style="text-align: right">
            <h4>TOTAL</h4>
        </div>
    </div>

    @foreach ($inquiry->inquiry_products as $i)
        <div class="row">
            <div class="column10">
                <h4>{{ $i->quantity }} pc/s</h4>
            </div>
            <div class="column5" style="text-align: center">
                <h4>{{ $i->product->name }}</h4>
            </div>
            <div class="column5" style="text-align: center">
                <h4>{{ $i->product_variation->variation() }}</h4>
            </div>
            <div class="column10" style="text-align: center">
                @if ($i->length != 0 && $i->length != null)
                    <h4>x</h4>
                @endif
            </div>
            <div class="column10" style="text-align: center">
                @if ($i->length != 0 && $i->length != null)
                    <h4>{{ $i->length }} m</h4>
                @endif
            </div>
            <div class="column10" style="text-align: center">

                <h4>{{ $i->color }} </h4>

            </div>
            <div class="column10" style="text-align: right">
                <h4>{{ number_format($i->price_piece, 2, '.', ',') }}</h4>
            </div>
            <div class="column10" style="text-align: right">
                <h4>{{ number_format($i->quantity * $i->price_piece, 2, '.', ',') }}</h4>
            </div>
        </div>
    @endforeach
    <div class="row" style="border-bottom: 2px solid; margin-bottom:2px"></div>
    <div class="row" style="border-bottom: 2px solid"></div>
    <div class="row">
        <div class="column70"></div>
        <div class="column5">
            <h4>TOTAL</h4>
        </div>
        <div class="column10" style="text-align: right">
            <h4>{{ number_format($inquiry->total(), 2, '.', ',') }}</h4>
        </div>
    </div>
    @if ($inquiry->discount_type != 0)
        <div class="row">
            <div class="column70"></div>
            <div class="column5">
                <h4>DISCOUNT</h4>
            </div>
            <div class="column10" style="text-align: right">
                <h4>{{ number_format($inquiry->discount(), 2, '.', ',') }}</h4>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="column70"></div>
        <div class="column5">
            <h4 style="font-weight: bold">GRAND TOTAL</h4>
        </div>
        <div class="column10" style="text-align: right">
            <h4>{{ number_format($inquiry->grand_total(), 2, '.', ',') }}</h4>


        </div>
    </div>
    <div class="row" style="text-align: right">
        <h5 style="color:gray">{{ ucwords($words) }} Only</h5>
    </div>
    <div class="row">
        <h4>TRANSACTIONS</h4>
    </div>
    <div class="row">
        <div class="column5">
            <h4>DATE</h4>
        </div>
        <div class="column10">
            <h4>MODE</h4>
        </div>
        <div class="column5" style="text-align: right">
            <h4>AMOUNT PAID</h4>
        </div>
        <div class="column5" style="text-align: right">
            <h4>REMAINING DUE </h4>
        </div>
    </div>
    @foreach ($inquiry->sales_confirmations->payments as $p)
        <div class="row">
            <div class="column5">
                <h4>{{ date('M d, Y', strtotime($p->date_received)) }}</h4>
            </div>
            <div class="column10">
                <h4>{{ $p->mode_payment() }}</h4>
            </div>
            <div class="column5" style="text-align: right">
                <h4>{{ number_format($p->amount_paid, 2, '.', ',') }}</h4>
            </div>
            <div class="column5" style="text-align: right">
                <h4>{{ number_format($p->remaining_payable, 2, '.', ',') }}</h4>
            </div>

            <div class="column5" style="text-align: right">
                @if ($p->remaining_payable < 0)
                    <h4 style="color:gray">overpayment</h4>
                @elseif($p->remaining_payable == 0)
                    <h4 style="color:gray">fully paid</h4>
                @endif
            </div>
        </div>
    @endforeach
    <div class="row" style="margin-bottom: 5%">
        <h5>NOTES:</h5>
    </div>
    <div class="row" style="margin-bottom: 5%">
        <h5>{{ $inquiry->notes }}</h5>
    </div>
    <div class="row" style="margin-bottom: 5%">
        <div class="column2">
            <h4>Prepared by:</h4>
        </div>
        <div class="column2">
            <h4>Approved by:</h4>
        </div>
    </div>
    <div class="row" style="margin-bottom: 5%">
        <div class="column2">
            <h4>SALES NAME:</h4>
            <h4>SALES CONTACT NUMBER: </h4>
        </div>
    </div>

   
</div>
