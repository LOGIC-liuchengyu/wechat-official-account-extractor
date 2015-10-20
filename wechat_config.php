<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include 'public_function.php';

$app_id = $_POST['app_id'];
$app_secret = $_POST['app_secret'];

$get_auth_url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&'.'appid='.$app_id.'&secret='.$app_secret;
$ret = http_get($get_auth_url);
$ret_array = json_decode($ret, true);


$ajax_response = array(
    'msg'=>'',
);

if (!isset($ret_array['errcode'])){
    S($app_id.'_access_token', $ret_array['access_token']);
    $ajax_response['msg'] = 'get access_token successful';
    $ajax_response['access_token'] = $ret_array['access_token'];
}
else{
    $ajax_response['msg'] = $ret_array['errmsg'];
}

echo json_encode($ajax_response);