<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include 'public_function.php';

switch ($_GET['function']) {
    case 'get_user_num':
        get_user_num();
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
