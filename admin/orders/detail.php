<?php session_start();?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>主要内容区main</title>
<link href="../include/css/css.css" type="text/css" rel="stylesheet" />
<link href="../include/css/main.css" type="text/css" rel="stylesheet" />
<link rel="shortcut icon" href="../include/images/main/favicon.ico" />
<style>
body{overflow-x:hidden; background:#f2f0f5; padding:15px 0px 10px 5px;}
#searchmain{ font-size:12px;}
#search{ font-size:12px; background:#548fc9; margin:10px 10px 0 0; display:inline; width:100%; color:#FFF; float:left}
#search form span{height:40px; line-height:40px; padding:0 0px 0 10px; float:left;}
#search form input.text-word{height:24px; line-height:24px; width:180px; margin:8px 0 6px 0; padding:0 0px 0 10px; float:left; border:1px solid #FFF;}
#search form input.text-but{height:24px; line-height:24px; width:55px; background:url(images/main/list_input.jpg) no-repeat left top; border:none; cursor:pointer; font-family:"Microsoft YaHei","Tahoma","Arial",'宋体'; color:#666; float:left; margin:8px 0 0 6px; display:inline;}
#search a.add{ background:url(../include/images/main/add.jpg) no-repeat -3px 7px #548fc9; padding:0 10px 0 26px; height:40px; line-height:40px; font-size:14px; font-weight:bold; color:#FFF; float:right}
#search a:hover.add{ text-decoration:underline; color:#d2e9ff;}
#main-tab{ border:1px solid #eaeaea; background:#FFF; font-size:12px;}
#main-tab th{ font-size:12px; background:url(../include/images/main/list_bg.jpg) repeat-x; height:32px; line-height:32px;}
#main-tab td{ font-size:12px; line-height:40px;}
#main-tab td a{ font-size:12px; color:#548fc9;}
#main-tab td a:hover{color:#565656; text-decoration:underline;}
.bordertop{ border-top:1px solid #ebebeb}
.borderright{ border-right:1px solid #ebebeb}
.borderbottom{ border-bottom:1px solid #ebebeb}
.borderleft{ border-left:1px solid #ebebeb}
.gray{ color:#dbdbdb;}
td.fenye{ padding:10px 0 0 0; text-align:right;}
.bggray{ background:#f9f9f9}
</style>
</head>
<body>
<!--main_top-->
<table width="99%" border="0" cellspacing="0" cellpadding="0" id="searchmain">
  <tr>
    <td width="99%" align="left" valign="top">您的位置：订单管理 >> 订单详情</td>
  </tr>
  <tr>
    <td align="left" valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="search">
  		<tr>
   		 <td width="90%" align="left" valign="middle">
		
         </td>
  		  <td width="10%" align="center" valign="middle" style="text-align:right; width:150px;">
		  <a href="../goods/add.php" target="mainFrame" onFocus="this.blur()" class="add">新增商品</a></td>
  		</tr>
	</table>
    </td>
  </tr>
    <td align="left" valign="top">
    
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="main-tab">
      <tr>
        <th align="center" valign="middle" class="borderright">ID</th>
        <th align="center" valign="middle" class="borderright">订单编号</th>
        <th align="center" valign="middle" class="borderright">商品编号</th>
        <th align="center" valign="middle" class="borderright">商品名称</th>
        <th align="center" valign="middle" class="borderright">商品单价</th>
        <th align="center" valign="middle" class="borderright">商品数量</th>
      

      </tr>
			<?php
								
				require("../../public/config.php");
				//连接数据库
				$link=mysqli_connect(HOST,USER,PASSWORD)or die("数据库连接失败");
				//选择数据库，设置字符编码
				mysqli_select_db($link,DBNAME);
				mysqli_set_charset($link,"utf8");
				//执行sql语句，并发送
				// $sql="select g.*,t.name typename from goods g LEFT JOIN type t where g.typeid=t.id".$limit;
				$sql="select * from detail where orderid={$_GET['id']}";
                //echo $sql;
                //exit();
               
				//$sql="select g.*,t.name typename from goods g LEFT JOIN type t ON g.typeid = t.id". $wheres .$limit;
				
				$result=mysqli_query($link,$sql);

				//解析结果集
				while($row=mysqli_fetch_assoc($result)){
					echo "<tr onMouseOut='this.style.backgroundColor='#ffffff'' onMouseOver='this.style.backgroundColor='#edf5ff''>";
					echo "<td align='center' valign='middle' class='borderright borderbottom'>{$row['id']}</td>";
					echo "<td align='center' valign='middle' class='borderright borderbottom'>{$_GET['id']}</td>";
					echo "<td align='center' valign='middle' class='borderright borderbottom'>{$row['goodsid']}</td>";
					echo "<td align='center' valign='middle' class='borderright borderbottom'>{$row['name']}</td>";
					echo "<td align='center' valign='middle' class='borderright borderbottom'>{$row['price']}</td>";
					echo "<td align='center' valign='middle' class='borderright borderbottom'>{$row['num']}</td>";
					

					echo "</tr>";
					}
				//关闭
				mysqli_free_result($result);
				mysqli_close($link);
				?>
    </table></td>
    </tr>
  <tr>

  </tr>
</table>
</body>
</html>