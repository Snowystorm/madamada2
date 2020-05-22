<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>用户列表</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
<div class="container">
    @if(session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div>
        欢迎您：{{ session('user')->username }}，进入后台管理系统！
    </div>
    <div class="text-right" style="margin-bottom: 10px;margin-top: 10px;">
        <a href="{{ route('user.create') }}" class="btn btn-success">添加用户</a>
        <a href="{{ route('user.logout') }}" class="btn btn-danger">用户退出</a>
    </div>
    <div>
        <form>
            <div style="margin-left: 1px;" class="form-group row">
                <input class="form-control" value="{{ request()->get('kw') }}" style="width: 200px;" type="text" name="kw" autocomplete="off">
                <input style="margin-left: 10px;" class="btn btn-success" type="submit" value="搜索一下">
            </div>
        </form>
    </div>
    <table class="table table-striped table-hover table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>用户名</th>
            <th>性别</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @forelse($data as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->username }}</td>
                <td>{{ $item->sex }}</td>
                <td>
                    @if($item->deleted_at)
                        <a href="{{ route('user.restore',$item) }}" class="badge badge-primary">还原</a>
                        <a href="{{ route('user.forever',$item) }}" class="badge badge-danger">永久删除</a>
                    @else
                        <a href="{{ route('user.edit',$item) }}" class="badge badge-primary">修改</a>
                        <a href="{{ route('user.destroy',$item) }}" class="badge badge-danger del">删除</a>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4">暂无搜索到的数据</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    {!! $data->appends(request()->except('page'))->links() !!}
</div>
<script src="/js/app.js"></script>
<script>
    /*
    a 标签只能发起GET请求，现在定义的路由为 delete请求类型，发起delete请求才可以
    方案1： 利用dom可以在把a变为表单，模拟delete请求
    方案2： ajax发起delete请求
    */
    // csrf_token 生成token值
    var _token = "{{ csrf_token() }}";
    // async/await 组合 指定能promise有作用，可以真正的解决异步变同步
    $('.del').click(async function (evt) {
        // 取消默认行为
        evt.preventDefault();
        var url = $(this).attr('href');
        if (confirm('您真的要删除此信息吗')) { // 真的要删除才进行
            let ret = await $.ajax({
                url,
                data: {_token},
                type: 'delete'
            });
            console.log(ret)
        }
    });

</script>
</body>
</html>
