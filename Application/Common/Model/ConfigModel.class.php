<?php
/**
 * Created by Sublime Text.
 * User: IshtarCC
 * Email: xmsjdm@gmail.com
 * Date Time: 2017/10/12 20:46
 */
namespace Common\Model;

use Think\Model;

/**
 * Config
 */
class ConfigModel extends BaseModel
{

    public function __construct()
    {}

    /**
    * 网站配置保存
    * @param  array  $data [description]
    * @return [type]       [description]
    */
    public function save($data = array()){
        if(!$data){
            throw_Exception("没有提交的数据");
        }
        $data = F('baseConfig',$data);
        return $data;
    }

        public function select(){
        return F("baseConfig");
    }
}
