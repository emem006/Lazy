<?php
namespace Common\Model;

class TwitterModel extends BaseModel {
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

        $model  = $this->alias('t')
            ->field('t.*')
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

        $row = $this->alias('t')
            ->field('t.*')
            ->where($param['where'])
            ->find();

        return $row;
    }
}