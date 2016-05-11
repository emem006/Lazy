<?php
namespace Home\Controller;
use \Think\Controller;
class LoginController extends Controller{
    public $oldUrl;//回跳地址
    public function login(){
        if(empty($_GET['type'])){
            $this->error('登陆类型错误');
        }
        $this->oldUrl=$_GET['oldurl'];
        $obj=ThinkOauth($_GET['type']);
        $obj->login($this->oldUrl);
    }

    public function callback($code=null){
        if($_GET['error']=="access_denied"){
            $this->error('取消授权！',"Message");
        }
        if(empty($code))$this->error('参数错误');
        if(empty($_GET['type']))$this->error('登录类型错误');
        $this->oldUrl=base64_decode($_GET['state']);
        $obj = ThinkOauth($_GET['type']);
        $result = $obj->callback($code);
        if($result['flag'] == 'first'){
            $data = $result['data'];
            cookie('nickname',$data['nickname'],array('expire'=>1209600));
            cookie('head',$data['head'],array('expire'=>1209600));
            $data['create_time'] = time();
            $res = M('Bind')->data($data)->add();
            if($res){
                if(!empty($this->oldUrl)){
                    redirect($this->oldUrl);
                }else{
                    redirect(U('Message/index'));
                }
                cookie('sid',$res,array('expire'=>1209600));
            }else{
                $this->error('登录失败');
            }
        }else{
            $info=M('Bind')->where(array('openid'=>$result['openid']))->find();
            if(!empty($info)){
                cookie('nickname',$info['nickname'],array('expire'=>1209600));
                cookie('head',$info['head'],array('expire'=>1209600));
                /***回跳***/
                if(!empty($this->oldUrl)){
                    redirect($this->oldUrl);
                }else{
                    redirect(U('Message/index'));
                }
                cookie('sid',$info['bind_id'],array('expire'=>1209600));
            }else{
                $this->error('登录失败'.json_encode($result));
            }
        }
    }

    public function loginOut(){
        cookie('nickname',null);
        redirect(U('Index/index'));
    }

}