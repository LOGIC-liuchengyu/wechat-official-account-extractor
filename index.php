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
                            alert('error');
                        },
                        success:function(data){
                            alert(data);
                        },
                    });
                });
            });
        </script>
        <form id="wechat_config_form">
            AppID: 
            <input type="text" name="app_id" />
            <br />
            AppSecret: 
            <input type="text" name="app_secret" />
        </form>
        <button id="submit_button">submit</button>
        <script>
        </script>
    </body>
</html>
