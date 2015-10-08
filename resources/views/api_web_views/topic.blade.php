<!doctype html>
<html lang="ch_zh">
<head>
    <meta charset="UTF-8">
    <title>{!! $topic->title !!}</title>
    <link rel="stylesheet" href="{!! cdn_elixir('css/api.css') !!}">
</head>
<body>
    <div class="markdown-content">
        {!! $topic->body !!}
    </div>
</body>
</html>