<?php
namespace app\index\controller;
use think\Controller;
use app\common\model\Pass;
use think\Request;
use think\Session;

class Login extends Controller{
    public function login(){
        $html=$this->fetch();
        return $html;
    }
    public function login_submit(){
        $postdata=Request::instance()->post();
        
        $user=Pass::get([
            'user_name'=>$postdata['user_name'],
            'user_pass'=>$postdata['user_pass']
        ]);
        
        Session::set('name',$postdata['user_name']);
        
        if($user){
            $this->success('登陆成功','php/tp5/public/index/index/index');
        }else{
            return $this->error('用户名或密码不正确');
        }
    }
}

