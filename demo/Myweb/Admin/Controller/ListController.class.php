<?php
namespace Admin\Controller;
use Think\Controller;
class ListController extends Controller {
	//首页
    public function index(){
        $this->display('Wel/welcome');
    }


}