<?php
namespace app\index\controller;

use think\Controller;
use app\common\model\Teacher as Mt;


class Index
{
    public function __construct()
    {
        parent::__construct();

        if(!Teacher::isLogin()){
            return $this->error('plz login first', url('/Login/index'));
        }

    }
}
