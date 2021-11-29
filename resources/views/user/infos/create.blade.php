@extends('template')

@section('content')

<div class="card">
{{ Breadcrumbs::render('user.infos.create') }}
    <div class="card-body">
        <h3 class="text-center mb-4">追加</h3>

        <form method="POST" action="{{ route('user.infos.store') }}">
            @csrf

            @include('info.info_template.create',['templates'=>$templates])

            <div class="form-group row mb-0 mt-4">
                <button type="submit" class="btn btn-primary btn-block">
                追加
                </button>
            </div>
        </form>
    </div>
</div>

@endsection