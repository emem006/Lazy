<?php
namespace Admin\Model;
class BindModel extends BaseModel {

    /**
     * 自动完成 新增时
     * @var array
     */
    protected $_auto = array (
        array('create_time','time',self::MODEL_INSERT,'function'),
        array('update_time','time',self::MODEL_UPDATE,'function'),
    );

    /**
     * @param array $param  综合条件参数
     * @return array
     */
   public function getList($param = array()) {
        if(!empty($param['page_size'])) {
            $total      = $this->alias('t')->where($param['where'])->count();
            $Page       = $this->getPage($total, $param['page_size'], $param['parameter']);
            $page_show  = $Page->show();
        }

        $model  = $this->alias('b')
            ->field('b.*')
            ->where($param['where'])
            ->order($param['order']);

        //是否分页
        !empty($param['page_size'])  ? $model = $model->limit($Page->firstRow,$Page->listRows) : '';

        $list = $model->select();

        return array('list'=>$list,'page'=>!empty($page_show) ? $page_show : '');
    }

    /**
     * @param $param
     * @return mixed
     */
   public function findRow($param = array()) {

        $row = $this->alias('b')
            ->field('b.*')
            ->where($param['where'])
            ->find();

        return $row;
    }
}