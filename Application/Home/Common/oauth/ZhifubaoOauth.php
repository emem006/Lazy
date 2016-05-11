<?php
namespace ThinkOauth;

/**
 * Class SinaOauth
 * @package ThinkOauth
 */
class ZhifubaoOauth{
    //接口通用配置参数
    public $app_key,$app_secret,$callback;

    public $basic_url='https://oauth.taobao.com/';
    public $token_dir='token';
    public $authorize_dir='authorize';
    public $api_base='https://eco.taobao.com/router/rest';
    //public $response_type='code';

    /**
     *
     */
    public function __construct(){
        $config=C('ZHIFUBAO');
        $this->app_key		=$config['APP_KEY'];
        $this->app_secret	=$config['APP_SECRET'];
        $this->callback		=$config['CALLBACK'];
        //载入第三方登录函数文件
        include_once APP_PATH.'Home/Common/oauth/OauthFunction.php';
    }

    public function login(){
        //Oauth 标准参数
        $params = array(
            'client_id'     => $this->app_key,
            'redirect_uri'  => $this->callback,
            'response_type' => 'code',
            'view'          =>"web",
        );

        $url=$this->basic_url.$this->authorize_dir.'?'.http_build_query($params).'&state=123';
        redirect($url);
    }

    /**
     * @param null $code
     *
     * @return array
     */
    public function callback($code=null){
        if(empty($code))return array('flag'=>'error','success'=>'参数错误');
        //第一次请求获得token等数据$result
        $params = array(
            'client_id'     =>$this->app_key,
            'client_secret' =>$this->app_secret,
            'grant_type'    =>'authorization_code',
            'code'          =>$code,
            'redirect_uri'  =>$this->callback,
        );
        $result = oauthHttp($this->basic_url.$this->token_dir, $params, 'POST');
        $data = json_decode($result, true);
        if($data['access_token'] && $data['expires_in'] && $data['open_uid']){
            $data['openid'] = $data['open_uid'];
            unset($data['open_uid']);
        }else{
            E("获取支付宝ACCESS_TOKEN出错：{$data['error']}".$result);
        }

        $obj=D('Bind');
        $bind_info=$obj->where(array('openid'=>$data['openid']))->find();
        if(empty($bind_info)){
            $fields = 'user_id,nick,sex,buyer_credit,avatar,has_shop,vip_info';
            //第三次请求,获得用户信息$user_info
            $params=array(
                'method'       => "taobao.user.buyer.get",
                'app_key'      =>$this->app_key,
                'timestamp'    =>date("Y-m-d H:i:s"),
                'sign_method' =>"md5",
                'fields'      =>$fields,
                'format'       => 'json',
                'v'            => '2.0',
            );
            $sign= createSign($params);
            //组织参数
            $strParam = createStrParam($params);
            $strParam .= 'sign='.$sign;
            $user_res = oauthHttp($this->api_base,$strParam,'GET');
            E("用户信息：".$user_res);
            $user_info=json_decode($user_res,true);
            $data['nickname']=$data['taobao_user_nick'];
            $data['head']=$user_info['avatar'];
            $data['type']='zhifubao';

            return array(
                'flag'=>'first',
                'data'=>$data,
            );
        }else{
            return array(
                'flag'=>'notfirst',
                'uid'=>$bind_info['uid'],
                'openid'=>$data["openid"],
            );
        }
    }
}
