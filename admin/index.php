<?php
   // header("Content-Type:text/html;charset=utf8");
    session_start();  //开启session会话
    
    //验证用户有没有登陆
    if(empty($_SESSION['sakura'])){
        header("Location:login.php");
            exit();  //预防程序惯性输出
    }
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>口袋书店网后台管理</title>
<link rel="shortcut icon" href="./include/images/favicon.ico" />
<link href="./include/css/css.css" type="text/css" rel="stylesheet" />
</head>
<!--框架样式-->
<frameset rows="95,*,30" cols="*" frameborder="no" border="0" framespacing="0">
<!--top样式-->
	<frame src="./include/header.php" name="topframe" scrolling="no" noresize id="topframe" title="topframe" />
<!--contact样式-->
	<frameset id="attachucp" framespacing="0" border="0" frameborder="no" cols="194,12,*" rows="*">
		<frame scrolling="auto" noresize="" frameborder="no" name="leftFrame" src="./include/menu.php"></frame>
		<frame id="leftbar" scrolling="no" noresize="" name="switchFrame" src="./include/swich.html"></frame>
		<frame scrolling="auto" noresize="" border="0" name="mainFrame" src="./include/main.php"></frame>
	</frameset>
<!--bottom样式-->
	<frame src="./include/bottom.html" name="bottomFrame" scrolling="No" noresize="noresize" id="bottomFrame" title="bottomFrame" />
</frameset><noframes></noframes>
<!--不可以删除-->
</html>