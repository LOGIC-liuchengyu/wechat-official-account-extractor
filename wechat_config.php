<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include 'public_function.php';

file_put_contents('test.txt',  json_encode($_POST));
die;

$appid = $_POST['app_id'];
$appsecret = $_POST['app_secret'];

$get_auth_url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&'.'appid='.$appid.'&secret='.$appsecret;
$ret = http_get($get_auth_url);
$ret_array = json_decode($ret);

if (!isset($ret_array['errcode'])){
    S('access_token'.$appid, $ret_array['access_token']);
}
else{
    echo $ret_array['errmsg'];
}