<?php
namespace Home\Controller;
class FriendController extends BaseController {

    public function index(){
        $list = M('Bind')->where(array('status'=>1))->field('nickname,head')->order('bind_id desc')->select();
        $count = M('Bind')->where(array('status'=>1))->count();
        $this->assign('count',$count);
        $this->assign('list',$list);
        $this->display();
    }

}