@extends('template')

@section('content')

<div class="card">
    <div class="card-body">
        <h3 class="text-center mb-4">アンケート設定</h3>

        <form action="{{route('user.questionnaire.setting',$base->id)}}" method="post">
            @csrf

            <div>                    
                <p>回答しない項目</p>
                <input type="hidden" name="info[not_use_items][]" value="">
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="info[not_use_items][]" value="feeling" @if(in_array("feeling", $info->info["not_use_items"])) checked @endif>
                        調子を回答しない
                        <span class="form-check-sign">
                            <span class="check"></span>
                        </span>
                    </label>
                </div>

                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="info[not_use_items][]" value="syokuyoku" @if(in_array("syokuyoku", $info->info["not_use_items"])) checked @endif>
                        食欲を回答しない
                        <span class="form-check-sign">
                            <span class="check"></span>
                        </span>
                    </label>
                    </div>
            
                    <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="info[not_use_items][]" value="otuzi" @if(in_array("otuzi", $info->info["not_use_items"])) checked @endif>
                        お通じを回答しない
                        <span class="form-check-sign">
                            <span class="check"></span>
                        </span>
                    </label>
                    </div>
                
                    <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="info[not_use_items][]" value="taion" @if(in_array("taion", $info->info["not_use_items"])) checked @endif>
                        体温を回答しない
                        <span class="form-check-sign">
                            <span class="check"></span>
                        </span>
                    </label>
                    </div>
                
                    <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="info[not_use_items][]" value="taiju" @if(in_array("taiju", $info->info["not_use_items"])) checked @endif>
                        体重を回答しない
                        <span class="form-check-sign">
                            <span class="check"></span>
                        </span>
                    </label>
                    </div>
                
                    <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="info[not_use_items][]" value="ketuatu" @if(in_array("ketuatu", $info->info["not_use_items"])) checked @endif>
                        血圧を回答しない
                        <span class="form-check-sign">
                            <span class="check"></span>
                        </span>
                    </label>
                    </div>
                
                    <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="info[not_use_items][]" value="warui_bui" @if(in_array("warui_bui", $info->info["not_use_items"])) checked @endif>
                        症状を回答しない
                        <span class="form-check-sign">
                            <span class="check"></span>
                        </span>
                    </label>
                    </div>
                
                    <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="info[not_use_items][]" value="comment" @if(in_array("comment", $info->info["not_use_items"])) checked @endif>
                        コメントを回答しない
                        <span class="form-check-sign">
                            <span class="check"></span>
                        </span>
                    </label>
                    </div>
            </div>
            
            <div class="form-group mb-0 mt-5">
                <button type="submit" class="btn btn-primary btn-block">
                設定
                </button>
            </div>
        </form>        

    </div>
</div>

@endsection
