<!DOCTYPE html>
<html>
<head runat="server">
	<meta charset="utf-8" />
    <title>口袋书店网后台管理</title>
    <link href="./include/css/alogin.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <form id="form1" runat="server" action="usersaction.php?element=welcome" method="post">
    <div class="Main">
        <ul>
            <li class="top"></li>
            <li class="top2"></li>
            <li class="topA"></li>
            <li class="topB" style="text-align: center";><span><img src="./include/images/login/logo.gif"  alt="" style="" /></span></li>
            <li class="topC"></li>
            <li class="topD">
                <ul class="login">
                    <li><span class="left login-text">用户名：</span> <span style="left">
                        <input id="Text1" type="text" class="txt" name="username"/>  
                     
                    </span></li>
                    <li><span class="left login-text">密码：</span> <span style="left">
                       <input id="Text2" type="password" class="txt" name="pass" /> 
                     </span></li> 
                    <li><span class="left login-text">验证：</span> <span style="left">
                       <input type="text" size="6" maxlength="4" name="onlycode"/>
                       <img src="../public/code.php" onclick="this.src='../public/code.php?id='+Math.random()">
                     </span></li> 
                     
                     
                </ul>
               
            </li>
            	 					
			

            <li class="topE"></li>
            <li class="middle_A"></li>
            <li class="middle_B"></li>
            <li class="middle_C"><span class="btn"><input name="count" type="image" src="./include/images/login/btnlogin.gif" /></span></li>
            <li class="middle_D">
                   
            </li>
            <li class="bottom_A" style="text-align: center;">
              <span style="color:grey;font-family:微软雅黑;font-size:13px;">
                <?php
                    //根据错误号输出错误信息
                    //PHP 本身不需要事先声明变量即可直接使用，但是对未声明变量会有提示。
                    //使用'@'错误抑制符来过滤掉错误
                    switch(@$_GET['error']){
                        case 1: echo "对不起，您的验证码输入有误，劳驾您重新输入，万分抱歉。";
                            break;
                        case 2: echo "对不起，您输入的账号有误或您不是管理员登录。";
                            break;   
                        case 3: echo "对不起，您输入的密码有误，劳驾您重新输入，万分抱歉。";
                            break;
                        case 4: echo "对不起，劳驾您重新登陆，万分抱歉。";
                            break;
                    }
                ?>
            </span>
            </li>
            <li class="bottom_B">口袋书店网后台管理&nbsp;&nbsp;www.liubin.com</li>
        </ul>
    </div>
    </form>  
</body>
</html>