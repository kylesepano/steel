<div>
    <h2 class="text-bold">Product Variation</h2>
    @if ($message != '')
        <h4 class="bg-success">{{ $message }}</h4>
    @endif
    <div class="d-flex">
        <button class="btn btn-success" wire:click="add_variation">ADD PRODUCT VARIATION</button>
        <div wire:ignore.self class="modal fade" id="add_variation" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">ADD PRODUCT VARIATION</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form wire:submit.prevent="add">
                        <div class="modal-body">
                            @csrf
                            <label for="">Product</label>
                            <select wire:model.defer="product_id" class="form-control" required>
                                <option value="" selected>Please Select Product</option>
                                @foreach ($products as $p)
                                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                                @endforeach
                            </select>
                            <label for="">Length</label>
                            <input required type="number" wire:model.defer="length" class="form-control" step="any"
                                min="0">
                            <label for="">Length UOM</label>
                            <input required type="text" wire:model.defer="length_uom" class="form-control">
                            <label for="">Width</label>
                            <input required type="number" wire:model.defer="width" class="form-control" step="any"
                                min="0">
                            <label for="">Width UOM</label>
                            <input required type="text" wire:model.defer="width_uom" class="form-control">
                            <label for="">Height</label>
                            <input required type="number" wire:model.defer="height" class="form-control" step="any"
                                min="0">
                            <label for="">Height UOM</label>
                            <input required type="text" wire:model.defer="height_uom" class="form-control">
                            <label for="">Thickness</label>
                            <input required type="number" wire:model.defer="thickness" class="form-control"
                                step="any" min="0">
                            <label for="">Thickness UOM</label>
                            <input required type="text" wire:model.defer="thickness_uom" class="form-control">
                            <label for="">Weight/pc</label>
                            <input required type="text" wire:model.defer="weight_pc" class="form-control"
                                step="any" min="0">
                            <label for="">Weight/meter</label>
                            <input required type="text" wire:model.defer="weight_meter" class="form-control"
                                step="any" min="0">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                                <button type="submit" class="btn btn-primary">ADD PRODUCT VARIATION</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <table class="table" id="variations">
        <thead class="thead-dark">
            <tr>
                <th>Product</th>
                <th>Length</th>
                <th>Length UOM</th>
                <th>Width</th>
                <th>Width UOM</th>
                <th>Height</th>
                <th>Height UOM</th>
                <th>Thickness</th>
                <th>Thickness UOM</th>
                <th>Weight/pc</th>
                <th>Weight/meter</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($variations as $v)
                <tr>
                    <td>{{ $v->product->name }}</td>
                    <td>{{ $v->length }}</td>
                    <td>{{ $v->length_uom }}</td>
                    <td>{{ $v->width }}</td>
                    <td>{{ $v->width_uom }}</td>
                    <td>{{ $v->height }}</td>
                    <td>{{ $v->height_uom }}</td>
                    <td>{{ $v->thickness }}</td>
                    <td>{{ $v->thickness_uom }}</td>
                    <td>{{ $v->weight_pc }}</td>
                    <td>{{ $v->weight_meter }}</td>
                    <td>
                        <button class="btn btn-secondary" wire:click="edit_variation({{ $v->id }})"><i
                                class="nc-icon nc-tag-content"></i></button>

                        <button class="btn btn-warning" wire:click="remove_variation({{ $v->id }})"><i
                                class="nc-icon nc-simple-remove"></i></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div id="variations"></div>
    @if ($variation != null)
        <div wire:ignore.self class="modal fade" id="edit_variation" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">EDIT PRODUCT VARIATION</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form wire:submit.prevent="edit">
                        <div class="modal-body">
                            @csrf
                            <label for="">Product</label>
                            <select wire:model.defer="product_id" class="form-control" required>
                                <option value="" selected>Please Select Product</option>
                                @foreach ($products as $p)
                                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                                @endforeach
                            </select>
                            <label for="">Length</label>
                            <input required type="number" wire:model.defer="length" class="form-control"
                                step="any" min="0">
                            <label for="">Length UOM</label>
                            <input required type="text" wire:model.defer="length_uom" class="form-control">
                            <label for="">Width</label>
                            <input required type="number" wire:model.defer="width" class="form-control"
                                step="any" min="0">
                            <label for="">Width UOM</label>
                            <input required type="text" wire:model.defer="width_uom" class="form-control">
                            <label for="">Height</label>
                            <input required type="number" wire:model.defer="height" class="form-control"
                                step="any" min="0">
                            <label for="">Height UOM</label>
                            <input required type="text" wire:model.defer="height_uom" class="form-control">
                            <label for="">Thickness</label>
                            <input required type="number" wire:model.defer="thickness" class="form-control"
                                step="any" min="0">
                            <label for="">Thickness UOM</label>
                            <input required type="text" wire:model.defer="thickness_uom" class="form-control">
                            <label for="">Weight/pc</label>
                            <input required type="text" wire:model.defer="weight_pc" class="form-control"
                                step="any" min="0">
                            <label for="">Weight/meter</label>
                            <input required type="text" wire:model.defer="weight_meter" class="form-control"
                                step="any" min="0">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                                <button type="submit" class="btn btn-primary">EDIT PRODUCT VARIATION</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div wire:ignore.self class="modal fade" id="remove_variation" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">REMOVE PRODUCT VARIATION</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form wire:submit.prevent="remove">
                        <div class="modal-body">
                            @csrf
                            <h4>Are you sure you want to remove product variation ? </h4>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                                <button type="submit" class="btn btn-primary">REMOVE PRODUCT VARIATION</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>

<script>
    $('#variations').DataTable({
        destroy: true,
        pageLength: 5,
    });
    window.addEventListener('add_variation', event => {
        $("#add_variation").modal('toggle');
    })
    window.addEventListener('edit_variation', event => {
        $("#edit_variation").modal('toggle');
    })
    window.addEventListener('remove_variation', event => {
        $("#remove_variation").modal('toggle');
    })
    window.addEventListener('remove_variation_hide', event => {
        $("#remove_variation").modal('hide');
        $('.modal-backdrop').remove()
    })

    window.addEventListener('data_table', event => {
        $('#variations').DataTable({
            destroy: true,
            pageLength: 5,
        });
    })
</script>
