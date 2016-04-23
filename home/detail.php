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
        <meta charset="utf-8"/>
		<title>口袋书店</title>
		<link rel="stylesheet" type="text/css" href="./include/css/common.css">
		<link rel="stylesheet" type="text/css" href="./include/css/sidebar.css">
		<link rel="stylesheet" type="text/css" href="./include/css/pro.css">
		<link rel="stylesheet" type="text/css" href="./include/css/pro_zi.css">
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
			<?php include("./include/header.php"); //导入页头 ?>
			<!--主体开始-->
			<div id="main">
				<?php include("./include/sidebar.php"); ?>
                <?php
                    //加载当前商品详情（数据库已连接库已选）
                    $sql = "select * from goods where id=".($_GET['id']+0);
                    //echo $sql;
                    $result = mysqli_query($link,$sql);
                    $goods = mysqli_fetch_assoc($result);
                    
                    
                ?>
                
				<!--产品列表子页开始-->
				<div class="main_wraper">
					<!--产品子页图片描述开始-->
					<div class="pro_description">
						<div class="pro_description_tu"><img src="../public/uploads/<?php echo $goods['picname']; ?> " width='78%'></div>
						<div class="pro_description_wen">
							<ul>
								<li style="border-bottom:1px dashed #ccc;"><span style="font-weight:bold;font-size:18px; padding-right:50px;"><?php echo $goods['goods']; ?></span>编号：<font color="red">201500<?php echo $goods['id']; ?></font></li>
								<li>现　价：<?php echo $goods['price']; ?>元</li>
								<li>会员价：<font color="red" size="5"><b><?php echo ($goods['price'])*0.8; ?></b></font>元　　　<a href="register.php">点此注册会员</a></li>
								<table border="0" cellpadding="6" cellspacing="0" width="88%" style="margin:10px 0;" >
									<tr>
										<td width="60">[出版社]：</td>
										<td><?php echo $goods['company'];?></td>
									</tr>
									<tr>
										<td>[描 述]：</td>
										<td><?php echo $goods['descr']; ?></li></td>
									</tr>
								</table>
								
								<li><a href="shopAction.php?a=add&id=<?php echo $goods['id'] ?>"><img src="./include/images/goumai.gif"></a></li>
								<li style="border-top:1px dashed #ccc;"></li>
								<li>分享到：
                                    <a href="">QQ</a>|
                                    <a href="">MSN</a>|
                                    <a href="">Facebook</a>|
                                    <a href="">Twitter</a>|
                                    <a href="">Youtube</a>
                                </li>
							</ul>
						</div>
						<div class="clear"></div>
					</div>
					<!--产品子页图片描述结束-->
					<div class="pro_description_title">图书描述</div>
					<div class="pro_description_message">
						<div class="pro_message">
							<div class="pro_message_title">图书介绍</div>
							<div class="pro_message_text">
								[书 名]：<?php echo $goods['goods']; ?><br>
								[出 版]：<?php echo $goods['company']; ?><br>
								[描 述]：<?php echo $goods['descr']; ?><br>
								[原 价]：<?php echo $goods['price']; ?><br>
								[库 存]：<?php echo $goods['store']; ?><br>
								[时 间]：<?php echo date("Y-m-d",$goods['addtime']); ?><br>
								
							</div>
							<div class="pro_message_title">图书封面</div>
							<div class="pro_message_text">
								<center><img src="../public/uploads/<?php echo $goods['picname']; ?>" ></center>
							</div>
						</div>
					</div>
				</div>
				<!--产品列表子页结束-->
				<div class="clear"></div>
			</div>
			<!--主体结束-->
			<?php include("./include/footer.php");  //导入页脚 ?>
		</div>
	</body>
</html>