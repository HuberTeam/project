<?php
namespace Admin\Controller;
use Think\Controller;

//use Common\BaseModel;
/**
 * use Common\Model 这块可以不需要使用，框架默认会加载里面的内容
 */

/**
 * 后台公共方法
 */
class CommonController extends Controller
{
    /**
     * 初始化
     * @return
     */
    public function __construct()
    {
        parent::__construct();
        $this->_init();
    }
    /**
     * 未登录用户跳转至登入页面
     * @return
     */
    private function _init()
    {
        //    is Login？
        $isLogin = $this->isLogin();
        if (!$isLogin) {
            $this->redirect('/admin.php?c=login');
        }
    }

    /**
     * Acquire session 获取用登录用户Session
     * @return array
     */
    public function getLoginSession()
    {
        return session("logined");
    }

    /**
     * is Login？ 判断是否登录
     * @return boolean
     */
    public function isLogin()
    {
        // Check Session is_array
        $session_user = $this->getLoginSession();
        if ($session_user && is_array($session_user) && $session_user["username"]) {
            return true;
        }
        return false;
    }

    /**
     * 通过类型+ID更新排序
     */
    public function listorder()
    {
        $listorder = I('listorder');
        $jumpUrl   = $_SERVER['HTTP_REFERER'];
        $modeltype = I('modeltype');
        $errors    = array();
        foreach ($listorder as $value) {
            if (!is_numeric($value)) {return showlayer(0, '排序数值只能是数字', array('jump_url' => $jumpUrl));}
            if ($value < 0 || $value > 255) {return showlayer(0, '排序数值范围只能是0~255', array('jump_url' => $jumpUrl));}
        }
        try {
            if ($listorder) {
                foreach ($listorder as $id => $v) {
                    // 执行更新
                    $id = D($modeltype)->upDateListorderById($id, $modeltype, $v);
                    if ($id === false) {
                        $errors[] = $id;
                    }
                }
                if ($errors) {
                    return showlayer(0, '排序失败-' . implode(',', $errors), array('jump_url' => $jumpUrl));
                }
                return showlayer(1, '排序成功', array('jump_url' => $jumpUrl));
            }
        } catch (Exception $e) {
            return showlayer(0, $e->getMessage());
        }
        return showlayer(0, '排序数据失败', array('jump_url' => $jumpUrl));
    }

    /**
     * 通过ID，类型更新状态 解析POST包 传递到Model层 
     */
    public function setStatus()
    {
        try {
            if ($_POST) {
                $id        = I('id');
                $modeltype = I('modeltype');
                $status    = intval(I('status'));
                if(!$id || !is_numeric($id)){
                    return showlayer(0, '非法操作，提交的数据不完整');
                }
                if ($status === 0 || $status === 1 || $status ===-1) {
                if (!$modeltype) {
                        return showlayer(0, '非法操作，提交的数据不完整');
                }
                $res = D($modeltype)->upDateStatusById($id, $modeltype, $status);
                if ($res) {
                        return showlayer(1, '操作成功');
                } else {
                        return showlayer(0, '操作失败');
                }
                }
            }
            return showlayer(0, '没有提交的内容');
        } catch (Exception $e) {
            return showlayer(0, $e->getMessage());
        }
    }

}
