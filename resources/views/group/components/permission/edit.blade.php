@extends('template')

@section('content')


<form method="POST" action="{{route('group.permission.update',[$group->id,$role->index])}}">
    @csrf
    {{ method_field('PUT') }}
    @php
    $permissions=$role->permissions()->pluck('name');
    @endphp
    <div class="card">
    {{ Breadcrumbs::render('group.permission.edit',$group,$role->index) }}
        <div class="card-body">
            <h3 class="text-center mb-4">権限</h3>
            <div>
                <div class="permissions">
                    <p class="h5">{{$group->getType()->formatted_name}}</p>
                    <div class="form-check">
                        <label class="form-check-label col-12">
                            <input class="form-check-input" type="checkbox" name="permissions[]" value="group.update">
                            {{$group->getType()->formatted_name}}の編集
                            <span class="form-check-sign">
                                <span class="check"></span>
                            </span>
                        </label>
                    </div>

                    <div class="form-check">
                        <label class="form-check-label col-12">
                            <input class="form-check-input" type="checkbox" name="permissions[]" value="group.delete">
                            {{$group->getType()->formatted_name}}の削除
                            <span class="form-check-sign">
                                <span class="check"></span>
                            </span>
                        </label>
                    </div>
                </div>
                

                
                <div class="permissions">
                    <p class="h5 mt-5">情報</p>
                    <div class="form-check">
                        <label class="form-check-label col-12">
                            <input class="form-check-input" type="checkbox" name="permissions[]" value="group_info_bases.viewAny">
                            情報一覧の閲覧
                            <span class="form-check-sign">
                                <span class="check"></span>
                            </span>
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label col-12">
                            <input class="form-check-input" type="checkbox" name="permissions[]" value="group_info_bases.create">
                            情報の追加
                            <span class="form-check-sign">
                                <span class="check"></span>
                            </span>
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label col-12">
                            <input class="form-check-input" type="checkbox" name="permissions[]" value="group_info_bases.update">
                            情報の編集
                            <span class="form-check-sign">
                                <span class="check"></span>
                            </span>
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label col-12">
                            <input class="form-check-input" type="checkbox" name="permissions[]" value="group_info_bases.delete">
                            情報の削除
                            <span class="form-check-sign">
                                <span class="check"></span>
                            </span>
                        </label>
                    </div>
                </div>
                


                
                <div class="permissions">
                    @foreach($group->infoBases()->get() as $base)
                    <div class="permissions">
                        <p class="h5 mt-4">{{$base->name}}</p>
                        @if(!$base->viewable)
                        <div class="form-check">
                            <label class="form-check-label col-12">
                                <input class="form-check-input" type="checkbox" name="permissions[]" value="group_info.{{$base->index}}.view">
                                {{$base->name}}の閲覧
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>
                        @endif

                        @if(!empty($base->edit))
                        <div class="form-check">
                            <label class="form-check-label col-12">
                                <input class="form-check-input" type="checkbox" name="permissions[]" value="group_info.{{$base->index}}.update">
                                {{$base->name}}の編集
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>



                
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
                    @if($role->index!=0)
                    <div class="permissions">
                        <p class="h5 mt-4">{{$role->role_name}}</p>
                        <div class="form-check">
                            <label class="form-check-label col-12">
                                <input class="form-check-input" type="checkbox" name="permissions[]" value="group_users.{{$role->index}}.permission">
                                {{$role->role_name}}の権限変更
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>
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
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="form-group mt-5 mb-0">
                <button type="submit" class="btn btn-primary btn-block">
                変更
                </button>
            </div>
        </div>



        <script type="module">
        $(function() { 
            @foreach($permissions as $permission)
            $("input[value='{{$permission}}']").prop('checked', true).change();
            @endforeach            
        });
        </script>
    </div>


</form>


@endsection