<?php
//1.导入数据库配置文件
require("../../public/config.php");

//2.连接mysqli数据库并检测是否连接成功
$link=@mysqli_connect(HOST,USER,PASSWORD) or die ("对不起，您连接数据库出现了问题。"."错误原因：".mysqli_error()."错误行号：".mysqli_errno());

//3.选择数据库并设置字符集
mysqli_select_db($link,DBNAME);
mysqli_set_charset($link,"utf8");

//4.根据参数'book'的值来进行对应的操作

switch($_GET['book']){
    case "insert":  //执行添加操作
        //4.1.1获取要添加的信息
        $name = $_POST['name'];
        //echo $name;
        $pid = $_POST['pid'];
        $path = $_POST['path'];
        
        //验证判断
        if(empty($name)){
            die("<center><span style='color:red'>对不起，请您添加类别名称</span></center>");
        }

        //4.1.3拼装SQL语句并发送执行
        $sql = "insert into type values(null,'{$name}','{$pid}','{$path}')";
        mysqli_query($link,$sql);
        
        //4.1.4判断添加是否成功
        if(mysqli_insert_id($link)>0){
                echo "<center><span style=\"color:pink;font-weight:bold;\">添加类别成功！！！<span></center>";
            }else{
                echo "<center><span style=\"color:red;font-weight:bold;\">添加类别失败~~~<span></center>";
            }
        break;
        
    case "update":  //执行修改操作
    
        //获取修改信息，并且要获取对应修改的id号
        $id = $_POST['id'];
        $name = $_POST['name'];
            //echo $name;
        //验证判断
        if(empty($name)){
            die("<center><span style='color:red'>对不起，请您添加类别名称</span></center>");
        }
        //拼装SQL语句
        $sql = "update type set name='{$name}' where id={$id}";
        //执行SQL语句
        mysqli_query($link,$sql);
        //根据影响的行数来判断是否更新成功
        if(mysqli_affected_rows($link)>0){
            echo "<center><span style=\"color:maroon;font-weight:bold;\">更新图书类别成功！！！<span></center>";
        }else{
            echo "<center><span style=\"color:green;font-weight:bold;\">更新图书类别失败~~~<span></center>";
        }
        break;
        
    // case "delete!@#$%^&*":  //执行删除操作,当删除父类时，自动删除他的子类
    case "delete":  //执行删除操作,当删除父类时，自动删除他的子类
         
        //定义删除SQL语句
        $sql = "delete from type where id={$_GET['id']}+0 or path like '%,{$_GET['id']},%'";
        //echo $sql;
        //exit();
        //执行SQL语句
        mysqli_query($link,$sql);
        //通过影响的行数来判断成功与否
        if(mysqli_affected_rows($link)>0){
            echo "<center><span style=\"color:blue;font-weight:bold;\">删除图书类别成功！！！成功删除<span></center>";
            
        }else{
            echo "<center><span style=\"color:black;font-weight:bold;\">删除图书类别失败~~~<span></center>";
        }
      
        break;
        
    case "del":  //执行删除操作,只能删除无子类的类别
        $id = $_GET['id'];
        //判断某个类别有无直系子类
        $sql = "select * from type where pid={$id}";
        // echo $sql;
        // exit();
        $result = mysqli_query($link,$sql);
        
        if($row = mysqli_num_rows($result)>0){
            die("<center><span style='color:red;background-color:sliver;'>对不起，该类别下还有子类别，无法删除，很抱歉！</span></center>");
        }else{
            $sql = "select * from goods where typeid = {$id}";
            //echo $sql;
            //exit();
            $result = mysqli_query($link,$sql);
            //echo var_dump($result);
            //exit();
            if($row = mysqli_num_rows($result)>0){
                die("<center><span style='color:red;'>对不起，该类别存在商品，无法删除，很抱歉！</span></center>");
            }else{
                //定义删除SQL语句
                $sql = "delete from type where id={$id}";
                //echo $sql;
                //exit();
                //执行SQL语句
                mysqli_query($link,$sql);
                //通过影响的行数来判断成功与否
                if(mysqli_affected_rows($link)>0){
                    echo "<center><span style=\"color:blue;font-weight:bold;\">删除图书类别成功！！！成功删除<span>"."<span style='color:maroon;font-size:30px'>".mysqli_affected_rows($link)."</span>"."行"."</center>"; 
                    echo "<br/><br/>";
                    echo "<hr width='60%'>";
                    echo "<br/><br/>";
                    echo "<center><a href='index.php' style=\"color:blue;font-weight:bold;\">返回<strong>浏览类别</strong></a></center>";
                }else{
                    echo "<center><span style=\"color:black;font-weight:bold;\">删除图书类别失败~~~<span></center>";
                }
                
            }
            
        }
      
        break;

}

//5.关闭数据库
mysqli_close($link);
