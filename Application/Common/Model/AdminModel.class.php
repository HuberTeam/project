<?php
/**
 * Created by Sublime Text.
 * User: IshtarCC
 * Email: xmsjdm@gmail.com
 * Date Time: 2017/09/24 10:23
 */
namespace Common\Model;
use Think\Model;
/**
 * 用户信息Model层
 */
class AdminModel extends Model{
	  /**
     * 实例化admin表
     * @return
     */
	private $_db = '';
	public function __construct(){
		$this->_db = M('admin');
	}

    /**
     * 通过用户名获取用户登录信息
     * @param    srting    $user    数据 
     * @return   array              数据
     */
    public function getAdminByUsername($user){
        $result = $this
			->_db
			->where('username="'.$user.'"')
			->find();
        return $result;
    }
	
	    /**
     * 修改数据
     * @param    array    $map    where语句数组形式 
     * @param    array    $data   修改的数据 
     * @return    boolean         操作是否成功
     */
    public function updateByAdminId($map,$data){
        $result=$this->where($map)->save($data);
        return $result;
    } 
}

