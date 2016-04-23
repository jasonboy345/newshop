<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8"/>
<title>口袋书店网后台管理</title>
<link href="../include/css/css.css" type="text/css" rel="stylesheet" />
<link href="../include/css/main.css" type="text/css" rel="stylesheet" />
<link rel="shortcut icon" href="../include/images/main/favicon.ico" />
<style>
body{overflow-x:hidden; background:#f2f0f5; padding:15px 0px 10px 5px;}
#searchmain{ font-size:12px;}
#search{ font-size:12px; background:#548fc9; margin:10px 10px 0 0; display:inline; width:100%; color:#FFF; float:left}
#search form span{height:40px; line-height:40px; padding:0 0px 0 10px; float:left;}
#search form input.text-word{height:24px; line-height:24px; width:100px; margin:8px 0 6px 0; padding:0 0px 0 10px; float:left; border:1px solid #FFF;}
#search form select.text-word{height:24px; line-height:24px; width:80px; margin:8px 0 6px 0; padding:0 0px 0 10px; float:left; border:1px solid #FFF;}
#search form select.text-word1{height:24px; line-height:24px; width:150px; margin:8px 0 6px 0; padding:0 0px 0 10px; float:left; border:1px solid #FFF;}
#search form span.text-word{height:24px; line-height:24px; width:80px; margin:8px 0 6px 0; padding:0 0px 0 10px; float:left;}
#search form span.text-price{height:24px; line-height:24px; width:40px; margin:8px 0 6px 0; padding:0 0px 0 5px; float:left;}
#search form span.text-line{height:24px; line-height:24px; width:10px; margin:8px 0 6px 0; padding:0 0px 0 10px; float:left;}
#search form input.text-but{height:24px; line-height:24px; width:55px; background:url(../include/images/main/list_input.jpg) no-repeat left top; border:none; cursor:pointer; font-family:"Microsoft YaHei","Tahoma","Arial",'宋体'; color:#666; float:left; margin:8px 0 0 16px; display:inline;}
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
    <td width="99%" align="left" valign="top">您的位置：<a href="index.php">商品管理</a>>><a href="index.php">浏览商品</a></td>
  </tr>
  <tr>
    <td align="left" valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="search">
        <tr>
        
         <td width="90%" align="left" valign="middle">
            <form method="get" action="index.php">
              
                <span>书名：</span>
                    <input type="text" name="goods" size="6" value="<?php  echo isset($_GET['goods'])?($_GET['goods']):""; ?>" class="text-word"/>
                <span>书类：</span>
                    <select name="typeid" class="text-word1">
                        <option value="">--全部--</option>
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
                            //数逗号，为了缩进
                            $m = substr_count($row['path'],',')-1;
                            //计算填充
                            $strpad = str_pad("",$m*6*5,"&nbsp;");
                            //判断是否禁用
                            if($row['pid']==0){
                                $stop = "disabled";
                            }
                            else{
                                $stop = "";
                            }
                            
                            //默认选择商品类别项
                            $selected = "";
                            if($_GET['typeid']==$row['id']){
                                $selected = "selected";
                            }
                            echo "<option {$stop} {$selected} value='{$row['id']}'>{$strpad}{$row['name']}</option>";
                        }
                            
                            //6.释放结果集并关闭数据库
                            mysqli_free_result($result);
                            //mysqli_close($link);
                        ?>
                    </select>
                    
                 <span>状态：</span>
                     <select name="state" class="text-word" >
                        <option value="" >-全部-</option>
                        <option value="1" <?php echo ($_GET['state']=='1')?"selected":""; ?>>新添加</option>
                        <option value="2" <?php echo ($_GET['state']=='2')?"selected":""; ?>>在售</option>
                        <option value="3" <?php echo ($_GET['state']=='3')?"selected":""; ?>>下架</option>
                      </select>
                
                <span>价格：</span>
                     <span class="text-price">
                        <input type="text" size="2" name="price1" value="<?php  echo isset($_GET['price1'])?($_GET['price1']):""; ?>"/>
                     </span>
                <span class="text-line">---</span>
                <span class="text-price">
                    <input type="text" size="2" name="price2" value="<?php  echo isset($_GET['price2'])?($_GET['price2']):""; ?>"/>
                </span>
                <input type="submit" value="搜索" class="text-but">
                <input type="button" onclick="window.location='index.php'" value="全部" class="text-but">
             </form>
         </td>
         <td width="10%" align="center" valign="middle" style="text-align:right; width:150px;"><a href="add.php" target="mainFrame" onFocus="this.blur()" class="add">添加图书</a></td>
        </tr>
    </table>
    </td>
  </tr>
  <tr>
    <td align="left" valign="top">
    
        <table width="100%" border="0" cellspacing="0" cellpadding="0" id="main-tab">
              <tr>
                <th align="center" valign="middle" class="borderright">ID编号</th>
                <th align="center" valign="middle" class="borderright">图书类别</th>
                <th align="center" valign="middle" class="borderright">图书书名</th>
                <th align="center" valign="middle" class="borderright">发行出版</th>
                <th align="center" valign="middle" class="borderright">图书封面</th>
                <th align="center" valign="middle" class="borderright">图书单价</th>
                <th align="center" valign="middle" class="borderright">图书库存</th>
                <!--<th align="center" valign="middle" class="borderright">图书销量</th>-->
                <!--<th align="center" valign="middle" class="borderright">图书点击</th>-->
                <th align="center" valign="middle" class="borderright">图书状态</th>
                <th align="center" valign="middle" class="borderright">添加时间</th>
                <th align="center" valign="middle" class="borderright">操作</th>
              </tr>
              
               <?php 
                //============封装搜索条件===================================
                $wherelist = array();  //定义一个用于封装搜索条件的数组 
                $urllist = array();
                //判断是否有名字搜索
                if(!empty($_GET['goods'])){
                    //搜索name名字里有某某字母
                    $wherelist[] = " goods like '%{$_GET['goods']}%'";
                    $urllist[] = "goods={$_GET['goods']}";
                    
                }
                //判断是否有状态搜索
                if(!empty($_GET['state'])){
                    //搜索state
                    $wherelist[] = "state='{$_GET['state']}'";
                    //状态维持
                    $urllist[] = "state={$_GET['state']}";
                }
                //判断是否有类别搜索
                //if(!empty($_GET['type_id'])){
                    //搜索typeid的值
                    //$wherelist[] = "typeid='{$_GET['type_id']}'";
                    //状态维持
                   // $urllist[] =  "type_id={$_GET['type_id']}";
                //}
                
                //判断是否有价格区间搜索
                if(!empty($_GET['price1']) && !empty($_GET['price2'])){
                    $wherelist[] = "  price between '{$_GET['price1']}' and '{$_GET['price2']}' ";
                    //状态维持
                    $urllist[] = "price1={$_GET['price1']}";
                    $urllist[] = "price2={$_GET['price2']}";
                }
                
                 /****************商品类别搜索**************************/
                    //当没有搜索商品分类时，不走以下的代码
                    if(!empty($_GET['typeid'])){
                        //拿到当前查询到的ID值，为了搜索他的子类
                        $id = $_GET['typeid'];
                        //echo $id;
                        //exit();
                    
                    //拿到id后，去type表查询当前id下的所有的子类
                    $sql = "select * from type where path like '%,{$id},%'";
                    //echo $sql;
                    //exit();
                    $result = mysqli_query($link,$sql);
                    //循环遍历出type的id号，为了对应goods表的typeid
                    if($result && mysqli_num_rows($result)>0){
                        $arr = array();   //定义一个存放type 表的新数组
                        while($row = mysqli_fetch_assoc($result)){
                            $arr[] = $row['id'];
                        }
                    }
                    $arr[]=$id;  //本身父系id也获取
                    //var_dump($arr);
                    //exit();
                    //将数组转化成字符串
                    $str = implode(",",$arr);
                    //print_r ($str);
                    //exit();
                    $wherelist[] = " g.typeid in ({$str})";  //g.typeid in (34,35,38)
                    //var_dump($wherelist);
                    //exit();
                    $urllist[] = "typeid={$_GET['typeid']}";
                }
               /*****************************************************/
                
              
                //判断并拼装搜索条件
                $where = "";
                $url = "";
                if(count($wherelist)>0){
                    $where  =" and ".implode(" and ",$wherelist);
                    $url = "&".implode("&",$urllist);
                    //echo $where;  //and goods like '%解%' and price between '12' and '34' and g.typeid in (34,35,38)
                    //exit();
                    //echo $url;  // &goods=我&price1=1&price2=2&typeid=28
                    //exit();
                    //echo "<br/>";
                    //echo var_dump ($urllist);
                    //echo "<br/>";
                }
                        
                     
                //=============================================================
                
                    $state=array(1=>"新添加",2=>"在售",3=>"下架");
                    //1.导入配置文件
                    //require("../../public/config.php");
                    
                    //2.连接数据库，并判断
                    //$link = @mysqli_connect(HOST,USER,PASSWORD) or die("对不起，数据库连接失败。");
                    
                    //3.选择数据库，设置字符集
                    //mysqli_select_db(DBNAME,$link);
                   // mysqli_set_charset("utf8");
                    
                    //==================做分页处理================================
                    //初始化变量
                    //$page = 1;  //告诉我当前那页(当前页)
                    $page = isset($_GET['page'])?$_GET['page']:1;  //当前页
                    $pagesize = 5;  //页大小
                    $maxrows = 0;   //总数据条数 
                    $maxpages = 0;  //总页数
                    //获取总数据条数
                    $sql = "select * from goods g,type t where g.typeid=t.id".$where;
                    //echo $sql;
                    //exit();
                    $result = mysqli_query($link,$sql);
                    //var_dump($result);
                    //exit();
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
                    
                    //4.准备SQL语句，并执行
                    //$sql = "select * from goods ".$where." order by addtime desc ".$limit;
                    $sql="select g.*,t.name as typename from goods as g,type as t where g.typeid=t.id ".$where." order by addtime desc ".$limit;
                    //echo "<br/>";
                    //echo $sql;
                    $result = @mysqli_query($link,$sql);
                    
                    //5.解析结果集
                    while($row=mysqli_fetch_assoc($result)){
                        
                        echo "<tr onMouseOut=\"this.style.backgroundColor='#ffffff'\" onMouseOver=\"this.style.backgroundColor='#edf5ff'\">";
                        echo "<td align=\"center\" valign=\"middle\" class=\"borderright borderbottom\">{$row['id']}</td>";
                        echo "<td align=\"center\" valign=\"middle\" class=\"borderright borderbottom\">{$row['typename']}</td>";
                        echo "<td align=\"center\" valign=\"middle\" class=\"borderright borderbottom\">{$row['goods']}</td>";
                        echo "<td align=\"center\" valign=\"middle\" class=\"borderright borderbottom\">{$row['company']}</td>";
                        echo "<td align=\"center\" valign=\"middle\" class=\"borderright borderbottom\"><img src='../../public/uploads/s_{$row['picname']}'/></td>";
                        echo "<td align=\"center\" valign=\"middle\" class=\"borderright borderbottom\">￥{$row['price']}</td>";
                        echo "<td align=\"center\" valign=\"middle\" class=\"borderright borderbottom\">{$row['store']}本</td>";
                        //echo "<td align=\"center\" valign=\"middle\" class=\"borderright borderbottom\">{$row['num']}本</td>";
                        //echo "<td align=\"center\" valign=\"middle\" class=\"borderright borderbottom\">{$row['clicknum']}点击</td>";
                        echo "<td align=\"center\" valign=\"middle\" class=\"borderright borderbottom\">{$state[$row['state']]}</td>";
                        echo "<td align=\"center\" valign=\"middle\" class=\"borderright borderbottom\">".date("Y-m-d H:i:s",$row['addtime'])."</td>";
                        echo "<td align=\"center\" valign=\"middle\" class=\"borderbottom\">
                            <a href=\"edit.php?id={$row['id']}\" target=\"mainFrame\" onFocus=\"this.blur()\" class=\"add\"><input name=\"button\" type=\"button\" value=\"编辑\"/></a>
                                <span class=\"gray\">&nbsp;&nbsp;</span>
                            <a href=\"action.php?goods=delete&id={$row['id']}&picname={$row['picname']}&state={$row['state']}\" target=\"mainFrame\" onFocus=\"this.blur()\" class=\"add\"><input name=\"button\" type=\"button\" value=\"删除\"/></a>
                        </td>";
                        echo "</tr>";

                    }   
                    
                    //6.释放结果集，关闭数据库
                    mysqli_free_result($result);
                    mysqli_close($link);
                ?>
              
        </table>
    </td>
    </tr>
  <tr>
    <td align="left" valign="top" class="fenye">
        <?php
            //输出页码信息
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