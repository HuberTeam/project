<?php 
namespace Admin\Model;
use Think\Model;
class MemberModel extends Model {
	 public function index($data)
     {
         $company = M('company_member')->where($data)->select();
         return $company;
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

     public function delete_member($data)
     {
        $result['image'] = M('company_member')->where($data)->select();
        $result['result'] = M('company_member')->where($data)->delete();
        return $result;
     }

     public function edit_member_show($data)
     {
        $result = M('company_member')->where($data)->select();
        return $result;
     }

     public function edit_member($id,$arr)
     {
        $result = M("company_member")->where($id)->save($arr);
        return $result;
     }

     public function group_show($cid)
     {
        $result = M('company_group')->where($cid)->select();
        return $result;
     }

     public function add_group($arr)
     {
        $result = M('company_group')->add($arr);
        return $result;
     }

     public function show_add_group_member($cid,$gid)
     {
        $result['result'] = M('company_member')->where($cid)->select();
        $result['compared'] = M('company_group_member')->where($gid)->select();
        return $result;
     }

     public function add_group_member($data)
     {
        $result = M('company_group_member')->add($data);
        return $result;
     }

     public function show_group_member($data)
     {
        $result = M('company_group_member')->where($data)->select();
        return $result;
     }

     public function show_group_member_info($where)
     {
        $result = M('company_member')->where($where)->select();
        return $result;
     }

     public function del_group_member($data)
     {
        $result = M('company_group_member')->where($data)->delete();
        return $result;
     }





}
		

 ?>