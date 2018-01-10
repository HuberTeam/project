<?php

namespace Admin\Controller;

use Think\Controller;

class ProjectController extends Controller {
    //显示项目列表模板
    public function index()
    {
        $project = D('Project');
        $arr  = $project->index();
        $result = $arr['result'];
        $number = $arr['num']['0']['number'];
        for ($i=0;$i<count($result);$i++) {
            $result[$i]['image'] = explode(",",$result[$i]['image']);
            $result[$i]['image'] = $result[$i]['image']['0'];
        }
        $this->assign('result',$result);
        $this->assign('number',$number);
        $this->display('Project/index');
    }

    public function add()
    {
        $project = D('Project');
        $arr = $project->add();
        $this->assign('main',$arr['main']);
        $this->assign('type',$arr['type']);
        $this->assign('mechanism',$arr['mechanism']);
        $this->assign('industry',$arr['industry']);
        $this->display();
    }

    public function project_add()
    {
        $arr = I('post.');
        $arr['industry'] = implode(",", $arr['industry']);
        $arr['type'] = implode(",",$arr['type']);
        $arr['mechanism'] = implode(",",$arr['mechanism']);
        // echo "<pre>";
        // print_r($arr);die;
        //实例化
        $upload = new \Think\Upload();
        //设置大小
        $upload->maxSize = 221124421312;
        //类型
        $upload->exts = array('jpg','png','gif','jpeg');
        //保存路径
        $upload->savePath = '/project/';
        //执行上传
        $info = $upload->upload();
        if(!$info){
//            $this->error($upload->getError());
        } else {
//            获取上传成功的图片的信息
            foreach ($info as $key=>$value) {
                if ($value['key'] == 'image') {
                    $arr['image'] .= $value['savepath'].$value['savename'].",";
                } else if ($value['key'] == 'deputy_map') {
                    $arr['deputy_map'] .= $value['savepath'].$value['savename'].",";
                }
            }
        }
        $arr['create_time'] = time();
        if ($arr['company_name'] == '') {
            $this->error('添加项目失败,公司名字不能为空');
        } else {
            $project = D('Project');
            $result = $project->project_add($arr);

            if ($result) {
                $this->success('添加项目成功', 'index');
            } else {
                $this->error('添加项目失败');
            }
        }

    }

    public function edit()
    {
        $id = I('get.id');
        $project = D('Project');
        $arr = $project->edit($id);
        $result = $arr['result'];
        $image = array_filter(explode(",",$arr['result']['0']['image']));
        $deputy_map = array_filter(explode(",",$arr['result']['0']['deputy_map']));

        $industry = explode(",",$result['0']['industry']);
        $main = explode(",",$result['0']['main']);
        $mechanism = explode(",",$result['0']['mechanism']);
        // 行业
        $this->assign('industry',$industry);
        // 主体
        $this->main("main",$main);
        // 类型
        $this->type("type",$type);
        $this->assign('image',$image);
        $this->assign('deputy_map',$deputy_map);
        $this->assign('result',$arr['result']['0']);
        $this->display('Project/edit');
    }

    public function project_edit()
    {
        $arr = I('post.');
        $arr['update_time'] = time();
        $project = D('Project');
        $result = $project->project_edit($arr);
        if ($result) {
            $this->success('修改项目成功', 'index');
        } else {
            $this->error('修改项目失败');
        }
    }

    public function del()
    {
        $id = I('post.id');
        $project = D('Project');
        $result = $project->del($id);
        if ($result) {
//            $this->success('添加项目成功', 'index');
            $data = 1;
            echo json_encode($data);
        } else {
//            $this->error('添加项目失败');
            $data = 2;
            echo json_encode($data);
        }

    }


}