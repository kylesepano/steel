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
        <h4>JOB ORDER #: CSC-JO- {{ sprintf('%04s', $inquiry->id) }}</h4>
    </div>
    <div class="row">
        <label for="">{{ date('M d, Y', strtotime($inquiry->created_at)) }}</label>
    </div>
    <div class="row">
        <div class="column2">
            <h2>CUSTOMER: </h2>
        </div>
        <div class="column2">
            <h2>
                {{ $inquiry->customer->fullname() }}</h2>
        </div>
    </div>
    <div class="row" style="margin-top: 2%">
        <div class="column10">
            <h4>QTY</h4>
        </div>
        <div class="column10">
            <h4>UNITS</h4>
        </div>
        <div class="column5">
            <h4>ITEMS</h4>
        </div>
        <div class="column5">
            <h4>WIDTH & THICKNESS</h4>
        </div>
        <div class="column10">
            <h4></h4>
        </div>
        <div class="column10">
            <h4>LENGTH</h4>
        </div>
        <div class="column5">
            <h4>COLOR</h4>
        </div>
    </div>

    @foreach ($inquiry->inquiry_products as $i)
        <div class="row">
            <div class="column10">
                <h4>{{ $i->quantity }}</h4>
            </div>
            <div class="column10">
                <h4> pc/s</h4>
            </div>
            <div class="column5">
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
            <div class="column10">
                @if ($i->length != 0 && $i->length != null)
                    <h4>{{ $i->length }} m</h4>
                @endif
            </div>
            <div class="column5">
                <h4>{{ $i->color }} </h4>
            </div>
        </div>
    @endforeach
    <div class="row" style="border-bottom: 2px solid; margin-bottom:2px"></div>
    <div class="row" style="border-bottom: 2px solid"></div>
    <div class="row" style="margin-bottom: 5%">
        <h5>{{ $inquiry->qty_total() }}</h5>
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
            <h4>SALES NAME: </h4>
            <h4>SALES CONTACT NUMBER: </h4>
        </div>
        <div class="column2">
            <h4>ACCOUNTING NAME</h4>
        </div>
    </div>
    <div class="row" style="margin-bottom: 5%">
        <div class="column70" style="border: 1px solid; padding-bottom:10%">
            <h4>Notes:</h4>
            <h4 for="">{{ $inquiry->sales_confirmations->sc_number }}</h4>
            <h4 for="">{{ $inquiry->notes }}</h4>
        </div>
    </div>
</div>
