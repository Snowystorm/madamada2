<?php

namespace App\Http\Controllers\Login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }
    public function login(Request $request){
        $data=$request->except(['_token']);
        dump($data);
    }
}
