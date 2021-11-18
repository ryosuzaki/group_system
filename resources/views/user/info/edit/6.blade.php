<form method="POST" action="{{ route('user.info.update',[$base->id]) }}">
    @csrf
    @method('PUT')

    @php
    $info=$base->info()->info;
    @endphp
    <input type="hidden" name="info[rescue]" value="{{$info['rescue']}}">
    <input type="hidden" name="info[group]" value="{{$info['group']}}">
    <input type="hidden" name="info[rescuer]" value="{{$info['rescuer']}}">
    <input type="hidden" name="info[last_answer]" value="{{now()}}">
    <div>
        <p class="h3 text-center">避難状況</p>
        <input type="hidden" name="info[feeling]" value="">
        <div class=" btn-group-toggle" data-toggle="buttons">
            <label class="btn btn-outline-primary btn-block">
                <input type="radio" name="info[evacuation]" value = "避難済み" class="form-check-input">
                <p class="h2">避難済み</p>
            </label>
            <label class="btn btn-outline-primary btn-block ">
                <input type="radio" name="info[evacuation]" value = "避難中" class="form-check-input">
                <p class="h2">避難中</p>
            </label>
            <label class="btn btn-outline-primary btn-block">
                <input type="radio" name="info[evacuation]" value = "要救助" class="form-check-input">
                <p class="h2">要救助</p>
            </label>
        </div>
    </div>

    <input type="hidden" name="info[location][latitude]" id="latitude">
    <input type="hidden" name="info[location][longitude]" id="longitude">

    <script type="module">
        $(function(){
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                (position) => {
                    $('#latitude').val(position.coords.latitude); 
                    $('#longitude').val(position.coords.longitude); 
                });
            }
        })
    </script>
    
    <div class="form-group mt-3">
        <p class="h3 text-center">コメント</p>
        <textarea class="form-control" id="comment" name="info[comment]" rows="5"></textarea>
    </div>

    <div class="form-group mb-0 mt-4">
        <button type="submit" class="btn btn-primary btn-block">
            回答
        </button>
    </div>

</form>
