<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include 'public_function.php';

$send_url = 'https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=CJ0y80Lfrwu671hxSjZZS8Q6-zd6VYArHmu3yV2MCZjcCTYFxRKy0MblnBLXnR3i7HsbJ5O-i-8tnor7N2qggKMRfm7_FFpa_XF6loU-c6Q';
$send_data = array('touser' => 'oUBaxs-nBvi86eeG_lbO3Q5o3Kps', 'msgtype' => 'text', 'text' => array('content' => '小染下午好吖'));
$send_data = json_encode($send_data, JSON_UNESCAPED_UNICODE);
print_r(http_post($send_url, $send_data));
die;

switch ($_GET['function']) {
    case 'get_user_num':
        get_user_num();
        break;
    case 'get_user_info':
        get_user_info();
        break;

    default:
        break;
}

function get_user_num() {
    $app_id = $_POST['app_id'];
    
    $ajax_response = array(
        'msg' => '',
    );
    if (!file_exists($app_id . '_access_token')) {
        $ajax_response['msg'] = 'access_token not exist';
        echo json_encode($ajax_response);
    }

    $url = 'https://api.weixin.qq.com/cgi-bin/user/get?access_token=' . L($app_id . '_access_token');
    $ret_array = json_decode(http_get($url), true);
    $ajax_response['msg'] = 'get user amount successful';
    $ajax_response['amount'] = $ret_array['total'];
    echo json_encode($ajax_response);
}

function get_user_info(){
    $app_id = $_POST['app_id'];
    
    $ajax_response = array(
        'msg' => '',
    );
    if (!file_exists($app_id . '_access_token')) {
        $ajax_response['msg'] = 'access_token not exist';
        echo json_encode($ajax_response);
    }
    
    //获取关注者openid列表
    $url = 'https://api.weixin.qq.com/cgi-bin/user/get?access_token=' . L($app_id . '_access_token').'&next_openid=owogBtzPp97oFlUuhKTjPfO7jMq8';
    $ret_array = json_decode(http_get($url), true);
    $file_name = $app_id.'_user_openid_list';
    //write_array_to_file($file_name, $ret_array['data']['openid'], $file_name);
    
    $ret_array['next_openid'] = 'owogBt8P7Ik7X_toVjFx0pdbd7ds';
    
    while ($ret_array['next_openid'] != '') {
        $url = 'https://api.weixin.qq.com/cgi-bin/user/get?access_token=' . L($app_id . '_access_token') . '&next_openid=' . $ret_array['next_openid'];
        $ret_array = json_decode(http_get($url), true);
        print_r($ret_array);
        die;
        write_array_to_file($file_name, $ret_array['data']['openid'], $file_name);
    }

    $ajax_response['msg'] = 'get user amount successful';
    $ajax_response['amount'] = $ret_array['total'];
    echo json_encode($ajax_response);
}

function write_array_to_file($file_name, $content_array){
    foreach ($content_array as $value) {
        file_put_contents($file_name, $value."\n", FILE_APPEND);
    }
}