<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>口袋书店网后台管理</title>
<link href="../include/css/css.css" type="text/css" rel="stylesheet" />
<link href="../include/css/main.css" type="text/css" rel="stylesheet" />
<link rel="shortcut icon" href="../include/images//main/favicon.ico" />
<style>
body{overflow-x:hidden; background:#f2f0f5; padding:15px 0px 10px 5px;}
#searchmain{ font-size:12px;}
#search{ font-size:12px; background:#548fc9; margin:10px 10px 0 0; display:inline; width:100%; color:#FFF}
#search form span{height:40px; line-height:40px; padding:0 0px 0 10px; float:left;}
#search form input.text-word{height:24px; line-height:24px; width:180px; margin:8px 0 6px 0; padding:0 0px 0 10px; float:left; border:1px solid #FFF;}
#search form input.text-but{height:24px; line-height:24px; width:55px; background:url(../include/images//main/list_input.jpg) no-repeat left top; border:none; cursor:pointer; font-family:"Microsoft YaHei","Tahoma","Arial",'宋体'; color:#666; float:left; margin:8px 0 0 6px; display:inline;}
#search a.add{ background:url(../include/images//main/add.jpg) no-repeat 0px 6px; padding:0 10px 0 26px; height:40px; line-height:40px; font-size:14px; font-weight:bold; color:#FFF}
#search a:hover.add{ text-decoration:underline; color:#d2e9ff;}
#main-tab{ border:1px solid #eaeaea; background:#FFF; font-size:12px;}
#main-tab th{ font-size:12px; background:url(../include/images//main/list_bg.jpg) repeat-x; height:32px; line-height:32px;}
#main-tab td{ font-size:12px; line-height:40px;}
#main-tab td a{ font-size:12px; color:#548fc9;}
#main-tab td a:hover{color:#565656; text-decoration:underline;}
.bordertop{ border-top:1px solid #ebebeb}
.borderright{ border-right:1px solid #ebebeb}
.borderbottom{ border-bottom:1px solid #ebebeb}
.borderleft{ border-left:1px solid #ebebeb}
.gray{ color:#dbdbdb;}
td.fenye{ padding:10px 0 0 0; text-align:right;}
.bggray{ background:#f9f9f9; font-size:14px; font-weight:bold; padding:10px 10px 10px 0; width:120px;}
.main-for{ padding:10px;}
.main-for input.text-word{ width:310px; height:36px; line-height:36px; border:#ebebeb 1px solid; background:#FFF; font-family:"Microsoft YaHei","Tahoma","Arial",'宋体'; padding:0 10px;}
.main-for select{ width:310px; height:36px; line-height:36px; border:#ebebeb 1px solid; background:#FFF; font-family:"Microsoft YaHei","Tahoma","Arial",'宋体'; color:#666;}
.main-for input.text-but{ width:100px; height:40px; line-height:30px; border: 1px solid #cdcdcd; background:#e6e6e6; font-family:"Microsoft YaHei","Tahoma","Arial",'宋体'; color:#969696; float:left; margin:0 10px 0 0; display:inline; cursor:pointer; font-size:14px; font-weight:bold;}
#addinfo a{ font-size:14px; font-weight:bold; background:url(../include/images//main/addinfoblack.jpg) no-repeat 0 1px; padding:0px 0 0px 20px; line-height:45px;}
#addinfo a:hover{ background:url(../include/images//main/addinfoblue.jpg) no-repeat 0 1px;}
</style>
</head>
<body>
<!--编辑页面，从数据库读取数据，显示在表单域中，再覆盖写到数据库-->

    <?php
        //=====获取要修改的信息==========
        //1.导入配置文件
        require("../../public/config.php");
        //2.连接数据库，并判断是否连接成功
        $link = @mysqli_connect(HOST,USER,PASSWORD) or die ("对不起，您的数据库连接失败，请重新配置连接。");
        //3.选择数据库并设置字符集
        mysqli_select_db($link,DBNAME);
        mysqli_set_charset($link,"utf8");
        //4.定义查询SQL语句，并执行
        $sql = "select * from users where id=".($_GET['id']+0);
        $result = mysqli_query($link,$sql);
        //5.解析结果集
        if(mysqli_num_rows($result)>0){
            $users = mysqli_fetch_assoc($result);
            //6.释放结果集
            mysqli_free_result($result);
        }else{
            die("对不起，没有找到您要修改的数据。非常抱歉");
        }
        //7.关闭数据库
        mysqli_close($link); 
    ?>
<!--main_top-->
<table width="99%" border="0" cellspacing="0" cellpadding="0" id="searchmain">
  <tr>
    <td width="99%" align="left" valign="top"><a href="edit.php">您的位置</a>：<a href="edit.php">会员管理</a>&nbsp;&nbsp;>&nbsp;&nbsp;<a href="edit.php">编辑用户</a></td>
  </tr>
  <tr>
    <td align="left" valign="top" id="addinfo">
    <a href="add.php" target="mainFrame" onFocus="this.blur()" class="add">新增用户</a>
    </td>
  </tr>
  <tr>
    <td align="left" valign="top">
    <form method="post" action="action.php?asuka=update">
    <input type="hidden" name="id" value="<?php echo $users['id']; ?>">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="main-tab">
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">账号：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="username" value="<?php echo $users['username'] ?>" class="text-word">
        </td>
        </tr>
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">真实姓名：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="name" value="<?php echo $users['name'] ?>" class="text-word">
        </td>
        </tr>
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">性别：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
            <input type="radio" name="sex" id = "sexy1" value="1" <?php echo ($users['sex']=='1')?"checked":""; ?>/><label for="sexy1">男</label>&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name="sex" id = "sexy2" value="0" <?php echo ($users['sex']=='0')?"checked":""; ?>/><label for="sexy2">女</label>
        </td>
      </tr>
    <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
    <td align="right" valign="middle" class="borderright borderbottom bggray">地址：</td>
    <td align="left" valign="middle" class="borderright borderbottom main-for">
    <input type="text" name="address" value="<?php echo $users['address'] ?>" class="text-word">
    </td>
    </tr>
    
    <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
    <td align="right" valign="middle" class="borderright borderbottom bggray">邮编：</td>
    <td align="left" valign="middle" class="borderright borderbottom main-for">
    <input type="text" name="code" value="<?php echo $users['code'] ?>" class="text-word">
    </td>
    </tr>
        <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
    <td align="right" valign="middle" class="borderright borderbottom bggray">电话：</td>
    <td align="left" valign="middle" class="borderright borderbottom main-for">
    <input type="text" name="phone" value="<?php echo $users['phone'] ?>" class="text-word">
    </td>
    </tr>
        <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
    <td align="right" valign="middle" class="borderright borderbottom bggray">邮箱：</td>
    <td align="left" valign="middle" class="borderright borderbottom main-for">
    <input type="text" name="email" value="<?php echo $users['email'] ?>" class="text-word">
    </td>
    </tr>
  
    <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
    <td align="right" valign="middle" class="borderright borderbottom bggray">权限：</td>
    <td align="left" valign="middle" class="borderright borderbottom main-for">
    <!--
        <input type="radio" name="state" value="1" <?php echo ($users['state']=='1')?"checked":""; ?>/>启用
        <input type="radio" name="state" value="2" <?php echo ($users['state']=='2')?"checked":""; ?>/>禁用
        <input type="radio" name="state" value="0" <?php echo ($users['state']=='0')?"checked":""; ?>/>管理员
        -->
        <select name="state" id="level">
            <option value="1" <?php echo ($users['state']=='1')?"selected":""; ?>>&nbsp;&nbsp;启用</option>
            <option value="2" <?php echo ($users['state']=='2')?"selected":""; ?>>&nbsp;&nbsp;禁用</option>
            <option value="0" <?php echo ($users['state']=='0')?"selected":""; ?>>&nbsp;&nbsp;管理员</option>
        </select>
     </td>
    </tr>
  <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
    <td align="right" valign="middle" class="borderright borderbottom bggray">&nbsp;</td>
    <td align="left" valign="middle" class="borderright borderbottom main-for">
    <input name="" type="submit" value="提交" class="text-but">
    <input name="" type="reset" value="重置" class="text-but"></td>
    </tr>
    </table>
    </form>
    </td>
    </tr>
</table>
</body>
</html>