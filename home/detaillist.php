 <?php
        session_start();  //开启回话
        //前台商品的结算页面
        if(!isset($_SESSION['liubindaren']['username'])){
                echo "<script>alert(\"请您登陆后购买\");location=\"./login.php\"</script>";
        }

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
        <style type="text/css">
        
            a{
                text-decoration:none;
            }
        </style>
       
	</head>
	</head>
	<body>
		<div id="container">
		<?php include("./include/header.php"); ?>
			<!--主体开始-->
        <center>
            <br/>
            <h3 style="font-size:26px;color:silver;">请您填写联系电话，以便我们能亲手将书送到您的手中</h3>
            <hr width="66%">
            <br/>
            <form action="listaction.php?a=orders" method="POST">
            
        
                <table width="300" >
                    <!--<tr>
                        <td align="right">联系人：</td>
                        <td><input type="text" name="linkman"/></td>
                    </tr>
                    
                    <tr>
                        <td align="right">地址：</td>
                        <td><input type="text" name="address"/></td>
                    </tr>
                    
                    <tr>
                        <td align="right">邮编：</td>
                        <td><input type="text" name="code"/></td>
                    </tr>
                    -->
                    <tr>
                        <td align="right">联系电话：</td>
                        <td><input type="text" name="phone"/>
                        <span style="color:red">重要,亲！</span>
                        </td>
                    </tr>
                    
                    <tr>
                        <td colspan="2" align="center">
                            <input type="submit" value="添加"/>
                            <input type="reset" value="重置"/>
                        </td>
                    </tr>
                </table>
            </form>
        </center>
             
			<!--主体结束-->
            <?php include("./include/footer.php"); ?>
		</div>
	</body>
</html>