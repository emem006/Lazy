<?php
namespace Admin\Controller;
class IndexController extends BaseController {

    public function index(){
        $bind=M("bind");
        $model  = $bind->field("type as unit,count(bind_id) as value")->group("type")->select();
        //循环
        foreach($model as $k=>$v){
            $list["type"][$k]=$v['unit'];
            $list["val"][$k]=$v['value'];
        }
        $this->assign('type',$list['type']);
        $this->assign('val',$list['val']);
        $this->display();
	}

}