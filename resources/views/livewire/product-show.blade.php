<div>
    <h2 class="text-bold">Products</h2>
    @if ($message != '')
        <h4 class="bg-success">{{ $message }}</h4>
    @endif
    <div class="d-flex">
        <button class="btn btn-success" wire:click="add_product">ADD PRODUCT</button>
        <div wire:ignore.self class="modal fade" id="add_product" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">ADD PRODUCT</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form wire:submit.prevent="add">
                        <div class="modal-body">
                            @csrf
                            @if ($message != '')
                                <h4 class="bg-success">{{ $message }}</h4>
                            @endif
                            <label for="">Name</label>
                            <input type="text" wire:model="name" class="form-control" required>
                            <label for="">Purlin ?</label>
                            <input type="checkbox" wire:model="purlin" class="form-check" value="1">
                            <label for="">With Standard Length ?</label>
                            <input type="checkbox" wire:model="length_dependent" class="form-check" value="1">

                            @if ($length_dependent == 1)
                                <label for="">Standard Length</label>
                                <input type="number" wire:model="standard_length" class="form-control " step="any">
                            @endif
                            <label for="">Available for Special Cut?</label>
                            <input type="checkbox" wire:model="special_cut" class="form-check " value="1">
                            <label for="">For Production Process?</label>
                            <input type="checkbox" wire:model="production_process" class="form-check" value="1">
                            <label for="">Bended Accessory?</label>
                            <input type="checkbox" wire:model="bended_accessory" class="form-check " value="1">
                            <label for="">With Color</label>
                            <input type="checkbox" wire:model="color" class="form-check " value="1">
                            <label for="">Unit</label>
                            <select wire:model="uom" class="form-control mb-2" required>
                                <option value="">Please Select Unit</option>
                                <option value="PC">PC</option>
                                <option value="BOX">BOX</option>
                                <option value="BAG">BAG</option>
                                <option value="PACK">PACK</option>
                            </select>
                            <label for="">Machine</label>
                            <select wire:model="machine_id" class="form-control mb-2" required>
                                <option value="">Please Select Machine</option>
                                @foreach ($product_machines as $m)
                                    <option value="{{ $m->id }}">{{ $m->name }}</option>
                                @endforeach
                            </select>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                                <button type="submit" class="btn btn-primary">ADD PRODUCT</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="ml-auto">
            <button class="btn btn-info" wire:click="add_machine">ADD MACHINE</button>
        </div>
        <div wire:ignore.self class="modal fade" id="add_machine" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">ADD MACHINE</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form wire:submit.prevent="machine">
                        <div class="modal-body">
                            @if ($message != '')
                                <h4 class="bg-success">{{ $message }}</h4>
                            @endif
                            @csrf
                            <label for="">Name</label>
                            <input type="text" wire:model="machine_name" class="form-control mb-2" required>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                                <button type="submit" class="btn btn-primary">ADD PRODUCT</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <table class="table" id="products">
        <thead class="thead-dark">
            <tr>
                <th>Name</th>
                <th>Purlin</th>
                <th>With Standard Length</th>
                <th>Standard Length</th>
                <th>Special Cut</th>
                <th>Production Process</th>
                <th>Bended Accessory</th>
                <th>With Color</th>
                <th>Unit</th>
                <th>Machine</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $p)
                <tr>
                    <td>{{ $p->name }}</td>
                    <td>
                        @if ($p->purlin == 1)
                            Yes
                        @else
                            No
                        @endif
                    </td>
                    <td>
                        @if ($p->length_dependent == 1)
                            Yes
                        @else
                            No
                        @endif
                    </td>
                    <td>
                        @if ($p->length_dependent == 1)
                            {{ $p->standard_length }}
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        @if ($p->special_cut == 1)
                            Yes
                        @else
                            No
                        @endif
                    </td>
                    <td>
                        @if ($p->production_process == 1)
                            Yes
                        @else
                            No
                        @endif
                    </td>
                    <td>
                        @if ($p->bended_accessory == 1)
                            Yes
                        @else
                            No
                        @endif
                    </td>
                    <td>
                        @if ($p->color == 1)
                            Yes
                        @else
                            No
                        @endif
                    </td>
                    <td>{{ $p->uom }}</td>
                    <td>
                        @if ($p->machine_id != null)
                            {{ $p->machine->name }}
                        @else
                            No Assigned Yet
                        @endif
                    </td>
                    <td>
                        <button class="btn btn-secondary" wire:click="edit_product({{ $p->id }})"><i
                                class="nc-icon nc-tag-content"></i></button>

                        <button class="btn btn-warning" wire:click="remove_product({{ $p->id }})"><i
                                class="nc-icon nc-simple-remove"></i></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div id="products"></div>
    @if ($product != null)
        <div wire:ignore.self class="modal fade" id="edit_product" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">EDIT PRODUCT</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form wire:submit.prevent="edit">
                        <div class="modal-body">
                            @csrf
                            <label for="">Name</label>
                            <input type="text" wire:model="name" class="form-control" required>
                            <label for="">Purlin ?</label>
                            <input type="checkbox" wire:model="purlin" class="form-control mb-2" value="1">
                            <label for="">With Standard Length ?</label>
                            <input type="checkbox" wire:model="length_dependent" class="form-control mb-2"
                                value="1">

                            @if ($length_dependent == 1)
                                <label for="">Standard Length</label>
                                <input type="number" wire:model="standard_length" class="form-control mb-2"
                                    step="any">
                            @endif
                            <label for="">Available for Special Cut?</label>
                            <input type="checkbox" wire:model="special_cut" class="form-control mb-2"
                                value="1">
                            <label for="">For Production Process?</label>
                            <input type="checkbox" wire:model="production_process" class="form-control mb-2"
                                value="1">
                            <label for="">Bended Accessory?</label>
                            <input type="checkbox" wire:model="bended_accessory" class="form-control mb-2"
                                value="1">
                            <label for="">With Color</label>
                            <input type="checkbox" wire:model="color" class="form-control mb-2" value="1">
                            <label for="">Unit</label>
                            <select wire:model="uom" class="form-control mb-2" required>
                                <option value="">Please Select Unit</option>
                                <option value="PC">PC</option>
                                <option value="BOX">BOX</option>
                                <option value="BAG">BAG</option>
                                <option value="PACK">PACK</option>
                            </select>
                            <label for="">Machine</label>
                            <select wire:model="machine_id" class="form-control mb-2" required>
                                <option value="">Please Select Machine</option>
                                @foreach ($product_machines as $m)
                                    <option value="{{ $m->id }}">{{ $m->name }}</option>
                                @endforeach
                            </select>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                                <button type="submit" class="btn btn-primary">EDIT PRODUCT</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div wire:ignore.self class="modal fade" id="remove_product" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">REMOVE PRODUCT</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form wire:submit.prevent="remove">
                        <div class="modal-body">
                            @csrf
                            <h4>Are you sure you want to remove product {{ $product->name }} ? </h4>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                                <button type="submit" class="btn btn-primary">REMOVE PRODUCT</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>

<script>
    $('#products').DataTable({
        destroy: true,
        pageLength: 5,
    });
    window.addEventListener('add_product', event => {
        $("#add_product").modal('toggle');
    })
    window.addEventListener('edit_product', event => {
        $("#edit_product").modal('toggle');
    })
    window.addEventListener('remove_product', event => {
        $("#remove_product").modal('toggle');
    })
    window.addEventListener('add_machine', event => {
        $("#add_machine").modal('toggle');
    })
    window.addEventListener('remove_product_hide', event => {
        $("#remove_product").modal('hide');
        $('.modal-backdrop').remove()
    })

    window.addEventListener('data_table', event => {
        $('#products').DataTable({
            destroy: true,
            pageLength: 5,
        });
    })
</script>
