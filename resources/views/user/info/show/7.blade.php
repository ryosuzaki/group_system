<div class="table-responsive">
    <table class="table text-nowrap">
        <thead>
            <tr>
                <th style="width: 30%">送信日時</th>
                <th style="width: 70%">タイトル</th>
            </tr>
        </thead>
        <tbody>
            @foreach($group->announcements()->get() as $announcement)
            <tr>
                <td>{{$announcement->created_at}}</td>
                <td>{{$announcement->title}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

