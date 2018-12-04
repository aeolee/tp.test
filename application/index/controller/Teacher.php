<?php

namespace app\index\controller;


use think\Controller;
use think\Db;
use app\common\model\Teacher as Mt;
use think\facade\Request;


/**
 * 
 * 
 */

class Teacher extends Controller
{

    public function __construt()
    {
        parent::__construct();

        if(!Mt::isLogin()){
            return $this->error('plz login first', url('/Login/index'));
        }
    }

    /**
     * 
     * @route('teacher/index$')
     */
    public function index()
    { 
        $name = input('get.name');
        $pageSize = 5;
        $Teacher = new Mt;
        if($name){
            $teachers = $Teacher->whereLike('name','%'.$name.'%')->paginat($pageSize, false, ['query'=>['name' => $name,],]);
        } else{
            $teachers = $Teacher->paginate($pageSize, false, ['query'=>['name' => $name,],]);
        }  
            
        $this->assign('teachers',$teachers);
            
        $htmls = $this->fetch();
        return $htmls;
    }

    /**
     * 
     * @route('teacher/insert$')
     */
    public function insert()
    {
        $message = '';
        try{

            $postData = Request::instance()->post();
            // var_dump($postData);
            // return ;
            
            //创建teaher对象
            $Teacher = new Mt();
            
            //获取数据
            $Teacher->name = $postData['name'];
            $Teacher->username = $postData['username'];
            $Teacher->sex = $postData['sex'];
            $Teacher->email = $postData['email'];
            
            //$Teacher->create_time = $time();
            
            
            //插入数据并判断结果
            $result = $Teacher->save();
            if($result === false){
                $message = '新增' .  $Teacher->name . '的数据失败:' . $Teacher->getError();
            } else{
                return $this->success('添加教师' .  $Teacher->name . '的信息成功.',url('/teacher'));
            }      
        } catch(\think\Exception\HttpResponseException $e){
            throw $e;
        } catch (\Exception $e){
            return $e->getMessage();
        }

        return $this->error($message);
    }

    /**
     * 
     * @param int $id
     * @route('teacher/delete/:id$','get')->ext('html')->pattern('id','\d+')
     */
    public function delete()
    {
        try{
            $message = '';
            $id = Request::instance()->param('id/d');
            
            if(is_null($id) || 0 === $id){
                throw new \Exception("未取得ID信息", 1);
            }
            
            $Teacher = Mt::get($id);
            
            var_dump($Teacher);
            return; 
            
            if(is_null($Teacher)){
                throw new \Exception('不存在ID为'.$id.'的教师,删除失败',1);
            }
            
            if(!$Teacher->delete()){
                $message = '删除教师信息失败';
            }
            
            return $this->success('删除成功', url('/teacher/index'));
        } catch(\think\Exception\HttpResponseException $e){
            throw $e;
        } catch(\Exception $e){
            return $e->getMessage();
        }

        return $this->error($mesage);
    }

    /**
     * 
     * @route('teacher/edit/:id$','get')->ext('html')->pattern('id','\d+')
     */
    public function edit()
    {
        try{

            //获取要编辑的记录
            $id = Request::instance()->param('id/d'); 
            if(is_null($id) || 0 === $id){
                throw new \Exception('未获取到ID信息',1);
            }

            $Teacher = Mt::get($id);
            if(is_null($Teacher)){
                $this-error('系统未找到ID为' . $id . '的记录');
            }
            
            //与V层进行交互
            $this->assign('Teacher',$Teacher);
            $htmls = $this->fetch();           
            //
            return $htmls;

        } catch(\think\Exception\HttpResponseException $e){
            throw $e;
        } catch(\Exception $e){
            return $e->getMessage();
        }
    }

    /**
     * 
     * @route('teacher/update$','post')
     */
    public function update()
    {
        try{
            
            $id = Request::instance()->post('id/d');
            
            $Teacher = Mt::get($id);
            
            if($id){
                $Teacher->name = input('post.name');
                $Teacher->username = input('post.username');
                $Teacher->sex = input('post.sex');
                $Teacher->email = input('post.email');
                
                $state = $Teacher->isUpdate(true)->save();
                if(!$state){
                    return $this->error('更新失败' . $Teacher->getError());
                }
            } else{
                throw new \Exception("所更新的记录不存在",1);
            }
            
        } catch(\think\Exception\HttpResposeException $e){
            throw $e;
        } catch(\Exception $e){
            return $e->getMessage();
        }
        
        return $this->success('操作成功',url('/teacher/index'));
    }
        

    /**
     * 
     * @route('teacher/add$')
     */
    public function add()
    {
        try{
            $htmls = $this->fetch();
            return $htmls;
        } catch(\Exception $e){
            return '系统错误' . $e->getMessage();
        }
    }
}
