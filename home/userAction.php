<?php
session_start();  //开启session会话跟踪

switch ($_GET['hello']){
    case "goLogin":  //执行前台登陆操作
    //首先对验证码进行验证
    if($_POST['onlycode']!==$_SESSION['turecode']){
        header("Location:login.php?error=1");
            exit();
    }
    //执行账号密码验证
        $username = $_POST['username'];
        $userpass = $_POST['pass'];
        
       //----mysqli数据库操作------------
        //1.导入配置文件
        require("../public/config.php");
        //2.连接mysqli数据库并进行是否连接成功判断
        $link = @mysqli_connect(HOST,USER,PASSWORD) or die("对不起，数据库连接失败！");
        //3.选择数据库并设置字符集
        mysqli_select_db($link,DBNAME);
        mysqli_set_charset($link,"utf8");
        //4.定义查询SQL语句(用户从表单中输入的值，我从数据库中可以匹配到)
        $sql = "select * from users where state in (0,1) and username='{$username}'";
        $result = mysqli_query($link,$sql);
        //5.判断是否查询到结果
        if(mysqli_num_rows($result)>0){
            //获取用户登录信息,$user以一个数组的形式存在
            $user = mysqli_fetch_assoc($result);
            //判断密码是否正确
            if($user['pass']==md5($userpass)){
                //*此处表示登录成功*
                $_SESSION['liubindaren']=$user;  //将整个会员信息放置到session中
                //header("Location:index.php");  //终于，调转首页！！！
                echo "<script>alert(\"恭喜登陆成功\");location=\"index.php\"</script>";
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
       
        
        
    case "exit": //执行登陆退出操作
    //销毁登录信息
        unset($_SESSION['liubindaren']);
        echo "<script>alert(\"退出成功，欢迎您下次再来\");location=\"./login.php\"</script>";
        exit();
        //header("Location:login.php"); 
        break;
    
    

}