<?php
namespace Admin\Controller;

class ArticleCategoryController extends BaseController {
    /**
     * 文章分类列表
     * 树状显示
     */
    public function index(){
        $this->cookie();
        //替换的字符串  若该分类禁止操作  将此处内容删除
        $replace = "<a href='".U('ArticleCategory/update')."-model-ArticleCategory-alias-ac-id-{id}' class='modify'>
                        <span class='fa fa-pencil' title='编辑'></span>
                    </a>&nbsp;
                    <a href='###' class='delete-delete' title='{id}'>
                        <span class='fa fa-remove' title='删除'></span>
                    </a><input type='hidden' value='".U('ArticleCategory/remove')."-model-ArticleCategory-id-{id}'>";
        //分类模板
        $tmp = "<tr>
                    <td>{create_time}</td>
                    <td>{id}</td>
                    <td>{nbsp}{name}</td>
                    <td>
                    {art_cate_is_show}
                    </td>
                    <td>
                    <input type='text' value='{sort}' data-model='ArticleCategory' data-field='sort' data-id='{id}' class='sort only-num'>
                    </td>
                    <td>".$replace."</td>
                </tr>";
        //分类数据
        $tree_data = D('ArticleCategory')->getArticleCate(0,true);
        //初始化树状结构类
        $tree = new \Think\Tree();
        //参数一  $tree_data层级结构数据
        //参数二  child子树数组名称
        //参数三  $tmp html模板
        //参数四  array()要赋值替换的字段内容
        //参数五  禁止操作时替换为''
        //参数六  禁止操作的ID  数组形式
        //参数七  ├&nbsp;根树的层级符号
        //参数八   └&nbsp;子树的层级符号
        //参数九  $indentation 子树缩进填充内容
        $tree -> __init($tree_data,'child',$tmp,array('id','name','description','keywords','sort','create_time','art_cate_is_show'),$replace,$this->prohibit,'├&nbsp;','└&nbsp;','　');
        $table = $tree->getTree();
        $this->assign('cate_list',$table);
        $this->display();
    }

    public function getAddRelation(){
        //获取分类
        $this->assign('cate_sel',$this->categorySelect('',''));
    }

    public function getUpdateRelation(){
        $cate = D('ArticleCategory')->findRow(array('where'=>array('ac.id'=>I('get.id'))));
        //获取分类
        $this->assign('cate_sel',$this->categorySelect($cate['parent_id'],'id'));
    }

    protected function processData($data = array()){
        $data['content'] = $_POST['content'];
        $data['author'] = session('nickname');
        if(!empty($_FILES['cover']['name'])){
            $data['cover'] = $this->uploadPic('article');
        }
        return $data;
    }

    /**
     * 生成 分类的下拉菜单
     * @param $val
     * @param $index
     * @return string
     */
    private function categorySelect($val,$index){
        //模板
        $select_tmp = '<option value="{id}">{nbsp}{name}</option>';
        $res = D('ArticleCategory')->getAllCategory(0,true);
        $tree = new \Think\Tree();
        //初始化下拉
        $tree->__init($res,'child',$select_tmp,array('id','name'));
        $select = '<select name="parent_id" class="form-control input-sm"><option value="0">--顶级分类--</option>'.$tree->getSelectTree($val,$index).'</select>';
        return $select;
    }
}