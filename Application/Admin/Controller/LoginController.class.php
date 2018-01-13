<?php
namespace Admin\Controller;
use Think\Controller;

/**
 * use Common\Model 这块可以不需要使用，框架默认会加载里面的内容
 */
class LoginController extends Controller {

	public	function index() {
		if ( session( 'LoginSession')) {
			$this->redirect( '/admin.php' );
		}
		$this->display();
	}

	public	function check() {
		$username = I('post.username') ;
		$password = I('post.password') ;
		if ( !trim( $username ) ) {
			return showlayer( 0, '请输入用户名' );
		}
		if ( !trim( $password ) ) {
			return showlayer( 0, '请输入密码' );
		}

		$db_result = D('Admin')->getAdminByUsername($username);
		if ( !$db_result || $db_result[ 'status' ] != 1 ) {
			return showlayer( 0, '该用户不存在或已被禁用' );
		}

		if ( $db_result[ 'password' ] != getMd5Password( $password ) ) {
			return showlayer( 0, '密码错误' );
		}

		session( 'logined', $db_result );
//		D( "Admin" )->updateByAdminId( $db_result[ 'admin_id' ]=username, array( 'lastlogintime' => time() ) );
//		D( "Admin" )->updateByAdminId( $db_result[ 'admin_id' ]=username, array( 'lastloginip' => getClientIP()));

		return showlayer( 1, '欢迎回来' );
	}



	public	function loginout() {
		session( 'logined', null );
		unset($_session['logined']);
		session_destroy();
		$this->redirect( '/admin.php?c=login' );
	}
}