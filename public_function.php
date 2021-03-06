<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function http_get($url) {
    $curl_instance = curl_init();
    if (stripos($url, "https://") !== FALSE) {
        curl_setopt($curl_instance, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl_instance, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl_instance, CURLOPT_SSLVERSION, 1); //CURL_SSLVERSION_TLSv1
    }
    curl_setopt($curl_instance, CURLOPT_URL, $url);
    curl_setopt($curl_instance, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($curl_instance);
    $status = curl_getinfo($curl_instance);
    curl_close($curl_instance);

    if (intval($status["http_code"]) == 200) {
        return $response;
    } else {
        return false;
    }
}

function http_post($url, $param, $post_file = false) {
    $curl_instance = curl_init();
    if (stripos($url, "https://") !== FALSE) {
        curl_setopt($curl_instance, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl_instance, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl_instance, CURLOPT_SSLVERSION, 1); //CURL_SSLVERSION_TLSv1
    }
    if (is_string($param) || $post_file) {
        $str_post = $param;
    } else {
        $aPOST = array();
        foreach ($param as $key => $val) {
            $aPOST[] = $key . "=" . urlencode($val);
        }
        $str_post = join("&", $aPOST);
    }
    curl_setopt($curl_instance, CURLOPT_URL, $url);
    curl_setopt($curl_instance, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl_instance, CURLOPT_POST, true);
    curl_setopt($curl_instance, CURLOPT_POSTFIELDS, $str_post);
    $sContent = curl_exec($curl_instance);
    $aStatus = curl_getinfo($curl_instance);
    curl_close($curl_instance);
    if (intval($aStatus["http_code"]) == 200) {
        return $sContent;
    } else {
        return false;
    }
}

function S($name, $obj) {
    file_put_contents($name, $obj, true);
}

function L($name) {
    return file_get_contents($name);
}
