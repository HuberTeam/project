<?php 
namespace Admin\Model;
use Think\Model;
class ProjectModel extends Model {
	 public function index()
     {
         $result['result'] = M('company_project')->field('*,FROM_UNIXTIME(create_time) AS ctime,FROM_UNIXTIME(update_time) AS utime')->select();
         $result['num'] = M('company')->field(' COUNT(id) AS number')->select();

         return $result;
     }

     public function add()
     {
        $arr['industry'] = M('industry')->select();
        $arr['type'] = M('type')->select();
        $arr['main'] = M('main')->select();
        $arr['mechanism'] = M('mechanism')->select();
        return $arr;
     }

     public function project_add($arr)
     {
         $result = M('company_project')->add($arr);
         return $result;
     }

     public function edit($id)
     {
         $arr['result'] = M('company_project')->where(" id = '{$id}' ")->field('*,FROM_UNIXTIME(create_time) AS ctime,FROM_UNIXTIME(update_time) AS utime')->select();
         $arr['main'] = M('main')->select();
         $arr['industry'] = M('industry')->select();
         $arr['type'] = M('type')->select();
         return $arr;
     }

     public function project_edit($arr)
     {
         $result = M('company_project')->where(" id = '{$arr['id']}' ")->save($arr);
         return $result;
     }

     public function del($id)
     {
         $result = M('company_project')->where(" id = '{$id}' ")->delete();
         return $result;
     }



}
		

