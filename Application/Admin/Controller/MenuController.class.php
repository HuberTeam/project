<?php
/**
 * 菜单管理控制器
 */
namespace Admin\ Controller;
use Think\ Controller;
class MenuController extends CommonController {

	public	function index() {
		/**
		 * 栏目搜索操作
		 */
        $conds = array();
        if(isset($_REQUEST['catid']) && in_array($_REQUEST['catid'], array(0,1))) {
            $conds['type'] = intval($_REQUEST['catid']);
            $this->assign('catid',$conds['type']);
        }else{
            $this->assign('catid',-1);
        }
		/**
		 * 分页操作
		 */
        $page         = I('request.p') ? I('request.p') : 1;
        $pageSize     = I('request.$pageSize') ? I('request.$pageSize') : getLoginSessionPageSize(); 
		$menu = D( 'Menu' )->getMenus( $conds, $page, $pageSize );
		$MenusCount = D( 'Menu' )->getMenusCount( $conds );
		$res = new\ Org\Bjy\ Page( $MenusCount, $pageSize );
		$pageRes = $res->show();
		$this->assign( 'pageRes', $pageRes );
		$this->assign( 'menus', $menu );
		$this->display();
	}

	public	function edit() {
		$this->assign( 'menu', (D( 'Menu' )->getMenuByMenuId( I('get.id') )) );
		$this->display();
	}

	/**
	 * 新增操作或进入更新方法
	 */
	public	function add() {
		if ( $_POST ) {
			$sbI = I('post.');
			if ( !$sbI['name']) {
				return showlayer( 0, '菜单字段不能为空' );
			}
			if ( !$sbI[ 'm' ] ) {
				return showlayer( 0, '模块字段不能为空' );
			}
			if ( !$sbI[ 'c' ] ) {
				return showlayer( 0, '控制器字段不能为空' );
			}
			if ( !$sbI[ 'f' ] ) {
				return showlayer( 0, '方法字段不能为空' );
			}
			//进入更新方法
			if ( $sbI[ 'menu_id' ] ) {
				return $this->upData( $sbI );
			}
			$res = D( "Menu" )->insert( $sbI );
			if ( $res ) {
				return showlayer( 1, '添加成功' );
			}
			return showlayer( 0, '发生错误，新增失败', $res );
		} else {
			$this->display();
		}
	}
	
	/**
	 * 更新数据方法
	 */
	public	function upData( $data ) {
		try {
			$menuId = $data[ 'menu_id' ];
			unset( $data[ 'menu_id' ] );
			$res = D( "Menu" )->upDataMenuById( $menuId, $data );
			if ( $res === false ) {
				return showlayer( 0, '更新失败' );
			}
			return showlayer( 1, '更新成功' );
		} catch ( Exception $e ) {
			return showlayer( 0, $e->getMessage() );
		}
	}

}