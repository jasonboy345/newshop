<?php
//执行数据的增删改操作（PS:为什么没有'查'呢？因为之前的'浏览会员'index.php就是查！）
//增删改的操作是要【动！】数据库数据的。

//1.导入数据库配置文件
require("../../public/config.php");

//2.连接mysqli数据库并检测是否连接成功
$link=@mysqli_connect(HOST,USER,PASSWORD) or die ("对不起，您连接数据库出现了问题。"."错误原因：".mysqli_error()."错误行号：".mysqli_errno());

//3.选择数据库并设置字符集
mysqli_select_db($link,DBNAME);
mysqli_set_charset($link,"utf8");

//4.根据参数'asuka'的值来进行对应的操作
switch($_GET['asuka']){
    case "insert":  //执行添加操作
        //4.1.1获取要添加的信息
        $username = $_POST['username'];
        $name = $_POST['name'];
        $pass = md5($_POST['pass']);
        $repass = $_POST['repass'];
        $sex = $_POST['sex'];
        $address = $_POST['address'];
        $code = $_POST['code'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $state = 1;
        $addtime = time();
        //验证判断
        if(empty($username)){
            die("<center><span style='color:red;'>对不起，请您输入用户账号</span></center>");
        }
        if(empty($name)){
            die("<center><span style='color:red;'>对不起，请您输入真实姓名</span></center>");
        }
        if(empty($_POST['pass']) && empty($_POST['repass'])){
            die("<center><span style='color:red;'>对不起，密码不能为空</span></center>");
        }
        
        //4.1.2执行两次密码是否一致的判断
        if($_POST['repass'] !== $_POST['pass']){
            die("<center><span style='color:red;'>密码和重复密码不相符，请您重新输入，谢谢。</span></center>");
        }
        
        if(empty($sex)){
            die("<center><span style='color:red;'>对不起，请您选择用户性别</span></center>");
        }
        if(empty($address)){
            die("<center><span style='color:red;'>对不起，请您输入地址</span></center>");
        }
        if(empty($code)){
            die("<center><span style='color:red;'>对不起，请您输入邮政编码</span></center>");
        }
        if(empty($phone)){
            die("<center><span style='color:red;'>对不起，请您输入电话号码</span></center>");
        }
        if(empty($email)){
            die("<center><span style='color:red;'>对不起，请您输入邮箱地址</span></center>");
        }
        
        
        //4.1.3拼装SQL语句并发送执行
        $sql = "insert into users values(null,'{$username}','{$name}','{$pass}','{$sex}','{$address}','{$code}','{$phone}','{$email}','{$state}','{$addtime}')";
        mysqli_query($link,$sql);
        
        //4.1.4判断添加是否成功
        if(mysqli_insert_id($link)>0){
                echo "<center><span style=\"color:pink;font-weight:bold;\">添加成功！！！<span></center>";
            }else{
                echo "<center><span style=\"color:red;font-weight:bold;\">添加失败~~~<span></center>";
            }
        break;
        
    case "update":  //执行修改操作
        //获取修改信息，并且要获取对应修改的id号
        $id = $_POST['id'];
        $username = $_POST['username'];
        $name = $_POST['name'];
        $sex = $_POST['sex'];
        $address = $_POST['address'];
        $code = $_POST['code'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $state = $_POST['state'];
        //判断验证
        if(empty($username)){
            die("<center><span style='color:red;'>对不起，请您输入用户账号</span></center>");
        }
        if(empty($name)){
            die("<center><span style='color:red;'>对不起，请您输入真实姓名</span></center>");
        }
        //if(empty($sex)){
        //    die("<center><span style='color:red;'>对不起，请您选择用户性别</span></center>");
       // }
        if(empty($address)){
            die("<center><span style='color:red;'>对不起，请您输入地址</span></center>");
        }
        if(empty($code)){
            die("<center><span style='color:red;'>对不起，请您输入邮政编码</span></center>");
        }
        if(empty($phone)){
            die("<center><span style='color:red;'>对不起，请您输入电话号码</span></center>");
        }
        if(empty($email)){
            die("<center><span style='color:red;'>对不起，请您输入邮箱地址</span></center>");
        } 
        //if(empty($state)){
        //    die("<center><span style='color:red;'>对不起，请您输入管理权限</span></center>");
        //}
        
        
        //拼装SQL语句
        $sql = "update users set state='{$state}',username='{$username}',name='{$name}',sex='{$sex}',address='{$address}',code='{$code}',phone='{$phone}',email='{$email}' where id={$id}";
        //执行SQL语句
        mysqli_query($link,$sql);
        //根据影响的行数来判断是否更新成功
        if(mysqli_affected_rows($link)>0){
            echo "<center><span style=\"color:maroon;font-weight:bold;\">更新数据成功！！！<span></center>";
        }else{
            echo "<center><span style=\"color:green;font-weight:bold;\">更新数据失败~~~<span></center>";
        }
        break;
        
    case "delete":  //执行删除操作
        //定义删除SQL语句
        $sql = "delete from users where id=".($_GET['id']+0);
        //执行SQL语句
        mysqli_query($link,$sql);
        //通过影响的行数来判断成功与否
        if(mysqli_affected_rows($link)>0){
            echo "<center><span style=\"color:blue;font-weight:bold;\">删除数据成功！！！<span></center>";
        }else{
            echo "<center><span style=\"color:black;font-weight:bold;\">删除数据失败~~~<span></center>";
        }
        
        break;
        
    case "repass":  //执行重置密码
        //获取新密码数据
        $id = $_POST['id'];
        $pass = md5($_POST['pass']);
        $admin = ($_POST['pastpass']);
        $pastpass = md5($_POST['pastpass']);
        //判断原始密码与数据库存储的密码是否一致
        //设施SQL语句，并执行操作
        $newsql = "select * from users where id={$id}";
        $result = mysqli_query($link,$newsql);
        //解析SQL语句
        $prove = mysqli_fetch_assoc($result);
        //原始密码与数据库密码的匹配,并设置超级权限密码
        if($pastpass == $prove['pass'] || $admin=='admin'){
            //判断两次密码是否一致
            if($_POST['repass'] !== $_POST['pass']){
                die("<center><span style='color:red'>新设密码和重复密码不相符，请您重新输入，谢谢。<span></center>");
            }
            //拼装SQL语句并执行操作
            $sql = "update users set pass='{$pass}' where id={$id}";
            mysqli_query($link,$sql);
            //根据影响的行数来判断,密码是否更改成功。
            if(mysqli_affected_rows($link)>0){
                 echo "<center><span style=\"color:silver;font-weight:bold;\">修改密码成功！！！<span></center>";
            }else{
                echo "<center><span style=\"color:grey;font-weight:bold;\">密码修改失败~~~<span></center>";
            }
        }else{
            echo "<center><span style=\"color:red;font-weight:bold;\">原始密码不相符！请重新输入。~~~<span></center>";
        }
       
        break;
}

//5.关闭数据库
mysqli_close($link);
