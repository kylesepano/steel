<div>
    <h2 class="text-bold">Product Prices</h2>
    @if ($message != '')
        <h4 class="bg-success">{{ $message }}</h4>
    @endif
    <div class="d-flex">
        <button class="btn btn-success" wire:click="add_price">ADD PRODUCT PRICE</button>
        <div wire:ignore.self class="modal fade" id="add_price" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">ADD PRODUCT PRICE</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form wire:submit.prevent="add">
                        <div class="modal-body">
                            @csrf
                            <label for="">Product</label>
                            <select wire:model="product_id" class="form-control mb-2" required>
                                <option value="" selected>Please Select Product</option>
                                @foreach ($products as $p)
                                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                                @endforeach
                            </select>
                            <label for="">Branch</label>
                            <select wire:model.defer="branch_id" class="form-control mb-2" required>
                                <option value="" selected>Please Select Branch</option>
                                @foreach ($branches as $b)
                                    <option value="{{ $b->id }}">{{ $b->name }}</option>
                                @endforeach
                            </select>
                            <label for="">Start Date</label>
                            <input type="date" wire:model="start_date" class="form-control mb-2"required>
                            <label for="">End Date</label>
                            <input type="date" wire:model.defer="end_date" class="form-control mb-2" required
                                min="{{ $start_date }}">
                            <label for="">End User</label>
                            <input type="number" wire:model.defer="end_user" class="form-control mb-2" required>
                            <label for="">Dealer</label>
                            <input type="number" wire:model.defer="dealer" class="form-control mb-2" required>
                            <label for="">Contractor</label>
                            <input type="number" wire:model.defer="contractor" class="form-control mb-2" required>

                            @if ($product != null)
                                @if ($product->special_cut == 1)
                                    <label for="">Additional Special Cut</label>
                                    <input type="number" wire:model.defer="additional_special_cut"
                                        class="form-control mb-2">
                                @endif
                            @endif


                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                                <button type="submit" class="btn btn-primary">ADD PRODUCT PRICE</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <table class="table" id="prices">
        <thead class="thead-dark">
            <tr>
                <th>Product</th>
                <th>Branch</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>End User</th>
                <th>Dealer</th>
                <th>Contractor</th>
                <th>Additional Special Cut</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($prices as $p)
                <tr>
                    <td>{{ $p->product->name }}</td>
                    <td>{{ $p->branch->name }}</td>
                    <td>{{ date('M d, Y', strtotime($p->start_date)) }}</td>
                    <td>{{ date('M d, Y', strtotime($p->end_date)) }}</td>
                    <td>{{ $p->end_user }}</td>
                    <td>{{ $p->dealer }}</td>
                    <td>{{ $p->contractor }}</td>
                    <td>
                        @if ($p->product->special_cut == 1)
                            {{ $p->additional_special_cut }}
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        <button class="btn btn-secondary" wire:click="edit_price({{ $p->id }})"><i
                                class="nc-icon nc-tag-content"></i></button>

                        <button class="btn btn-warning" wire:click="remove_price({{ $p->id }})"><i
                                class="nc-icon nc-simple-remove"></i></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div id="prices"></div>
    @if ($price != null)
        <div wire:ignore.self class="modal fade" id="edit_price" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">EDIT PRODUCT PRICE</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form wire:submit.prevent="edit">
                        <div class="modal-body">
                            @csrf
                            <label for="">Product</label>
                            <select wire:model="product_id" class="form-control mb-2">
                                <option value="" selected>Please Select Product</option>
                                @foreach ($products as $p)
                                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                                @endforeach
                            </select>
                            <label for="">Branch</label>
                            <select wire:model.defer="branch_id" class="form-control mb-2">
                                <option value="" selected>Please Select Branch</option>
                                @foreach ($products as $p)
                                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                                @endforeach
                            </select>
                            <label for="">Start Date</label>
                            <input type="date" wire:model.defer="start_date" class="form-control mb-2"required>
                            <label for="">End Date</label>
                            <input type="date" wire:model.defer="end_date" class="form-control mb-2" required>
                            <label for="">End User</label>
                            <input type="number" wire:model.defer="end_user" class="form-control mb-2" required>
                            <label for="">Dealer</label>
                            <input type="number" wire:model.defer="dealer" class="form-control mb-2" required>
                            <label for="">Contractor</label>
                            <input type="number" wire:model.defer="contractor" class="form-control mb-2" required>

                            @if ($product != null)
                                @if ($product->special_cut == 1)
                                    <label for="">Additional Special Cut</label>
                                    <input type="number" wire:model.defer="additional_special_cut"
                                        class="form-control mb-2">
                                @endif
                            @endif

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                                <button type="submit" class="btn btn-primary">EDIT PRODUCT PRICE</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div wire:ignore.self class="modal fade" id="remove_price" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">REMOVE PRODUCT PRICE</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form wire:submit.prevent="remove">
                        <div class="modal-body">
                            @csrf
                            <h4>Are you sure you want to remove product price ? </h4>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                                <button type="submit" class="btn btn-primary">REMOVE PRODUCT PRICE</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>

<script>
    $('#prices').DataTable({
        destroy: true,
        pageLength: 5,
    });
    window.addEventListener('add_price', event => {
        $("#add_price").modal('toggle');
    })
    window.addEventListener('edit_price', event => {
        $("#edit_price").modal('toggle');
    })
    window.addEventListener('remove_price', event => {
        $("#remove_price").modal('toggle');
    })
    window.addEventListener('remove_price_hide', event => {
        $("#remove_price").modal('hide');
        $('.modal-backdrop').remove()
    })

    window.addEventListener('data_table', event => {
        $('#prices').DataTable({
            destroy: true,
            pageLength: 5,
        });
    })
</script>
