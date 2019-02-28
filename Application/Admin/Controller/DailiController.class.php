<?php
namespace Admin\Controller;
use Think\Controller;

class DailiController extends Controller {
    public function index(){
    
    }

    public function getInfo(){
        $username = $_POST['name'];
        $ret = D('Daili')->getDailiInfo($username);   
        if($ret){
            return show(1,'代理信息获取成功',$ret);  
        }else{
            return show(0,'用户不存在');  
        }
    }

    public function check(){
    	$username = $_POST['username'];
        $password = $_POST['password'];
    	$ret = D('Daili')->getAdminByUsername($username);
    	if(!$ret) {
            return show(0,'用户不存在');
        }
        if($ret['pass'] != $loginpass) {
            return show(0,'密码不正确');
        }
        return show(1,$ret);
    }
    
    public function get(){
        $code = $_POST['code'];
        $page = $_POST['page'];
        $ret = D('Daili')->getAllUser($page,$code);
        show(1,'数据获取成功',$ret);
    }
    public function getCount(){
        $code = $_POST['code'];
        $ret = D('Daili')->getCount($code);
        show(1,'数据获取成功',$ret);
    }
    public function add(){
        $ret = D('Daili')->addUser($_POST); 
        show(1,'数据添加成功'); 
    }
    public function xiugai(){
        $ret = D('Daili')->xiugaiUser($_POST); 
        show(1,'数据修改成功');  
    }
}