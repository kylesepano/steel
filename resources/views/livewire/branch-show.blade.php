<div>
    <h2 class="text-bold">Branches</h2>
    @if ($message != '')
        <h4 class="bg-success">{{ $message }}</h4>
    @endif
    <button class="btn btn-success" wire:click="add_branch">Add Branch</button>
    <div wire:ignore.self class="modal fade" id="add_branch" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ADD BRANCH</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="add">
                    <div class="modal-body">
                        @csrf
                        <label for="">Name</label>
                        <input type="text" wire:model="name" class="form-control" required>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                            <button type="submit" class="btn btn-primary">ADD BRANCH</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <table class="table" id="branch">
        <thead class="thead-dark">
            <tr>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($branches as $b)
                <tr>
                    <td>{{ $b->name }}</td>
                    <td>
                        <button class="btn btn-secondary" wire:click="edit_branch({{ $b->id }})"><i
                                class="nc-icon nc-tag-content"></i></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div id="branch"></div>
    @if ($branch != null)
        <div wire:ignore.self class="modal fade" id="edit_branch" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">EDIT BRANCH</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form wire:submit.prevent="edit">
                        <div class="modal-body">
                            @csrf
                            <label for="">Name</label>
                            <input type="text" wire:model="name" class="form-control" required>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                                <button type="submit" class="btn btn-primary">EDIT BRANCH</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>

<script>
    window.addEventListener('add_branch', event => {
        $("#add_branch").modal('toggle');
    })

    window.addEventListener('edit_branch', event => {
        $("#edit_branch").modal('toggle');
    })

    window.addEventListener('data_table', event => {
        $('#branch').DataTable({
            destroy: true,
            pageLength: 5,
        });
    })
</script>
