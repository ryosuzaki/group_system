@extends('template')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
        {{ Breadcrumbs::render('group.user.create',$group,$role->index) }}
            <div class="card-body">
                <h3 class="text-center mb-5">招待</h3>

                <h4 class="text-center">招待する役割</h4>
                <div class="form-group">
                    <select class="form-control selectpicker h4" data-style="btn btn-link" id="role-link">
                        @foreach($group->roles()->get() as $r)
                        @if($r->index!=0)
                        <option value="{{route('group.user.create',[$group->id,$r->index])}}"@if($role==$r) selected @endif>{{$r->role_name}}</option>
                        @endif
                        @endforeach
                    </select>
                </div>

               

                <script type="module">
                    document.getElementById("role-link").onchange = function() {
                        window.location.href = this.value;
                    };
                </script>
            </div>
        </div>

        @if ($errors->any())
        <div class="modal" tabindex="-1" id="error_modal" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title">エラー</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                    </div>
                </div>
            </div>
        </div>
        <script type="module">
            $('#error_modal').modal('show');
        </script>
        @endif

        <div class="card">
            <div class="card-body">
                <h3 class="text-center mb-4">1人ずつ招待</h3>

                <form method="POST" action="{{ route('group.user.store',[$group->id,$role->index]) }}">
                    @csrf
                    <div class="form-group">
                        <label for="email">招待するメールアドレス</label>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                    </div>

                    <div class="form-group row mb-0">
                        <button type="submit" class="btn btn-primary btn-block">
                        招待
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h3 class="text-center mb-4">CSVファイルを使う</h3>
                <h4 class="text-center">1列目に招待するメールアドレスを並べてください</h4>
               

                <form method="POST" action="{{ route('group.user.store_by_csv',[$group->id,$role->index]) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="form-group form-file-upload form-file-multiple col-6">
                            <input type="file" name="csv_file" multiple="" class="inputFileHidden" accept=".csv" required>
                            <div class="input-group">
                                <input type="text" class="form-control inputFileVisible" placeholder="CSVファイルを選択">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-fab btn-round btn-primary">
                                        <i class="material-icons">attach_file</i>
                                    </button>
                                </span>
                            </div>
                        </div>
                        <div class="col-6 pt-3">
                            <button type="submit" class="btn btn-primary mb-2 w-100">招待</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection