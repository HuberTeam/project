<?php
/**
 * Created by Sublime Text.
 * User: IshtarCC
 * Email: xmsjdm@gmail.com
 * Date Time: 2017/10/10 17:46
 */
namespace Common\Model;
use Think\Model;
/**
 * 文章内容Model层方法
 */
class ContentModel extends BaseModel{
    private $_db = '';
    public function __construct()    {
        $this->_db = M('content');
    }

    /**
     * 添加文章主表
     * @param array $data
     * @return int|mixed
     */
    public function insert($data = array())    {
        $data['create_time'] = time();
        $data['update_time'] = time();
        $data['author']      = getLoginSessionUsername();
        return $this->_db->add($data);
    }

    /** 获取文章列表
     * @param $conds
     * @param $page
     * @param int $pageSize
     * @return mixed
     */
    public function getContentList($conds, $page, $pageSize = 10)
    {
        $conditions = $conds;
        if (isset($conds['title']) && $conds['title']) {
            $conditions['title'] = array('like', '%' . $conds['title'] . '%');
        }
        if (isset($conds['catid']) && $conds['catid']) {
            $conditions['catid'] = intval($conds['catid']);
        }
       $conditions['status'] = array('neq',-1);   //不列出状态值等X的数据

        $offset = ($page - 1) * $pageSize;
        $list   = $this->_db
            ->where($conditions)
            ->order('status desc ,listorder desc ,content_id desc')
            ->limit($offset, $pageSize)
            ->select();
        return $list;
    }

    /**
 * 获取文章主表表内容给编辑页面
 */
    public function find($id)
    {
        return $this->_db
        ->where('content_id=' . $id)
        ->find();
    }

    /** 获取文章列表计数
     * @param array $conds
     * @return mixed
     */
    public function getContentCount($conds = array())
    {
        $conditions = $conds;
        if (isset($conds['title']) && $conds['title']) {
            $conditions['title'] = array('like', '%' . $conds['title'] . '%');
        }
        if (isset($conds['catid']) && $conds['catid']) {
            $conditions['catid'] = intval($conds['catid']);
        }
       $conditions['status'] = array('neq',-1); //不列出状态值等X的数据
        return $this->_db
        ->where($conditions)
        ->count();
    }

    /**
     * 通过文章ID更新数据
     * @param    integer    $contentId   数据 
     * @param    array     $data   数据 
     * @return    integer           更新数据的id 
     */
    public function upDataContentById( $contentId,$data ) {
        return $this->_db
            ->where('content_id='.$contentId)
            ->save($data)
            ;
    }   
    }