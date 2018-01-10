<?php 
namespace Admin\Model;
use Think\Model;
class FirmModel extends Model {
	 public function index()
     {
         $company = M('company')->select();
         return $company;
     }

     public function firm_add($arr)
     {
         $result = M('company')->add($arr);
         return $result;
     }

     public function add_member_show($cid)
     {
        $result = M('company')->where($cid)->select();
        return $result;
     }

     public function add_member($arr)
     {
        $result = M('company_member')->add($arr);
        return $result;
     }
}
		

 ?>