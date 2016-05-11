<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {

    public function index(){
        if(IS_POST){
            if(empty($_POST['username'])){
                $this->error('请输入账号！！');
            }if(empty($_POST['password'])){
                $this->error('验证码错误！！');
            }if(empty($_POST['verify'])){
                $this->error('请输入验证码！！');
            }if(!$this->checkVerify($_POST['verify'])){
                $this->error('验证码错误！！');
            }
            $result = M('User')->where(array('account'=>I('post.account'),'password'=>md5(I('post.password'))))->find();
            if($result){
                session('uid',$result['id']);
                session('nickname',$result['nickname']);
                $this->success('登陆成功！',U('Index/index'));
            }else{
                $this->error('用户名或密码错误！！');
            }
        }else{
            $uid = session('uid');
            if(empty($uid)){
                $this->display('Login/index');
            }else{
                $this->redirect(U('Index/index'));
            }
        }
    }

    /**
     * 退出登录
     */
    public function logOut(){
        session('uid',null);
        session('nickname',null);
        $this->redirect('Login/index');
    }

    /**
     * 生成验证码
     */
    public function verify(){
        $verify = new \Think\Verify(array('length'=>4));
        $verify->entry();
    }

    /**验证码检验
     * $code
     */
    public function checkVerify($code,$id=''){
        $verify = new \Think\Verify();
        return $verify->check($code,$id);
    }


}
