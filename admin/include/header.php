<?php session_start(); //开启session会话跟踪 ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>后台页面头部</title>
<link href="./css/css.css" type="text/css" rel="stylesheet" />
</head>
<body onselectstart="return false" oncontextmenu=return(false) style="overflow-x:hidden;">
<!--禁止网页另存为-->
<noscript><iframe scr="*.htm"></iframe></noscript>
<!--禁止网页另存为-->
<table width="100%" border="0" cellspacing="0" cellpadding="0" id="header">
  <tr>
    <td rowspan="2" align="left" valign="top" id="logo"><img src="images/main/logo.png" width="54"></td>
    <td align="left" valign="bottom">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="left" valign="bottom" id="header-name">口袋书店后台管理</td>
        <td align="right" valign="top" id="header-right">
        	<a href="../usersaction.php?element=thanks" target="_top" target="_top" onFocus="this.blur()" class="admin-out">注销</a>
            <a href="../index.php" target="_top" onFocus="this.blur()" class="admin-home">管理首页</a>
        	<a href="../../home/index.php" target="_top" onFocus="this.blur()" class="admin-index">网站首页</a>       	
            <span>
<!-- 日历 -->
<SCRIPT type=text/javascript src="js/clock.js"></SCRIPT>
<SCRIPT type=text/javascript>showcal();</SCRIPT>
            </span>
        </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="left" valign="bottom">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="left" valign="top" id="header-admin">后台管理系统</td>
        <td align="left" valign="bottom" id="header-menu">
        <!--
        <a href="index.html" target="left" onFocus="this.blur()" id="menuon">后台首页</a>
        <a href="index.html" target="left" onFocus="this.blur()">用户管理</a>
        <a href="index.html" target="left" onFocus="this.blur()">栏目管理</a>
        <a href="index.html" target="left" onFocus="this.blur()">信息管理</a>
        <a href="index.html" target="left" onFocus="this.blur()">留言管理</a>
        <a href="index.html" target="left" onFocus="this.blur()">附件管理</a>
        <a href="index.html" target="left" onFocus="this.blur()">站点管理</a>
        -->
        </td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>