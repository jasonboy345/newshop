<?php session_start(); //开启session会话跟踪 ?>
<!DOCTYPE html>
<html>
<head>
<meta  charset=utf-8" />
<title>左侧导航menu</title>
<link href="css/css.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="js/sdmenu.js"></script>
<script type="text/javascript">
	// <![CDATA[
	var myMenu;
	window.onload = function() {
		myMenu = new SDMenu("my_menu");
		myMenu.init();
	};
	// ]]>
</script>
<style type=text/css>
html{ SCROLLBAR-FACE-COLOR: #538ec6; SCROLLBAR-HIGHLIGHT-COLOR: #dce5f0; SCROLLBAR-SHADOW-COLOR: #2c6daa; SCROLLBAR-3DLIGHT-COLOR: #dce5f0; SCROLLBAR-ARROW-COLOR: #2c6daa;  SCROLLBAR-TRACK-COLOR: #dce5f0;  SCROLLBAR-DARKSHADOW-COLOR: #dce5f0; overflow-x:hidden;}
body{overflow-x:hidden; background:url(images/main/leftbg.jpg) left top repeat-y #f2f0f5; width:194px;}
</style>
</head>
<body onselectstart="return false;" ondragstart="return false;" oncontextmenu="return false;">
<div id="left-top">
	<div><img src="images/main/member.png" width="44" height="44" /></div>
    <span>用户：<?php echo $_SESSION['sakura']['name']; ?><br>角色：<?php echo $_SESSION['sakura']['username']; ?></span>
</div>
    <div style="float: left" id="my_menu" class="sdmenu">
      <div class="collapsed">
        <span>会员管理</span>
        <a href="../users/index.php" target="mainFrame" onFocus="this.blur()">浏览会员</a>
        <a href="../users/add.php" target="mainFrame" onFocus="this.blur()">添加会员</a>
      </div>
      <div>
        <span>类别管理</span>
        <a href="../type/index.php" target="mainFrame" onFocus="this.blur()">浏览类别</a>
        <a href="../type/newindex1.php" target="mainFrame" onFocus="this.blur()">分层浏览</a>
        <a href="../type/add.php" target="mainFrame" onFocus="this.blur()">添加类别</a>
       <!--<a href="../type/newindex2.php" target="mainFrame" onFocus="this.blur()">下拉浏览</a>-->
      </div>
      <div>
        <span>商品管理</span>
        <a href="../goods/index.php" target="mainFrame" onFocus="this.blur()">浏览商品</a>
        <a href="../goods/add.php" target="mainFrame" onFocus="this.blur()">添加商品</a>
      </div>
      <div>
        <span>订单管理</span>
        <a href="../orders/index.php" target="mainFrame" onFocus="this.blur()">浏览订单</a>
        <a href="../orders/index.php" target="mainFrame" onFocus="this.blur()">订单详情</a>
      </div>
    </div>
</body>
</html>