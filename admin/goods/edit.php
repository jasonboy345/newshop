<?php header("Content-Type:text/html;charset=utf-8"); ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>口袋书店网后台管理</title>
<link href="../include/css/css.css" type="text/css" rel="stylesheet" />
<link href="../include/css/main.css" type="text/css" rel="stylesheet" />
<link rel="shortcut icon" href="images/main/favicon.ico" />
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
.bggray{ background:#f9f9f9; font-size:14px; font-weight:bold; padding:10px 10px 10px 0; width:120px;}
.main-for{ padding:10px;}
.main-for input.text-word{ width:310px; height:36px; line-height:36px; border:#ebebeb 1px solid; background:#FFF; font-family:"Microsoft YaHei","Tahoma","Arial",'宋体'; padding:0 10px;}
.main-for select{ width:310px; height:36px; line-height:36px; border:#ebebeb 1px solid; background:#FFF; font-family:"Microsoft YaHei","Tahoma","Arial",'宋体'; color:#666;}
.main-for input.text-but{ width:100px; height:40px; line-height:30px; border: 1px solid #cdcdcd; background:#e6e6e6; font-family:"Microsoft YaHei","Tahoma","Arial",'宋体'; color:#969696; float:left; margin:0 10px 0 0; display:inline; cursor:pointer; font-size:14px; font-weight:bold;}
#addinfo a{ font-size:14px; font-weight:bold; background:url(../include/images/main/addinfoblack.jpg) no-repeat 0 1px; padding:0px 0 0px 20px; line-height:45px;}
#addinfo a:hover{ background:url(../include/images/main/addinfoblue.jpg) no-repeat 0 1px;}
</style>
</head>
<body>
<!--编辑页面，从数据库读取数据，显示在表单域中，再覆盖写到数据库-->
     <?php 
        //编辑图书信息，首先要获取商品信息
        //1.导入配置文件
        require("../../public/config.php");
        //2.连接MySQL数据库，并判断是否已连接成功
        $link = @mysqli_connect(HOST,USER,PASSWORD) or die("对不起，您连接数据库失败！");
        //3.选择连接数据库并配置字符集
        mysqli_select_db($link,DBNAME);
        mysqli_set_charset($link,"utf8");
        //4.获取要修改的图书信息
        $sql = "select * from goods where id={$_GET['id']}";
        $result = mysqli_query($link,$sql);
        //5.判断是否获取要编辑的图书信息
        if($result && mysqli_num_rows($result)>0){  //如果结果集存在并且获取了数据条数
            //id是主键，查到的数据绝对唯一
            $liubin = mysqli_fetch_assoc($result);  //解析出要修改的图书信息
            mysqli_free_result($result);
        }else{
            die("没有找到要修改的图书信息");
        }
        //mysql_close($link);
    ?>
<!--main_top-->
<table width="99%" border="0" cellspacing="0" cellpadding="0" id="searchmain">
  <tr>
    <td width="99%" align="left" valign="top">您的位置：类别管理&nbsp;&nbsp;>&nbsp;&nbsp;<a href="">修改分类</a></td>
  </tr>
  <tr>
    <td align="left" valign="top" id="addinfo">
    <a href="add.php" target="mainFrame" onFocus="this.blur()" class="add">新增分类</a>
    </td>
  </tr>
  <tr>
    <td align="left" valign="top">
    <form method="post" action="action.php?goods=update" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $liubin['id']; ?>"/>
    <input type="hidden" name="oldpic" value="<?php echo $liubin['picname']; ?>"/>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="main-tab">
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">图书类别：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
            <select name="typeid">
                <?php
                    //1.导入配置文件
                    //require("../../public/config.php");
                    
                    //2.连接Mysql,并判断是否连接成功过
                    //$link=@mysql_connect(HOST,USER,PASSWORD) or die("对不起，您连接数据库出现了问题。");
                    
                    //3.选择连接数据库并配置字符集
                     //mysql_select_db(DBNAME,$link);
                    // mysql_set_charset("utf8");
                    
                    //4.拼装SQL语句并发送服务器执行
                    //$sql = "select * from type";
                    //排列字段;
                    $sql = "select * from type order by concat(path,id)";
                    $result = mysqli_query($link,$sql);
                    
                    //5.执行遍历解析输出操作,循环显示，将每一行信息写入<option></option>中
                    while($row = mysqli_fetch_assoc($result)){
                        //处理缩进效果
                        $m = substr_count($row['path'],",")-1;//获取path字段中逗号出现的次数-1
                        $nbsp = str_repeat("&nbsp;",$m*4);  //计算空格
                        //遍历输出，并生成下拉菜单
                        //判断是否是当前的类型
                        $default = ($liubin['typeid']==$row['id'])?"selected":"";
                        //判断根目录是否被禁止
                        if($row['pid']==0){
                            $stop = "disabled";
                        }else{
                            $stop = "";
                        }
                        echo "<option  {$stop} value='{$row['id']}' {$default}>{$nbsp}{$row['name']}</option>"; 
                        
                    }
                    
                    //6.释放结果集并关闭数据库
                    mysqli_free_result($result);
                    mysqli_close($link);
                ?>
            </select>
        </td>
     </tr>
     
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">图书书名：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="goods" value="<?php echo $liubin['goods']; ?>" class="text-word">
        </td>
        </tr>
        
         <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">发行出版：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="company" value="<?php echo $liubin['company']; ?>" class="text-word">
        </td>
        </tr>
        
         <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">图书封面：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="file" name="pic" value="" class="text-word">
        </td>
        </tr>
        
         <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">图书状态：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
            新添加：<input type="radio" name="state" value="1" <?php echo ($liubin['state']=='1')?"checked":""; ?>/>
            <br/>
            在售的：<input type="radio" name="state" value="2" <?php echo ($liubin['state']=='2')?"checked":""; ?>/>
            <br/>
            已下架：<input type="radio" name="state" value="3" <?php echo ($liubin['state']=='3')?"checked":""; ?>/>
        </td>
        </tr>
        
         <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">图书单价：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="price" value="<?php echo $liubin['price']; ?>" class="text-word">
        </td>
        </tr>
        
         <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">图书库存：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input type="text" name="store" value="<?php echo $liubin['store']; ?>" class="text-word">
        </td>
        </tr>
        
         <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">图书简介：</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <textarea rows="6" cols="30" name="descr" /><?php echo $liubin['descr']; ?></textarea>
        </td>
        </tr>
        
         <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">&nbsp ;</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <img src="../../public/uploads/<?php echo $liubin['picname']; ?>">
        </td>
        </tr>
        
     
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="right" valign="middle" class="borderright borderbottom bggray">&nbsp;</td>
        <td align="left" valign="middle" class="borderright borderbottom main-for">
        <input name="" type="submit" value="修改" class="text-but">
        <input name="" type="reset" value="重置" class="text-but"></td>
      </tr>
    </table>
    </form>
    </td>
    </tr>
</table>
</body>
</html>