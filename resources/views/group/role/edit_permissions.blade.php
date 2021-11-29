@extends('template')

@section('content')


<form method="POST" action="{{route('group.role.update_permissions',[$group->id,$role->index])}}">
    @csrf
    {{ method_field('PUT') }}

    <div class="card">
    {{ Breadcrumbs::render('group.role.edit_permissions',$group,$role->index) }}
        <div class="card-body">
            <h3 class="text-center mb-4">権限</h3>
            <div>
                <div class="permissions">
                    <p class="h5">{{$type->getName()}}</p>
                    <div class="form-check">
                        <label class="form-check-label col-12">
                            <input class="form-check-input" type="checkbox" name="permissions[]" value="group.update">
                            {{$type->getName()}}の編集
                            <span class="form-check-sign">
                                <span class="check"></span>
                            </span>
                        </label>
                    </div>

                    <div class="form-check">
                        <label class="form-check-label col-12">
                            <input class="form-check-input" type="checkbox" name="permissions[]" value="group.delete">
                            {{$type->getName()}}の削除
                            <span class="form-check-sign">
                                <span class="check"></span>
                            </span>
                        </label>
                    </div>
                </div>
                

                @if($type->permission["group_infos"])
                <div class="permissions">
                    <p class="h5 mt-5">情報</p>
                    <div class="form-check">
                        <label class="form-check-label col-12">
                            <input class="form-check-input" type="checkbox" name="permissions[]" value="group_infos.viewAny">
                            情報一覧の閲覧
                            <span class="form-check-sign">
                                <span class="check"></span>
                            </span>
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label col-12">
                            <input class="form-check-input" type="checkbox" name="permissions[]" value="group_infos.create">
                            情報の追加
                            <span class="form-check-sign">
                                <span class="check"></span>
                            </span>
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label col-12">
                            <input class="form-check-input" type="checkbox" name="permissions[]" value="group_infos.update">
                            情報の編集
                            <span class="form-check-sign">
                                <span class="check"></span>
                            </span>
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label col-12">
                            <input class="form-check-input" type="checkbox" name="permissions[]" value="group_infos.delete">
                            情報の削除
                            <span class="form-check-sign">
                                <span class="check"></span>
                            </span>
                        </label>
                    </div>
                </div>
                @endif


                
                <div class="permissions">
                    @foreach($group->infos()->get() as $info)
                    <div class="permissions">
                        <p class="h5 mt-4">{{$info->name}}</p>
                        @if(!$info->viewable)
                        <div class="form-check">
                            <label class="form-check-label col-12">
                                <input class="form-check-input" type="checkbox" name="permissions[]" value="group_info.{{$info->index}}.view">
                                {{$info->name}}の閲覧
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>
                        @endif

                        @if(!empty($info->edit))
                        <div class="form-check">
                            <label class="form-check-label col-12">
                                <input class="form-check-input" type="checkbox" name="permissions[]" value="group_info.{{$info->index}}.update">
                                {{$info->name}}の編集
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>



                @if($type->permission["group_roles"])
                <div class="permissions">
                    <p class="h5 mt-5">役割</p>
                    <div class="form-check">
                        <label class="form-check-label col-12">
                            <input class="form-check-input" type="checkbox" name="permissions[]" value="group_roles.viewAny">
                            役割の閲覧
                            <span class="form-check-sign">
                                <span class="check"></span>
                            </span>
                        </label>
                    </div>

                    <div class="form-check">
                        <label class="form-check-label col-12">
                            <input class="form-check-input" type="checkbox" name="permissions[]" value="group_roles.create">
                            役割の追加
                            <span class="form-check-sign">
                                <span class="check"></span>
                            </span>
                        </label>
                    </div>

                    <div class="form-check">
                        <label class="form-check-label col-12">
                            <input class="form-check-input" type="checkbox" name="permissions[]" value="group_roles.update">
                            役割の変更
                            <span class="form-check-sign">
                                <span class="check"></span>
                            </span>
                        </label>
                    </div>

                    <div class="form-check">
                        <label class="form-check-label col-12">
                            <input class="form-check-input" type="checkbox" name="permissions[]" value="group_roles.delete">
                            役割の削除
                            <span class="form-check-sign">
                                <span class="check"></span>
                            </span>
                        </label>
                    </div>
                </div>




                
                <div class="permissions">
                    @foreach($group->roles()->get() as $role)
                    <div class="permissions">
                        <p class="h5 mt-4">{{$role->role_name}}</p>
                        @if($role->index!=0)
                        <div class="form-check">
                            <label class="form-check-label col-12">
                                <input class="form-check-input" type="checkbox" name="permissions[]" value="group_users.{{$role->index}}.permission">
                                {{$role->role_name}}の権限変更
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>
                        @endif
                        <div class="form-check">
                            <label class="form-check-label col-12">
                                <input class="form-check-input" type="checkbox" name="permissions[]" value="group_users.{{$role->index}}.view">
                                {{$role->role_name}}に登録されたユーザーの閲覧
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label col-12">
                                <input class="form-check-input" type="checkbox" name="permissions[]" value="group_users.{{$role->index}}.invite">
                                {{$role->role_name}}にユーザーを招待
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label col-12">
                                <input class="form-check-input" type="checkbox" name="permissions[]" value="group_users.{{$role->index}}.remove">
                                {{$role->role_name}}のユーザーを退会
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif


            </div>

            <div class="form-group mt-5 mb-0">
                <button type="submit" class="btn btn-primary btn-block">
                変更
                </button>
            </div>
        </div>



        <script type="module">
        $(function() { 
            @foreach($permission_names as $permission_name)
            $("input[value='{{$permission_name}}']").prop('checked', true).change();
            @endforeach            
        });
        </script>
    </div>


</form>


@endsection