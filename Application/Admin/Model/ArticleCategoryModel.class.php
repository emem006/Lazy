<?php
namespace Admin\Model;
class ArticleCategoryModel extends BaseModel {

    /**
     * 自动验证 使用create()方法时自动调用
     * @var array
     */
    protected $_validate = array(
        array('name','require','分类名称不能为空！'), //空验证  默认情况下用正则进行验证
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
     * @param int $parent_id
     * @param bool $is_child
     * @return mixed
     */
    function getArticleCate($parent_id = 0,$is_child = false){
        $result = $this->where(array('parent_id'=>$parent_id))->order('sort DESC')->select();
        if($is_child){
            foreach ($result as $key => $val){
                $result[$key]['create_time'] = date('Y-m-d',$val['create_time']);
                //ajax操作分类显示与否的 html
                $art_cate_str = "<span class='fa fa-eye on-off fa-black' title='显示' style1></span><input type='hidden' value='ArticleCategory|status|".$val['id']."|1'>
                <span class='fa fa-eye-slash on-off fa-red' title='不显示' style2></span><input type='hidden' value='ArticleCategory|status|".$val['id']."|0'>";
                //是否显示 正则替换样式
                if($val['status'] == 0){
                    $result[$key]['art_cate_is_show'] = preg_replace(array('/style1/','/style2/'),array("style='display:none;'",""),$art_cate_str);
                }elseif($val['status'] == 1){
                    $result[$key]['art_cate_is_show'] = preg_replace(array('/style1/','/style2/'),array("","style='display:none;'"),$art_cate_str);
                }
                $result[$key]['child'] = $this->getChild($val['id']);
            }
        }
        return $result;
    }


    /**
     * @param int $parent_id
     * @param bool $is_child
     * @return mixed
     */
    function getAllCategory($parent_id = 0,$is_child = false){
        $result = $this->where(array('parent_id'=>$parent_id))->order('sort DESC')->select();
        if($is_child){
            foreach ($result as $key => $val){
                $result[$key]['child'] = $this->getChild($val['id']);
            }
        }
        return $result;
    }

    /**
     * 获取子分类
     * @param $cate_id
     * @param bool $child
     * @return mixed|void
     */
    function getChild($cate_id,$child = true){
        if (empty($cate_id)){
            return false;
        }
        $result = $this->where(array('parent_id'=>$cate_id))->order('sort DESC')->select();
        if ($child){
            foreach($result as $key => $val){
                $result[$key]['create_time'] = date('Y-m-d',$val['create_time']);
                //ajax操作分类显示与否的 html
                $art_cate_str = "<span class='fa fa-eye on-off fa-black' title='显示' style1></span><input type='hidden' value='ArticleCategory|status|".$val['id']."|1'>
                <span class='fa fa-eye-slash on-off fa-red' title='不显示' style2></span><input type='hidden' value='ArticleCategory|status|".$val['id']."|0'>";
                //是否显示 正则替换样式
                if($val['status'] == 0){
                    $result[$key]['art_cate_is_show'] = preg_replace(array('/style1/','/style2/'),array("style='display:none;'",""),$art_cate_str);
                }elseif($val['status'] == 1){
                    $result[$key]['art_cate_is_show'] = preg_replace(array('/style1/','/style2/'),array("","style='display:none;'"),$art_cate_str);
                }
                $result[$key]['child'] = $this->getChild($val['id']);
            }
        }
        return $result;
    }

    /**
     * @param array $param  综合条件参数
     * @return array
     */
   public function getList($param = array()) {
        if(!empty($param['page_size'])) {
            $total      = $this->alias('ac')->where($param['where'])->count();
            $Page       = $this->getPage($total, $param['page_size'], $param['parameter']);
            $page_show  = $Page->show();
        }

        $model  = $this->alias('ac')
            ->field('ac.*')
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

        $row = $this->alias('ac')
            ->field('ac.*')
            ->where($param['where'])
            ->find();

        return $row;
    }
}