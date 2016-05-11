<?php
namespace Admin\Controller;
class ConfigController extends BaseController {

    public function getUpdateRelation(){
        $this->cookie();
    }

    protected function processData($data = array()){
        if(!empty($_FILES['logo']['name'])){
            $data['logo'] = $this->uploadPic('config');
        }
        return $data;
    }


}