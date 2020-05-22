<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>添加用户</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
<div class="container">
    <div class="text-right" style="margin: 10px 0;">
        <a class="btn btn-success text-light" href="{{ route('user.index') }}">返回到列表</a>
    </div>
    <div>
        <form method="post" enctype="multipart/form-data" action="{{ route('user.store') }}" id="form">
            @csrf
            <div class="form-group">
                <label>账号：</label>
                <input type="text" class="form-control" name="username" value="{{ old('username') }}">
                <!-- <small class="form-text text-danger">你好我是一个提示</small> -->
            </div>
            <div class="form-group">
                <label>密码：</label>
                <input type="text" class="form-control" name="password">
                <!-- <small class="form-text text-danger">你好我是一个提示</small> -->
            </div>
            <div class="form-group">
                <label>确认密码：</label>
                <input type="text" class="form-control" name="password_confirmation">
                <!-- <small class="form-text text-danger">你好我是一个提示</small> -->
            </div>
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="sex" id="sex1" value="男" checked>
                    <label class="form-check-label" for="sex1">男</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="sex" id="sex2" value="女">
                    <label class="form-check-label" for="sex2">女</label>
                </div>
            </div>
            <div class="form-group">
                <input type="file" name="file" id="file" onchange="readAsDataURL()" >
                <img alt="" id="img" style="width:100px;height:100px;"/>
                <!-- <input type="submit" name="do" id="do"> -->
            </div>
            <div class="form-group">
                <label>描述：</label>
                <input type="text" class="form-control" name="desn" value="{{ old('desn') }}">
                <!-- <small class="form-text text-danger">你好我是一个提示</small> -->
            </div>
            <button type="submit" class="btn btn-primary" name="do" id="do">添加用户</button>
        </form>
    </div>
    <script src="/js/jquery.js"></script>
    <script>
        function readAsDataURL(){
        //检验是否为图像文件
            var file = document.getElementById("file").files[0];
            if(!/image\/\w+/.test(file.type)){
            alert("看清楚，这个需要图片！");
        
            return false;
            }else{
            var reader = new FileReader();
            //将文件以Data URL形式读入页面
            reader.readAsDataURL(file);
            reader.onload=function(e){
            var result=document.getElementById("img");
            //显示文件
            result.src= this.result ;
            }
        }
        }
        $("form").submit(function(e){
            e.preventDefault();
            //空对象然后添加
            var fd = new FormData();
            var _token = "{{ csrf_token() }}";
            var fd = new FormData(document.getElementById("form"));
            fd.append('_token',_token);
            fd.append("file", document.getElementById("file"));
            //fd.append("file", $(":file")[0].files[0]); //jQuery 方式
            // fd.append("do", "submit");
             
            //通过表单对象创建 FormData
            //var fd = new FormData($("form:eq(0)")[0]); //jquery 方式
             console.log(fd);
            //XMLHttpRequest 原生方式发送请求
            var xhr = new XMLHttpRequest();       
            xhr.open("POST" ,"" , true);
            xhr.send(fd);
            xhr.onload = function(e) {
                if (this.status == 200) {
                   alert('添加成功！');
                };
            };
            return;
            //jQuery 方式发送请求
            $.ajax({
                type:"post",
                url:"http://localhost:8083/user/create",
                data: fd,
                processData: false,
                contentType: false
            }).then(function(res){
                console.log(res);
            });
                // alert('添加成功！');
             
            return false;
        });
        </script>
</div>
</body>
</html>
