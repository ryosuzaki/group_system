@extends('template')

@section('content')

<div class="card">
{{ Breadcrumbs::render('user.infos.index') }}
    <div class="card-body">
        <h3 class="text-center mb-4">情報</h3>


        <a class="btn btn-success btn-sm btn-round text-white" href="{{route('user.infos.create')}}"><i class="material-icons">add</i> 追加</a>
        <div class="table-responsive">
            <table class="table text-nowrap">
                <thead>
                <tr>
                    <th>テンプレート</th>
                    <th>アクション</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($infos as $info)
                    <tr>
                        <td><a href="{{route('info_template.show',$info->getTemplate()->id)}}">{{$info->getTemplate()->name}}</a></td>                             
                        <td class="row p-1">
                            <button type="button" data-toggle="modal" data-target="#delete{{$info->id}}" class="btn btn-danger btn-round btn-sm text-white"><i class="material-icons">remove_circle_outline</i> 削除</button>
                            <div class="modal fade" id="delete{{$info->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            本当に削除しますか？
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">やめる</button>
                                            <form action="{{route('user.infos.destroy',[$info->index])}}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger text-white">削除する</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection