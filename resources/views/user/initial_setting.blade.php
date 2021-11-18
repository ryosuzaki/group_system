@extends('template')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <p class="text-center h3">初期設定</p>
                <p class="text-center h4">使う機能を選択してください</p>
                <form method="POST" action="{{ route('user.initial_setting') }}">
                    @csrf
                    <div>
                    @foreach($types as $type)
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="types[]" value="{{$type->id}}">
                            {{$type->formatted_name}}
                            <span class="form-check-sign">
                                <span class="check"></span>
                            </span>
                        </label>
                    </div>
                    @endforeach
                    </div>

                    <div class="form-group mb-0 mt-5">
                        <button type="submit" class="btn btn-primary btn-block">
                        登録
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection