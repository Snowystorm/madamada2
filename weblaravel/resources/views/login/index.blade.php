<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>用户登录</title>
</head>
<body>
@if($errors->any())
    @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
@endif
<form action="{{ route('login') }}" method="post">
    @csrf
    <div>
        <input type="text" name="username" autocomplete="off" value="admin">
    </div>
    <div>
        <input type="text" name="password" autocomplete="off" value="admin888">
    </div>
    <div>
        <label>
            验证码：
            {{--{!! captcha_img('mini') !!}--}}
            <img data-src="{{ captcha_src('mini') }}" src="{{ captcha_src('mini') }}" id="codeimg" style="height: 50px;cursor: pointer;"/>
            <input type="text" name="code" autocomplete="off">
        </label>
    </div>
    <div>
        <input type="submit" value="用户登录">
    </div>
</form>
<script src="/js/app.js"></script>
<script>
    $('#codeimg').click(function () {
        let src = $(this).attr('data-src') + "&rn=" + Math.random();
        $(this).attr('src', src);
    });
</script>
</body>
</html>
