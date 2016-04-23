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
    <td width="99%" align="left" valign="top">您的位置：订单管理 >> <a href="index.php">浏览订单</a></td>
  </tr>
  <tr>
    <td  valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="search">
        <tr>
         <td width="90%" align="left" valign="middle">
             <form method="get" action="index.php" >
             
             <span>订单状态：</span>  
            
             <span><select name="status">
                    <option class="text-word" value="">全部</option>
                    <option  value="0" <?php echo $_GET['status']=='0'?"selected":""; ?> >新订单</option>
                    <option  value="1" <?php echo $_GET['status']=='1'?"selected":""; ?> >已发货</option>
                    <option  value="2" <?php echo $_GET['status']=='2'?"selected":""; ?> >已收货</option>
                    <option  value="3" <?php echo $_GET['status']=='3'?"selected":""; ?> >无效订单</option>
            </select>
            <input type="submit" value="查询" />
            <input type="button" onclick="window.location='index.php'"  value="全部"/>
            </span>
             </form>
         </td>
          <td width="10%" align="center" valign="middle" style="text-align:right; width:150px;"><a href="../users/add.php" target="mainFrame" onFocus="this.blur()" class="add">新增管理员</a></td>
        </tr>
    </table>
    </td>
  </tr>
  <tr>
    <td align="left" valign="top">
    
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="main-tab">
      <tr>
        <th align="center" valign="middle" class="borderright">编号</th>
        <th align="center" valign="middle" class="borderright">会员ID号</th>
        <th align="center" valign="middle" class="borderright">收货人</th>
     
        <th align="center" valign="middle" class="borderright">地址</th>
        <th align="center" valign="middle" class="borderright">邮编</th>
        <th align="center" valign="middle" class="borderright">电话</th>
        <th align="center" valign="middle" class="borderright">总金额</th>
        <th align="center" valign="middle" class="borderright">状态</th>
        <th align="center" valign="middle" class="borderright">购买时间</th>
        <th align="center" valign="middle">操作</th>
      </tr>
    <?php
        //======封装搜索条件==========
        $wherelist=array(); //定义一个空数组用于存放搜索条件
        $urllist = array(); //定义一个封装url传值的条件

        //print_r($_GET['state']);
        //echo $_GET['name'];
        //判断是否有状态搜索
        if(!empty($_GET['status']) || $_GET['status']==="0"){
            $wherelist[]="status='{$_GET['status']}'";
            $urllist[]="status={$_GET['status']}";
        }
        //判断并拼装sql的where条件
        $where=""; //SQL的where子句
        $url="";  //状态保持
        if(count($wherelist)>0){
            $where = " where ".implode(" and ",$wherelist);
             $url="&".implode("&",$urllist); //拼装url条件
        }
        //============================
        //导入配置文件
        require("../../public/config.php");
        //连接数据库，并判断
        $link=mysqli_connect(HOST,USER,PASSWORD)or die("对不起，数据库连接失败");
        //选择库设置字符编码
        mysqli_select_db($link,DBNAME);
        mysqli_set_charset($link,"utf8");
        //执行sql语句，并发送
        //======分页处理======================
        //定义初始化变量
        $page = isset($_GET['p'])?$_GET['p']:1; //当前页
        $pageSize = 10; //页大小
        $maxRows = 0; //总数据条数
        $maxPage = 0; //最大页数
        //获取总数据条数
        $sql = "select * from orders".$where;
        // echo $sql;
        //echo "<br/>";
        $result = mysqli_query($link,$sql);
        $maxRows = mysqli_num_rows($result);
        // echo $maxRows;
        //计算最大页数
        $maxPage = ceil($maxRows/$pageSize); //采用进一取整法
        //判断页号是否有效
        if($page>$maxPage){
            $page=$maxPage;
        }
        if($page<1){
            $page=1;
        }
        //拼装limit子句:分页公式：limit (当前页-1)*页大小，页大小
        $limit =" limit ".(($page-1)*$pageSize).",".$pageSize;
        //====================================
        $sql="select * from orders".$where.$limit;
        //echo $sql;
        //echo "<br/>";
        $result=mysqli_query($link,$sql);


        //解析结果，并遍历输出
        while($user=mysqli_fetch_assoc($result)){
            echo "<tr onMouseOut='this.style.backgroundColor='#ffffff'' onMouseOver='this.style.backgroundColor='#edf5ff''>";
            echo "<td align='center' valign='middle' class='borderright borderbottom'>{$user['id']}</td>";
            echo "<td align='center' valign='middle' class='borderright borderbottom'>{$user['uid']}</td>";
            echo "<td align='center' valign='middle' class='borderright borderbottom'>{$user['linkman']}</td>";

            echo "<td align='center' valign='middle' class='borderright borderbottom'>{$user['address']}</td>";
            echo "<td align='center' valign='middle' class='borderright borderbottom'>{$user['code']}</td>";
            echo "<td align='center' valign='middle' class='borderright borderbottom'>{$user['phone']}</td>";
            echo "<td align='center' valign='middle' class='borderright borderbottom'>{$user['total']}</td>";
            if($user['status']==0){
                $user['status']="新订单";
            }elseif($user['status']==1){
                $user['status']="已发货";
            }elseif($user['state']==2){
                $user['status']="已收货";
            }else{
                $user['status']="无效";
            }
            $addtime=date("Y-m-d",$user['addtime']);
            echo "<td align='center' valign='middle' class='borderright borderbottom'>{$user['status']}</td>";
            echo "<td align='center' valign='middle' class='borderright borderbottom'>{$addtime}</td>";
            echo "<td align='center' valign='middle' class='borderbottom'>
                      <a href='./detail.php?id={$user['id']}' target='mainFrame' onFocus='this.blur()' class='add'><button>详情</button></a><span class='gray'>&nbsp;|&nbsp;</span>
                      <button onclick='window.location=\"action.php?a=d&id={$user['id']}\"'>确认发货</button><span class='gray'>
                    <span>&nbsp;|&nbsp;</span>&nbsp;|&nbsp;</span><button onclick='window.location=\"action.php?a=q&id={$user['id']}\"'>取消订单</button><span class='gray'>
                      </td>";
            echo "</tr>";
            
        }
        //关闭数据库
        mysqli_free_result($result);
        mysqli_close($link);
?>
    </table></td>

    </tr>
  <tr>
    <?php
    echo "<td align='left' valign='top' class='fenye'>{$maxRows} 条数据 {$page}/{$maxPage} 页&nbsp;&nbsp;";
    
    echo "<a href='index.php?p=1&{$url}' target='mainFrame' onFocus='this.blur()'>首页</a>&nbsp;&nbsp;";
    
    echo "<a href='index.php?p=".($page-1)."{$url}' target='mainFrame' onFocus='this.blur()'>上一页</a>&nbsp;&nbsp";
    echo "<a href='index.php?p=".($page+1)."{$url}' target='mainFrame' onFocus='this.blur()'>下一页</a>&nbsp;&nbsp";
    echo "<a href='index.php?p={$maxPage}{$url}' target='mainFrame' onFocus='this.blur()'>尾页</a>";
    echo "<br/><br/>";
        echo "第 ";
        for($i=1;$i<=$maxPage;$i++){
            echo " <a href='index.php?p={$i}{$url}'>{$i}</a> ";
        }
            echo " 页";
        echo "</td>";
        
    ?>
    
  </tr>
</table>
</body>
</html>