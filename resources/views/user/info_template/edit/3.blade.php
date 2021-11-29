<form method="POST" action="{{ route('group.info_base.info.update',[$group->id,$info->id]) }}">
    @csrf
    @method('PUT')
    
    <div class="form-group row">
        <label for="input">混雑度</label>
        <input id="input" type="text" class="form-control-plaintext form-control-lg" name="info[degree]" value="" readonly>
    </div> 

    <div id="slider" class="slider"></div>

    <div class="form-group row">
        <label for="info">詳細情報</label>
        <textarea class="form-control" id="info" name="info[info]" rows="5">{{$info->pivot->info['info']}}</textarea>
    </div>

    <div class="form-group row mb-0">
        <button type="submit" class="btn btn-primary btn-block">
            登録
        </button>
    </div>
</form>

<script type="module">
var slider = document.getElementById('slider');
var input = document.getElementById('input');
noUiSlider.create(slider, {
    start: 50,
    behaviour: 'snap',
    connect: [true, false],
    step: 25,
    range: {
        'min': 0,
        'max': 100
    },
});
slider.noUiSlider.on('update', function( values,handle) {
    input.value = parseInt(values[handle])+"%";
});
</script>
