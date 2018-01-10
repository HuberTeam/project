<?php

namespace Admin\Controller;

use Think\Controller;

class UserController extends Controller {
    //列表模板
    public function index()
    {
        $num = I('post.num') ? I('post.num') : '1';
        $status = I('post.status') ? I('post.status') : '';
        if ($num == '1' ) {
            $start = '0';
            $end = '20';
        } else if ($num > '1') {
            $start = (20 * intval($num)) - 20;
            $end   = 20;
        }
    	$user = D('User');
        $data = $user->index($start,$end);
        if ($status) {
            $this->assign('data',$data['company']);
            $this->assign('number',$data['number']);
            $this->assign('offset',$offset);
            $this->display('User/table');
            exit;
        }
//        获取总消息数，做翻页查询数据的偏移量
        $offset = ceil($data['number']['0']['number'] / 20) + 1;
//        分配变量
    	$this->assign('data',$data['company']);
        $this->assign('number',$data['number']);
        $this->assign('offset',$offset);
//    	//加载模板
        $this->display('User/list');
    }



}