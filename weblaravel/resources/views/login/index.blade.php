<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>用户登录</title>
</head>
<body>
    <h1>搞心态</h1>
    <form action="{{route('login')}}" method="post">
    @csrf
    <input type="text" name="username" id="" placeholder="请输入用户名" autocomplete="off"><br>
    <input type="text" name="password" id="" placeholder="请输入密码" autocomplete="off"><br>
    <input type="submit" value="登录">
    </form>
</body>
</html>