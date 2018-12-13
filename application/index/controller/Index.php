<?php
namespace app\index\controller;

use think\Controller;
use app\common\model\Teacher as Mt;


class Index extends Controller
{
    public function __construct()
    {
        parent::__construct();

        if(!Mt::isLogin()){
            return $this->error('plz login first', url('/Login/index'));
        }

    }
}
