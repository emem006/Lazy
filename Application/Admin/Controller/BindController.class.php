<?php
namespace Admin\Controller;
class BindController extends BaseController {

    public function index(){
        $this->cookie();
        $param['page_size'] = 20;
        $param['order'] = 'create_time DESC';
        $list = D('Bind')->getList($param);
        $this->assign('list',$list['list']);
        $this->assign('page',$list['page']);
        $this->display();
	}

}