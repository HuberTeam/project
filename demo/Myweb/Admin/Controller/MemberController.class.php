<?php

namespace Admin\Controller;

use Think\Controller;

class MemberController extends Controller {
    //列表模板
    public function index()
    {
        // 获取公司ID
        $data['cid'] = I('get.cid');
        $firm = D('Member');
        $company = $firm->index($data);
        $this->assign('cid',$data['cid']);
        $this->assign('result',$company);
        $this->display('');
    }
    
    public function add_member_show()
    {
        // 获取公司的ID  
        $cid['id'] = I('get.cid');
        // 获取该公司的信息
        $firm = D("Member");
        $info = $firm->add_member_show($cid);
        $this->assign('result',$info);
        $this->display();
    }
    public function add_member()
    {
        $arr = I('post.');
        //实例化
        $upload = new \Think\Upload();
        //设置大小
        $upload->maxSize = 221124421312;
        //类型
        $upload->exts = array('jpg','png','gif','jpeg');
        //保存路径
        $upload->savePath = '/project/member/';
        //执行上传
        $info = $upload->upload();
        if($info){
              // 获取上传成功的图片的信息
              $arr['image'] .= $info['image']['savepath'].$info['image']['savename'];
        }
        // 实例化Model
        $firm = D('Member');
        $result = $firm->add_member($arr);
        if ($result) {
            # code...
            $this->success("添加公司成员成功");
        } else {
            $this->error("添加公司成员失败");
        }
    }

    //  删除公司成员
    public function delete_member()
    {
        // 获取要删除的公司成员
        $data['id'] = I("get.id");
        $member = D("Member");
        $result = $member->delete_member($data);
        if ($result['result']) {
            # code...
            unlink('Uploads'.$result['image']['0']['image']);
            $this->success("删除公司成员成功");
        } else {
            $this->error("删除公司成员失败");
        }
    }

    // 显示要修改的公司成员信息
    public function edit_member_show()
    {
        // 获取要修改的公司成员
        $data['id'] = I('get.id');
        $member = D("Member");
        $result = $member->edit_member_show($data);

        if ($result['0']) {
            # code...
            $this->assign('result',$result['0']);
            $this->display();
        } else {
            $this->error("没有找到当前成员对应的信息");
        }
    }

    // 执行修改公司员工的方法
    public function edit_member()
    {
        // 获取要修改的公司成员的信息
        $arr = I('post.');
        $id['id'] = $arr['id'];
        $del_image = $arr['del_image'];
        unset($arr['del_image']);
        $data = $arr;
         //实例化
        $upload = new \Think\Upload();
        //设置大小
        $upload->maxSize = 221124421312;
        //类型
        $upload->exts = array('jpg','png','gif','jpeg');
        //保存路径
        $upload->savePath = '/project/member/';
        //执行上传
        $info = $upload->upload();
        if($info){
              // 获取上传成功的图片的信息
              $arr['image'] .= $info['image']['savepath'].$info['image']['savename'];
        }
 
        // 实例化
        $member = D('Member');
        $result = $member->edit_member($id,$arr);
        if ($result) {
            # code...
            // 如果修改信息有改换到图片，并已上传成功，则把原来的头像删除掉，减少内存
            if ($info) {
                unlink("Uploads".$del_image);
            }
            $this->success("修改公司成员信息成功");
        } else {
            $this->error("修改公司成员信息失败");
        }
    }

     public function group_show()
    {
        $cid['cid'] = I('get.cid');
        // 实例化
        $member = D('Member');
        $result = $member->group_show($cid);
        $this->assign('result',$result);
        $this->assign('cid',$cid);
        $this->display();
    }

    public function add_group_show()
    {
        $cid = I('get.cid');
        $this->assign('cid',$cid);
        $this->display();
    }

    public function add_group()
    {
        $arr = I('post.');
        $member = D('Member');
        $result = $member->add_group($arr);
        if ($result) {
            # code...
            $this->success("添加分组成功");
        } else {
            $this->error("添加分组失败");
        }
    }

    public function show_add_group_member()
    {
        $cid['cid'] = I('get.cid');
        $gid['gid'] = I('get.gid');
        $member = D('Member');
        $data = $member->show_add_group_member($cid,$gid);
        $answer = $data['result'];
        $compared = $data['compared'];
        for ($i=0; $i < count($answer); $i++) { 
            # code...
            $res[$answer[$i]['id']] = $answer[$i];
        }
        for ($i=0; $i < count($compared); $i++) { 
            # code...
            if ($res[$compared[$i]['mid']]) {
                # code...
                unset($res[$compared[$i]['mid']]);
            }
        }
        $this->assign('result',$res);
        $this->assign('gid',I('get.gid'));
        $this->display();

    }

    public function add_group_member()
    {
        $data = I('get.');
        $member = D('Member');
        $result = $member->add_group_member($data);
        if ($result) {
            # code...
            $this->success('添加会员成功');
        } else {
            $this->error("添加会员失败");
        }
    }

    public function show_group_member()
    {
        $data = I('get.');
        $member = D('Member');
        $result = $member->show_group_member($data);
        $where = '';
        for ($i=0; $i < count($result); $i++) { 
            # code...
            $keys = $result[$i]['mid'];
            if ($where) {
                # code...
                $where .= " OR id = {$keys} ";
            } else {
                $where = " id = {$keys} ";
            }

        }
        if ($where) {
            # code...
            $info = $member->show_group_member_info($where);
        } 

        $this->assign('gid',$result['0']['gid']);
        $this->assign('result',$info);
        $this->display();
    }

    public function del_group_member()
    {
        $data = I('post.');
        $member = D('Member');
        $result = $member->del_group_member($data);

        if ($result) {
            # code...
            $arr = "组员删除成功";
            echo json_encode($arr);
        } else {
            $arr = "组员删除失败";
            echo json_encode($arr);
        }
    }

    public function demo()
    {
        echo "demo";
    }



}