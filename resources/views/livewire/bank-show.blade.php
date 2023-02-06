<div>
    <h2 class="text-bold">Bank Accounts</h2>
    @if ($message != '')
        <h4 class="bg-success">{{ $message }}</h4>
    @endif
    <button class="btn btn-success" wire:click="add_bank">ADD BANK ACCOUNT</button>
    <div wire:ignore.self class="modal fade" id="add_bank" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ADD BANK ACCOUNT</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="add">
                    <div class="modal-body">
                        @csrf
                        <label for="">Bank Name</label>
                        <input type="text" wire:model="name" class="form-control" required>
                        <label for="">Branch</label>
                        <select wire:model="branch_id" class="form-control mb-2" required>
                            <option value="">Please Select Branch</option>
                            @foreach ($branches as $b)
                                <option value="{{ $b->id }}">{{ $b->name }}</option>
                            @endforeach
                        </select>
                        <label for="">Account Name</label>
                        <input type="text" wire:model="account_name" required class="form-control">
                        <label for="">Account Number</label>
                        <input type="text" wire:model="account_number" required class="form-control">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                            <button type="submit" class="btn btn-primary">ADD BANK ACCOUNT</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <table class="table" id="bank">
        <thead class="thead-dark">
            <tr>
                <th>Bank Name</th>
                <th>Branch</th>
                <th>Account Name</th>
                <th>Account Number</th>

                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($banks as $b)
                <tr>
                    <td>{{ $b->name }}</td>
                    <td>{{ $b->branch->name }}</td>
                    <td>{{ $b->account_name }}</td>
                    <td>{{ $b->account_number }}</td>
                    <td>
                        <button class="btn btn-secondary" wire:click="edit_bank({{ $b->id }})"><i
                                class="nc-icon nc-tag-content"></i></button>
                        <button class="btn btn-warning" wire:click="remove_bank({{ $b->id }})"><i
                                class="nc-icon nc-simple-remove"></i></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div id="bank"></div>
    @if ($bank != null)
        <div wire:ignore.self class="modal fade" id="edit_bank" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">EDIT BANK ACCOUNT</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form wire:submit.prevent="edit">
                        <div class="modal-body">
                            @csrf
                            <label for="">Bank Name</label>
                            <input type="text" wire:model="name" class="form-control" required>
                            <label for="">Branch</label>
                            <select wire:model="branch_id" class="form-control mb-2" required>
                                <option value="">Please Select Branch</option>
                                @foreach ($branches as $b)
                                    <option value="{{ $b->id }}">{{ $b->name }}</option>
                                @endforeach
                            </select>
                            <label for="">Account Name</label>
                            <input type="text" wire:model="account_name" required class="form-control">
                            <label for="">Account Number</label>
                            <input type="text" wire:model="account_number" required class="form-control">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                                <button type="submit" class="btn btn-primary">EDIT BANK ACCOUNT</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div wire:ignore.self class="modal fade" id="remove_bank" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">REMOVE BANK ACCOUNT</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form wire:submit.prevent="remove">
                        <div class="modal-body">
                            @csrf
                            <h4>Are you sure you want to remove bank account {{ $bank->account_name }} ? </h4>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                                <button type="submit" class="btn btn-primary">REMOVE BANK ACCOUNT</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
<script>
    $('#bank').DataTable({
        destroy: true,
        pageLength: 5,
    });
    window.addEventListener('add_bank', event => {
        $("#add_bank").modal('toggle');
    })

    window.addEventListener('edit_bank', event => {
        $("#edit_bank").modal('toggle');
    })

    window.addEventListener('remove_bank', event => {
        $("#remove_bank").modal('toggle');
    })

    window.addEventListener('data_table', event => {
        $('#bank').DataTable({
            destroy: true,
            pageLength: 5,
        });
    })
</script>
