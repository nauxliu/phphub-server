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
    @foreach($replies as $reply)
    <li class="list-comment-item">
        <div class="infos">
            <div class="meta">
                <a class="topic-title" href="/topics/{!! $reply->topic->id !!}">{!! $reply->topic->title !!}</a>
                <span>•</span>
                <abbr class="created_time">{!! $reply->created_at->format('Y-m-d') !!}</abbr>
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