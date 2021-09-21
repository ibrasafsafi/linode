<div>
    <div>
        @if(isset($error) && sizeof($error) > 0)
            <div class="alert alert-danger" role="alert">
                @foreach($error as $er)
                    <p>{{$er['reason']}}</p>
                @endforeach
            </div>
        @endif
        <form wire:submit.prevent="updateInstance()">
            <div class="form-group mb-2">
                <div class="form-group mb-2">
                    <label for="exampleFormControlInput1">Choose a Distribution </label>
                    <select class="form-control" wire:model="newInstance.image" name="" id="">
                        @foreach($images['data'] as $image)
                            <option value="{{$image['id']}}"> {{$image['label']}} </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-2">
                    <label for="exampleFormControlInput1">Region</label><br>
                    <small>Determine the best location for your Linode.</small>
                    <select class="form-control" wire:model="newInstance.region" name="" id="">
                        @foreach($regions['data'] as $key=> $region)
                            <option value="{{$region['id']}}">{{$region['id']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-4">
                    <label class="mb-2">Linode Plan</label>
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a  class="nav-link @if($activeTab === 'dedicated') active @endif" id="pills-home-tab" data-toggle="pill" href="#dedicated" role="tab"
                                aria-controls="pills-home" aria-selected="true">Dedicated</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link @if($activeTab === 'standard') active @endif" id="pills-home-tab" data-toggle="pill" href="#standard" role="tab"
                               aria-controls="pills-home" aria-selected="true">Shared CPU</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a @if($activeTab === 'highmem') class="nav-link active" @else class="nav-link" @endif id="pills-profile-tab" data-toggle="pill" href="#highmem" role="tab"
                               aria-controls="pills-profile" aria-selected="false">High Memory</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a @if($activeTab === 'gpu') class="nav-link active" @else class="nav-link" @endif id="pills-contact-tab" data-toggle="pill" href="#gpu" role="tab"
                               aria-controls="pills-contact" aria-selected="false">GPU</a>
                        </li>
                    </ul>
                    <div class="tab-content mb-3" id="pills-tabContent">
                        <div wire:click="setCurrentTab('dedicated')" class="tab-pane fade @if($activeTab === 'dedicated') show active @endif" id="dedicated" role="tabpanel" aria-labelledby="pills-home-tab">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Label</th>
                                    <th>Monthly</th>
                                    <th>Hourly</th>
                                    <th>RAM</th>
                                    <th>CPUs</th>
                                    <th>Storage</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($types['data'] as $key=> $type)
                                    @if($type['class'] === 'dedicated')
                                        <tr>
                                            <td><input wire:model="newInstance.type" type="radio" name="type"
                                                       value="{{$type['id']}}"/></td>
                                            <td>{{$type['label']}}</td>
                                            <td>${{$type['price']['monthly']}}</td>
                                            <td>${{$type['price']['hourly']}}</td>
                                            <td>{{$type['memory'] / 1024}} GB</td>
                                            <td>{{$type['vcpus']}}</td>
                                            <td>{{$type['disk'] / 1024}} GB</td>
                                        </tr>
                                @endif
                                @endforeach
                            </table>
                        </div>
                        <div wire:click="setCurrentTab('highmem')" class="tab-pane fade @if($activeTab === 'highmem') show active @endif" id="highmem" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Label</th>
                                    <th>Monthly</th>
                                    <th>Hourly</th>
                                    <th>RAM</th>
                                    <th>CPUs</th>
                                    <th>Storage</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($types['data'] as $key=> $type)
                                    @if($type['class'] === 'highmem')
                                        <tr>
                                            <td><input wire:model="newInstance.type" type="radio" name="type"
                                                       value="{{$type['id']}}"/></td>
                                            <td>{{$type['label']}}</td>
                                            <td>${{$type['price']['monthly']}}</td>
                                            <td>${{$type['price']['hourly']}}</td>
                                            <td>{{$type['memory'] / 1024}} GB</td>
                                            <td>{{$type['vcpus']}}</td>
                                            <td>{{$type['disk'] / 1024}} GB</td>
                                        </tr>
                                @endif
                                @endforeach
                            </table>
                        </div>
                        <div wire:click="setCurrentTab('gpu')" class="tab-pane fade @if($activeTab === 'gpu') show active @endif" id="gpu" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Label</th>
                                    <th>Monthly</th>
                                    <th>Hourly</th>
                                    <th>RAM</th>
                                    <th>CPUs</th>
                                    <th>Storage</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($types['data'] as $key=> $type)
                                    @if($type['class'] === 'gpu')
                                        <tr>
                                            <td><input wire:model="newInstance.type" type="radio" name="type"
                                                       value="{{$type['id']}}"/></td>
                                            <td>{{$type['label']}}</td>
                                            <td>${{$type['price']['monthly']}}</td>
                                            <td>${{$type['price']['hourly']}}</td>
                                            <td>{{$type['memory'] / 1024}} GB</td>
                                            <td>{{$type['vcpus']}}</td>
                                            <td>{{$type['disk'] / 1024}} GB</td>
                                        </tr>
                                @endif
                                @endforeach
                            </table>
                        </div>
                        <div wire:click="setCurrentTab('standard')" class="tab-pane fade @if($activeTab === 'standard') show active @endif" id="standard" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Label</th>
                                    <th>Monthly</th>
                                    <th>Hourly</th>
                                    <th>RAM</th>
                                    <th>CPUs</th>
                                    <th>Storage</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($types['data'] as $key=> $type)
                                    @if(in_array($type['class'], ['standard', 'nanode']))
                                        <tr>
                                            <td><input wire:model="newInstance.type" type="radio" name="type"
                                                       value="{{$type['id']}}"/></td>
                                            <td>{{$type['label']}}</td>
                                            <td>${{$type['price']['monthly']}}</td>
                                            <td>${{$type['price']['hourly']}}</td>
                                            <td>{{$type['memory'] / 1024}} GB</td>
                                            <td>{{$type['vcpus']}}</td>
                                            <td>{{$type['disk'] / 1024}} GB</td>
                                        </tr>
                                @endif
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>

                <div class="form-group mb-2">
                    <label class="form-label">Linode label</label>
                    <input wire:model="newInstance.label" type="text" placeholder="Enter Linode Label" class="form-control">
                </div>

                <div class="form-group mb-2">
                    <input wire:model="newInstance.backups_enabled" type="checkbox" class="">
                    <label class="form-label">BackUp</label><br>
                    <small>Three backup slots are executed and rotated automatically: a daily backup, a 2-7 day old
                        backup, and an 8-14 day old backup. Plans are priced according to the Linode plan selected
                        above.</small>

                </div>


                <div class="form-group">
                    <button type="submit" class=" btn btn-success"> Upddate Linode</button>
                </div>
            </div>

        </form>


    </div>
</div>
