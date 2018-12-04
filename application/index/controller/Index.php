<?php
namespace app\index\controller;
use think\Db;

class Index
{
    public function index()
    {
        var_dump(Db::name('teacher')->find());
    }

    /**
     * 
     * @route('hello')
     */
    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }
}
