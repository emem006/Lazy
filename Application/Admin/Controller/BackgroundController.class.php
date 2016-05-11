<?php
namespace Admin\Controller;
class BackgroundController extends BaseController {

    public function index(){
        $this->cookie();
        $param['page_size'] = $this->getPage();
        $param['order'] = 'id DESC';
        $list = D('Background')->getList($param);
        $this->assign('list',$list['list']);
        $this->assign('page',$list['page']);
        $this->display();
	}

    public function getAddRelation(){}

    public function getUpdateRelation(){}

    protected function processData($data = array()){
        if(!empty($_FILES['img']['name'])){
            $data['img'] = $this->uploadPic('background');
        }
        return $data;
    }

}