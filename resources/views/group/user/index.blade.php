@extends('template')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
        {{ Breadcrumbs::render('group.user.index',$group,$role->index) }}
            <div class="card-body">
                <h3 class="text-center mb-4">ユーザー</h3>
                
                <div class="form-group">
                    <select class="form-control selectpicker h4" data-style="btn btn-link" id="role-link">
                        @foreach($group->roles()->get() as $r)
                        <option value="{{route('group.user.index',[$group->id,$r->index])}}"@if($role==$r) selected @endif>{{$r->role_name}}</option>
                        @endforeach
                    </select>
                </div>

                <script type="module">
                    document.getElementById("role-link").onchange = function() {
                        window.location.href = this.value;
                    };
                </script>

                @if($role->index!=0)
                @can('invite-group-users',[$group,$role->index]);
                <a class="btn btn-success btn-sm btn-round text-white" href="{{route('group.user.create',[$group->id,$role->index])}}"><i class="material-icons">person_add</i>招待</a>
                @endcan
                @endif



                <ul class="nav nav-pills nav-pills-primary justify-content-center" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#role_users" role="tablist" aria-expanded="true">
                            参加中
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#request_join" role="tablist" aria-expanded="false">
                            招待中
                        </a>
                    </li>
                </ul>




                <div class="tab-content tab-space">
                    <div class="tab-pane active" id="role_users" aria-expanded="true">
                        @php
                        $users=$role->users()->get();
                        @endphp
                        
                        @if(Illuminate\Support\Facades\View::exists('group.user.index.'.$group->getTypeName()))
                        @include('group.user.index.'.$group->getTypeName(),['users'=>$users])
                        @else
                        <div class="table-responsive">
                            <table class="table text-nowrap tablesorter" id="sorter">
                                <thead>
                                <tr>
                                    <th>ユーザー名</th>
                                    <th>メールアドレス</th>
                                    <th>アクション</th>
                                </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach ($users as $user)
                                    <tr>
                                        <td><a href="{{route('group.user.show',[$group->id,$user->id,$role->index])}}">{{$user->name}}</a></td>
                                        <td>{{$user->email}}</td>
                                        <td class="row pt-1">
                                        @if($role->index!=0)
                                        <form action="{{route('group.user.destroy',[$group->id,$user->id,$role->index])}}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="button" data-toggle="modal" data-target="#delete{{$user->id}}" class="btn btn-danger btn-round btn-sm text-white m-0"><i class="material-icons">logout</i> 退出</button>
                                            <div class="modal fade" id="delete{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            本当にユーザーを退出させますか？
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">やめる</button>
                                                            <button type="submit" class="btn btn-danger text-white">退出させる</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endif
                    </div>
                    

                    <script type="module">
                        $(document).ready(function() { 
                            $("#sorter").tablesorter();
                        });
                    </script>


                    <div class="tab-pane" id="request_join" aria-expanded="false">
                        @php
                        $requests=$group->usersRequestJoin()->wherePivot('role_id',$role->id)->get();
                        @endphp
                        <div class="table-responsive">
                            <table class="table text-nowrap">
                                <thead>
                                <tr>
                                    <th>メールアドレス</th>
                                    <th>アクション</th>
                                </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach ($requests as $user)
                                    <tr>
                                        <td>{{$user->email}}</td>
                                        <td class="row pt-1">
                                        <a class="btn btn-danger btn-round btn-sm text-white" href="{{route('group.user.quit_request_join',[$group->id,$user->id,$role->index])}}"><i class="material-icons">close</i> 招待をやめる</a>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>        
            </div>
        </div>
    </div>
</div>

@endsection