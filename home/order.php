<?php
        session_start();  //开启回话
        //前台商品的结算页面
        if(!isset($_SESSION['liubindaren']['username'])){
                echo "<script>alert(\"请您登陆后购买\");location=\"./login.php\"</script>";
        }

        //1.判断会员是否登陆
        


        //2.输出收货人的表单信息

