<?php
namespace Admin\Controller;
use Think\Controller;

class ZhuanzhangController extends Controller {
    public function index(){
  
    }

    public function go(){
        $code = $_POST['code'];
        $pass = $_POST['pass'];
        $score = $_POST['score'];
        $id = $_POST['id'];
        $ret = D('Daili')->checkBank($code);   
        if($ret['bankpass'] == $pass){
            $oldscore = $ret['score'];
            if($ret['money'] > $score){
                $mon = $ret['money'] - $score;
                $ret = D('User')->savemoney($id, $score);
                $ret = D('Daili')->savemoney($code,$mon);
                $ret = D('Zhuanzhang')->go($_POST);  
                show(1,'转账成功');     
            }else{
                show(0,'余额不足');   
            }
        }else{
            show(0,'银行卡密码输入不正确'); 
        }   
    }
    // public function get(){
    //     $page = $_POST['page'];
    //     $code = $_POST['code'];
    //     $ret = D('User')->getAllUser($page,$code);
    //     show(1,'数据获取成功',$ret);
    // }
    // public function getCount(){
    //     $ret = D('User')->getCount($_POST['code']);
    //     show(1,'数据获取成功',$ret);
    // }
    // public function add(){
    //     $ret = D('User')->addUser($_POST); 
    //     show($ret,'数据添加成功'); 
    // }
}