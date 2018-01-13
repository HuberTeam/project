<?php
/**
 * Created by Sublime Text.
 * User: IshtarCC
 * Email: xmsjdm@gmail.com
 * Date Time: 2017/10/10 18:09
 */
namespace Common\Model;

use Think\Model;

/**
 * 文章内容Model层方法  副表
 */
class ContentCModel extends BaseModel
{
    private $_db = '';
    public function __construct()
    {
        $this->_db = M('content_c');
    }

    public function insert($data = array())
    {
        $data['create_time'] = time();
        $data['update_time'] = time();
        // $data['content']     = htmlspecialchars($data['content']);
        return $this->_db->add($data);
    }

/**
 * 获取文章副表内容给编辑页面
 */
    public function find($id)
    {
        $res = $this->_db
            ->where('content_id=' . $id)
            ->find();
        $res['content']= htmlspecialchars_decode($res['content']);    
        return $res;
    }

    /**
     * 通过文章ID更新数据
     * @param    integer    $contentId   数据
     * @param    array     $contentC   数据
     * @return    integer           更新数据的id
     */
    public function upDataContentCById($contentId, $data)
    {
        $data['update_time'] = time();
        $data['content']     = htmlspecialchars($data['content']);
        return $this->_db
            ->where('content_id=' . $contentId)
            ->save($data);
    }
}
