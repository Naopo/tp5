<?php
namespace app\index\controller;
use think\Db;       // 数据库操作类

class Teacher
{
    public function index()
    {
        $teacher=DB::name('job_user')->select();
		echo ($teacher[0]['user_name']);
    }
}