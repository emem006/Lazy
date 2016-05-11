<?php
namespace Admin\Model;
class FriendlyLinkModel extends BaseModel {

    /**
     * 自动验证 使用create()方法时自动调用
     * @var array
     */
    protected $_validate = array(
        array('title','require','友链标题不能为空！'), //空验证  默认情况下用正则进行验证
        array('link','require','链接不能为空！'),
        array('link', '/http(s)?:\/\/([\w-]+\.)+[\w-]+(\/[\w- .\/?%&=]*)?/', '连接地址非法', self::VALUE_VALIDATE, 'regex', self::MODEL_BOTH),
    );


    /**
     * @param array $param  综合条件参数
     * @return array
     */
   public function getList($param = array()) {
        if(!empty($param['page_size'])) {
            $total      = $this->alias('fl')->where($param['where'])->count();
            $Page       = $this->getPage($total, $param['page_size'], $param['parameter']);
            $page_show  = $Page->show();
        }

        $model  = $this->alias('fl')
            ->field('fl.*')
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

        $row = $this->alias('fl')
            ->field('fl.*')
            ->where($param['where'])
            ->find();

        return $row;
    }
}