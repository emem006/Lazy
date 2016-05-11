<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 16-4-17
 * Time: 下午4:06
 * To change this template use File | Settings | File Templates.
 */
namespace Admin\Controller;
class TalkController extends BaseController {
    public function index(){
        $this->cookie();
        $param['page_size'] = $this->getPage();
        $param['order'] = 'id DESC';
        $list = D('Talk')->getList($param);
        $this->assign('list',$list['list']);
        $this->assign('page',$list['page']);
        $this->display();
    }

    protected function processData($data = array()){
        $data['content'] = $_POST['content'];
        $data['head'] = cookie('head');
        $data['nickname']= cookie('nickname')==null?$_POST['nickname']:cookie('nickname');
        $data['province'] = "四川";
        $data['city']= "成都";
        $data['ip']= get_client_ip();
        $data['create_time']=time();
        $data['is_show']=1;
        $data['uid']=1;
        return $data;
    }

    public function getAddRelation(){}

    public function getUpdateRelation(){}
}