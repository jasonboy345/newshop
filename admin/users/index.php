<?php header("Content-Type:text/html;charset=utf-8"); ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>主要内容区main</title>
<script type="text/javascript">
    function dodel(id){
        if(confirm ("大人，您确认删除吗？")){
            window.location="action.php?asuka=delete&id="+id;
        }
    }
</script>
<link href="../include/css/css.css" type="text/css" rel="stylesheet" />
<link href="../include/css/main.css" type="text/css" rel="stylesheet" />
<link rel="shortcut icon" href="../include/images/main/favicon.ico" />
<style>
body{overflow-x:hidden; background:#f2f0f5; padding:15px 0px 10px 5px;}
#searchmain{ font-size:12px;}
#search{ font-size:12px; background:#548fc9; margin:10px 10px 0 0; display:inline; width:100%; color:#FFF; float:left}
#search form span{height:40px; line-height:40px; padding:0 0px 0 10px; float:left;}
#search form input.text-word{height:24px; line-height:24px; width:120px; margin:8px 0 6px 0; padding:0 0px 0 10px; float:left; border:1px solid #FFF;}
#search form select.text-word{height:24px; line-height:24px; width:80px; margin:8px 0 6px 0; padding:0 0px 0 10px; float:left; border:1px solid #FFF;}
#search form input.text-but{height:24px; line-height:24px; width:55px; background:url(../include/images/main/list_input.jpg) no-repeat left top; border:none; cursor:pointer; font-family:"Microsoft YaHei","Tahoma","Arial",'宋体'; color:#666; float:left; margin:8px 0 0 6px; display:inline;}
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
    <td width="99%" align="left" valign="top">您的位置：<a href="index.php">会员管理</a><a href="index.php">>>浏览会员</a></td>
  </tr>
  <tr>
    <td align="left" valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="search">
        <tr>
         <td width="90%" align="left" valign="middle">

              <!---=======搜索表单信息========-->
            <form action="index.php" method="get"/>
            <span>账号：</span>
            <input class="text-word" type="text" size="6" name="username" value="<?php  echo isset($_GET['username'])?($_GET['username']):""; ?>"/>
            <span>姓名：</span>
            <input class="text-word" type="text" size="6" name="name" value="<?php  echo isset($_GET['name'])?($_GET['name']):""; ?>"/>             
              <span>性别：</span>
              <span>
              <select name="sex" class="text-word">
                            <option value="" >-全部-</option>
                            <option value="1" <?php echo ($_GET['sex']=='1')?"selected":""; ?>>男</option>
                            <option value="0" <?php echo ($_GET['sex']=='0')?"selected":""; ?>>女</option>
                      </select>
              </span>
                      <input type="submit" value="搜索" class="text-but">
                      <input type="button" onclick="window.location='index.php'" value="全部" class="text-but">
            </form>
            <!--=======================================================================================-->
         </td>
          <td width="10%" align="center" valign="middle" style="text-align:right; width:150px;"><a href="add.php" target="mainFrame" onFocus="this.blur()" class="add">新增会员</a></td>
        </tr>
    </table>
    </td>
  </tr>
  <tr>
    <td align="left" valign="top">
    
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="main-tab">
      <tr>
        <th align="center" valign="middle" class="borderright">ID号</th>
        <th align="center" valign="middle" class="borderright">账号</th>
        <th align="center" valign="middle" class="borderright">姓名</th>
        <th align="center" valign="middle" class="borderright">性别</th>
        <th align="center" valign="middle" class="borderright">电话</th>
        <th align="center" valign="middle" class="borderright">邮箱</th>
        <th align="center" valign="middle" class="borderright">添加时间</th>
        <th align="center" valign="middle" class="borderright">状态</th>
        <th align="center" valign="middle">操作</th>
      </tr>
        <?php
            //============封装搜索条件===================================
            $wherelist = array();  //定义一个用于封装搜索条件的数组 
            $urllist = array();
            //判断是否有名字搜索
            if(!empty($_GET['username'])){
                //搜索name名字里有某某字母
                $wherelist[] = "username like '%{$_GET['username']}%'";
                $urllist[] = "username={$_GET['username']}";
                
            }
            if(!empty($_GET['name'])){
                //搜索名字
                $wherelist[] = "name like '%{$_GET['name']}%'";
                $urllist[] = "name={$_GET['name']}";
                
            }
            //判断是否有性别搜索
            //if(!empty($_GET['sex'])){
                //搜索sex
                //$wherelist[] = "sex='{$_GET['sex']}'";
                //状态维持
               // $urllist[] = "sex={$_GET['sex']}";
            //}
            
            //判断是否有性别搜索
            if(!empty($_GET['sex']) || $_GET['sex']==='0'){
             $wherelist[]="sex='{$_GET['sex']}'";
             $urllist[] = "sex={$_GET['sex']}";
            }
            
            //判断并拼装搜索条件
            $where = "";
            $url = "";
            if(count($wherelist)>0){
                $where  =" where ".implode(" and ",$wherelist);
                $url = "&".implode("&",$urllist);
            }
                    
            //=============================================================
            //定义数组选择器
            $state = array(0=>"管理员",1=>"启用",2=>"禁用");
            $sex = array(0=>"女",1=>"男");
            
            //1.导入配置文件
            require("../../public/config.php");
            
            //2.连接mysqli,并判断是否连接成功过
            $link=@mysqli_connect(HOST,USER,PASSWORD) or die("对不起，您连接数据库出现了问题。");
            
            //3.选择连接数据库并配置字符集
            mysqli_select_db($link,DBNAME);
            mysqli_set_charset($link,"utf8");
                
            //==================做分页处理================================
            //初始化变量
            //$page = 1;  //告诉我当前那页(当前页)
            $page = isset($_GET['page'])?$_GET['page']:1;  //当前页
            $pagesize = 9;  //页大小
            $maxrows = 0;   //总数据条数 
            $maxpages = 0;  //总页数
            
            //获取总数据条数
            $sql = "select * from users".$where;
            echo $sql;

            $result = mysqli_query($link,$sql);
            $maxrows = mysqli_num_rows($result);  //结果集的定位取值
            //计算总页数
            $maxpages = ceil($maxrows/$pagesize);//采用进一取整法计算总页数
            //判断页数是否越界
            if($page>$maxpages){
                $page=$maxpages;  //防止页数过大
            }
            if($page<1){
                $page=1;          //防止页数过小
            }
            //拼装分页limit语句----limit (当前页-1)*页大小,页大小-----分页公式
            $limit = " limit ".(($page-1)*$pagesize).",".$pagesize;
                /*
                limit 0,4      第1条 (1-1*4),4     0,4
                limit 4,4      第2条 (2-1*4),4     1,4
                limit 8,4      第3条 (3-1*4),4     2,4
                limit 12,4     第4条 (4-1*4),4     3,4
                limit 16,4     第5条 (5-1*4),4     4,4
                */
                
            //==================================================    
                //4.拼装SQL语句并发送服务器执行
                $sql = "select * from users".$where.$limit;
                $result = mysqli_query($link,$sql);
                
            //5.执行遍历解析输出操作
            while($row = mysqli_fetch_assoc($result)){
                echo "<tr onMouseOut=\"this.style.backgroundColor='#ffffff'\" onMouseOver=\"this.style.backgroundColor='#edf5ff'\">";
                echo "<td align=\"center\" valign=\"middle\" class=\"borderright borderbottom\">{$row['id']}</td>";
                echo "<td align=\"center\" valign=\"middle\" class=\"borderright borderbottom\">{$row['username']}</td>";
                echo "<td align=\"center\" valign=\"middle\" class=\"borderright borderbottom\">{$row['name']}</td>";
                echo "<td align=\"center\" valign=\"middle\" class=\"borderright borderbottom\">{$sex[$row['sex']]}</td>";
                echo "<td align=\"center\" valign=\"middle\" class=\"borderright borderbottom\">{$row['phone']}</td>";
                echo "<td align=\"center\" valign=\"middle\" class=\"borderright borderbottom\">{$row['email']}</td>";
                echo "<td align=\"center\" valign=\"middle\" class=\"borderright borderbottom\">".date("Y-m-d H:i:s",$row['addtime'])."</td>";
                echo "<td align=\"center\" valign=\"middle\" class=\"borderright borderbottom\">{$state[$row['state']]}</td>";
                echo "<td align=\"center\" valign=\"middle\" class=\"borderbottom\">
                        <a href=\"edit.php?id={$row['id']}\" target=\"mainFrame\" onFocus=\"this.blur()\" class=\"add\">编辑</a>
                            <span class=\"gray\">&nbsp;|&nbsp;</span>
                        <a href=\"javascript:dodel({$row['id']})\" target=\"mainFrame\" onFocus=\"this.blur()\" class=\"add\">删除</a>
                            <span class=\"gray\">&nbsp;|&nbsp;</span>
                        <a href=\"repass.php?id={$row['id']}\" target=\"mainFrame\" onFocus=\"this.blur()\" class=\"add\">重置密码</a>
                </td>";
                echo "</tr>";
            }
                
            //6.释放结果集并关闭数据库
            mysqli_free_result($result);
            mysqli_close($link);
        ?>
      
     
    </table></td>
    </tr>
  <tr>
    <td align="left" valign="top" class="fenye">
      <?php
            //输出页码信息
      // echo $maxrows;
            echo "当前第{$page}/{$maxpages}页，共计{$maxrows}条 ";
            echo " <a href='index.php?page=1{$url}'>首页</a> ";
            echo " <a href='index.php?page=".($page-1)."{$url}'>上一页</a> ";
            echo " <a href='index.php?page=".($page+1)."{$url}'>下一页</a> ";
            echo " <a href='index.php?page={$maxpages}{$url}'>末页</a> ";
        ?> 
    </td>
  </tr>
</table>
</body>
</html>