<?php
namespace Home\Controller;

class MessageController extends BaseController {

    public function index(){
        $param['where']['parent_id'] = 0;
        $param['where']['is_show'] = 1;
        $param['where']['art_id'] = 0;
        $param['page_size'] = $this->page();
        $param['order'] = 'm.create_time DESC';
        $list = D('Message')->getList($param);
        foreach($list['list'] as $k=>$v){
            $list['list'][$k]['create_time'] = smartDate($v['create_time']);
            $reply = D('Message')->where(array('parent_id'=>$v['id']))->find();
            if(!empty($reply)){
                $reply['create_time'] = smartDate($reply['create_time']);
                $reply['p_name'] = D('Message')->where(array('id'=>$reply['parent_id']))->getField('nickname');
                $list['list'][$k]['reply'] = $reply;
            }
        }
        $this->assign('list',$list['list']);
        $this->assign('page',$list['page']);
        $this->assign('head',cookie('head'));
        $this->assign('nickname',cookie('nickname'));
        $this->assign('smilies',$this->createHtml());
        $this->display();
    }

    /**
     * 发布留言
     */
    public function post(){
        $nickname = cookie('nickname');
        $message = M('Message')->where(array('ip'=>getIp()))->order('create_time desc')->find();
        if(!empty($message)){
            if($message['expire_time'] >= time()){
                $this->error('请您2分钟后再留言！');
            }
        }
        $curIp=getCurrentIp();
        if(empty($nickname)){
            if(empty($_POST['nickname'])){
                $_POST['nickname']="游客";
            }if(empty($_POST['content'])){
                $this->error('内容不能为空！');
            }
            $data = array(
                'nickname'   => $_POST['nickname'],
                'email'      => $_POST['email'],
                'head'       => getGravatar($_POST['email']),
                'web_url'    => $_POST['web'],
                'content'    => $_POST['content'],
                'province'   =>$curIp["province"],
                'city'       =>$curIp['city'],
                'ip'         => getIp(),
                'create_time'=> time(),
                'expire_time'=> time() + 120
            );
        }else{
            $data = array(
                'nickname'   => $nickname,
                'email'      => $_POST['email'],
                'head'       => cookie('head'),
                'web_url'    => $_POST['web'],
                'content'    => $_POST['content'],
                'province'   => $curIp['province'],
                'city'       => $curIp['city'],
                'ip'         => getIp(),
                'create_time'=> time(),
                'expire_time'=> time() + 120
            );
        }

        $result = M('Message')->data($data)->add();

        $result ? $this->success('留言成功！',"index") : $this->error('留言失败！');
    }


    private function createHtml(){
        $html = '';
        for($i=1;$i<=30;$i++){
            $html .='<li class="inline-li">';
            if($i == 30){
                $html .='<a href="javascript:;" class="smilie smilie-close">';
            }else{
                $html .='<a href="javascript:;" class="smilie smilie-click">';
            }
            $html .='<img src="'.__ROOT__.'/Public/Home/img/baidu/f'.$i.'.png">
                        </a>
                    </li>';
        }
        return $html;
    }
}