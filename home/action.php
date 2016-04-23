<?php 

//1.导入配置文件
require("../public/config.php");
//2.连接数据库，并判断是否已经连接成功
$link = @mysqli_connect(HOST,USER,PASSWORD) or die("对不起,数据库连接失败");
//3.连接数据库，并设置字符集
mysqli_select_db($link,DBNAME);
mysqli_set_charset($link,"utf8");
//4.根据对应的'hello'值来进入对应的操作模块
switch($_GET['a']){
    case "insert":  //执行用户的添加操作
    //获取要添加的信息
        $username = $_POST['username'];
        $name = $_POST['name'];
        $pass = md5($_POST['pass']);
        $sex = $_POST['sex'];
        $address = $_POST['address'];
        $code = $_POST['code'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $state = 1;
        $addtime = time();
    //执行两次密码是否一致的判断
    if($_POST['repass'] !== $_POST['pass']){
        die("密码和重复密码不相符，请您重新输入，谢谢。");
    }
    if(empty($email)){
        die("邮箱地址为空!");
    }
    //拼装SQL语句并发送执行
     $sql = "insert into users values(null,'{$username}','{$name}','{$pass}','{$sex}','{$address}','{$code}','{$phone}','{$email}','{$state}','{$addtime}')";
        mysqli_query($link,$sql,);
    
    
    if(mysqli_insert_id($link)>0){
            echo "<center><span style=\"color:red;font-weight:bold;\">恭喜您，注册成功，3秒钟后返回登陆界面<span><center>";
            header('refresh:3;./login.php');
            
        }else{
            echo "<center><span style=\"color:red;font-weight:bold;\">很抱歉，请重新输出<span></center>";
        }
    break;

    case "update":
        //获取要修改的信息
        $id = $_POST['uid'];
        $name = $_POST['name'];
        $address = $_POST['address'];
        $code = $_POST['code'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        //拼装sql语句并发送执行
        $sql="update users set name='{$name}',address='{$address}',code='{$code}',phone='{$phone}',email='{$email}' where id = {$id}";
        //echo $sql;
        //exit();
        $res = mysqli_query($link,$sql);
        if($res && mysqli_affected_rows($link)){
            echo "<script>alert(\"恭喜您，修改成功\");location=\"./info.php\"</script>";
        }else{
            echo "<script>alert(\"对不起，修改失败\");location=\"edit.php\"</script>";
        }









}
//5.关闭数据库
