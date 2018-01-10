<?php

namespace Admin\Controller;

use Think\Controller;

class FirmController extends Controller {
    //列表模板
    public function index()
    {
        $firm = D('Firm');
        $company = $firm->index();
        $this->assign('company',$company);
        $this->display('Firm/list');
    }

    //显示添加公司添加模板
    public function add()
    {
    	$this->display('Firm/add');
    }

    //添加项目
    public function firm_add()
    {
        $arr  = I("post.");
        if ($arr['name']) {
            $firm = D('Firm');
            $result = $firm->firm_add($arr);
        } else {
            $this->error('添加公司失败,公司名字不能为空');
        }
        if ($result) {
            $this->success('添加公司成功', 'Firm/index');
        } else {
            $this->error('添加公司失败');
        }
    }
    

}