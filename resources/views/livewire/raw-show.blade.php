<div>
    <h2 class="text-bold">Raw Materials</h2>
    @if ($message != '')
        <h4 class="bg-success">{{ $message }}</h4>
    @endif
    <button class="btn btn-success" wire:click="add_raw">ADD RAW MATERIAL</button>
    <div wire:ignore.self class="modal fade" id="add_raw" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ADD RAW MATERIAL</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="add">
                    <div class="modal-body">
                        @csrf
                        <label for="">Raw Material</label>
                        <select wire:model.defer="raw_material" class="form-control mb-2" required>
                            <option value="" selected>Please Select Raw Material</option>
                            <option value="GI">GI</option>
                            <option value="PPGL">PPGL</option>
                            <option value="NANO">NANO</option>
                            <option value="PPGI">PPGI</option>
                        </select>
                        <label for="">Coil Type</label>
                        <select wire:model.defer="coil_type" class="form-control mb-2" required>
                            <option value="" selected>Please Select Coil Type</option>
                            <option value="Mother Coil">Mother Coil</option>
                            <option value="Baby Coil">Baby Coil</option>
                        </select>
                        <label for="">BL #</label>
                        <input type="text" wire:model.defer="bl_number" class="form-control mb-2" required>
                        <label for="">J Code</label>
                        <input type="text" wire:model.defer="j_code" class="form-control mb-2" required>
                        <label for="">L Code</label>
                        <input type="text" wire:model.defer="l_code" class="form-control mb-2" required>

                        <label for="">Width</label>
                        <input type="number" wire:model.defer="width" class="form-control mb-2" required
                            step="any">
                        <label for="">Thickness</label>
                        <input type="number" wire:model.defer="thickness" class="form-control mb-2" required
                            step="any">
                        <label for="">Beginning Weight</label>
                        <input type="number" wire:model.defer="beginning_weight" class="form-control mb-2" required
                            step="any">
                        <label for="">Beginning Length</label>
                        <input type="number" wire:model.defer="beginning_length" class="form-control mb-2" required
                            step="any">
                        <label for="">Type</label>
                        <input type="text" wire:model.defer="type" class="form-control mb-2" required>
                        <label for="">Color</label>
                        <input type="text" wire:model.defer="color" class="form-control mb-2" required>
                        <label for="">Notes</label>
                        <textarea wire:model="notes" class="form-control mb-2" rows="20"></textarea>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                            <button type="submit" class="btn btn-primary">ADD RAW MATERIAL</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <table class="table" id="raws">
        <thead class="thead-dark">
            <tr>
                <th>Raw Material</th>
                <th>Coil Type</th>
                <th>BL #</th>
                <th>J Code</th>
                <th>L Code</th>
                <th>Width</th>
                <th>Thickness</th>
                <th>Beginning Weight</th>
                <th>Beginning Length</th>
                <th>Type</th>
                <th>Color</th>
                <th>Notes</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($raws as $r)
                <tr>
                    <td>{{ $r->raw_material }}</td>
                    <td>{{ $r->coil_type }}</td>
                    <td>{{ $r->bl_number }}</td>
                    <td>{{ $r->j_code }}</td>
                    <td>{{ $r->l_code }}</td>
                    <td>{{ $r->width }}</td>
                    <td>{{ $r->thickness }}</td>
                    <td>{{ $r->beginning_weight }}</td>
                    <td>{{ $r->beginning_length }}</td>
                    <td>{{ $r->type }}</td>
                    <td>{{ $r->color }}</td>
                    <td>
                        <button class="btn btn-info" wire:click="notes_raw({{ $r->id }})"> <i
                                class="nc-icon nc-glasses-2"></i></button>
                    </td>
                    <td>
                        <button class="btn btn-secondary" wire:click="edit_raw({{ $r->id }})"><i
                                class="nc-icon nc-tag-content"></i></button>

                        <button class="btn btn-warning" wire:click="remove_raw({{ $r->id }})"><i
                                class="nc-icon nc-simple-remove"></i></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div id="raws"></div>
    @if ($raw != null)
        <div wire:ignore.self class="modal fade" id="edit_raw" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">EDIT RAW MATERIAL</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form wire:submit.prevent="edit">
                        <div class="modal-body">
                            @csrf
                            <label for="">Raw Material</label>
                            <select wire:model="raw_material" class="form-control mb-2" required>
                                <option value="" selected>Please Select Raw Material</option>
                                <option value="GI">GI</option>
                                <option value="PPGL">PPGL</option>
                                <option value="NANO">NANO</option>
                                <option value="PPGI">PPGI</option>
                            </select>
                            <label for="">Coil Type</label>
                            <select wire:model="coil_type" class="form-control mb-2" required>
                                <option value="" selected>Please Select Coil Type</option>
                                <option value="Mother Coil">Mother Coil</option>
                                <option value="Baby Coil">Baby Coil</option>
                            </select>
                            <label for="">BL #</label>
                            <input type="text" wire:model.defer="bl_number" class="form-control mb-2" required>
                            <label for="">J Code</label>
                            <input type="text" wire:model.defer="j_code" class="form-control mb-2" required>
                            <label for="">L Code</label>
                            <input type="text" wire:model.defer="l_code" class="form-control mb-2" required>

                            <label for="">Width</label>
                            <input type="number" wire:model.defer="width" class="form-control mb-2" required
                                step="any">
                            <label for="">Thickness</label>
                            <input type="number" wire:model.defer="thickness" class="form-control mb-2" required
                                step="any">
                            <label for="">Beginning Weight</label>
                            <input type="number" wire:model.defer="beginning_weight" class="form-control mb-2"
                                required step="any">
                            <label for="">Beginning Length</label>
                            <input type="number" wire:model.defer="beginning_length" class="form-control mb-2"
                                required step="any">
                            <label for="">Type</label>
                            <input type="text" wire:model.defer="type" class="form-control mb-2" required>
                            <label for="">Color</label>
                            <input type="text" wire:model.defer="color" class="form-control mb-2" required>
                            <label for="">Notes</label>
                            <textarea wire:model.defer="notes" class="form-control mb-2" rows="20"></textarea>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                                <button type="submit" class="btn btn-primary">EDIT RAW MATERIAL</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div wire:ignore.self class="modal fade" id="remove_raw" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">REMOVE RAW MATERIAL</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form wire:submit.prevent="remove">
                        <div class="modal-body">
                            @csrf
                            <h4>Are you sure you want to remove raw material {{ $raw->raw_material }} ? </h4>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                                <button type="submit" class="btn btn-primary">REMOVE RAW MATERIAL</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div wire:ignore.self class="modal fade" id="notes_raw" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">NOTES RAW MATERIAL</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @foreach ($raw->raw_material_notes as $r)
                            <h4 for="">{{ $loop->index + 1 }}. {{ $r->notes }}</h4>
                        @endforeach
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<script>
    $('#raws').DataTable({
        destroy: true,
        pageLength: 5,
    });
    window.addEventListener('add_raw', event => {
        $("#add_raw").modal('toggle');
    })
    window.addEventListener('edit_raw', event => {
        $("#edit_raw").modal('toggle');
    })
    window.addEventListener('remove_raw', event => {
        $("#remove_raw").modal('toggle');
    })
    window.addEventListener('remove_raw_hide', event => {
        $("#remove_raw").modal('hide');
        $('.modal-backdrop').remove()
    })
    window.addEventListener('notes_raw', event => {
        $("#notes_raw").modal('toggle');

    })
    window.addEventListener('data_table', event => {
        $('#raws').DataTable({
            destroy: true,
            pageLength: 5,
        });
    })
</script>
