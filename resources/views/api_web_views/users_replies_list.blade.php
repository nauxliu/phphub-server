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
        <?php
            if (! $reply->topic) {
                continue;
            }
        ?>
        <li class="list-comment-item">
            <a class="avatar" href="{!! schema_url('users', ['id' => $reply->topic->user->id]) !!}">
                <img class="avatar" src="{!!  $reply->topic->user->avatar.'?imageView2/1/w/80/h/80' !!}">
            </a>
            <div class="info">
                <div class="meta">
                    <a class="topic-title" href="{!! schema_url('topics', ['id' => $reply->topic->id]) !!}">{!! $reply->topic->title !!}</a>
                    <span>•</span>
                    <abbr>{!! $reply->created_at !!}</abbr>
                </div>
                <div class="markdown-content">
                    {!! $reply->body !!}
                </div>
            </div>
        </li>
    @endforeach
</ul>

<script src="{!! cdn_elixir('js/api.js') !!}"></script>
</body>
</html>