<div>
    <button wire:click="loadInstances" class="btn-delete btn-sm btn btn-danger">Refresh instances</button>

    <div class="input-group mb-3 float-end">
        <div class="input-group-prepend">
            <label class="input-group-text" for="inputGroupSelect01">Accounts</label>
        </div>
        <select class="custom-select" wire:model="authorization"
                wire:change="$emit('accountChanged', $event.target.value.replace('Bearer ', ''))">
            <option value="" hidden>---</option>
            @foreach($accounts as $account)
                <option value="Bearer {{$account->token}}">{{$account->label}}</option>
            @endforeach
        </select>
    </div>

    {{--<button class="btn-delete btn-sm btn btn-primary float-end">
        <select class="custom-select" wire:model="token" name="" id="">
            @foreach($accounts as $account)
                <option value="{{$account->token}}">{{$account->label}}</option>
            @endforeach
        </select>
    </button>--}}

    <table class="table">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">label</th>
            <th scope="col">status</th>
            <th scope="col">plan</th>
            <th scope="col">IP Address</th>
            <th scope="col">region</th>
            <th scope="col">Backups</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($this->instances['data'] as $key => $instance)
            <tr>
                <th scope="row">{{ $instance['id'] }}</th>
                <td>{{ $instance['label'] }}</td>
                <td>{{ $instance['status'] }}</td>
                <td>Linode {{ $instance['specs']['memory'] / 1024 }} GB</td>
                <td>{{ implode(' | ', $instance['ipv4']) }}</td>
                <td>{{ $instance['region'] }}</td>
                <td>{{ $instance['backups']['schedule']['day'] }}</td>
                <td>
                    <button wire:click="delete({{ $instance['id']  }})" class="btn-delete btn-sm btn btn-danger">
                        Delete
                    </button>
                    {{--
                    |
                    <form action="{{ route('reboot-instance', ['linodeId'=>$instance['id']]) }}" method="post">
                        @csrf
                        <button type="submit" class="btn-reboot btn-sm btn btn-success">Reboot
                        </button>
                    </form>
                    --}}
                    <button wire:click="reboot({{$instance['id']}})" class="btn-reboot btn-sm btn btn-success">Reboot
                    </button>
                    <button wire:click="powerOff({{$instance['id']}})" class="btn-reboot btn-sm btn btn-secondary">Power
                        OFF
                    </button>
                    <button wire:click="boot({{$instance['id']}})" class="btn-reboot btn-sm btn btn-primary">Boot
                    </button>
                    <button wire:click="setCurrentLinodeId({{$instance['id']}})" class="btn-sm btn btn-info"
                            data-toggle="modal" data-target="#modalClone">Clone
                    </button>
                    <a href="{{route('instances.show',[$account['id'], $instance['id']])}}" class="btn-sm btn btn-info">Show</a>
                    <a href="{{route('instances.manage',['accountId' => $account['id'], $instance['id']])}}"
                       class="btn-sm btn btn-secondary">Update</a>
                    <a href="{{route('instances.manage',['accountId' => $account['id'], $instance['id'], 'rebuild'] )}}"
                       class="btn-sm btn btn-success">rebuild</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="modalClone" tabindex="-1" wire:ignore role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Choose Region & Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <select wire:model="newInstance.region" name="" id="">
                        @foreach($regions['data'] as $key=> $region)
                            <option value="{{$region['id']}}">{{$region['id']}}</option>
                        @endforeach
                    </select>
                    <select wire:model="newInstance.type" name="" id="">
                        @foreach($types['data'] as $key=> $type)
                            <option value="{{$type['id']}}">{{$type['label']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button wire:click="clone" type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

</div>
