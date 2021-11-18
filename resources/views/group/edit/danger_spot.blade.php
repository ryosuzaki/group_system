@foreach(config('kaigohack.danger_spot.spot_names') as $name)
<div class="form-check form-check-radio">
    <label class="form-check-label">
        <input class="form-check-input" type="radio" name="name" value="{{$name}}" @if($group->name==$name) checked @endif>
        {{$name}}
        <span class="circle">
            <span class="check"></span>
        </span>
    </label>
</div>
@endforeach