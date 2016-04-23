<?php session_start(); //开启session会话跟踪 ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>主要内容区main</title>
<link href="css/css.css" type="text/css" rel="stylesheet" />
<link href="css/main.css" type="text/css" rel="stylesheet" />
<link rel="shortcut icon" href="images/main/favicon.ico" />
<style>
body{overflow-x:hidden; background:#f2f0f5; padding:15px 0px 10px 5px;}
#main{ font-size:12px;}
#main span.time{ font-size:14px; color:#528dc5; width:100%; padding-bottom:10px; float:left}
#main div.top{ width:100%; background:url(images/main/main_r2_c2.jpg) no-repeat 0 10px; padding:0 0 0 15px; line-height:35px; float:left}
#main div.sec{ width:100%; background:url(images/main/main_r2_c2.jpg) no-repeat 0 15px; padding:0 0 0 15px; line-height:35px; float:left}
.left{ float:left}
#main div a{ float:left}
#main span.num{  font-size:30px; color:#538ec6; font-family:"Georgia","Tahoma","Arial";}
.left{ float:left}
div.main-tit{ font-size:14px; font-weight:bold; color:#4e4e4e; background:url(images/main/main_r4_c2.jpg) no-repeat 0 33px; width:100%; padding:30px 0 0 20px; float:left}
div.main-con{ width:100%; float:left; padding:10px 0 0 20px; line-height:36px;}
div.main-corpy{ font-size:14px; font-weight:bold; color:#4e4e4e; background:url(images/main/main_r6_c2.jpg) no-repeat 0 33px; width:100%; padding:30px 0 0 20px; float:left}
div.main-order{ line-height:30px; padding:10px 0 0 0;}
</style>
</head>
<body>
<?php
    //------导入【计数】数据库---------------------------------
    //1导入配置文件
    require("../../public/config.php");
    //2连接数据库并判断是否连接成功
    $link = @mysql_connect(HOST,USER,PASSWORD) or die("对不起，数据库连接失败");
    //3连接库并设置字符集
    mysql_select_db(DBNAME,$link);
    mysql_set_charset("utf8");
    
    $sql = "select * from number";
    $result = mysql_query($sql,$link);
    $numrows = mysql_result($result,0,1);
    //-----------------导入【计数】数据库结束---------------------------------------------------------------
?>
<!--main_top-->
<table width="99%" border="0" cellspacing="0" cellpadding="0" id="main">
  <tr>
    <td colspan="2" align="left" valign="top">
    <span class="time"><strong>上午好！<?php echo $_SESSION['sakura']['name']; ?>&nbsp;&nbsp;</strong><u>[<?php echo $_SESSION['sakura']['username']; ?>]</u></span>
    <div class="top"><span class="left">您本次登陆时间：<?php echo date ("Y-m-d H:i:s"); ?>   登录IP：<?php echo $_SERVER['SERVER_ADDR']; ?> &nbsp;&nbsp;&nbsp;&nbsp;如非您本人操作，请及时</span><a href="../users/repass.php?id=1" target="mainFrame" onFocus="this.blur()" style="color:maroon;text-decreation:line;">更改密码</a></div>
    <div class="sec">这是您第<span class="num"><?php echo $numrows; ?></span>次,登录！</div>
    </td>
  </tr>
  <tr>
    <td align="left" valign="top" width="50%">
    <div class="main-tit">网站信息</div>
    <div class="main-con">
    会员注册：开启<br/>
会员投稿：关闭<br/>
    <?php
        //1.导入配置文件
        //require("../../public/config.php");
        
        //2.连接Mysql,并判断是否连接成功过
        //$link=@mysql_connect(HOST,USER,PASSWORD) or die("对不起，您连接数据库出现了问题。");
        
        //3.选择连接数据库并配置字符集
        //mysql_select_db(DBNAME,$link);
        //mysql_set_charset("utf8");
        $sql = "select count(*) from users where state=0";
        $result = mysql_query($sql,$link);
        $maxrows = mysql_result($result,0,0);  //结果集的定位取值
    ?>
管理员个数：<font color="#538ec6"><strong><span class="num"><?php echo $maxrows; ?></span></strong></font> 人<br/>
登陆者IP：<?php echo $_SERVER['SERVER_ADDR']; ?><br/>
程序编码：UTF-8<br/>
    </div>
    </td>
    <td align="left" valign="top" width="49%">
    <div class="main-tit">服务器信息</div>
    <div class="main-con">
本地主机名：<?php echo $_SERVER['SERVER_ADDR']; ?><br/>
PHP版本：5.2.5<br/>
MYSQL版本：5.1.45-community-nt<br/>
魔术引用：开启 (建议开启)<br/>
使用域名：<?php echo $_SERVER['SERVER_ADDR']; ?> <br/>
    </div>
    </td>
  </tr>
  <tr>
    <td colspan="2" align="left" valign="top">
    <div class="main-corpy">系统提示</div>
    <div class="main-order">1=>如您在使用过程有发现出错请及时与我们取得联系；为保证您得到我们的后续服务，强烈建议您购买我们的正版系统或向我们定制系统！<br/>
2=>强烈建议您将IE6以上版本或其他的浏览器</div>
    </td>
  </tr>
</table>
</body>
</html>