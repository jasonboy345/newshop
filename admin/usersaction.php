<?php
session_start();   //开启session会话跟踪
//会员信息操作：【登陆验证】和【退出操作】

//根据login.php传值参数element，进行对应的操作

switch($_GET['element']){
    case "welcome":   //执行登陆验证
        //对验证码进行效验
        if($_POST['onlycode']!==$_SESSION['turecode']){
            header("Location:login.php?error=1");
                exit();
        }
        //执行账号密码验证
        $username = $_POST['username'];
        $userpass = $_POST['pass'];
        //----Mysql数据库操作------------
        //1.导入配置文件
        require("../public/config.php");
        //2.连接Mysql数据库并进行是否连接成功判断
        $link = @mysqli_connect(HOST,USER,PASSWORD) or die("对不起，数据库连接失败！");
        //3.选择数据库并设置字符集
        mysqli_select_db($link,DBNAME);
        mysqli_set_charset($link,"utf8");
        //4.定义查询SQL语句(用户从表单中输入的值，我从数据库中可以匹配到)
        $sql = "select * from users where state=0 and username='{$username}'";
        $result = mysqli_query($link,$sql);
        //5.判断是否查询到结果
        if(mysqli_num_rows($result)>0){
            //获取用户登录信息,$user以一个数组的形式存在
            $user = mysqli_fetch_assoc($result);
            //判断密码是否正确
            
            //===================计数登陆模块=========================================
            
            //1导入配置文件
            require("../public/config.php");
            //2连接数据库并判断是否连接成功
            $link = @mysqli_connect(HOST,USER,PASSWORD) or die("对不起，数据库连接失败");
            //3连接库并设置字符集
            mysqli_select_db($link,DBNAME);
            mysqli_set_charset($link,"utf8");
            $sql = "select * from number where id=1";
            $result = mysqli_query($sql,$link);
            while($row=mysqli_fetch_assoc($result)){
                $num = $row['num'];    
            }
            if($user['pass']==md5($userpass)){
                //计数判断
               $num = $num+1 ;
               $sqls= "update number set num= {$num} where id=1";//将登陆自加后写入数据库
               $results = mysqli_query($link,$sqls);
            //===============================================================
                //*此处表示登录成功*
                $_SESSION['sakura']=$user;  //将整个会员信息放置到session中
                header("Location:index.php");  //终于，调转首页！！！
                exit();
            }else{
                header("Location:login.php?error=3");
                exit();
            }
        }else{
            header("Location:login.php?error=2");
                exit();
        }
        
        
        
        break;
    case "thanks":   //执行退出操作
        //销毁登录信息
        unset($_SESSION['sakura']);
        header("Location:index.php"); 
        break;
}