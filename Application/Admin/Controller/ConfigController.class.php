<?php
/**
 * 
 */
namespace Admin\Controller;
use Think\Controller;
class ConfigController extends CommonController {
    
    public function index(){
    	$res = D("Config")->select();
    	$this->assign("vo",$res);
        $this->display();
    }

	/**
	 * 新增操作或进入更新方法
	 */
	public	function add() {
		$sbI = I('post.');
			if (!$sbI['title']){
				return showlayer( 0, '站点信息不能为空' );
			}
			if (!$sbI['keywords']){
				return showlayer( 0, '站点关键词不能为空' );
			}
			if (!$sbI['description']){
				return showlayer( 0, '站点描述不能为空' );
			}
			$res = D("Config")->save($sbI);	
			if(	$res === false){
				return showlayer( 0, '配置失败' );
			}else
			return showlayer( 1, '配置成功' );
		} 



}