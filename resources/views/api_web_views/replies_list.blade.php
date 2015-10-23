<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <title>评论列表</title>
    <link rel="stylesheet" href="{!! cdn_elixir('css/api.css') !!}">
</head>
<body>
<ul class="list-comment">
    @if(0 == $replies->count())
        <div class="content-blank">暂无内容</div>
    @endif
    @foreach($replies as $reply)
    <li class="list-comment-item">
        <a class="avatar" href="{!! schema_url('users', ['id' => $reply->user->id]) !!}">
            <img class="avatar" src="{!!  $reply->user->avatar.'?imageView2/1/w/80/h/80' !!}">
        </a>
        <div class="info">
            <div class="meta">
                <a href="{!! schema_url('users', ['id' => $reply->user->id]) !!}">{!! $reply->user->name !!}</a>
                <span>•</span>
                <abbr>{!! $reply->created_at !!}</abbr>
                <span>•</span>
                <a class="anchor" href="#{!! $count !!}">#{!! $count++ !!}</a>
            </div>
            <div class="markdown-content">
                {!! $reply->body !!}
            </div>
        </div>
    </li>
    @endforeach
</ul>
</body>
</html>