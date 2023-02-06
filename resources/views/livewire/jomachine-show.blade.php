<div>
    <h2 class="text-bold">Production JO </h2>
    @if ($message != '')
        <h4 class="bg-success">{{ $message }}</h4>
    @endif
    <div class="row mb-4 pb-4">
        <div class="col-md-4">
            <label for="">MACHINE: </label>
            <select wire:model="machine" class="form-control">
                <option value="">ALL</option>
                @foreach ($machines as $m)
                    <option value="{{ $m->id }}">{{ $m->name }}</option>
                @endforeach
            </select>
        </div>
    </div>


    <table class="table" id="inquiries">
        <thead class="thead-dark">
            <tr>
                <th>JOB #</th>
                <th>ITEM</th>
                <th>QTY</th>
                <th>REMAINING</th>
                <th>MACHINE</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($inquiry_products as $i)
                <tr>
                    <td>
                        JOB ORDER #: CSC-JO- {{ sprintf('%04s', $i->inquiry_id) }}

                    </td>
                    <td>{{ $i->product->name }} @ {{ $i->product_variation->variation() }}</td>
                    <td>{{ $i->quantity }}</td>
                    <td>{{ $i->remaining() }}</td>
                    <td>{{ $i->product->machine->name }}</td>
                    <td>
                        <button class="btn btn-secondary" wire:click="record({{ $i->id }})"><i
                                class="nc-icon nc-tag-content"></i></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div id="inquiries"></div>
    @if ($inquiry_selected != null)
        <div wire:ignore.self class="modal fade" id="record" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">RECORD FORM</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form wire:submit.prevent="record_production">
                        <div class="modal-body">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="pb-3">Item</h6>
                                    <h6 class="pb-2">Produced</h6>
                                    <h6 class="pb-2">JPC Code</h6>
                                    <h6 class="pb-2">Total Length Used</h6>
                                    <h6 class="pb-2">Weight of scrap/usable damage</h6>
                                </div>
                                <div class="col-md-6">
                                    <p for="">{{ $inquiry_selected->product->name }} @
                                        {{ $inquiry_selected->product_variation->variation() }}</p>
                                    <input type="number" wire:model="produced" class="form-control">
                                    <select wire:model="raw_material_id" class="form-control" required>
                                        <option value="">Select Raw Material</option>
                                        @foreach ($raw_materials as $r)
                                            <option value="{{ $r->id }}">{{ $r->j_code }}</option>
                                        @endforeach
                                    </select>
                                    <input type="number" wire:model="total_length_used" class="form-control">
                                    <input type="number" wire:model="scrap_weight" class="form-control">
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                                <button type="submit" class="btn btn-primary">SAVE</button>
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
        pageLength: 10,
    });
    window.addEventListener('record', event => {
        $("#record").modal('toggle');
    })

    window.addEventListener('data_table', event => {
        $('#inquiries').DataTable({
            destroy: true,
            pageLength: 10,
        });
    })
</script>
