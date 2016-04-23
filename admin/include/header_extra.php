<?php session_start(); //开启session会话跟踪 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>口袋书店后台管理</title>
    </head>
    <body>
        <h2>口袋书店后台管理</h2>
        你好 <strong><span style="color:maroon;"><?php echo $_SESSION['sakura']['name']; ?></span></strong>&nbsp;
             <a href="../usersaction.php?element=thanks" target="_top">退出</a>
    </body>
</html>