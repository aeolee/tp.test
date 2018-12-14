<?php
namespace app\index\controller;

use app\common\model\Klass as Ks;
use app\common\model\Teacher as Mt;
use think\facade\Request;



class Klass extends Index
{
    /**
     * 
     * @route('/klass/index$')
     */
    public function index()
    {
        $klasses = Ks::paginate(2);
        $this->assign('klasses',$klasses);
        return $this->fetch();
    }

    /**
     * 
     * @route('/klass/add$')
     */
    public function add()
    {
        $teachers = Mt::all();
        $this->assign('teachers',$teachers);

        return $this->fetch();
    }


    /**
     * 
     * @route('/klass/save$')
     */
    public function save()
    {
        $Request = Request::instance();

        $Klass = new Ks();
        $Klass->name = $Request->post('name');
        $Klass->teacher_id = $Request->post('teacher_id/d');

        $validate = new \app\common\validate\Klass;
        $result = 0;

        if($validate->check($Klass->getData())){
            $result = $Klass->save();
        } 
        
        if(!$result){
            return $this->error('数据添加错误:' . $validate->getError());
        }
        
        return $this->success('操作成功',url('/klass/index'));
    }

    /**
     * @param int $id
     * @route('klass/edit/:id$','get')->ext('html')->pattern('id','\d+')
     */
    public function edit()
    {
        $id = Request::instance()->param('id/d');

        $teachers = Mt::all();
        $this->assign('teachers',$teachers);

        if(false === $Klass = Ks::get($id))
        {
            return $this->error('系统未找到ID为'.$id.'的记录');
        }

        $this->assign('Klass',$Klass);
        return $this->fetch();
    }

    /**
     * 
     * @param int $id
     * @route('klass/delete/:id$','get')->ext('html')->pattern('id','\d+')
     */
    public function delete()
    {
        try{
            $message = '';
            $id = Request::instance()->param('id/d');
            
            if(is_null($id) || 0 === $id){
                throw new \Exception("未取得ID信息", 1);
            }
            
            $Klass = Ks::get($id);
            
            var_dump($Klass);
            return; 
            
            if(is_null($klass)){
                throw new \Exception('不存在ID为'.$id.'的班级,删除失败',1);
            }
            
            if(!$klass->delete()){
                $message = '删除班级信息失败';
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
     * @route('/klass/update$')
     */
    public function update()
    {
        $id = Request::instance()->post('id/d');

        $Klass = Ks::get($id);
        if(is_null($Klass)){
            return $this->error('系统未找到ID为'.$id.'的记录');
        }

        $Klass->name = Request::instance()->post('name');
        $Klass->teacher_id = Request::instance()->post('teacher_id/d');

        $validate = new \app\common\validate\Klass;
        $result = 1;

        if($validate->check($Klass->getData())){
            $result = $Klass->save();
        } 
        if(!$result){
            return $this->error('更新错误:'.$validate->getError());
        }

        return $this->success('操作成功',url('/klass/index'));
    }
}