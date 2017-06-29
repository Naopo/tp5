<?php
namespace app\yunzhi\controller;
use think\Db;
class Hi
{
   
	
	public function yunzhier(){
		var_dump(Db::name('job_user')->find());
	}
		
}
