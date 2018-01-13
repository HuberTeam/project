<?php
/**
 * Created by Sublime Text.
 * User: IshtarCC
 * Email: xmsjdm@gmail.com
 * Date Time: 2017/09/27 20:40
 */
namespace Common\Model;
use Think\Model;
/**
 * 后台菜单Model层方法
 */
class MenuModel extends BaseModel {
	private $_db = '';
	public function __construct() {
		$this->_db = M( 'menu' );
	}

	/**
	 * 添加数据
	 * @param    array    $data    数据 
	 * @return   integer           新增数据的id 
	 */
	public function insert( $data = array() ) {
        $data['create_time'] = time();
        $data['update_time'] = time();
		return $this->_db->add( $data );
	}
	
	/**
	 * 查询菜单或导航栏数据
	 * @param    
	 * @return   array             数据 
	 */
	public function getMenus( $data , $page, $pageSize=10) {
		$data['status']=array('neq',-1);   //过滤状态为-1的数据
		$offset = ($page - 1) * $pageSize;
		return $this->_db
			->where($data)
			->order('status desc,listorder desc,menu_id desc')
			->limit($offset,$pageSize)
			->select()
			;
	}
	/**
	 * 查询菜单或导航栏数据结果计数
	 * @param    
	 * @return   array             数据 
	 */
	public function getMenusCount( $data = array()) {
		$data['status']=array('neq',-1);   //过滤状态为-1的数据
		return $this->_db
			->where($data)
			->count()
			;
	}	
	
	/**
	 * 查询某一行菜单数据
     * @param    integer    $MenuId   数据 
     * @return   array              数据
     */
	public function getMenuByMenuId( $MenuId ) {
		return $this->_db
			->where('menu_id='.$MenuId)
			->find()
			;
	}	
	
	/**
	 * 通过菜单ID更新数据
	 * @param    array     $data   数据 
     * @return    integer           更新数据的id 
     */
	public function upDataMenuById($MenuId, $data ) {
        $data['update_time'] = time();		
		return $this->_db
			->where('menu_id='.$MenuId)
			->save($data)
			;
	}	
	
	/**
	 * 获取自由模块数据   后台
	 * @param    
	 * @return   array             数据 
	 */
	public function getAdminPlusMenus( ) {
		$data = array(
			'status' => 1,
			'type' => 1,
		);
		return $this->_db
			->where($data)
			->order('listorder desc,menu_id desc')
			->select()
			;
	}

    /**
     * 获取前台导航栏数据
     * @param
     * @return   array             数据
     */
    public function getViewMenus( ) {
        $data = array(
            'status' => 1,
            'type' => 0,
        );
        return $this->_db
            ->where($data)
            ->order('listorder desc,menu_id desc')
            ->select()
            ;
    }

}