<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
use think\Session;
use app\common\model\Index as Message;

class Index extends Controller{
    public function index(){
        if(Session::has('name')){
            $name=Session::get('name');
        }else{
            $this->error('请先登陆','login/login');
        }
        
        
        $Message=new Message;
        $arr=$Message->select();
        
        $this->assign('message',$arr);
        $this->assign('name',$name);
        $html=$this->fetch();
        return $html; 
    }
    public function add(){
        if(Session::has('name')){
            $name=Session::get('name');
        }else{
            $this->error('请先登陆','login/login');
        }
        $this->assign('name',$name);
        $html=$this->fetch();
        return $html;
    }
    public function addaction(){
        $postdata=Request::instance()->post();
        
        $Message=new Message;
        $Message->note_title=$postdata['note_title'];
        $Message->note_content=$postdata['note_content'];
        $Message->user_name=Session::get('name');
        $result=$Message->save($Message->getData());
        
        if(false===$result){
            return "新增失败:".$Message->getError();
        }else{
            $this->success('新增成功','index');
        }
    }
    public function out(){
        Session::clear();
        return $this->success('退出成功','php/tp5/public/index/login/login');
    }
    public function delete($id){
        $confirm=Message::get($id);
        if($confirm){
            $confirm->delete();
            $this->success('删除成功','index');
        }else{
            $this->error('没有要删除的记录');
        }
    }
    public function read($id){
        if(Session::has('name')){
            $name=Session::get('name');
        }else{
            $this->error('请先登陆','login/login');
        }
        
        $Message=Message::get($id);
        $this->assign('Message',$Message);
        $this->assign('name',$name);
        $html=$this->fetch();
        return $html;
    }
}

