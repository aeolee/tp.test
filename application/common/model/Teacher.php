<?php

namespace app\common\model;

use think\Model;

class Teacher extends Model
{
    /**
     * 用户登录
     * @param string $username 用户名
     * @param string $password 密码
     * @return bool 成功true,失败false
     */
    static public function login($name, $password)
    {
        $map = array('name' => $name);
        $Teacher = self::get($map);

        if(!is_null($Teacher)){
            if($Teacher->checkPassword($password)){
                session('teacherId', $Teacher->getData('id'));
                return true;
            }
        }

        var_dump($Teacher);
        return false;
    }

    static public function logOut()
    {
        session('teacherId', null);
        return true;
    }

    static public function isLogin()
    {
        $teacherId = session('teacherId');

        if(isset($teacherId)){
            return true;
        } else{
            return false;
        }
    }

    public function checkPassword($password)
    {
        if($this->getData('password') === $this::encryptPassword($password)){
            return true;
        } else{
            return false;
        }
    }

    static public function encryptPassword($password)
    {
        if(!is_string($password)){
            throw new \RuntimeException("传入变量类型非字符串,错误码2", 2);
        }

        return sha1(md5($password) . 'mengyunzhi');
    }
}
