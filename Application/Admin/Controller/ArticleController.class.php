<?php
namespace Admin\Controller;
class ArticleController extends BaseController {

    /**
     * 文章列表
     */
    public function index(){
        $this->cookie();
        if(!empty($_REQUEST['title'])){
            $param['where']['art.title'] = array('LIKE','%'.$_REQUEST['title'].'%');
        }
        $param['page_size'] = $this->getPage();
        $param['order'] = 'is_top DESC,create_time DESC';
        $param['parameter'] = $_REQUEST;
        $list = D('Article')->getList($param);
        $this->assign('list',$list['list']);
        $this->assign('page',$list['page']);
        $this->assign('request',$_REQUEST);
        $this->display();
	}

    public function getAddRelation(){
        $this->assign('cate_sel',$this->categorySelect('',''));
    }

    public function getUpdateRelation(){
        $article = D('Article')->findRow(array('where'=>array('art.id'=>I('get.id'))));
        $this->assign('cate_sel',$this->categorySelect($article['cate_id'],'id'));
    }

    protected function processData($data = array()){
        $data['content'] = $_POST['content'];
        $data['author'] = session('nickname');
        if(!empty($_FILES['cover']['name'])){
            $data['cover'] = $this->uploadPic('article',450,250,true);
        }
        return $data;
    }

    protected function afterUpdate($result, $request = array()){
        if(!empty($request['tags'])){
            $this->updateTags($request['tags']);
        }
        return true;
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
        $select = '<select name="cate_id" class="form-control input-sm"><option value="0">--顶级分类--</option>'.$tree->getSelectTree($val,$index).'</select>';
        return $select;
    }

    /**
     * 更新标签
     * @param $tags
     */
    private function updateTags($tags){
        if(!empty($tags)){
            if(strstr($tags,',')){
                $arr = explode(',',$tags);
                foreach($arr as $k=>$v){
                    $tag = M('Tag')->where(array('tag_name'=>$v))->find();
                    if(empty($tag)){
                        M('Tag')->data(array('tag_name'=>$v))->add();
                    }
                }
            }else{
                $tag = M('Tag')->where(array('tag_name'=>$tags))->find();
                if(empty($tag)){
                    M('Tag')->data(array('tag_name'=>$tags))->add();
                }
            }
        }
    }

}
