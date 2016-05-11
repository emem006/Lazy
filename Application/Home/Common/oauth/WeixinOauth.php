<?php
namespace ThinkOauth;
/**
 * Class QqOauth
 * @package ThinkOauth
 */
class WeixinOauth{
	//接口通用配置参数
	public $app_key,$app_secret,$callback;
	
	public $basic_url='https://open.weixin.qq.com/';
	public $token_dir='https://api.weixin.qq.com/sns/oauth2/access_token';
	public $authorize_dir='connect/qrconnect';
	public $response_type='code';

	/**
	 * 
	 */
	public function __construct(){
		$config=C('WEIXIN');
		$this->app_key		=$config['APP_KEY'];
		$this->app_secret	=$config['APP_SECRET'];
		$this->callback		=$config['CALLBACK'];
		//载入第三方登录函数文件
		include_once APP_PATH.'Home/Common/oauth/OauthFunction.php';
	}

    public function login($oldurl){
        //Oauth 标准参数
        $params = array(
            'appid'     => $this->app_key,
            'redirect_uri'  => $this->callback,
            'response_type' => $this->response_type,
        );

        //获取额外参数
        parse_str('scope=snsapi_login', $_param);
        if(is_array($_param)){
            $params = array_merge($params, $_param);
        } else {
            E('AUTHORIZE配置不正确！');
        }
        $url=$this->basic_url.$this->authorize_dir.'?'.http_build_query($params).'&state='.$oldurl.'#wechat_redirect';
        redirect($url);
    }

	/**
	 * @param $code
	 *
	 * @return array
	 */
	public function callback($code){
		if(empty($code))return array('flag'=>'error','success'=>'参数错误');
		//第一次请求获得token等数据$result
		$params = array(
			'appid'     =>$this->app_key,
			'secret' 	=>$this->app_secret,
			'code'          =>$code,
			'grant_type'    =>'authorization_code',
		);
		$result = oauthHttp($this->token_dir,$params, 'GET');
		$data = json_decode($result,true);
		if($data['access_token'] && $data['expires_in']){
			//第二次请求获得openid  $data['openid']
			$data['openid'] = openid($data,$this->basic_url.'oauth2.0/me');
		}else{
			E("获取微信 ACCESS_TOKEN 出错：{$result}");
		}
		$obj=D('Bind');
		$bind_info=$obj->where(array('openid'=>$data['openid']))->find();
		if(empty($bind_info)){
			//第三次请求,获得用户信息$user_info
			$params = array(
				'oauth_consumer_key' =>$this->app_key,
				'access_token'       =>$data['access_token'],
				'refresh_token'       =>$data['refresh_token'],
				'openid'             =>$data['openid'],
			    'expires_in'         =>$data['expires_in'],
				'scope'              =>'snsapi_userinfo'
			);
			$user_res=oauthHttp('https://api.weixin.qq.com/sns/userinfo',$params,'GET');
			$user_info=json_decode($user_res,true);
            write("weixin",$user_info);
			$data['nickname']=$user_info['nickname'];
			$data['head']=$user_info['headimgurl'];
			$data['type']='weixin';
			return array(
				'flag'=>'first',
				'data'=>$data,
			);
		}else{
			return array(
				'flag'=>'notfirst',
				'uid'=>$bind_info['uid'],
                'openid'=>$data['openid'],
			);
		}
	}
}
