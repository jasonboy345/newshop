<?php session_start();?>
<!DOCTYPE HTML>
<html>

	<head>
		<title>口袋书店</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="./include/css/common.css">
		<link rel="stylesheet" type="text/css" href="./include/css/register.css">
		<script src="./include/js/index.js" type="text/javascript"></script>
		<script src="./include/js/jquery.min.js" type="text/javascript"></script>
        <script type="text/javascript">
        var timeout         = 500;
        var closetimer		= 0;
        var ddmenuitem      = 0;

        function jsddm_open()
        {	jsddm_canceltimer();
            jsddm_close();
            ddmenuitem = $(this).find('ul').eq(0).css('visibility', 'visible');}

        function jsddm_close()
        {	if(ddmenuitem) ddmenuitem.css('visibility', 'hidden');}

        function jsddm_timer()
        {	closetimer = window.setTimeout(jsddm_close, timeout);}

        function jsddm_canceltimer()
        {	if(closetimer)
            {	window.clearTimeout(closetimer);
                closetimer = null;}}

        $(document).ready(function()
        {	$('#jsddm > li').bind('mouseover', jsddm_open);
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
//开启session

$id = $_SESSION['liubindaren']['id'];


//1.导入配置文件
require("../public/config.php");
//2.连接数据库并查看数据库是否连接成功
$link =@mysqli_connect(HOST,USER,PASSWORD) or die ("对不起,您连接数据库失败");
//3.选择库,并设置字符集
mysqli_set_charset($link,"utf8");
mysqli_select_db($link,DBNAME);
//4.拼装SQL语句，并发送执行
$sql = "select * from orders where uid={$id}";
$result=mysqli_query($link,$sql);
//echo $sql;
//exit();
echo"<h2 align='center'>订单记录</h2>";
//5.解析结果集
        echo "<table width='980' border='1' align='center'>";
        echo "<tr>";
        echo "<th>姓名</th>";
        echo "<th>地址</th>";
        echo "<th>邮编</th>";
        echo "<th>电话</th>";
        echo "<th>添加时间</th>";
        echo "<th>价格</th>";
        echo "<th>状态</th>";
        echo "</tr>";
    
while($row = mysqli_fetch_assoc($result)){
   
        echo "<tr>";
        echo "<td>{$row['linkman']}</td>";
        echo "<td>{$row['address']}</td>";
        echo "<td>{$row['code']}</td>";
        echo "<td>{$row['phone']}</td>";
        echo "<td>{$row['addtime']}</td>";
        echo "<td>{$row['total']}</td>";
        echo "<td>{$row['status']}</td>";
        echo "</tr>";
 } 
echo "</table>";
 
//6.清空结果集，并关闭数据库
mysqli_free_result($result);
mysqli_close($link);
?>
			<!--主体结束-->
            <?php include("./include/footer.php"); ?>
		</div>
	</body>
</html>