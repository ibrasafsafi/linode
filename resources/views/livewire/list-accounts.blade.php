<div>
    <div class="mb-3">
        <button class="btn-reboot btn-sm btn btn-primary"
                data-toggle="modal" data-target="#modalAdd">New Account
        </button>
    </div>


    <table class="table">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Account label</th>
            <th scope="col">Token</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($accounts as $account)
            <tr>
                <th scope="row"> {{ $account->id  }}</th>
                <td>{{ $account->label  }}</td>
                <td>{{ $account->token  }}</td>
                <td>
                    <button wire:click="delete({{ $account->id  }})" class="btn-delete btn-sm btn btn-danger">Delete
                    </button>
                    {{--
                    |
                    <form action="{{ route('reboot-instance', ['linodeId'=>$instance['id']]) }}" method="post">
                        @csrf
                        <button type="submit" class="btn-reboot btn-sm btn btn-success">Reboot
                        </button>
                    </form>
                    --}}
                    <button wire:click="edit({{$account->id}})" class="btn-reboot btn-sm btn btn-secondary"
                            data-toggle="modal" data-target="#modalUpdate">Update
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="modal fade" id="modalAdd" tabindex="-1" wire:ignore role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form wire:submit.prevent="create">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Account Name</label>
                        <input type="text" wire:model="newAccount.label" class="form-control"
                               placeholder="Enter Account Name">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Password</label>
                        <input type="password" wire:model="newAccount.pass" class="form-control"
                               placeholder="Enter Password">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Token</label>
                        <input type="text" wire:model="newAccount.token" class="form-control"
                              value="" placeholder="Token">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalUpdate" tabindex="-1" wire:ignore role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="createInstance">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Account Name</label>
                        <input type="text" wire:model="newAccount.label" value="{{}}" class="form-control"
                               placeholder="Enter Account Name">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Password</label>
                        <input type="password" wire:model="newAccount.pass" class="form-control"
                               placeholder="Enter Password">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Token</label>
                        <input type="text" wire:model="newAccount.token" class="form-control"
                               placeholder="Token">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button wire:click="create" type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>


</div>
