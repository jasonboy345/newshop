<!DOCTYPE HTML>
<html>
<?php 
    session_start();
    //将上一个页面的URL地址记录到session   //http://localhost/newshop/home/detail.php?id=18'
    //放到session中是为了全界面引用；
    $_SESSION['url'] = $_SERVER['HTTP_REFERER'];
    //var_dump($_SESSION);
    
?>
    <head>
        <title>口袋书店</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="./include/css/common.css">
        <link rel="stylesheet" type="text/css" href="./include/css/register.css">
        <script src="./include/js/index.js" type="text/javascript"></script>
        <script src="./include/js/jquery.min.js" type="text/javascript"></script>
        <script type="text/javascript">
        var timeout         = 500;
        var closetimer      = 0;
        var ddmenuitem      = 0;

        function jsddm_open()
        {   jsddm_canceltimer();
            jsddm_close();
            ddmenuitem = $(this).find('ul').eq(0).css('visibility', 'visible');}

        function jsddm_close()
        {   if(ddmenuitem) ddmenuitem.css('visibility', 'hidden');}

        function jsddm_timer()
        {   closetimer = window.setTimeout(jsddm_close, timeout);}

        function jsddm_canceltimer()
        {   if(closetimer)
            {   window.clearTimeout(closetimer);
                closetimer = null;}}

        $(document).ready(function()
        {   $('#jsddm > li').bind('mouseover', jsddm_open);
            $('#jsddm > li').bind('mouseout',  jsddm_timer);});

        document.onclick = jsddm_close;
        </script>
    </head>
    </head>
    <body>
        <div id="container">
        <?php include("./include/header.php"); ?>
            <!--主体开始-->
            
           <?php
                 session_start();  //开启回话

                //从数据库提取对应的个人信息
                //获取session中的会员id
                $id = $_SESSION['liubindaren']['id'];

                //1.导入配置文件
                require("../public/config.php");
                //2.连接数据库，并判断数据库是否连接成功
                $link = @mysqli_connect(HOST,USER,PASSWORD) or die("对不起，数据库连接失败");
                //3.连接库，并设置字符集
                mysqli_select_db($link,DBNAME);
                mysqli_set_charset($link,"utf8");

                //4.拼装SQL语句，并发送执行

                $sql = "select * from users where id={$id}";
                $result = mysqli_query($link,$sql);
                //echo $sql;
                //exit();
                //5.遍历数据
                $row = mysqli_fetch_assoc($result)
            ?>
            <div id="main" style="background-color:#eee">
                    <div class="denglu_text" style="color:black">
                        <h2 align='center'>会员信息查看</h2>
                         <hr align='center' width='100%'>
                        <table border="0" width="300" cellpadding="4" cellspacing="0" align="center">
                        
                            <tr>
                                <th>注册ID：</th>
                                <td><?php echo $row['id']; ?></td>
                            </tr>
                            <tr>
                                <th>姓名：</th>
                                <td><?php echo $row['name']; ?></td>
                            </tr>
                            <tr>
                                <th>地址：</th>
                                <td><?php echo $row['address']; ?></td>
                            </tr>
                            <tr>
                                <th>邮编：</th>
                                <td><?php echo $row['code']; ?></td>
                            </tr>
                            <tr>
                                <th>电话：</th>
                                <td><?php echo $row['phone']; ?></td>
                            </tr>
                            <tr>
                                <th>邮箱：</th>
                                <td><?php echo $row['email']; ?></td>
                            </tr>
                            <tr>
                                <th>注册时间：</th>
                                <td><?php echo date("Y-m-d H:i:s",$row['addtime']); ?></td>
                            </tr>
                        
                           
                            <tr>
                                <td colspan="2" align="center"><a href="edit.php?userid=<?php echo $id;?>"><input type="image" src="./include/images/d2.jpg" name="denglu"></a></td>
                            </tr>
                        
                        </table>
                    </div>
                
            
                <div class="clear"></div>
            </div>
            <!--主体结束-->
            <?php include("./include/footer.php"); ?>
        </div>
    </body>
</html>