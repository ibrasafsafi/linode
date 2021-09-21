<div>

    <ul class="list-group">
        <li class="list-group-item activee"><strong class="text-center"> Label: </strong> <p class="float-end">{{$currentInstance['label']}}</p>  </li>
        <li class="list-group-item"><strong class="text-center"> Status: </strong> <p class="float-end">{{$currentInstance['status']}}</p>  </li>
        <li class="list-group-item"><strong class="text-center"> Created At: </strong> <p class="float-end">{{$currentInstance['created']}}</p>  </li>
        <li class="list-group-item"><strong class="text-center"> Last Update: </strong> <p class="float-end">{{$currentInstance['updated']}}</p>  </li>
        <li class="list-group-item"><strong class="text-center"> Type: </strong> <p class="float-end">{{$currentInstance['type']}}</p>  </li>
        <li class="list-group-item"><strong class="text-center"> ip Addresses: </strong> <p class="float-end">{{$currentInstance['ipv4'][0]}}</p>  </li>
        <li class="list-group-item"><strong class="text-center"> Image: </strong> <p class="float-end">{{$currentInstance['image']}}</p>  </li>
        <li class="list-group-item"><strong class="text-center"> Region: </strong> <p class="float-end">{{$currentInstance['region']}}</p>  </li>
        <li class="list-group-item"><strong class="text-center"> Disk: </strong> <p class="float-end">{{$currentInstance['specs']['disk']/1024}} GB</p>  </li>
        <li class="list-group-item"><strong class="text-center"> Memory: </strong> <p class="float-end">{{$currentInstance['specs']['memory']/1024}} GB</p>  </li>
{{--        <li class="list-group-item"><strong class="text-center"> tags: </strong> <p class="float-end">{{$currentInstance['tags'][0]}}</p>  </li>--}}
        <li class="list-group-item"><strong class="text-center"> Backups: </strong> <p class="float-end">{{$currentInstance['backups']['schedule']['day']}}</p>  </li>
    </ul>


{{--
<div class="row list-group">
    <p class="col-4 bg-primary list-group-item" style="height: 40px; border-radius: 7px"> </p>
    <p class="col-8 ">{{$currentInstance['label']}}</p>
</div>--}}


</div>
