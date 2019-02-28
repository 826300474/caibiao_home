<?php
namespace Admin\Controller;
use Think\Controller;

class UserController extends Controller {
    public function index(){
               
    }

    public function get(){
        $page = $_POST['page'];
        $code = $_POST['code'];
        $ret = D('User')->getAllUser($page,$code);
        show(1,'数据获取成功',$ret);
    }
    public function getCount(){
        $ret = D('User')->getCount($_POST['code']);
        show(1,'数据获取成功',$ret);
    }
    public function add(){
        $ret = D('User')->addUser($_POST); 
        show(1,'数据添加成功'); 
    }
}