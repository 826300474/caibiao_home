<?php
namespace Admin\Controller;
use Think\Controller;

class LoginController extends Controller {
    public function index(){
        
    }
    public function check(){
    	$username = $_POST['username'];
        $password = $_POST['password'];
    	$ret = D('User')->getAdminByUsername($username);
    	if(!$ret) {
            return show(0,'用户不存在');
        }
        if($ret['pass'] != $password) {
            return show(0,'密码不正确');
        }
        return show(1,$ret);
    }
}