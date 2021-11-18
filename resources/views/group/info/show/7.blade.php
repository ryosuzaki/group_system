<h4 class="text-center">お知らせ一覧</h4>
<div class="table-responsive">
    <table class="table text-nowrap table-hover">
        <thead>
            <tr>
                <th style="width: 30%">日時</th>
                <th style="width: 70%">タイトル</th>
            </tr>
        </thead>
        <tbody>
            @foreach($group->announcements()->get() as $announcement)
            <tr onclick="$('#announcementModal{{$announcement->id}}').modal('show')">
                <td>{{$announcement->created_at}}</td>
                <td>{{$announcement->title}}</td>
            </tr>
            
            <div class="modal fade" id="announcementModal{{$announcement->id}}" tabindex="-1" role="dialog" aria-labelledby="announcementModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <p class="h4 font-weight-bold">{{$announcement->title}}</p>
                            <p class="card-text h5" style="white-space:pre-line;">{{$announcement->content}}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>
</div>


