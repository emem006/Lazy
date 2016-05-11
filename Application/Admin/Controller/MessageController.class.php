<?php
namespace Admin\Controller;
use QL\QueryList;
class MessageController extends BaseController {

    public function index(){
        //import('Vendor.QL.QueryList');
        //采集某页面所有的图片
        //$data = QueryList::Query('http://cms.querylist.cc/bizhi/453.html',array("image"=>array("img","src")))->data;//['image' => ['img','src']]
        //打印结果
        //print_r($data);


        $this->cookie();
        $param['where']['parent_id'] = 0;
        $param['page_size'] = $this->getPage();
        $param['order'] = 'create_time DESC';
        $list = D('Message')->getList($param);
        $this->assign('list',$list['list']);
        $this->assign('page',$list['page']);
        $this->assign('smilies',$this->createHtml());
        $this->display();
	}

    public function replyList(){
        $this->cookie();
        $param['where']['parent_id'] = array('neq',0);
        $param['page_size'] = $this->getPage();
        $param['order'] = 'create_time DESC';
        $list = D('Message')->getList($param);
        $this->assign('list',$list['list']);
        $this->assign('page',$list['page']);
        $this->display();
    }

    public function reply(){
        $data = array(
            'uid'        => session('uid'),
            'parent_id'  => $_POST['id'],
            'nickname'   => session('nickname'),
            'email'      => '',
            'head'       => '',
            'web_url'    => '',
            'content'    => $_POST['reply_desc'],
            'province'   => '',
            'city'       => '',
            'ip'         => getIp(),
            'create_time'=> time()
        );

        $result = M('Message')->data($data)->add();
        M('Message')->where(array('id'=>$_POST['id']))->data(array('status'=>1))->save();

        $web = M('Config')->find();
        $this->sendE($_POST['id'],'【<a href="http://www.easymall.top">'.$web['title'].'</a>】的回复：'.$_POST['reply_desc'],$web);
        $result ? $this->success('留言成功！') : $this->error('留言失败！');
    }

    /**
     * 回复时发送邮件通知
     * @param $id
     * @param $body
     * @param $web
     */
    public function sendE($id,$body,$web){
        $message = M('Message')->where(array('id'=>$id))->find();
        if(!empty($message['email'])){
            $this->sendEmail($message['email'],$message['email'],'您在【'.$web['title'].'】博客上的留言有了新回复',$body);
        }
    }

    /**
     * 发送邮件
     * @param $to  接受者邮箱
     * @param $name 接受者名称
     * @param string $subject  邮件标题
     * @param string $body  邮件内容 支持html
     * @param null $attachment 附件
     * @return bool|string
     */
    public function sendEmail($to,$name,$subject = '',$body = '',$attachment = null){
        $config = C('THINK_EMAIL');
        vendor('PHPMailer.class#phpmailer');      //从PHPMailer目录导class.phpmailer.php类文件
        $mail             = new \Vendor\PHPMailer\PHPMailer(true); //PHPMailer对象
        $mail->CharSet    = 'UTF-8';              //设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置，否则乱码
        $mail->IsSMTP();                          // 设定使用SMTP服务
        $mail->SMTPAuth   = true;                // 启用 SMTP 验证功能
        $mail->SMTPDebug  = 0;                    // 关闭SMTP调试功能
        //$mail->SMTPSecure = 'ssl';              // 使用安全协议
        $mail->Host       = $config['SMTP_HOST']; // SMTP 服务器
        $mail->Port       = $config['SMTP_PORT']; // SMTP服务器的端口号
        $mail->Username   = $config['SMTP_USER']; // SMTP服务器用户名
        $mail->Password   = $config['SMTP_PASS']; // SMTP服务器密码
        $replyEmail       = $config['REPLY_EMAIL'] ? $config['REPLY_EMAIL'] : $config['FROM_EMAIL'];//回复地址
        $replyName        = $config['REPLY_NAME'] ? $config['REPLY_NAME'] : $config['FROM_NAME'];//回复名称
        $mail->AddReplyTo($replyEmail,$replyName);
        $mail->From       = $config['FROM_EMAIL'];
        $mail->FromName   = $config['FROM_NAME'];
        $mail->AddAddress($to,$name);
        $mail->Subject    = $subject;//邮件标题
        $mail->AltBody    = "";
        $mail->WordWrap   = 80;
        // 添加附件
        if(is_array($attachment)){
            foreach ($attachment as $file){
                is_file($file) && $mail->AddAttachment($file);
            }
        }
        $mail->MsgHTML($body);//邮件主体
        $mail->IsHTML(true);
        return $mail->Send() ? true : $mail->ErrorInfo;
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