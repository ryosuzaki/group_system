@extends('template')

@section('content')

<div class="card">
{{ Breadcrumbs::render('user.announcement.index') }}
    <div class="card-body">
        <h3 class="text-center mb-4">お知らせ</h3>
        <a class="btn btn-success btn-sm btn-round text-white" href="{{route('user.announcement.markAsReadAll')}}"><i class="material-icons">mark_email_read</i> 全て既読にする</a>
        


        <div class="table-responsive">
            <table class="table text-nowrap table-hover">
                <thead>
                    <tr>
                        <th style="width: 10%"></th>
                        <th style="width: 30%">送信元</th>
                        <th style="width: 50%">タイトル</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($announcements as $announcement)
                    <tr class="clickable-row" data-href="{{route('user.announcement.show',$announcement)}}">
                        <td>
                            @if($announcement->read_at==null)<i class="material-icons text-warning">mark_email_unread</i>
                            @else<i class="material-icons text-success">mark_email_read</i>
                            @endif
                        </td>
                        <td>{{$announcement->data['model']['name']}}</td>
                        <td>{{$announcement->data['announcement']['title']}}</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <script type="module">
        $(function($) {
            $(".clickable-row").css("cursor","pointer").click(function() {
                location.href = $(this).data("href");
            });
        });
        </script>

    </div>
</div>

@endsection