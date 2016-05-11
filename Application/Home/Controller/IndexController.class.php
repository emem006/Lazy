<?php
/**
 * Created by JetBrains PhpStorm.
 * User: 罗林
 * Date: 16-4-15
 * Time: 下午1:34
 * To change this template use File | Settings | File Templates.
 */
namespace Home\Controller;

class IndexController extends BaseController{
    /**
     * 首页
     */
    public function index(){
        if(!empty($_GET['cate'])){
            $param['where']['art.cate_id'] = $_GET['cate'];
        }
        if(!empty($_GET['tag'])){
            $param['where']['art.tags'] = array('LIKE','%'.$_GET['tag'].'%');
        }
        $param['where']['art.status'] = 1;
        $param['page_size'] =8;//$this->page();
        $param['order'] = 'create_time DESC';
        $list = D('Article')->getList($param);
        foreach($list['list'] as $k=>$v){
            $list['list'][$k]['create_time'] = smartDate($v['create_time']);
            if(!empty($v['tags'])){
                $list['list'][$k]['tags'] =  explode(',',$v['tags']);
            }
            $brief = extractHtmlData($v['brief'],120);
            if(empty($brief)){
                $list['list'][$k]['brief'] = extractHtmlData($v['content'],120);
            }else{
                $list['list'][$k]['brief'] = extractHtmlData($v['brief'],120);
            }
        }
        //微语
        $twitter = M('Twitter')->order('id desc')->limit(1)->find();
        //杂谈
        $talk = M('Talk')->order('id desc')->limit(9)->select();
        foreach($talk as $k=>$v){
            $reply = D('Message')->where(array('art_id'=>$v['id']))->select();
            if(count($reply)>0){
                $talk[$k]['reply'] = $reply;
            }else{
                $talk[$k]['reply'] = "";
            }
        }
        //朋友
        $friends = M('Bind')->where(array('status'=>1))->field('nickname,head')->order('bind_id desc')->select();
        $this->assign('friends',$friends);
        $this->assign('list',$list['list']);
        $this->assign('page',$list['page']);
        $this->assign('twitter',$twitter);
        $this->assign('talking',$talk);
        $this->assign('smilies',$this->createHtml());
        $this->display();
    }

    /**
     * 文章详情页
     */
    public function art(){
        //更新浏览
        M('Article')->where(array('id'=>I('get.id')))->setInc("view",1);

        $param['where']['art.id'] = I('get.id');
        $info = D('Article')->findRow($param);
        $neighborlog = $this->neighborLog($info['create_time']);
        $info['create_time'] = smartDate($info['create_time']);
        if(!empty($info['tags'])){
            $info['tags'] = explode(',',$info['tags']);
        }

        $params['where']['art_id'] = I('get.id');
        $params['page_size'] = $this->page();
        $params['order'] = 'm.create_time DESC';
        $list = D('Message')->getList($params);
        $this->assign('list',$list['list']);
        $this->assign('page',$list['page']);

        $this->assign('title',$info['title']);
        $this->assign('info',$info);
        $this->assign('neighborlog',$neighborlog);
        $this->assign('smilies',$this->createHtml());
        $this->display('art');
    }

    /**
     * 文章列表
     */
    public function artlist(){
        if(!empty($_GET['cate'])){
            $param['where']['art.cate_id'] = $_GET['cate'];
        }
        if(!empty($_GET['tag'])){
            $param['where']['art.tags'] = array('LIKE','%'.$_GET['tag'].'%');
        }
        $param['where']['art.status'] = 1;
        $param['page_size'] =12;//$this->page();
        $param['order'] = 'is_top DESC,create_time DESC';
        $list = D('Article')->getList($param);
        foreach($list['list'] as $k=>$v){
            $list['list'][$k]['create_time'] = smartDate($v['create_time']);
            if(!empty($v['tags'])){
                $list['list'][$k]['tags'] =  explode(',',$v['tags']);
            }
            $brief = extractHtmlData($v['brief'],120);
            if(empty($brief)){
                $list['list'][$k]['brief'] = extractHtmlData($v['content'],120);
            }else{
                $list['list'][$k]['brief'] = extractHtmlData($v['brief'],120);
            }
            //评论
            $count = M('Message')->where(array('art_id'=>$v['id']))->count();
            $list['list'][$k]['count']=$count;
        }
        $this->assign('list',$list['list']);
        $this->assign('page',$list['page']);
        $this->display();
    }

    /**
     * 杂谈
     */
    public function talklist(){
        $param['page_size'] =$this->page();
        $param['order'] = 'id DESC,create_time DESC';
        $talk = D('Talk')->getList($param);
        foreach($talk['list'] as $k=>$v){
            $reply = D('Message')->where(array('art_id'=>$v['id']))->select();
            if(count($reply)>0){
                $talk['list'][$k]['reply'] = $reply;
            }else{
                $talk['list'][$k]['reply'] = "";
            }
        }
        $this->assign('list',$talk['list']);
        $this->assign('page',$talk['page']);
        $this->display();
    }

    public function UpLaud(){
        $result=M('Talk')->where(array('id'=>I('get.id')))->setInc("laud",1);
        $result ? $this->success('赞成功！',"index") : $this->error('赞失败！');
    }

    /**
     * 获取相邻文章
     * @param $date
     * @return mixed
     */
    private function neighborLog($date){
        $neighborlog = array();
        $neighborlog['next'] = D('Article')->where(array('create_time'=>array('gt',$date),'status'=>1))->field('id,title')->order('create_time')->find();
        $neighborlog['prev'] = D('Article')->where(array('create_time'=>array('lt',$date),'status'=>1))->field('id,title')->order('create_time DESC')->find();
        return $neighborlog;
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

    /**
     * 添加talk
     */
    public function addtalk(){
        $nickname = cookie('nickname');
        $message = M('Talk')->where(array('ip'=>getIp()))->order('create_time desc')->find();
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
                'head'       => '',
                'content'    => $_POST['content'],
                'province'   =>$curIp["province"],
                'city'       =>$curIp['city'],
                'ip'         => getIp(),
                'create_time'=> time(),
                'is_show'=> 1,
                'expire_time'=> time()+120
            );
        }else{
            $data = array(
                'nickname'   => $nickname,
                'head'       => cookie('head'),
                'content'    => $_POST['content'],
                'province'   => $curIp['province'],
                'city'       => $curIp['city'],
                'ip'         => getIp(),
                'create_time'=> time(),
                'is_show'=> 1,
                'expire_time'=> time()+120
            );
        }

        $result = M('Talk')->data($data)->add();

        $result ? $this->success('杂谈添加成功！',"index") : $this->error('杂谈添加失败！');
    }

    /**
     * 发布留言
     */
    public function post(){
        $nickname = cookie('nickname');
        $curIp=getCurrentIp();
        if(empty($nickname)){
            if(empty($_POST['nickname'])){
                $_POST['nickname']="游客";
            }if(empty($_POST['content'])){
                $this->error('内容不能为空！');
            }
            $data = array(
                'nickname'   => $_POST['nickname'],
                'art_id'     =>$_POST['art_id'],
                'email'      => $_POST['email'],
                'head'       => '',
                'web_url'    => $_POST['web'],
                'content'    => $_POST['content'],
                'province'   =>$curIp["province"],
                'city'       =>$curIp['city'],
                'ip'         => getIp(),
                'create_time'=> time(),
                'is_show'=> 1,
                'expire_time'=> time()
            );
        }else{
            $data = array(
                'nickname'   => $nickname,
                'art_id'     =>$_POST['art_id'],
                'email'      => $_POST['email'],
                'head'       => cookie('head'),
                'web_url'    => $_POST['web'],
                'content'    => $_POST['content'],
                'province'   => $curIp['province'],
                'city'       => $curIp['city'],
                'ip'         => getIp(),
                'create_time'=> time(),
                'is_show'=> 1,
                'expire_time'=> time()
            );
        }

        $result = M('Message')->data($data)->add();

        $result ? $this->success('留言成功！',"index") : $this->error('留言失败！');
    }
}