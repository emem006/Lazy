<?php
namespace Admin\Controller;
use Think\Controller;
class BaseController extends Controller {

    public function _initialize(){
        $this->checkLogin();
        $this->assign('menus',$this->getMenus());
        $this->assign('admin',session('nickname'));
    }

    /**
     * 判断登陆
     */
    protected function checkLogin(){
        $admin = session('uid');
        if(empty($admin)){
            $this->redirect('Login/index');
        }
    }

    /**
     * 记录cookie
     */
    public function cookie() {
        // 记录当前列表页的cookie
        Cookie('__forward__',$_SERVER['REQUEST_URI']);
    }

    /**
     * 添加
     */
    public function add(){
        $this->getAddRelation();
        $this->display('update');
    }

    /**
     * 新增 修改
     */
    public function update(){
        $request = I('post.');
        if(IS_POST){
            //执行前操作
            if(!$this->beforeUpdate($request)) { return false; }
            $model = D($request['model']);
            $data = $model->create();
            if(!$data){
                $this->error($model->getError());
            }
            //处理数据
            $data = $this->processData($data);
            if(empty($data['id'])){
                $result = $model->data($data)->add();
                if(!$result){
                    $this->error('新增时出错');
                }
            }else{
                $where['id'] = I('post.id');
                if(empty($request['update_time'])){
                    $data['update_time'] = time();
                }
                $result = $model->where($where)->data($data)->save();
                if(!$result){
                    $this->error('更新时出错');
                }
            }
            //执行后操作
            if(!$this->afterUpdate($result,$request)) { return false; }
            $this->success($data['id'] ? '更新成功！' : '新增成功！',Cookie('__forward__'));
        }else{
            $model = D(I('get.model'));
            $alias = I('get.alias');
            if($_GET['id']){
                $param['where'][''.$alias.'.id'] = I('get.id');
                $row = $model->findRow($param);
            }else{
                $row = D('Config')->where(array('id'=>1))->find();
            }
            if ($row) {
                $this->getUpdateRelation();
                $this->assign('row', $row);
            } else {
                $this->error($model->getError());
            }
            $this->display('update');
        }
    }

    /**
     * 添加时 获取相关系数据
     */
    protected function getAddRelation() {}

    /**
     * 修改时 获取相关系数据
     */
    protected function getUpdateRelation() {}

    /**
     * @param array $request
     * @return boolean
     * 更新前执行
     */
    protected function beforeUpdate($request = array()) { return true; }
    /**
     * @param array $data
     * @return array
     * 处理提交数据 进行加工或者添加其他默认数据
     */
    protected function processData($data = array()) { return $data; }
    /**
     * @param $result
     * @param array $request
     * @return boolean
     * 更新后执行
     */
    protected function afterUpdate($result, $request = array()) { return true; }

    /**
     * 删除操作
     */
    public function remove(){
        $request = I('request.');
        if(empty($request['id'])){
            $this->error('请选择要删除的数据');
        }
        $where['id'] = array('IN',$request['id']);
        $result = D($request['model'])->where($where)->delete();
        $result ? $this->success('删除成功') : $this->error('删除失败');
    }

    /**
     * @param string $model 模型名称
     * @param int $id 数据ID
     * @param string $field 修改的字段名称
     * @param string $flag 标记 1显示 0隐藏
     * 开关操作
     */
    public function onOff($model = '', $id = 0, $field = '', $flag='') {
        if($flag == 1){
            $data[$field] = 0;
        }else{
            $data[$field] = 1;
        }
        $result = D($model)->where(array('id' => $id))->data($data)->save();
        S($model.'_Cache', null);
        $result ? $this->success('修改成功') : $this->error('修改失败');
    }

    /**
     * 修改某一字段
     * @param string $model
     * @param string $field
     * @param string $value
     * @param int $id
     */
    public function editField($model = '',$field = '',$id = 0,$value = ''){
        $data[$field] = $value;
        $result = D($model)->where(array('id' => $id))->data($data)->save();
        S($model.'_Cache', null);
        $result ? $this->success('修改成功') : $this->error('未修改任何值');
    }

    /**
     * 获取后台分页数
     * @return mixed
     */
    public function getPage(){
        $page = D('Config')->getField('admin_page');
        return $page;
    }

    /**
     * @return mixed
     * 处理菜单列表
     */
    final protected function getMenus() {
        $menus = C('MENUS');
        //处理每个菜单的信息
        foreach($menus as $key_a =>& $menu) {
            //该判断主要是 针对没有子菜单的父菜单
            if (false !== strpos($menu['group']['url'], CONTROLLER_NAME)) {
                $menu['group']['class'] = 'active';
            }
            //存在子菜单
            if (!empty($menu['_child'])) {
                foreach ($menu['_child'] as $key_b =>& $child) {
                    //判断当前控制器在那个菜单路径下 该菜单高亮
                    $explode = explode('/', $child['url']);
                    if (in_array(CONTROLLER_NAME, $explode)) {
                        //子菜单高亮
                        $child['class'] = 'active';
                        //其父菜单高亮
                        $menu['group']['class'] = 'active';
                    }
                }
            }
        }
        return $menus;
    }

    /**
     * 上传操作
     * @param $path
     * @return array|bool
     */
    private function upload($path){
        if(!empty($_FILES)){
            $config = array(
                'maxSize'    =>    3145728,
                'rootPath'   =>    'Uploads',
                'savePath'   =>    '/'.$path.'/',
                'saveName'   =>    getRandStr(20,0),
                'autoSub'    =>    true,
                'subName'    =>    array('date','Ymd'),
            );
            $upload = new \Think\Upload($config);
            $file = $upload->upload();
            if(!$file){
                $this->error($upload->getError());
            }
            return $file;
        }
    }

    /**
     * 上传图片
     * @param string $path
     * @param int $width
     * @param int $height
     * @param bool $thumb
     * @return string
     */
    public function uploadPic($path = '',$width = 0,$height = 0,$thumb = false){
        $file = $this->upload($path);
        foreach($file as $val){
            if($thumb){
                $image = new \Think\Image();
                $image->open('./Uploads'.$val['savepath'].$val['savename']);
                $image->thumb($width, $height,$image::IMAGE_THUMB_CENTER)->save('./Uploads'.$val['savepath'].'thumb_'.$val['savename']);
                $result = $val['savepath'].'thumb_'.$val['savename'];
            }else{
                $result = $val['savepath'].$val['savename'];
            }
        }
        return $result;
    }

    /**
     * 上传文件
     * @param $path
     * @return string
     */
    public function uploadFile($path){
        $file = $this->upload($path);
        foreach($file as $val){
            $result = $val['savepath'].$val['savename'];
        }
        return $result;
    }

    /**
     * UE编辑器
     */
    public function ueditor(){
        $data = new \Org\Util\Ueditor();
        echo $data->output();
    }

}