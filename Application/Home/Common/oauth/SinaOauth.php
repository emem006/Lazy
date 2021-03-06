<?php
namespace ThinkOauth;

/**
 * Class SinaOauth
 * @package ThinkOauth
 */
class SinaOauth{
	//接口通用配置参数
	public $app_key,$app_secret,$callback;
	
	public $basic_url='https://api.weibo.com/';
	public $token_dir='oauth2/access_token';
	public $authorize_dir='oauth2/authorize';
	public $api_base='https://api.weibo.com/2/';
	public $response_type='code';

	/**
	 *
	 */
	public function __construct(){
		$config=C('THINK_SDK_SINA');
		$this->app_key		=$config['APP_KEY'];
		$this->app_secret	=$config['APP_SECRET'];
		$this->callback		=$config['CALLBACK'];
		//载入第三方登录函数文件
		include_once APP_PATH.'Home/Common/oauth/OauthFunction.php';
	}

	public function login($oldurl){
		//Oauth 标准参数
		$params = array(
			'client_id'     => $this->app_key,
			'redirect_uri'  => $this->callback,
			'response_type' => 'code',
            'state'         =>$oldurl,
		);

		$url=$this->basic_url.$this->authorize_dir.'?'.http_build_query($params);
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
		if($data['access_token'] && $data['expires_in'] && $data['remind_in'] && $data['uid']){
			$data['openid'] = $data['uid'];
			unset($data['uid']);
		}else{
			E("获取新浪微博ACCESS_TOKEN出错：{$data['error']}");
		}

		$obj=D('Bind');
		$bind_info=$obj->where(array('openid'=>$data['openid']))->find();
		if(empty($bind_info)){
			//第三次请求,获得用户信息$user_info
			$params=array(
				'uid'=>$data['openid'],
				'access_token'=>$data['access_token'],
			);
			$user_res = oauthHttp($this->api_base.'users/show.json',$params,'GET',array(),false);
			$user_info=json_decode($user_res,true);
			$data['nickname']=$user_info['screen_name'];
			$data['head']=$user_info['avatar_large'];
			$data['type']='sina';

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
