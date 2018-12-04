<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use app\common\model\Teacher as Mt;
use think\facade\Request;

class Login extends Controller
{
    /**
     * 
     * @route('login/index$')
     */
    public function index()
    {
        return $this->fetch();
    }

    /**
     * 
     * @route('login/login$')
     */
    public function login()
    {
        $postData = Request::instance()->post();
 
        if(Mt::login($postData['username'], $postData['password'])){
            return $this->success('login success', url('/Teacher/index'));
        } else {
            return $this->error('username or password incrrect', url('/login/index'));

        }
        
    }

    /**
     * 
     * @route('login/logOut$')
     */
    public function logOut()
    {
        if(Mt::logOut()){
            return $this->success('logout success', url('/teacher/index'));
        } else {
            return $this->error('logout error', url('/teacher/index'));
        }
    }

    /**
     * 
     * 加密默认密码123
     * @route('login/test$')
     */
    public function test()
    {
        echo Mt::encryptPassword('123');
    }
}
