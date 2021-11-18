@php
$degree=$info->info['degree'];
$color=$info->info['color'];
@endphp
<div class="text-center">
    <div class="card">
        <div class="card-body">
            <p class="h4 mb-0 border-bottom">混雑度</p>
            <p class="h2 font-weight-bold mt-0" style="color:{{$color}};">{{$degree}}%</p>
        </div>
    </div>
    
    <div class="card">
        <div class="card-body">
            <p class="h4 mb-0 border-bottom">混雑詳細</p>
            <p class="h5" style="white-space:pre-line;">{{$info->info['detail']}}</p>
        </div>
    </div>
</div>

