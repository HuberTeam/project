<?php
/**
 * Created by Sublime Text.
 * User: IshtarCC
 * Email: xmsjdm@gmail.com
 * Date Time: 2017/10/17 14:21
 */
namespace Common\Model;

use Think\Model;

/**
 * 视频控制器
 */
class VideoSModel extends BaseModel
{
    private $_db = '';
    public function __construct()
    {
        $this->_db = M('video_s');
    }

/**
 * 根据Hex查找
 */
    public function find($hex)
    {
        $res = $this->_db
            ->where('hex=' . $hex)
            ->find();
        return $res['src'];
    }
/**
 * 添加视频信息
 */
    public function insert($data = array())    {
        return $this->_db->add($data);
    }

}
