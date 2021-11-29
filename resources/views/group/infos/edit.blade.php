@extends('template')

@section('content')


<div class="card">
{{ Breadcrumbs::render('group.info_base.create',$group) }}
    <div class="card-body">
        <h3 class="text-center mb-4">変更</h3>


        <form method="POST" action="{{route('group.info_base.update',[$group->id,$base->id])}}">
            @csrf
            {{ method_field('PUT') }}
            <div class="form-check">
                <label class="form-check-label">
                    <input type="hidden" name="viewable" value="0">
                    <input class="form-check-input" type="checkbox" name="viewable" value="1" @if($base->viewable) checked @endif>
                    一般に公開する
                    <span class="form-check-sign">
                        <span class="check"></span>
                    </span>
                </label>
            </div>

            <div class="form-group mb-0 mt-4">
                <button type="submit" class="btn btn-primary btn-block">
                変更
                </button>
            </div>
        </form>
    </div>
</div>


@endsection