<?php
   // header("Content-Type:text/html;charset=utf8");
    session_start(); //开启session会话
    
    //验证用户有没有登陆
    if(empty($_SESSION['liubindaren'])){
        header("Location:login.php");
            exit();  //预防程序惯性输出
    }
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>猫先生的口袋书店</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="./include/css/common.css">
		<link rel="stylesheet" type="text/css" href="./include/css/index.css">
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
            <?php include("./include/header.php"); //导入页头?>
			<!--主体开始-->
			<div id="main">
				<!--mainA开始-->
				<div class="mainA">
					<div class="mainA_le">
						<!--幻灯片开始-->
						<div class="mainA_le_flash">
							<div class="mainA_le_flash_tu">
                                <!--幻灯片开始-->
                                <script type="text/javascript">
                                    <!--焦点图开始-->
                                    
                                    var focus_width=980;
                                    var focus_height=345;
                                    var text_height=0;
                                    var swf_height = focus_height+text_height;
                                    var pics='./include/images/fire.jpg|./include/images/future.jpg|./include/images/lunbo02.jpg|./include/images/book.jpg|./include/images/reading02.jpg';
                                    var links='#|#|#|#|#|#|#';
                                    var texts='猫先生的口袋书店'; 
                                    document.write('<object ID="focus_flash" classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="'+ focus_width +'" height="'+ swf_height +'">');
                                    document.write('<param name="allowScriptAccess" value="sameDomain"><param name="movie" value="./include/images/pix.swf"><param name="quality" value="high"><param name="wmode" value="transparent">');
                                    document.write('<param name="menu" value="false"><param name=wmode value="opaque">');
                                    document.write('<param name="FlashVars" value="pics='+pics+'&links='+links+'&texts='+texts+'&borderwidth='+focus_width+'&borderheight='+focus_height+'&textheight='+text_height+'">');
                                    document.write('<embed ID="focus_flash" src="./include/images/pix.swf" wmode="opaque" FlashVars="pics='+pics+'&links='+links+'&texts='+texts+'&borderwidth='+focus_width+'&borderheight='+focus_height+'&textheight='+text_height+'" menu="false" quality="high" width="'+ focus_width +'" height="'+ swf_height +'" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />'); 
                                    document.write('</object>');
                                    <!--焦点图结束-->
                                </script>
                                <!--幻灯片结束-->

							</div>
						</div>
						<!--幻灯片结束-->
                        
								<div class="clear"></div>
								<!--热销循环结束-->
					</div>
				</div>
						<!--热销产品结束-->
			</div>
			<div class="clear"></div>
				<!--mainA结束-->
				<!--新品上市开始-->
				<div class="xinpin">
					<div class="mainA_rexiao_title"><h2 class="en">新书上市</h3><a href="list.php" class="more">查看所有新书</a></div>
					<div class="xinpin_text">
						<div class="xinpin_text_le"></div>
						<div class="xinpin_text_ri">
								<!--新品循环开始-->
                                <?php
                                    //加载商品信息并遍历输出(没关数据库)
                                    //随机
                                    $rand = rand(0,6);
                                    $sql = "select * from goods limit ".$rand.",8";
                                    $result = mysqli_query($link,$sql);
                                    //遍历解析 
                                    
                                    while($row = mysqli_fetch_assoc($result)){
                                        echo "<div class=\"xinpin_xun\">";
                                        echo "<div class=\"xinpin_tu\"><a href=\"detail.php?id={$row['id']}\"><img src=\"../public/uploads/m_{$row['picname']}\" width=\"175\" height=\"228\"></a></div>";
                                        echo "<div class=\"xinpin_wen\">";
                                        echo "<ul>";
                                        echo "<li>{$row['goods']} <font color=\"red\">会员价：￥".($row['price']*0.8)."</font></li>";
                                        echo "<li>编号：201500{$row['id']}</li>";
                                        echo "<li><a href=\"detail.php?id={$row['id']}\">查看详情</a> <a href=\"detail.php?id={$row['id']}\">立即订购</a></li>";
                                        echo "</ul>";
                                        echo "</div>";
                                        echo "</div>"; 
                                    }
                                    
                                    //释放结果集
                                    mysqli_free_result($result);
                                ?>
                                
                                <!--
								<div class="xinpin_xun">
									<div class="xinpin_tu"><a href=""><img src="./include/images/xinpin/xinpin1.jpg" width="175" height="228"></a></div>
									<div class="xinpin_wen">
										<ul>
											<li>因为爱情 <font color="#cc0000"><b>[￥278元]</b></font></li>
											<li>编号：2012731</li>
											<li><a href="">查看详情</a> <a href="">立即订购</a></li>
										</ul>
									</div>
								</div>
                                -->
    
								<div class="clear"></div>
								<!--新品循环结束-->
						</div>
						<div class="clear"></div>
					</div>
				</div>
				<!--新品上市结束-->
				<!--特惠推荐开始-->
				<div class="tehui">
					<div class="mainA_rexiao_title"><h2 class="en">猜你喜欢</h2><a class="more" href="list.php">查看所有新品</a></div>
					<div class="xinpin_text">
						<div class="tehui_text_le"></div>
						<div class="tehui_text_ri">
								<!--特惠循环开始-->
                                        <?php
                                            //加载商品信息并遍历输出(没关数据库)
                                            //随机
                                            $rand1 = rand(10,9);
                                            $sql = "select * from goods limit ".$rand1.",8";
                                            $result = mysqli_query($link,$sql);
                                            //遍历解析 
                                            
                                            while($row = mysqli_fetch_assoc($result)){
                                                echo "<div class=\"xinpin_xun\">";
                                                echo "<div class=\"xinpin_tu\"><a href=\"detail.php?id={$row['id']}\"><img src=\"../public/uploads/m_{$row['picname']}\" width=\"175\" height=\"228\"></a></div>";
                                                echo "<div class=\"xinpin_wen\">";
                                                echo "<ul>";
                                                echo "<li>{$row['goods']} <font color=\"red\">会员价：￥".($row['price']*0.8)."</font></li>";
                                                echo "<li>编号：201500{$row['id']}</li>";
                                                echo "<li><a href=\"detail.php?id={$row['id']}\">查看详情</a> <a href=\"detail.php?id={$row['id']}\">立即订购</a></li>";
                                                echo "</ul>";
                                                echo "</div>";
                                                echo "</div>"; 
                                            }
                                            
                                            //释放结果集
                                            mysqli_free_result($result);
                                        ?>


								<div class="clear"></div>
								<!--特惠循环结束-->
						</div>
						<div class="clear"></div>
					</div>
				</div>
				<!--特惠推荐结束-->
                <div class="clear"></div>
                <div>             
                    <marquee direction="left" height="150px"  onMouseOut="this.start()" onMouseOver="this.stop()" behavior="scroll" color="red" scrollamount="6px">
                     <?php 
                        //加载商品信息，并遍历
                        $rand = rand(10,10);
                        $sql = "select * from goods limit ".$rand.",10";
                        $result = mysqli_query($link,$sql);
                        while($row = mysqli_fetch_assoc($result)){
                        echo "<a href=\"detail.php?id={$row['id']}\"><img src=\"../public/uploads/m_{$row['picname']}\" width=\"100px\"></a>";
                        }
                     ?>
                     
                    </marquee>
                </div>
                

			<?php include("./include/footer.php");  //导入页脚 ?>
		</div>
	</body>
</html>