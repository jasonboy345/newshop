<?php header("Content-Type:text/html;charset=utf-8"); ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>口袋书店网后台管理</title>
<link href="../include/css/css.css" type="text/css" rel="stylesheet" />
<script type="text/javascript">
    function dodel(id){
        if(confirm("商品类别，确认要删除吗?")){
            window.location="action.php?book=del&id="+id;
        }
    }
</script>
<link href="../include/css/main.css" type="text/css" rel="stylesheet" />
<link rel="shortcut icon" href="../include/images/main/favicon.ico" />
<style>
body{overflow-x:hidden; background:#f2f0f5; padding:15px 0px 10px 5px;}
#searchmain{ font-size:12px;}
#search{ font-size:12px; background:#548fc9; margin:10px 10px 0 0; display:inline; width:100%; color:#FFF}
#search form span{height:40px; line-height:40px; padding:0 0px 0 10px; float:left;}
#search form input.text-word{height:24px; line-height:24px; width:180px; margin:8px 0 6px 0; padding:0 0px 0 10px; float:left; border:1px solid #FFF;}
#search form input.text-but{height:24px; line-height:24px; width:55px; background:url(../include/images/main/list_input.jpg) no-repeat left top; border:none; cursor:pointer; font-family:"Microsoft YaHei","Tahoma","Arial",'宋体'; color:#666; float:left; margin:8px 0 0 6px; display:inline;}
#search a.add{ background:url(../include/images/main/add.jpg) no-repeat 0px 6px; padding:0 10px 0 26px; height:40px; line-height:40px; font-size:14px; font-weight:bold; color:#FFF}
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
#addinfo{ padding:0 0 10px 0;}
input.text-word{ width:50px; height:24px; line-height:20px; border:#ebebeb 1px solid; background:#FFF; font-family:"Microsoft YaHei","Tahoma","Arial",'宋体'; text-align:center; color:#666}
.tda{width:200px;}
.tdc{width:98px;}
.tdb{ padding-left:20px;}
td#xiugai{ padding:10px 0 0 0;}
td#xiugai input{ width:100px; height:40px; line-height:30px; border:none; border:1px solid #cdcdcd; background:#e6e6e6; font-family:"Microsoft YaHei","Tahoma","Arial",'宋体'; color:#969696; float:left; margin:0 10px 0 0; display:inline; cursor:pointer; font-size:14px; font-weight:bold;}
</style>
</head>
<body>
<!--main_top-->
<form method="post" action="">
<table width="99%" border="0" cellspacing="0" cellpadding="0" id="searchmain">
  <tr>
    <td width="99%" align="left" valign="top" id="addinfo">您的位置：<a href="index.php">类别管理</a><a href="index.php">>>浏览类别</a></td>
  </tr>
  <tr>
    <td align="left" valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="main-tab">
      <tr>
        <th align="center" valign="middle" class="borderright tdc">id编号</th>
        <th align="center" valign="middle" class="borderright tda">商品类别</th>
        <th align="center" valign="middle" class="borderright tda">父类别pid</th>
        <th align="center" valign="middle" class="borderright">路径path</th>
        <th align="center" valign="middle">操作</th>
      </tr>
      <?php
            //1.导入配置文件
            require("../../public/config.php");
            
            //2.连接mysqli,并判断是否连接成功过
            $link=@mysqli_connect(HOST,USER,PASSWORD) or die("对不起，您连接数据库出现了问题。");
            
            //3.选择连接数据库并配置字符集
            mysqli_select_db($link,DBNAME);
            mysqli_set_charset($link,"utf8");
            
            //4.拼装SQL语句并发送服务器执行
            //$sql = "select * from type";
            //排列字段;
            $sql = "select * from type order by concat(path,id)";
            $result = mysqli_query($link,$sql);
            
            //5.执行遍历解析输出操作
            while($row = mysqli_fetch_assoc($result)){
                //处理缩进效果
                $m = substr_count($row['path'],",")-1;//获取path字段中逗号出现的次数-1
                $nbsp = str_repeat("&nbsp;",$m*8);  //计算空格
                //根目录高亮
                if($row['pid']==0){
                    $color = 'color:#538EC6;font-size:13px;font-weight:bold';
                }else{
                    $color = '';
                }
                  echo "<tr class=\"bggray\">";
                  echo "<td align=\"center\" valign=\"middle\" class=\"borderright borderbottom\">{$row['id']}</td>";
                  echo "<td align=\"left\" valign=\"middle\" class=\"borderright borderbottom tdb\" style=\"width: 120px;{$color}\" >{$nbsp}{$row['name']}</td>";
                  echo "<td align=\"center\" valign=\"middle\" class=\"borderright borderbottom\" style=\"width: 120px;\">{$row['pid']}</td>";
                  echo "<td align=\"left\" valign=\"middle\" class=\"borderright borderbottom tdb\">{$row['path']}</td>";
                  echo "<td align=\"center\" valign=\"middle\" class=\"borderbottom\">
                        <a href=\"add.php?id={$row['id']}&path={$row['path']}&name={$row['name']}\" target=\"mainFrame\" onFocus=\"this.blur()\" class=\"add\"><input name=\"button\" type=\"button\" value=\"添加子类别\"/></a>
                        <span class=\"gray\">&nbsp;</span>
                        <a href=\"edit.php?id={$row['id']}\" target=\"mainFrame\" onFocus=\"this.blur()\" class=\"add\"><input name=\"button\" type=\"button\" value=\"修改\"/></a>
                        <span class=\"gray\"><span class=\"gray\">&nbsp;</span>
                        <a href=\"javascript:dodel({$row['id']})\" target=\"mainFrame\" onFocus=\"this.blur()\" class=\"add\"><input name=\"button\" type=\"button\" value=\"删除\"/></a></td>";
                  echo "</tr>";
                
            }
            
            //6.释放结果集并关闭数据库
            mysqli_free_result($result);
            mysqli_close($link);
        ?>
      
    <!--
      <tr class="bggray">
        <td align="center" valign="middle" class="borderright borderbottom"><input type="text" name="" class="text-word" value="112"></td>
        <td align="left" valign="middle" class="borderright borderbottom tdb"><img src="../include/images/main/dirfirst.gif" width="15" height="13"></td>
        <td align="center" valign="middle" class="borderright borderbottom">2</td>
        <td align="left" valign="middle" class="borderright borderbottom tdb">廉政文化专栏</td>
        <td align="center" valign="middle" class="borderbottom"><a href="add.html" target="mainFrame" onFocus="this.blur()" class="add">修改</a><span class="gray">&nbsp;|&nbsp;</span><a href="add.html" target="mainFrame" onFocus="this.blur()" class="add">复制</a><span class="gray">&nbsp;|&nbsp;</span><a href="add.html" target="mainFrame" onFocus="this.blur()" class="add">删除</a></td>
      </tr>
     
      <tr>
        <td align="center" valign="middle" class="borderright borderbottom"><input type="text" name="" class="text-word" value="112"></td>
        <td align="left" valign="middle" class="borderright borderbottom tdb"><img src="../include/images/main/dirsecond.gif" width="29" height="29"></td>
        <td align="center" valign="middle" class="borderright borderbottom">8</td>
        <td align="left" valign="middle" class="borderright borderbottom tdb">新闻报道 </td>
        <td align="center" valign="middle" class="borderbottom"><a href="add.html" target="mainFrame" onFocus="this.blur()" class="add">修改</a><span class="gray">&nbsp;|&nbsp;</span><a href="add.html" target="mainFrame" onFocus="this.blur()" class="add">复制</a><span class="gray">&nbsp;|&nbsp;</span><a href="add.html" target="mainFrame" onFocus="this.blur()" class="add">删除</a></td>
      </tr>
     -->
     
    </table></td>
    </tr>
  <tr>
    <td align="left" valign="top" id="xiugai"></td>
  </tr>
</table>
</form>
</body>
</html>