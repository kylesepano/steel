<div>
    <h2 class="text-bold">Customers</h2>
    @if ($message != '')
        <h4 class="bg-success">{{ $message }}</h4>
    @endif
    <button class="btn btn-success" wire:click="add_customer">Add CUSTOMER</button>
    <div wire:ignore.self class="modal fade" id="add_customer" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ADD CUSTOMER</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="add">
                    <div class="modal-body ">
                        @csrf
                        <div class="overflow-auto" style="max-height: 700px;">


                            <label for="">Type</label>
                            <select wire:model.defer="type" class="form-control mb-2" required>
                                <option value="">Please Select Customer Type</option>
                                <option value="End User">End User</option>
                                <option value="Dealer">Dealer</option>
                                <option value="Contractor">Contractor</option>
                            </select>
                            <label for="">First Name</label>
                            <input type="text" wire:model.defer="first_name" class="form-control mb-2" required>
                            <label for="">Middle Name</label>
                            <input type="text" wire:model.defer="middle_name" class="form-control mb-2" required>
                            <label for="">Last Name</label>
                            <input type="text" wire:model.defer="last_name" class="form-control mb-2" required>
                            <label for="">Home Address</label>
                            <textarea wire:model.defer="home_address" rows="3" class="form-control mb-2"></textarea>
                            <label for="">Home Province</label>
                            <select wire:model="home_province" class="form-control mb-2" required>
                                <option value="">Please Select Home Province</option>
                                @foreach ($provinces as $p)
                                    <option value="{{ $p->provCode }}">{{ $p->provDesc }}</option>
                                @endforeach
                            </select>
                            <label for="">Home City/Municipality </label>
                            <select wire:model="home_city_municipality" class="form-control mb-2" required>
                                <option value="">Please Select Home City/Municipality</option>
                                @foreach ($citymun_home as $c)
                                    <option value="{{ $c->citymunCode }}">{{ $c->citymunDesc }}</option>
                                @endforeach
                            </select>
                            <label for="">Home Barangay </label>
                            <select wire:model="home_barangay" class="form-control mb-2" required>
                                <option value="">Please Select Home Barangay</option>
                                @foreach ($brangay_home as $b)
                                    <option value="{{ $b->brgyCode }}">{{ $b->brgyDesc }}</option>
                                @endforeach
                            </select>
                            <label for="">Company Name</label>
                            <input type="text" wire:model.defer="company_name" class="form-control mb-2">

                            <label for="">Company Address</label>
                            <textarea wire:model.defer="company_address_line" rows="3" class="form-control mb-2"></textarea>

                            <label for="">Company Province</label>
                            <select wire:model="company_province" class="form-control mb-2">
                                <option value="">Please Select Company Province</option>
                                @foreach ($provinces as $p)
                                    <option value="{{ $p->provCode }}">{{ $p->provDesc }}</option>
                                @endforeach
                            </select>
                            <label for="">Company City/Municipality</label>
                            <select wire:model="company_city_municipality" class="form-control mb-2">
                                <option value="">Please Select Company City/Municipality</option>
                                @foreach ($citymun_com as $c)
                                    <option value="{{ $c->citymunCode }}">{{ $c->citymunDesc }}</option>
                                @endforeach
                            </select>
                            <label for="">Company Barangay</label>
                            <select wire:model="company_barangay" class="form-control mb-2">
                                <option value="">Please Select Company Barangay</option>
                                @foreach ($barangay_com as $b)
                                    <option value="{{ $b->brgyCode }}">{{ $b->brgyDesc }}</option>
                                @endforeach
                            </select>

                            <label for="">Mobile Number</label>
                            <input type="number" wire:model.defer="mobile_number" class="form-control mb-2" required>
                            <label for="">Phone Number</label>
                            <input type="number" wire:model.defer="phone_number" class="form-control mb-2">
                            <label for="">Email Address</label>
                            <input type="email" wire:model.defer="email_address" class="form-control mb-2" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                            <button type="submit" class="btn btn-primary">ADD CUSTOMER</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <table class="table" id="customers">
        <thead class="thead-dark">
            <tr>
                <th>Type</th>
                <th>Name</th>
                <th>Home Address</th>
                <th>H Prov</th>
                <th>H City/Mun</th>
                <th>H Brgy</th>
                <th>Company Name</th>
                <th>C Address</th>
                <th>C Prov</th>
                <th>C City/Mun</th>
                <th>C Brgy</th>
                <th>Mobile #</th>
                <th>Phone #</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $c)
                <tr>
                    <td>{{ $c->type }}</td>
                    <td>{{ $c->fullname() }}</td>
                    <td>{{ $c->home_address }}</td>
                    <td>{{ $c->home_province_loc() }}</td>
                    <td>{{ $c->home_city_municipality_loc() }}</td>
                    <td>{{ $c->home_barangay_loc() }}</td>
                    <td>{{ $c->company_name }}</td>
                    <td>{{ $c->company_address_line }}</td>
                    <td>{{ $c->company_province_loc() }}</td>
                    <td>{{ $c->company_city_municipality_loc() }}</td>
                    <td>{{ $c->company_barangay_loc() }}</td>
                    <td>{{ $c->mobile_number }}</td>
                    <td>{{ $c->phone_number }}</td>
                    <td>{{ $c->email_address }}</td>
                    <td>
                        <button class="btn btn-secondary" wire:click="edit_customer({{ $c->id }})"><i
                                class="nc-icon nc-tag-content"></i></button>

                        <button class="btn btn-warning" wire:click="remove_customer({{ $c->id }})"><i
                                class="nc-icon nc-simple-remove"></i></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div id="customers"></div>
    @if ($customer != null)
        <div wire:ignore.self class="modal fade" id="edit_customer" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">EDIT CUSTOMER</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form wire:submit.prevent="edit">
                        <div class="modal-body">
                            @csrf
                            <div class="overflow-auto" style="max-height: 700px;">
                                <label for="">Type</label>
                                <select wire:model.defer="type" class="form-control mb-2" required>
                                    <option value="">Please Select Customer Type</option>
                                    <option value="End User">End User</option>
                                    <option value="Dealer">Dealer</option>
                                    <option value="Contractor">Contractor</option>
                                </select>
                                <label for="">First Name</label>
                                <input type="text" wire:model.defer="first_name" class="form-control mb-2"
                                    required>
                                <label for="">Middle Name</label>
                                <input type="text" wire:model.defer="middle_name" class="form-control mb-2"
                                    required>
                                <label for="">Last Name</label>
                                <input type="text" wire:model.defer="last_name" class="form-control mb-2"
                                    required>
                                <label for="">Home Address</label>
                                <textarea wire:model.defer="home_address" rows="3" class="form-control mb-2"></textarea>
                                <label for="">Home Province</label>
                                <select wire:model="home_province" class="form-control mb-2" required>
                                    <option value="">Please Select Home Province</option>
                                    @foreach ($provinces as $p)
                                        <option value="{{ $p->provCode }}">{{ $p->provDesc }}</option>
                                    @endforeach
                                </select>
                                <label for="">Home City/Municipality </label>

                                <select wire:model="home_city_municipality" class="form-control mb-2" required>
                                    <option value="">Please Select Home City/Municipality</option>
                                    @foreach ($citymun_home as $c)
                                        <option value="{{ $c->citymunCode }}">{{ $c->citymunDesc }}</option>
                                    @endforeach
                                </select>
                                <label for="">Home Barangay</label>

                                <select wire:model.defer="home_barangay" class="form-control mb-2" required>
                                    <option value="">Please Select Home Barangay</option>
                                    @foreach ($brangay_home as $b)
                                        <option value="{{ $b->brgyCode }}">{{ $b->brgyDesc }}</option>
                                    @endforeach
                                </select>
                                <label for="">Company Name</label>
                                <input type="text" wire:model.defer="company_name" class="form-control mb-2">

                                <label for="">Company Address</label>
                                <textarea wire:model.defer="company_address_line" rows="3" class="form-control mb-2"></textarea>

                                <label for="">Company Province</label>
                                <select wire:model="company_province" class="form-control mb-2">
                                    <option value="">Please Select Company Province</option>
                                    @foreach ($provinces as $p)
                                        <option value="{{ $p->provCode }}">{{ $p->provDesc }}</option>
                                    @endforeach
                                </select>
                                <label for="">Company City/Municipality</label>
                                <select wire:model="company_city_municipality" class="form-control mb-2">
                                    <option value="">Please Select Company City/Municipality</option>
                                    @foreach ($citymun_com as $c)
                                        <option value="{{ $c->citymunCode }}">{{ $c->citymunDesc }}</option>
                                    @endforeach
                                </select>
                                <label for="">Company Barangay</label>
                                <select wire:model.defer="company_barangay" class="form-control mb-2">
                                    <option value="">Please Select Company Barangay</option>
                                    @foreach ($barangay_com as $b)
                                        <option value="{{ $b->brgyCode }}">{{ $b->brgyDesc }}</option>
                                    @endforeach
                                </select>

                                <label for="">Mobile Number</label>
                                <input type="number" wire:model.defer="mobile_number" class="form-control mb-2"
                                    required>
                                <label for="">Phone Number</label>
                                <input type="number" wire:model.defer="phone_number" class="form-control mb-2">
                                <label for="">Email Address</label>
                                <input type="email" wire:model.defer="email_address" class="form-control mb-2"
                                    required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                                <button type="submit" class="btn btn-primary">EDIT CUSTOMER</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div wire:ignore.self class="modal fade" id="remove_customer" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">REMOVE CUSTOMER</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form wire:submit.prevent="remove">
                        <div class="modal-body">
                            @csrf
                            <h4>Are you sure you want to remove customer {{ $customer->fullname() }} ? </h4>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                                <button type="submit" class="btn btn-primary">REMOVE CUSTOMER</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>

<script>
    $('#customers').DataTable({
        destroy: true,
        pageLength: 5,
    });
    window.addEventListener('add_customer', event => {
        $("#add_customer").modal('toggle');
    })

    window.addEventListener('edit_customer', event => {
        $("#edit_customer").modal('toggle');
    })

    window.addEventListener('remove_customer', event => {
        $("#remove_customer").modal('toggle');
    })

    window.addEventListener('data_table', event => {
        $('#customers').DataTable({
            destroy: true,
            pageLength: 10,
        });
    })
</script>
