<form method="POST" action="{{ route('group.info.update',[$group->id,$index]) }}">
    @csrf
    @method('PUT')


    <div class="form-group">
        <label for="degree">混雑度</label>
        <input id="degree" type="text" class="form-control-plaintext form-control-lg" value="" readonly>
    </div> 

    <div id="slider" class="slider mb-5"></div>

    <input type="hidden" name="info[degree]" value="{{$info->info['degree']}}">
    <input type="hidden" name="info[color]" value="{{$info->info['color']}}">

    <div class="form-group">
        <label for="detail">詳細情報</label>
        <textarea class="form-control" id="detail" name="info[detail]" rows="5">{{$info->info['detail']}}</textarea>
    </div>

    <div class="form-group mb-0">
        <button type="submit" class="btn btn-primary btn-block">
        変更
        </button>
    </div>
    
</form>


<script type="module">
var slider = document.getElementById('slider');
var input = document.getElementById('degree');
noUiSlider.create(slider, {
    start: {{$info->info['degree']}},
    behaviour: 'snap',
    connect: [true, false],
    step: 25,
    range: {
        'min': 0,
        'max': 100
    },
    /*pips: {
        mode: 'count',
        values: 5,
        density: 5
    }*/
});
slider.noUiSlider.on('update', function( values,handle) {
    input.value = parseInt(values[handle])+"%";
    $('input[name="info[degree]"]').val(parseInt(values[handle]));
    if(parseInt(values[handle])==0){
        $('input[name="info[color]"]').val("#555");
    }else if (parseInt(values[handle])==25){
        $('input[name="info[color]"]').val("#00bcd4");
    }else if(parseInt(values[handle])==50){
        $('input[name="info[color]"]').val("#4caf50");
    }else if(parseInt(values[handle])==75){
        $('input[name="info[color]"]').val("#ff9800");
    }else if(parseInt(values[handle])==100){
        $('input[name="info[color]"]').val("#f44336");
    }
});


</script>
