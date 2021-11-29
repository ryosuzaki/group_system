@extends('template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @foreach ($bases as $base)
                    {{$base}}
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection