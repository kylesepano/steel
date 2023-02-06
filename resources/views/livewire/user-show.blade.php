<div>
    <h2 class="text-bold">Users</h2>
    @if ($message != '')
        <h4 class="bg-success">{{ $message }}</h4>
    @endif
    <button class="btn btn-success" wire:click="add_user">Add User</button>
    <div wire:ignore.self class="modal fade" id="add_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ADD USER</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="add">
                    <div class="modal-body">
                        @csrf
                        <label for="">First Name</label>
                        <input type="text" wire:model="first_name" class="form-control" required>
                        <label for="">Last Name</label>
                        <input type="text" wire:model="last_name" class="form-control" required>
                        <label for="">Email Address</label>
                        <input type="email" wire:model="email_address" class="form-control" required>
                        <label for="">Branch</label>
                        <select wire:model="branch_id" class="form-control" required>
                            <option value="">Please Select Branch</option>
                            @foreach ($branches as $b)
                                <option value="{{ $b->id }}">{{ $b->name }}</option>
                            @endforeach
                        </select>
                        <label for="">Department</label>
                        <select wire:model="department" class="form-control" required>
                            <option value="">Please Select Department</option>
                            <option value="Stockroom">Stockroom</option>
                            <option value="Sales">Sales</option>
                            <option value="Production">Production</option>
                            <option value="Management">Management</option>
                            <option value="Accounting">Accounting</option>
                        </select>
                        <label for="">Position</label>
                        <input type="text" wire:model="position" class="form-control" required>
                        <label for="">Contact Number</label>
                        <input type="text" wire:model="contact_number" class="form-control" required>
                        <label for="">Upload Signature</label>
                        <input type="file" wire:model="signature" class="form-control" required
                            accept=".png,.jpg,.png">
                        @if ($signature)
                            <div class="text-center">
                                <p> Signature Preview:</p>
                                @if ($signature)
                                    <img src="{{ $signature->temporaryUrl() }}">
                                @elseif($user != null)
                                    <img src="{{ asset('uploads/' . $user->signature) }}">
                                @endif
                            </div>
                        @endif
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                            <button type="submit" class="btn btn-primary">ADD USER</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <table class="table" id="user">
        <thead class="thead-dark">
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Department</th>
                <th>Position</th>
                <th>Contact Number</th>
                <th>Branch</th>
                <th>Status</th>
                <th>Signature</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $u)
                <tr>
                    <td>{{ $u->first_name }}</td>
                    <td>{{ $u->last_name }}</td>
                    <td>{{ $u->email_address }}</td>
                    <td>{{ $u->department }}</td>
                    <td>{{ $u->position }}</td>
                    <td>{{ $u->contact_number }}</td>
                    <td>{{ $u->branch->name }}</td>
                    <td>{{ $u->status }}</td>
                    <td>
                        <button class="btn btn-info" wire:click="signature_user({{ $u->id }})"> <i
                                class="nc-icon nc-glasses-2"></i></button>
                    </td>
                    <td>
                        <button class="btn btn-secondary" wire:click="edit_user({{ $u->id }})"><i
                                class="nc-icon nc-tag-content"></i></button>
                        @if ($u->status === 'Active')
                            <button class="btn btn-warning" wire:click="remove_user({{ $u->id }})"><i
                                    class="nc-icon nc-simple-remove"></i></button>
                        @else
                            <button class="btn btn-success" wire:click="active_user({{ $u->id }})"><i
                                    class="nc-icon nc-check-2"></i></button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div id="user"></div>
    @if ($user != null)
        <div wire:ignore.self class="modal fade" id="edit_user" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">EDIT USER</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form wire:submit.prevent="edit">
                        <div class="modal-body">
                            @csrf
                            <label for="">First Name</label>
                            <input type="text" wire:model="first_name" class="form-control" required>
                            <label for="">Last Name</label>
                            <input type="text" wire:model="last_name" class="form-control" required>
                            <label for="">Email Address</label>
                            <input type="email" wire:model="email_address" class="form-control" required>
                            <label for="">Branch</label>
                            <select wire:model="branch_id" class="form-control" required>
                                <option value="">Please Select Branch</option>
                                @foreach ($branches as $b)
                                    <option value="{{ $b->id }}">{{ $b->name }}</option>
                                @endforeach
                            </select>
                            <label for="">Department</label>
                            <select wire:model="department" class="form-control" required>
                                <option value="">Please Select Department</option>
                                <option value="Stockroom">Stockroom</option>
                                <option value="Sales">Sales</option>
                                <option value="Production">Production</option>
                                <option value="Management">Management</option>
                                <option value="Accounting">Accounting</option>
                            </select>
                            <label for="">Position</label>
                            <input type="text" wire:model="position" class="form-control" required>
                            <label for="">Contact Number</label>
                            <input type="text" wire:model="contact_number" class="form-control" required>
                            <label for="">Upload Signature</label>
                            <input type="file" wire:model="signature" class="form-control"
                                accept=".png,.jpg,.png">
                            @if ($signature)
                                <div class="text-center">
                                    <p> Signature Preview:</p>
                                    @if ($signature != $user->signature)
                                        <img src="{{ $signature->temporaryUrl() }}">
                                    @else
                                        <img src="{{ asset('uploads/' . $user->signature) }}">
                                    @endif
                                </div>
                            @endif
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                                <button type="submit" class="btn btn-primary">EDIT USER</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div wire:ignore.self class="modal fade" id="remove_user" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">REMOVE USER</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form wire:submit.prevent="remove">
                        <div class="modal-body">
                            @csrf
                            <h4>Are you sure you want to remove user {{ $user->fullname() }} ? </h4>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                                <button type="submit" class="btn btn-primary">REMOVE USER</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div wire:ignore.self class="modal fade" id="active_user" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">ACTIVE USER</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form wire:submit.prevent="active">
                        <div class="modal-body">
                            @csrf
                            <h4>Are you sure you want to active user {{ $user->fullname() }} ? </h4>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                                <button type="submit" class="btn btn-primary">ACTIVE USER</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div wire:ignore.self class="modal fade" id="signature_user" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">SIGNATURE USER {{ $user->fullname() }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <h4>Signature</h4>
                        {{ $user->signature }}
                        <img src="{{ asset('uploads/' . $user->signature) }}">
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
    $('#user').DataTable({
        destroy: true,
        pageLength: 5,
    });
    window.addEventListener('add_user', event => {
        $("#add_user").modal('toggle');
    })

    window.addEventListener('edit_user', event => {
        $("#edit_user").modal('toggle');
    })

    window.addEventListener('remove_user', event => {
        $("#remove_user").modal('toggle');
    })
    window.addEventListener('signature_user', event => {
        $("#signature_user").modal('toggle');
    })
    window.addEventListener('active_user', event => {
        $("#active_user").modal('toggle');
    })

    window.addEventListener('data_table', event => {
        $('#user').DataTable({
            destroy: true,
            pageLength: 5,
        });
    })
</script>
