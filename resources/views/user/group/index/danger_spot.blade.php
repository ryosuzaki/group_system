
<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th>地点情報</th>
            <th>役割</th>
            <th>アクション</th>
        </tr>
        </thead>
        <tbody>
            @foreach($groups as $group)
            <tr>
                <td><a href="{{route('group.show',$group->id)}}">ページへ</a></td>
                <td>{{$user->getRoleByGroup($group->id)->role_name}}</td>                                        
                <td class="p-1">
            
                
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>