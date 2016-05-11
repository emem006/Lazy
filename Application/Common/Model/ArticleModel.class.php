<?php
namespace Common\Model;

/**
 * Class ArticleModel
 * @package Manager\Model
 * 文章咨询模型
 */
class ArticleModel extends BaseModel {


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