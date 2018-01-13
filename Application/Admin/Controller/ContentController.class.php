<?php
/**
 * 文章管理控制器
 */
namespace Admin\Controller;

class ContentController extends CommonController
{
    public function index()
    {
        $conds = array();
        $sbI   = I('post.');
        if ($sbI['catid'] && $sbI['catid'] != -1) {
            //按栏目搜索
            $conds['catid'] = intval($sbI['catid']);
            $this->assign('catid', $conds['catid']);
        } else {
            $this->assign('catid', -1);
        }
        if ($sbI['title']) {
            //按标题搜索
            $conds['title'] = $sbI['title'];
            $this->assign('title', $conds['title']);
        }
        /**
         * 分页处理  搜索文章并填充进页面
         */
        $page         = I('request.p') ? I('request.p') : 1;
        $pageSize     = I('request.$pageSize') ? I('request.$pageSize') : getLoginSessionPageSize(); //每页？条
        $contentList  = D("Content")->getContentList($conds, $page, $pageSize);
        $contentCount = D("Content")->getContentCount($conds);
        $res          = new \Org\Bjy\Page($contentCount, $pageSize);
        $pageRes      = $res->show();
        $this->assign('contents', $contentList);
        $this->assign('pageRes', $pageRes);
        $this->assign('viewMenus', D("Menu")->getViewMenus());
        $this->display();
    }

    /**
     * 新增文章操作或进入更新方法
     */
    public function add()
    {
        if ($_POST) {
            $sbI = $_POST;
            if (!isset($sbI['title']) || !$sbI['title']) {
                return showlayer(0, '标题不能为空');
            }
            if (!isset($sbI['keywords']) || !$sbI['keywords']) {
                return showlayer(0, '关键字不能为空');
            }
            if (!isset($sbI['catid']) || !$sbI['catid']) {
                return showlayer(0, '所属栏目未选择');
            }
            if (!isset($sbI['content']) || !$sbI['content']) {
                return showlayer(0, '内容不能为空');
            }
            /**
             * 更新方法入口 有ID值则进入文章更新
             */
            if ($sbI['content_id']) {
                return $this->upData($sbI);
            }

            $contentId = D("Content")->insert($sbI);
            if ($contentId) {
                $contentData['content_id'] = $contentId;
                $contentData['content']    = $sbI['content'];
                $resId                     = D("ContentC")->insert($contentData);
                if ($resId) {
                    return showlayer(1, '添加成功');
                } else {
                    return showlayer(0, '主表添加成功，副表添加失败');
                }
            } else {
                return showlayer(0, '添加失败');
            }
        }
        $viewMenus = D("Menu")->getViewMenus();
        $this->assign('viewMenus', D("Menu")->getViewMenus());
        $this->display();
    }

    public function edit()
    {
        $id      = I('get.id');
        $jumpUrl = $_SERVER['HTTP_REFERER'];
        if (!$id || !is_numeric($id)) {
            $this->error('非法操作', '/admin.php?c=login&a=loginout');
        }
        //获取文章主表内容
        $content = D('Content')->find($id);
        if (!$content) {
            $this->error('好像有哪里不对……程序猿正在努力加班中', '/admin.php?c=content');
        }
        /**
         * 检查用户是否有权限编辑
         */
        if ($content['author'] == getLoginSessionUsername() || getLoginSessionLevel() >= 255) {
            //获取文章副表内容
            $contentC = D('ContentC')->find($id);
            if ($contentC) {
                $content['content'] = $contentC['content'];
            }
            //获取栏目数据并填充各种数据到页面
            $viewMenus = D("Menu")->getViewMenus();
            $this->assign('content', $content);
            $this->assign('viewMenus', $viewMenus);
            $this->display();
        } else {
            $this->error('非常抱歉，您没有权限编辑此篇文章', '/admin.php?c=content');
        }
    }
    /**
     * 更新数据方法
     * 根据用户名和用户权限进行检查 是否允许修改别的用户的文章
     * 直接从session获取用户、权限等可能导致session劫持重放攻击 有空再改了2333……
     *
     */
    public function upData($data)
    {
        $cId = $data['content_id'];
        if (!is_numeric($cId)) {
            return showlayer(0, '非法操作');
        }
        $check = D('Content')->find($cId);
        if ($check['author'] == getLoginSessionUsername() || getLoginSessionLevel() >= 255) {
            $cId                 = $data['content_id'];
            $contentC['content'] = $data['content'];
            unset($data['content_id']);
            unset($data['content']);
            try {
                $res = D("Content")->upDataContentById($cId, $data);
                if ($res === false) {
                    return showlayer(0, '编辑失败');
                }
                $res = D("ContentC")->upDataContentCById($cId, $contentC);
                if ($res === false) {
                    return showlayer(0, '文章副表编辑失败');
                }
                return showlayer(1, '编辑成功');
            } catch (Exception $e) {
                return showlayer(0, $e->getMessage());
            }
        } else {
            return showlayer(0, '非常抱歉，您没有权限编辑此篇文章');
        }
    }
}
