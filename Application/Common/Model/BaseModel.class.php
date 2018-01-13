<?php
namespace Common\ Model;
use Think\ Model;
/**
 * 模板Model
 * 其他自定义Model全部继承该Model
 */
class BaseModel extends Model {


    // private $_db = '';
    // public function __construct()
    // {
    //     $this->_db = M();
    // }

        /**
     * 通过ID，类型更新排序
     * @param $id
     * @param $modeltype
     * @param $listorder
     * @return bool
     */
    public  function upDateListorderById( $id, $modeltype, $listorder ) {
        $modeltype=strtolower($modeltype);
        $this->_db = M( $modeltype );
        if ( !$id || !is_numeric( $id ) ) {
            throw_exception( 'ID不合法' );
        }
        $data = array(
            'listorder' => intval( $listorder ),
        );
        return $this->_db->where( $modeltype . '_id=' . $id )->save( $data );
    }

     /** 通过ID，类型更新状态
     * @param $id
     * @param $type
     * @param $status
     * @return bool
     */
    public function upDateStatusById( $id, $type ,$status ) {
        $type=strtolower($type);
        $this->_db = M( $type );
            $data['status'] = $status;
            return $this->_db
                ->where($type . '_id=' . $id)
                ->save($data);
    }
    /**
     * ---------------------------------------------------------
     * CRUD Block-separated Methods
     * CRUD 子功能方法
     * ---------------------------------------------------------
     */
    /**
     * 添加数据
     * @param    array    $data    数据 
     * @return   integer           新增数据的id 
     */
    public function addData($data){
        $id=$this->add($data);
        return $id;
    }
    
    /**
     * 修改数据
     * @param    array    $map    where语句数组形式 
     * @param    array    $data   修改的数据 
     * @return    boolean         操作是否成功
     */
    public function editData($map,$data){
        $result=$this->where($map)->save($data);
        return $result;
    }
    
    /**
     * 删除数据
     * @param    array    $map    where语句数组形式
     * @return   boolean          操作是否成功
     */
    public function deleteData($map){
        $result=$this->where($map)->delete();
        return $result;
    }
}


