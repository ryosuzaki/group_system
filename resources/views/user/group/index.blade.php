@extends('template')

@section('content')

<div class="card mt-0">
{{ Breadcrumbs::render('user.group.index') }}
    <div class="card-body">
        <h3 class="text-center mb-4">グループ</h3>

        <ul class="nav nav-pills nav-pills-primary" role="tablist">

            
            <li class="nav-item mx-auto">
                <a class="nav-link @if($requests->isNotEmpty())active @endif" href="#join_request" data-toggle="tab">参加リクエスト</a>
            </li>
            
            
            <li class="nav-item mx-auto">
                <a class="nav-link @if($requests->isEmpty())active @endif" href="#group" data-toggle="tab">参加中</a>
            </li>

            
            <li class="nav-item mx-auto">
                <a class="nav-link" href="#extra" data-toggle="tab">アクション中</a>
            </li>
            

        </ul>
        
        <div class="tab-content tab-space">


            
            <div class="tab-pane @if($requests->isNotEmpty())active @endif" id="join_request">
                <div class="table-responsive">
                    <table class="table text-nowrap">
                        <thead>
                        <tr>
                            <th>種類</th>
                            <th>名前</th>
                            <th>役割</th>
                            <th>アクション</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($requests as $group)
                            <tr>
                                <td>{{$group->getType()->formatted_name}}</td>
                                <td><a href="{{route('group.show',$group->id)}}">{{$group->name}}</a></td>
                                <td>{{$group->getRole($group->pivot->role_id)->role_name}}</td>                                    
                                <td class="p-1">

                                <a class="btn btn-success btn-round btn-sm text-white" href="{{route('user.group.accept_join_request',$group->id)}}"><i class="material-icons">login</i> 参加する</a>
                                <!--
                                <a class="btn btn-success btn-round btn-sm text-white" data-toggle="modal" data-target="#accept_join{{$group->id}}"><i class="material-icons">login</i> 参加する</a>
                                <div class="modal fade" id="accept_join{{$group->id}}" tabindex="-1" role="dialog" aria-labelledby="{{$group->id}}Label" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-body">
                                            参加すると、{{$group->name}}があなたの
                                            @foreach($group->getType()->user_info as $user_info)
                                            <p class="mb-0">{{$user_info}}</p>
                                            @endforeach
                                            を見られるようになります。<br>
                                            本当に参加しますか？
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">戻る</button>
                                            <a class="btn btn-success text-white" href="{{route('user.group.accept_join_request',$group->id)}}">参加する</a>
                                        </div>
                                        </div>
                                    </div>
                                </div>
-->

                                <a class="btn btn-danger btn-round btn-sm text-white" data-toggle="modal" data-target="#denied_join{{$group->id}}"><i class="material-icons">close</i> 参加しない</a>
                                <div class="modal fade" id="denied_join{{$group->id}}" tabindex="-1" role="dialog" aria-labelledby="{{$group->id}}Label" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-body">
                                            本当に参加をやめますか？
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">戻る</button>
                                            <a class="btn btn-danger text-white" href="{{route('user.group.denied_join_request',$group->id)}}">参加しない</a>
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
            



            <div class="tab-pane @if($requests->isEmpty())active @endif" id="group">
                <div class="table-responsive">
                    <table class="table text-nowrap">
                        <thead>
                        <tr>
                            <th>種類</th>
                            <th>名前</th>
                            <th>役割</th>
                            <th>アクション</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($groups as $group)
                            @php
                            $role=$group->getRole($group->pivot->role_id);
                            @endphp
                            <tr>
                                <td>{{$group->getFormattedTypeName()}}</td>
                                <td><a href="{{route('group.show',$group->id)}}">{{$group->name}}</a></td>
                                <td>{{$role->role_name}}</td>                                     
                                <td class="p-1">
                                @if($role->index!=0)
                                <a class="btn btn-primary btn-sm btn-round text-white" href="{{route('user.group.edit',[$group->id])}}"><i class="material-icons">autorenew</i> 変更</a>
                                <a class="btn btn-danger btn-round btn-sm text-white" data-toggle="modal" data-target="#delete{{$group->id}}"><i class="material-icons">logout</i> 退出</a>
                                <div class="modal fade" id="delete{{$group->id}}" tabindex="-1" role="dialog" aria-labelledby="{{$group->id}}Label" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-body">
                                            本当に退出しますか？
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">やめる</button>
                                            <form action="{{route('user.group.destroy',$group->id)}}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger text-white">退出する</button>
                                            </form>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>


            
            <div class="tab-pane" id="extra">
                <div class="table-responsive">
                    <table class="table text-nowrap">
                        <thead>
                        <tr>
                            <th>種類</th>
                            <th>名前</th>
                            <th>アクション</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($extras as $group)
                            <tr>
                                <td>{{$group->getFormattedTypeName()}}</td>
                                <td><a href="{{route('group.show',$group->id)}}">{{$group->name}}</a></td>
                                <td>{{$group->pivot->name}}</td>                                    
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>
</div>

@endsection