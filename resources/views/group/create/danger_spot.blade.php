
<div class="modal fade" id="position_error_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
            位置情報をONにしてから、リロードボタンを押してください。
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="location.reload();">リロード</button>
            </div>
        </div>
    </div>
</div>

<form method="POST" action="{{ route('group.store_with_location',$type) }}">
    @csrf
    <div class="text-center">
        <p class="h3">危険地点</p>
        <p>あなたのいる場所の状況を教えてください。<br>登録すると現在地が共有されます。</p>
    </div>
    <div class="my-5 mx-5">
        @foreach(config('kaigohack.danger_spot.spot_names') as $name)
        <div class="form-check form-check-radio">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="name" value="{{$name}}">
                {{$name}}
                <span class="circle">
                    <span class="check"></span>
                </span>
            </label>
        </div>
        @endforeach
    </div>
    

    <input type="hidden" name="latitude">
    <input type="hidden" name="longitude">
    <script type="module">
        $(function(){
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                (position) => {
                    $('input[name="latitude"]').val(position.coords.latitude); 
                    $('input[name="longitude"]').val(position.coords.longitude); 
                });
            }else{
                $("#position_error_modal").modal('show');
            }
        })
    </script>
    

    

    <div class="form-group mb-0">
        <button type="submit" class="btn btn-primary btn-block">
        登録
        </button>
    </div>
</form>