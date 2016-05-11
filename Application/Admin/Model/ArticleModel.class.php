<?php
namespace Admin\Model;
class ArticleModel extends BaseModel {

    protected $tableName = "article";

    /**
     * 自动验证 使用create()方法时自动调用
     * @var array
     */
    protected $_validate = array(
        array('title','require','标题不能为空！'), //空验证  默认情况下用正则进行验证
        array('cate_id','0','请选择文章分类！',self::EXISTS_VALIDATE,'notequal'),
        array('content','require','内容不能为空！'),
    );

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
            $total      = $this->alias('art')->where($param['where'])->count();
            $Page       = $this->getPage($total, $param['page_size'], $param['parameter']);
            $page_show  = $Page->show();
        }

        $model  = $this->alias('art')
            ->field('art.*,art_cate.name cate_name,art_cate.status cate_status')
            ->where($param['where'])
            ->join(array(
                'LEFT JOIN '.C('DB_PREFIX').'article_category art_cate ON art_cate.id = art.cate_id AND art_cate.status < 9',
            ))
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

        $row = $this->alias('art')
            ->field('art.*,art_cate.name cate_name')
            ->where($param['where'])
            ->join(array(
                'LEFT JOIN '.C('DB_PREFIX').'article_category art_cate ON art_cate.id = art.cate_id AND art_cate.status < 9',
            ))
            ->find();

        return $row;
    }
}