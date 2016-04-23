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
		<link rel="stylesheet" type="text/css" href="./include/css/register.css">
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
	</head>
	<body>
		<div id="container">
		<?php include("./include/header.php"); ?>
			<!--主体开始-->
			<div id="main">
				<div class="denglu">
					<div class="denglu_title"></div>
					<div class="denglu_text">
						<table border="0" width="300" cellpadding="4" cellspacing="0" align="center">
						<form action="userAction.php?hello=goLogin" method="post">
							<tr>
								<th>用户名：</th>
								<td><input type="text" name="username"></td>
							</tr>
							<tr>
								<th>密码：</th>
								<td><input type="password" name="pass"></td>
							</tr>
                            <tr>
								<th>验证码：</th>
								<td>
                                    <input type="text" size="4" maxlength="4" name="onlycode"/>
                                    <img src="../public/code.php" onclick="this.src='../public/code.php?id='+Math.random()">
                                    
                                </td>
							</tr>
							<tr>
								<td colspan="2" align="center">
                                    <span style="color:maroon;font-family:微软雅黑;">
                                        <?php
                                            //根据错误号输出错误信息
                                            //PHP 本身不需要事先声明变量即可直接使用，但是对未声明变量会有提示。
                                            //使用'@'错误抑制符来过滤掉错误
                                            switch(@$_GET['error']){
                                                case 1: echo "对不起，您的验证码输入有误";
                                                    break;
                                                case 2: echo "对不起，您输入的账号有误。";
                                                    break;   
                                                case 3: echo "对不起，您输入的密码有误。";
                                                    break;
                                                case 4: echo "对不起，劳驾您重新登陆，万分抱歉。";
                                                    break;
                                            }
                                        ?>
                                    </span>
                                </td>
							</tr>
                           
							
							<tr>
								<td colspan="2" align="center"><input type="image" src="./include/images/dl.jpg" name="denglu"> <a href=""></a></td>
							</tr>
						</form>
						</table>
					</div>
				</div>
				<div class="zhu">
					<div class="zhu_title"></div>
					<div class="zhu_text">
<ul>
<h3>注册会员有什么优惠？</h3>
<li>1.在口袋书店买书可享受八折优惠</li>
<li>2.可登录“我的帐户”，享受更多功能</li>
<li>3.每次购物完可获得积分</li>
<li>4.首次注册科获得100元口袋券</li>
<li><a href="register.php"><img src="./include/images/huiyuanzhu.jpg" alt=""></a></li>
</ul>
					</div>
				</div>
				<div class="clear"></div>
			</div>
			<!--主体结束-->
            <?php include("./include/footer.php"); ?>
		</div>
	</body>
</html>