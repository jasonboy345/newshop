<?php 
    session_start();
    //将上一个页面的URL地址记录到session   //http://localhost/newshop/home/detail.php?id=18'
    //放到session中是为了全界面引用；
    $_SESSION['url'] = $_SERVER['HTTP_REFERER'];
    //var_dump($_SESSION);
    
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>口袋书店</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="./include/css/common.css">
		<link rel="stylesheet" type="text/css" href="./include/css/sidebar.css">
		<link rel="stylesheet" type="text/css" href="./include/css/pro.css">
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
	
	<body>
		<div id="container">
			<?php include("./include/header.php"); ?>
			<!--主体开始-->
			<div id="main">
				<?php include("./include/sidebar.php"); ?>
				<!--产品列表页开始-->
				<div class="main_wraper">
					<div class="wraper_category">
						<!----------搜索栏设置开始--------------->
                <form method="get" action="list.php">
      
                    <span>书名：</span>
                        <input type="text" name="keyword" size="6" value="<?php  echo isset($_GET['keyword'])?($_GET['keyword']):""; ?>" class="text-word"/>
                    <span>书类：</span>
                    <select name="tid" class="text-word1">
                        <option value="">--全部--</option>
                    <?php
                        //1.导入配置文件
                        //require("../../public/config.php");
                        
                        //2.连接Mysql,并判断是否连接成功过
                        // $link=@mysql_connect(HOST,USER,PASSWORD) or die("对不起，您连接数据库出现了问题。");
                        
                        //3.选择连接数据库并配置字符集
                        // mysql_select_db(DBNAME,$link);
                        // mysql_set_charset("utf8");
                        
                        //4.拼装SQL语句并发送服务器执行
                        //$sql = "select * from type";
                        //排列字段;
                        $sql = "select * from type order by concat(path,id)";
                        $result = mysql_query($sql,$link);
                        
                        //5.执行遍历解析输出操作
                        while($row = mysql_fetch_assoc($result)){
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
                            if($_GET['tid']==$row['id']){
                                $selected = "selected";
                            }
                            echo "<option {$stop} {$selected} value='{$row['id']}'>{$strpad}{$row['name']}</option>";
                        }
                            
                            //6.释放结果集并关闭数据库
                            mysql_free_result($result);
                            //mysql_close($link);
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
                    <input type="button" onclick="window.location='list.php'" value="全部" class="text-but">
                </form>
                
						<!--搜索栏设置结束-->
					</div>
					<div class="wraper_pro">
						<div class="wraper_pro_title">产品分类</div>
						<div class="wraper_pro_tu">
							<!--产品图片循环开始-->
                            <?php
                                //加载商品列表信息并遍历输出
                                //封装搜索条件
                                $wherelist = array();
                                $urllist = array();
                                //判断是否有商品类别搜索
                                if(!empty($_GET['tid'])){
                                    $wherelist[] = "typeid in(select id from type where path like '%,{$_GET['tid']},%' or id={$_GET['tid']})";
                                    $urllist[] = "tid={$_GET['tid']}";
                                }
                                //判断是否有关键字(即书名搜索)
                                if(!empty($_GET['keyword'])){
                                    $wherelist[] = "goods like '%{$_GET['keyword']}%'";
                                    $urllist[] = "keyword={$_GET['keyword']}";
                                }
                                
                                //判断是否有状态搜索
                                if(!empty($_GET['state'])){
                                    //搜索state
                                    $wherelist[] = "state='{$_GET['state']}'";
                                    //状态维持
                                    $urllist[] = "state={$_GET['state']}";
                                }
                                
                                
                                //判断是否有价格区间搜索
                                if(!empty($_GET['price1']) && !empty($_GET['price2'])){
                                    $wherelist[] = "  price between '{$_GET['price1']}' and '{$_GET['price2']}' ";
                                    //状态维持
                                    $urllist[] = "price1={$_GET['price1']}";
                                    $urllist[] = "price2={$_GET['price2']}";
                                }
                                
                                
                                
                                //拼装搜索条件
                                $where = "";
                                $url = "";
                                if(count($wherelist)>0){
                                    $where = " where ".implode(" and ",$wherelist);
                                    //$neWhere = " and ".implode(" and ",$wherelist);
                                    //echo $where;
                                    //exit();
                                    //echo "<br/>";
                                    $url = "&".implode("&",$urllist);
                                    //echo $url;
                                    //exit();
                                    /*
                                    where typeid in(select id from type where path like '%,28,%' or id=28) and goods like '%解%' and state='2' and price between '1' and '2' 
                                    &tid=28&keyword=解&state=2&price1=1&price2=2
                                    */
                                }
                                
                                 //==================做分页处理================================
                                    //初始化变量
                                    //$page = 1;  //告诉我当前那页(当前页)
                                    $page = isset($_GET['page'])?$_GET['page']:1;  //当前页
                                    $pagesize = 8;  //页大小
                                    $maxrows = 0;   //总数据条数 
                                    $maxpages = 0;  //总页数
                                    //获取总数据条数
                                    $sql = "select * from goods".$where;
                                    //echo "<br/>";
                                    //echo $sql;
                                    //echo "<br/>";
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
                                
                                
                                //$sql = "select * from goods where typeid=".$_GET['tid']; //使用等号封装是不行的
                                $sql = "select * from goods".$where." order by addtime desc ".$limit;
                               //echo "<br>";
                               //echo $sql;
                               // exit();
                                $result = mysqli_query($link,$sql);
                                //遍历解析
                                while($row = mysqli_fetch_assoc($result)){
                                    echo "<div class=\"wraper_pro_tu_xun\">";
                                    echo "<div class=\"wraper_pro_xun_pic\"><a href=\"detail.php?id={$row['id']}\"><img src=\"../public/uploads/m_{$row['picname']}\" width=\"175\" height=\"228\"></a></div>";
                                    echo "<div class=\"wraper_pro_xun_wen\">";
									echo "<ul>";
                                    echo "<li>{$row['goods']}</li>";
                                    echo "<li>现价：{$row['price']} &nbsp;&nbsp;<font color=\"red\">会员价：￥".($row['price']*0.8)."</font></li>";
                                    echo "<li><a href=\"detail.php?id={$row['id']}\">查看详情</a>　<a href=\"detail.php?id={$row['id']}\">立即订购</a></li>";
									echo "</ul>";
                                    echo "</div>";
                                    echo "</div>";
                                }
                                //释放结果集
                                mysqli_free_result($result);
                            ?>
                            <!--
							<div class="wraper_pro_tu_xun">
								<div class="wraper_pro_xun_pic"><a href="xianhua_zi.html" target="_blank"><img src="./include/images/pro/pro1.jpg" width="175" height="228"></a></div>
								<div class="wraper_pro_xun_wen">
									<ul>
										<li>相伴永远</li>
										<li>现价：￥448　<font color="red">会员价：￥428</font></li>
										<li><a href="xianhua_zi.html" target="_blank">查看详情</a>　<a href="xianhua_zi.html" target="_blank">立即订购</a></li>
									</ul>
								</div>
							</div>
                            -->
							<div class="clear"></div>
							<!--产品图片循环结束-->
						</div>
						<div class="wraper_pro_page">
                            <?php
                                //输出页码信息
                                echo "当前第{$page}/{$maxpages}页，共计{$maxrows}条 ";
                                echo " <a href='list.php?page=1{$url}'>首页</a> ";
                                echo " <a href='list.php?page=".($page-1)."{$url}'>上一页</a> ";
                                echo " <a href='list.php?page=".($page+1)."{$url}'>下一页</a> ";
                                echo " <a href='list.php?page={$maxpages}{$url}'>末页</a> ";
                            ?> 
                        </div>
					</div>
				</div>
				<!--产品列表页结束-->
				<div class="clear"></div>
			</div>
			<!--主体结束-->
		    <?php include("./include/footer.php");  //导入页脚 ?>
		</div>
	</body>
</html>