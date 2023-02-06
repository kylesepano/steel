<div>
    <img src="{{ public_path('img/qoutation_head.png') }}" alt="" style="width:100%">
    {{-- <img src="{{ asset('img/qoutation_head.png') }}" alt="" style="width:100%" height="10%"> --}}
    <section class="container">
        <div class="row">
            <div class="column4">
                <h4>CUSTOMER: </h4>
            </div>
            <div class="column40">
                <h4>
                    {{ $inquiry->customer->fullname() }}</h4>
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
                <h5>CONTACT
                    PERSON: </h5>
            </div>
            <div class="column4">
                <h5>
                    {{ $inquiry->customer->fullname() }}</h5>
            </div>
        </div>
        <div class="row">
            <div class="column4">
                <h5>ADDRESS: </h5>
            </div>
            <div class="column4">
                <h5>
                    {{ $inquiry->customer->home_address }}</h5>
            </div>
        </div>
        <div class="row">
            <div class="column4">
                <h5>CONTACT NUMBER: </h5>
            </div>
            <div class="column4">
                <h5>
                    {{ $inquiry->customer->contact_number }}</h5>
            </div>
        </div>

        <div class="row">
            <h6>Dear Sir/Ma'am: {{ $inquiry->customer->last_name }}</h6>
        </div>

        <div class="row">
            <h6>Thank you very much for reaching out to us. Please allow us to offer the following items: </h6>
        </div>

        <div class="row">
            <div class="title">
                <h4 class="">PRODUCT INFORMATION</h4>
            </div>
        </div>
        <div class="row">
            <div class="column10" style="border: 1px solid black;  text-align: center;">
                <h5> QTY UNITS</h5>

            </div>
            <div class="column70" style="border: 1px solid black;  text-align: center;">
                <h5>DESCRIPTION</h5>

            </div>
            <div class="column10" style="border: 1px solid black;  text-align: center;">
                <h5>PRICE</h5>

            </div>
            <div class="column10" style="border: 1px solid black;  text-align: center;">
                <h5>TOTAL</h5>
            </div>
        </div>
        @foreach ($inquiry->inquiry_products as $i)
            <div class="row">
                <div class="column10"
                    style="  @if ($loop->last) border-bottom: 1px solid black; @endif border-right: 1px solid black; border-left: 1px solid black;   text-align: center;">
                    <h5>{{ $i->quantity }} pc/s</h5>
                </div>
                <div class="column70"
                    style="  @if ($loop->last) border-bottom: 1px solid black; @endif border-right: 1px solid black; border-left: 1px solid black;   text-align: center;">
                    <h5> {{ $i->product->name }} {{ $i->product_variation->variation() }} @if ($i->length != null)
                            x
                        @endif
                        @if ($i->length != null)
                            {{ $i->length }} m
                        @endif

                        {{ $i->color }}
                        <h5>
                </div>
                <div class="column10"
                    style="  @if ($loop->last) border-bottom: 1px solid black; @endif border-right: 1px solid black; border-left: 1px solid black;   text-align: right; ">
                    <h5>{{ number_format($i->price_piece, 2, '.', ',') }}</h5>
                </div>
                <div class="column10"
                    style="  @if ($loop->last) border-bottom: 1px solid black; @endif border-right: 1px solid black; border-left: 1px solid black;   text-align: right; ">
                    <h5>{{ number_format($i->price_piece * $i->quantity, 2, '.', ',') }}</h5>
                </div>
            </div>
        @endforeach
        <div class="row">
            <div class="column10">
                <h5>LEAD TIME</h5>
            </div>
            <div class="column70">

            </div>
            <div class="column10">
                <h5>TOTAL</h5>
            </div>
            <div class="column10" style=" text-align: right;">
                <h5> {{ number_format($inquiry->total(), 2, '.', ',') }}</h5>
            </div>
        </div>

        <div class="row">
            <div class="column10">
                <h5>PICKUP</h5>
            </div>
            <div class="column70">
                <h5>3-5 working days</h5>
            </div>
            @if ($inquiry->discount_type != 0)
                <div class="column10">
                    <h5>DISCOUNT</h5>
                </div>
                <div class="column10" style=" text-align: right;">
                    <h5>{{ number_format($inquiry->discount(), 2, '.', ',') }} </h5>
                </div>
            @endif
        </div>
        <div class="row">
            <div class="column10">
                <h5>DELIVERY</h5>
            </div>
            <div class="column5">
                <h5> 5-10 working days</h5>
            </div>
            <div class="column2" style=" border-bottom: 2px solid black;">
                <h5>GRAND TOTAL</h5>
            </div>
            <div class="column10" style=" border-bottom: 2px solid black;">
                <h5>PHP</h5>
            </div>
            <div class="column10" style=" text-align: right;  border-bottom: 2px solid black;">
                <h5> {{ number_format($inquiry->grand_total(), 2, '.', ',') }}</h5>
            </div>
        </div>
        <div class="row"style="border-bottom: 2px solid black;"></div>

        <h5>TERMS & CONDITIONS</h5>


        <p> 1. The seller is not responsible for any delays due to fortuitous events or any circumstances whatever
            and
            however arising over which the seller of his agents have no control.
            <br><br>
            2. When this contract is based on “PLANS” (not on actual measurement), the buyer shall be responsible
            for
            any changes (size, type & quantities of materials) and/or alterations on the plans or changes in the
            final
            dimensions. Any additional materials needed to complete the project shall be subject to changes in price
            without prior notice.
            <br><br>
            3. The acceptance of this offer is subject to the final confirmation by the Authorized Company Officer
            and
            to the terms and conditions stated herein.
            <br><br>
            4. If payment is made by cheque, there will be a 2-day cheque clearing before the order will be
            confirmed
            and proceed into process.
            <br>
            <br>
            5. This contract shall be valid for fifteen (15) days from the date of signing.
            <br><br>
            6.Prices are subject to change without prior notice.
        </p>
        <div class="row"style="border-bottom: 2px solid black;"></div>
        <h5>PAYMENT METHODS</h5>
        <p style="font-style:italic;  color: rgb(102, 101, 101); ">Cash, Manager's Check, Financing, or Bank Transfer
        </p>
        @php
            $x = 0;
        @endphp
        <div class="row"> </div>
        @foreach ($bank_accounts as $ac)
            <div class="column4">
                <h6 style="color: green;">BANK NAME: {{ $ac->name }}</h6>
                <h6 style="color: green;">ACCOUNT NAME: {{ $ac->account_name }}</h6>
                <h6 style="color: green;">ACCOUNT NUMBER: {{ $ac->account_number }}</h6>
            </div>
            @php
                $x += 1;
            @endphp
            @if ($x % 4 == 0)
                <div class="row"></div>
            @endif
        @endforeach

        <div class="row"style="border-bottom: 2px solid black;"></div>

        <h5 style="margin-bottom:30px !important">We hope that these items will fit your requirements. If you have any
            questions, please do not hesitate to
            contact me through my cellphone number {{ $inquiry->user->contact_number }} or email me at,
            {{ $inquiry->user->email_address }} or visit us at our main office in Zone 1, Taytay, El Salvador
            City, Misamis Oriental.</h5>

        <div class="column2">
            <h5>Sincerely,</h5>
        </div>
        <div class="column2">
            <h5>Received by:</h5>
        </div>
        <div class="row"></div>
        <div class="column10">
            <img src="{{ public_path('uploads/' . $inquiry->user->signature) }}" alt="" style="width:100%">
        </div>
        <div class="row"></div>
        <div class="column2">
            <h5>{{ $inquiry->user->first_name }} {{ $inquiry->user->last_name }}</h5>
        </div>
        <div class="column2">
            <h5>{{ $inquiry->customer->first_name }} {{ $inquiry->customer->last_name }}</h5>
        </div>
        <div class="row"></div>
        <div class="column2">
            <h5>{{ $inquiry->user->position }}</h5>
        </div>
        <div class="column2">
            <h5>CLIENT &emsp; DATE:</h5>
        </div>

    </section>
</div>
