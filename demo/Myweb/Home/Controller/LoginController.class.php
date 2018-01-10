<?php
namespace Home\Controller;

use Think\Controller;
header("Content-Type:text/html; charset=utf-8");
class LoginController extends Controller
{

   public function index()
   {
   	  $this->display();
   }
   
   public function login()
   {
      $username = I('post.username','','htmlspecialchars');
      $password = md5(I('post.password','','htmlspecialchars').'_7day@phper:jingxy');

      $result = M("day_user")->where(" mobile = '{$username}' AND pwd = '{$password}'")->select();
         // 如果数据库中有对应的会员，则返回到首页
        if ($result) {
           $_SESSION['user'] = $result;
           $data = 2;
           echo json_encode($data);
           # code...
        } else {
           $data = 1;
           echo json_encode($data);
        }      
  
   }
}
?>