<?php 
namespace Admin\Model;
use Think\Model;
class UserModel extends Model {
	 public function index($start,$end)
     {
         $arr['company'] = M('day_user')->limit("$start,$end")->select();
         $arr['number']  = M('day_user')->field('count(id) as number')->select();
         return $arr;
     }

}
		

 ?>