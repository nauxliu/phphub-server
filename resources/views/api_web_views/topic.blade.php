<!doctype html>
<html lang="ch_zh">
<head>
    <meta charset="UTF-8">
    <title>{!! $topic->title !!}</title>
    <link rel="stylesheet" href="{!! cdn_elixir('css/api.css') !!}">
</head>
<body>
<div class="header-title">
    <h3>{!! $topic->title !!}</h3>

    <p>{!! $topic->created_at->format('Y-m-d H:i:s') !!} • {!! $topic->view_count !!} 阅读</p>
</div>
<div class="markdown-content">
    {!! $topic->body !!}
</div>

<script src="{!! cdn_elixir('js/api.js') !!}"></script>
<script>
    function connectWebViewJavascriptBridge(callback) {
        if (window.WebViewJavascriptBridge) {
            callback(WebViewJavascriptBridge)
        } else {
            document.addEventListener('WebViewJavascriptBridgeReady', function () {
                callback(WebViewJavascriptBridge)
            }, false)
        }
    }

    connectWebViewJavascriptBridge(function (bridge) {
        bridge.init(function (message, responseCallback) {
            responseCallback(data)
        });

        var imgs = document.getElementsByTagName('img');

        for (var i = 0; i < imgs.length; i++) {
            imgs[i].onclick = function (e) {
                var data = {"imageUrl": this.src};
                bridge.send(data, function (responseData) {

                })
            }
        }
    })
</script>
</body>
</html>