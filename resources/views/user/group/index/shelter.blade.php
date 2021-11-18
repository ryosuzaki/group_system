<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th>避難所名</th>
            <th>役割</th>
            <th>アクション</th>
        </tr>
        </thead>
        <tbody>
            @foreach($groups as $group)
            <tr>
                <td><a href="{{route('group.show',$group->id)}}">{{$group->name}}</a></td>
                <td>{{$user->getRoleByGroup($group->id)->role_name}}</td>                                    
                <td class="p-1">
                
                <a class="btn btn-success btn-sm btn-round text-white" href="{{route('user.group.edit',$group->id)}}"><i class="material-icons">edit</i></a>
                <a class="btn btn-info btn-sm btn-round text-white" href="{{route('group.user.index',$group->id)}}"><i class="material-icons">groups</i></a>
                <a class="btn btn-danger btn-round btn-sm text-white" data-toggle="modal" data-target="#{{$group->id}}"><i class="material-icons">logout</i></a>
                <div class="modal fade" id="{{$group->id}}" tabindex="-1" role="dialog" aria-labelledby="{{$group->id}}Label" aria-hidden="true">
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
                                <button type="submit" class="btn btn-danger text-white">退出</button>
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