@extends('template')

@section('content')


<div class="card">
{{ Breadcrumbs::render('group.info_base.index',$group) }}
    <div class="card-body">
        <h3 class="text-center mb-4">情報</h3>


        <a class="btn btn-success btn-sm btn-round text-white" href="{{route('group.info_base.create',[$group->id])}}"><i class="material-icons">add</i> 追加</a>
        <div class="table-responsive">
            <table class="table text-nowrap">
                <thead>
                <tr>
                    <th>テンプレート</th>
                    <th>閲覧可能</th>
                    <th>アクション</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($bases as $base)
                    <tr>
                        <td><a href="{{route('info_template.show',$base->infoTemplate()->first()->id)}}">{{$base->name}}</a></td>
                        <td>@if($base->viewable)一般公開@else権限を持つユーザーのみ@endif</td>                              
                        <td>
                        <a class="btn btn-primary btn-sm btn-round m-0 text-white" href="{{route('group.info_base.edit',[$group->id,$base->id])}}"><i class="material-icons">edit</i> 変更</a>
                            <button type="button" data-toggle="modal" data-target="#delete{{$base->id}}". class="btn btn-danger btn-round btn-sm m-0 text-white"><i class="material-icons">remove_circle_outline</i> 削除</button>
                            <div class="modal fade" id="delete{{$base->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            本当に削除しますか？
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">やめる</button>
                                            <form action="{{route('group.info_base.destroy',[$group,$base->id])}}" method="post">
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