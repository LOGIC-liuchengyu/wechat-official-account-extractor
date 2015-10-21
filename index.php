<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <script src="http://libs.baidu.com/jquery/1.9.0/jquery.js"></script>
        <script>
            $(document).ready(function(){
                $("button#submit_button").click(function(){
                    $.ajax({
                        type:"POST",
                        url:"wechat_config.php",
                        data:$('form#wechat_config_form').serialize(),
                        error:function(request){
                            alert('request error');
                        },
                        success:function(data){
                            ret_obj = JSON.parse(data);
                            $("input#access_token").val(ret_obj['access_token']);
                        },
                    });
                });
                
                $("button#get_user_num").click(function(){
                    $.ajax({
                        type:"POST",
                        url:"wechat_function.php?function=get_user_num",
                        data:$('form#wechat_config_form').serialize(),
                        error:function(request){
                            alert('request error');
                        },
                        success:function(data){
                            ret_obj = JSON.parse(data);
                            $("input#user_amount").val(ret_obj.amount);
                        },
                    });
                });
                
                $("button#get_user_info").click(function(){
                    $.ajax({
                        type:"POST",
                        url:"wechat_function.php?function=get_user_info",
                        data:$('form#wechat_config_form').serialize(),
                        error:function(request){
                            alert('request error');
                        },
                        success:function(data){
                            ret_obj = JSON.parse(data);
                            $("input#user_amount").val(ret_obj.amount);
                        },
                    });
                });
            });
        </script>
        
        <form id="wechat_config_form">
            AppID: 
            <input type="text" name="app_id" /><br />
            AppSecret: 
            <input type="text" name="app_secret" /><br />
            access_token:
            <input type="text" id="access_token" disabled="disabled" /><br />
        </form>
        <button id="submit_button">submit</button>
        <hr />
        
        <form id="wechat_user_info_form">
            用户数量: 
            <input type="text" id="user_amount" disabled="disabled"/><br>
        </form>
        <button id="get_user_num">获取用户数量</button><br>
        <button id="get_user_info">获取用户信息</button><br>
        
        <script>
        </script>
    </body>
</html>
