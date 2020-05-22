<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    public function __construct()
    {
        /*$this->middleware(function ($request, $next) {
            dump(session()->all());
            return $next($request);
        });*/
        #$this->middleware('checklogin');
    }


    public function index(Request $request)
    {

        // 获取记录总数
        #$total = User::count();

        // 获取指定id=2的数据
        #$ret = User::find(2);
        // 得到模型对象转换为数组
        #$ret = $ret->toArray();
        // first
        #$ret = User::where('id',2)->first();

        // 获取所有的数据
        #$ret = User::all();
        #$ret = User::get();
        #$ret = User::where('id', '>', 1)->get();

        // 获取指定字段的值
        #$ret = User::where('id',2)->value('username');

        // 获取指定列的数据
        #$ret = User::pluck('username','id')->toArray();

        // 分页
        #$ret = User::orderBy('id','asc')->offset(0)->limit(2)->get();


        #$data = User::all();

        // 搜索
        $kw = $request->get('kw');

        // 分页数
        #$pagesize = env('PAGESIZE');
        $pagesize = config('app.pagesize');
        // when搜索
        $data = User::when($kw, function ($query) use ($kw) {
            $query->where('username', 'like', "%$kw%");
        })->withTrashed()->paginate($pagesize);
        return view('user.index', compact('data'));
    }

    // 添加显示
    public function create()
    {
        return view('user.create');
    }

    // 添加接受数据处理
    public function store(Request $request)
    {
        // 获取数据时要去除 文件上传对象
        $data = $request->except(['_token', 'password_confirmation', 'pic','file']);
        // 默认图片
        // $data['pic'] = 'http://www.itcast.cn/2018czgw/images/logo.png';

        // 判断用户是否上传图片
        /*if ($request->hasFile('pic')) {
            // 处理上传文件  保存在数据库是一个上传到服务器上的文件路径
            $file = $request->file('pic');
            // 上传到服务器端位置
            $filepath = public_path('uploads');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            // 上传
            $file->move($filepath, $filename);

            $data['pic'] = '/uploads/' . $filename;
        }*/

        // store方法上传
        if ($request->hasFile('file')) {
            $pic = $request->file('file');
            $info = $pic->store('', 'avatar');
            $data['pic'] = '/uploads/' . $info;

            // 图片绝对路径
            $filepath = public_path($data['pic']);
            $image = Image::make($filepath);

            // 重置图片
            $image->resize(100, 100)->save($filepath);
        }

        // insert添加数据
        #$bool = User::insert($data);

        // 返回是插入成功时的模型对象
        // dump($data);
        // exit;
        $model = User::create($data);
        #dump($model->id);
        
        return redirect(route('user.index'));
    }

    // 修改显示
    public function edit(Request $request, int $id)
    {
        $data = User::find($id);
        return view('user.edit', compact('data'));
    }

    // 修改接受处理
    public function update(Request $request, int $id)
    {
        // 表单验证
        $this->validate($request, [
            'username' => 'required|unique:user,id,' . $id
        ]);
        $data = $request->except(['_token', '_method']);
        // 修改数据  自动更新行记录中的修改时间
        User::where('id', $id)->update($data);
        return redirect(route('user.index'));
    }

    // 删除
    public function destroy(int $id)
    {
        User::destroy($id);
        #User::where('id',$id)->delete();

        return ['status' => 0, 'msg' => '删除成功'];
    }

    // 还原
    public function restore(int $id)
    {
        $model = User::onlyTrashed()->where('id', $id)->first();
        $model->restore();
        return redirect(route('user.index'));
    }

    //永久删除
    public function forever(int $id)
    {
        User::where('id', $id)->forceDelete();
        return redirect(route('user.index'));
    }

    // 退出
    public function logout()
    {
        // 清空session
        session()->flush();
        return redirect(route('login'));
    }
}
