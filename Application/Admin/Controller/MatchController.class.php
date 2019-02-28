<?php
namespace Admin\Controller;
use Think\Controller;
import("Org.Util.simple_html_dom", '', '.php');
class MatchController extends Controller {
    public function index(){

    }
    
    public function get(){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'http://www.310win.com/buy/JingCaiHunhe.aspx');
        curl_setopt($curl, CURLOPT_HEADER, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($curl);
        curl_close($curl);
        $html = str_get_html($data);
        $matchs = [];
        foreach($html->find('.niDate') as $box){
            $match['niDate'] = explode("&",$box->plaintext)[0]; 
            $data = explode("_",$box->find('a',0)->id)[1];
            $match['con'] = [];
            foreach($html->find('#lottery_container tr[name='.$data.']') as $row){
                $item['id'] = $row->id;
                $item['name'] = $row->name;
                $item['gamename'] = $row->gamename;
                $item['matchid'] = $row->matchid;
                $item['num'] = $row->find('td', 0)->plaintext;
                $item['type'] = $row->find('td', 1)->plaintext;
                $item['time_1'] = $row->find('td', 2)->plaintext;
                $item['time_2'] = $row->find('td', 3)->plaintext;
                $item['zhu_name'] = $row->find('td', 4)->plaintext;
                $item['zhu_num'] = $row->find('td', 5)->plaintext;
                $item['ke_name'] = $row->find('td', 7)->plaintext;
                $item['ke_num'] = $row->find('td', 6)->plaintext;
                $tr = $html->find('#lottery_container #tr_'.$item['matchid'],0);
                $item['feirangs'] = [];
                $item['banquanchang'] = [];
                $item['zhongjinqie'] = [];
                $item['bifen'] = [];
                $item['rangqiu'] = [];
                foreach($tr->find('.hunhe_5 .hunhe_cell') as $td){
                    $con['name'] = $td->find('b',0)->plaintext;
                    $con['val'] = $td->find('span',0)->plaintext;
                    array_push($item['feirangs'],$con);   
                }
                foreach($tr->find('.hunhe_4 .hunhe_cell') as $td){
                    $con['name'] = $td->find('b',0)->plaintext;
                    $con['val'] = $td->find('span',0)->plaintext;
                    array_push($item['banquanchang'],$con);   
                }
                foreach($tr->find('.hunhe_3 .hunhe_cell') as $td){
                    $con['name'] = $td->find('b',0)->plaintext;
                    $con['val'] = $td->find('span',0)->plaintext;
                    array_push($item['zhongjinqie'],$con);   
                }
                foreach($tr->find('.hunhe_2 .hunhe_cell') as $td){
                    $con['name'] = $td->find('b',0)->plaintext;
                    $con['val'] = $td->find('span',0)->plaintext;
                    array_push($item['bifen'],$con);   
                }
                foreach($tr->find('.hunhe_1 .hunhe_cell') as $td){
                    $con['name'] = $td->find('b',0)->plaintext;
                    $con['val'] = $td->find('span',0)->plaintext;
                    array_push($item['rangqiu'], $con);   
                }
                array_push($match['con'], $item);  
            }
            array_push($matchs, $match);  
        }
        return show(1,'数据获取成功',$matchs);
    }
}