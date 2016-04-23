<!DOCTYPE HTML>
<html>
	<head>
		<title>口袋书店网</title>
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
			<div id="mainA">
				<div class="zhuce_title"></div>
				<div class="zhuce_text">
					<table border="0" width="600" cellpadding="12" cellspacing="0" align="center">
					<form action="action.php?a=insert" method="post" name="zhuce">
                      <tr>
                        <td align="right">账号：</td>
                        <td><input type="text" name="username"/></td>
                    </tr>
                    
                    <tr>
                        <td align="right">密码：</td>
                        <td><input type="password" name="pass"/></td>
                    </tr>
                    
                    <tr>
                        <td align="right">重复密码：</td>
                        <td><input type="password" name="repass"/></td>
                    </tr>
                    
                    <tr>
                        <td align="right">真实姓名：</td>
                        <td><input type="text" name="name"/></td>
                    </tr>
                    
                    <tr>
                        <td align="right">性别：</td>
                        <td>
                            <input type="radio" name="sex" value="1" />男
                            <input type="radio" name="sex" value="0" checked/>女
                        </td>
                    </tr>
                     
                    <tr>
                        <td align="right">地址：</td>
                        <td><input type="text" name="address"/></td>
                    </tr>
                    
                    <tr>
                        <td align="right">邮编：</td>
                        <td><input type="text" name="code" value="100000"/></td>
                    </tr>
                    
                    <tr>
                        <td align="right">电话：</td>
                        <td><input type="text" name="phone"/></td>
                    </tr>
                    
                    <tr>
                        <td align="right">邮箱：</td>
                        <td><input type="text" name="email" value="@qq.com"/></td>
                    </tr>
                        
						<tr>							
							<td colspan="2" align="center"><input type="radio" name="agree" value="1" checked="">我已经阅读并同意 <font color="red"><a href="">注册协议</a></font></td>
						</tr>
						<tr>
							<td colspan="2" align="center"><input type="image" name="submit" src="./include/images/tijiao.gif"></td>
						</tr>
					</form>
					</table>
				</div>
			</div>
			<!--主体结束-->
            <?php include("./include/footer.php");?>
		</div>
	</body>
</html>