<div class="d-flex">
    <div class="ml-auto">
        @if(Auth::user()->hasGroup($group->id))
        <a class="btn btn-primary text-white btn-round btn-sm">参加中</a>
        @endif
    </div>
</div>
<h3 class="text-center">{{$group->name}}</h3>
            