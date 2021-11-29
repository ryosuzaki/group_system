@foreach($templates as $template)
<div class="media ml-4">
    <div class="media-body">
        <div class="form-check mb-4">
            <label class="form-check-label row text-dark h5">
                <input class="form-check-input" type="checkbox" name="templates[]" value="{{$template->id}}">
                {{$template->name}}
                <span class="form-check-sign position-absolute" style="top:4px; left:0;">
                    <span class="check"></span>
                </span>
            </label>
        </div>
        <p class="text-secondary">{{$template->detail}}</p>
    </div>
</div>
@endforeach
