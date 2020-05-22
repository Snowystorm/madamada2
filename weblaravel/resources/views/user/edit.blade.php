<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>修改用户</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
<div class="container">
    <div class="text-right" style="margin: 10px 0;">
        <a class="btn btn-success text-light" href="{{ route('user.index') }}">返回到列表</a>
    </div>
    <div>
        <form method="post" action="{{ route('user.update',['id'=>$data->id]) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>账号：</label>
                <input type="text" class="form-control" name="username" value="{{ $data->username }}">
                <small class="form-text text-danger">你好我是一个提示</small>
            </div>
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="sex" id="sex1" value="男"
                           @if($data->sex == '男') checked @endif
                    >
                    <label class="form-check-label" for="sex1">男</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="sex" id="sex2" value="女"
                           @if($data->sex == '女') checked @endif
                    >
                    <label class="form-check-label" for="sex2">女</label>
                </div>
            </div>
            <div class="form-group">
                <label>描述：</label>
                <input type="text" class="form-control" name="desn" value="{{ $data->desn }}">
                <small class="form-text text-danger">你好我是一个提示</small>
            </div>
            <button type="submit" class="btn btn-primary">修改加用户</button>
        </form>
    </div>

</div>
</body>
</html>
