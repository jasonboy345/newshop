<?php 
    session_start();  //开启回话
    
    //1.导入配置文件
    require("../public/config.php");
    //2连接数据库，判断数据库是否连接成功
    $link = @mysqli_connect(HOST,USER,PASSWORD) or die ("对不起，数据库连接失败"); 
    //3.连接库，并设置字符集
    mysqli_select_db($link,DBNAME);
    mysqli_set_charset($link,"utf8");
    //4.根据对应的switch语句中$_GET['a']的值来执行对应的操作
    switch($_GET['a']){
        case 'orders':
        //获取所需要的参数信息
        //大部分通过session获取
        $uid = ($_SESSION['liubindaren']['id']);
        $total = $_SESSION['xujing'];
        //$linkman = $_POST['linkman'];
        $linkman =($_SESSION['liubindaren']['name']);
        //$address = $_POST['address'];
        $address = ($_SESSION['liubindaren']['address']);
        //$code = $_POST['code'];
        $code = ($_SESSION['liubindaren']['code']);
        $phone = $_POST['phone'];
        $addtime = time();
        $status = 0; //将新订单设为默认状态
        
        //拼装SQL语句，并发送执行
        $sql = "insert into orders values (null,'{$uid}','{$linkman}','{$address}','{$code}','{$phone}','{$addtime}','{$total}',0)";
        //echo $sql;
        //exit();
        $result = mysqli_query($link,$sql);
        if($result && mysqli_insert_id($link)>0){
            echo "<script>alert(\"信息提交成功\");location=\"./confirmlist.php\"</script>";
        }else{
            echo "<script>alert(\"对不起，信息未提交\");location=\"./detaillist.php\"</script>";
        }
        break;
    }
    //5.关闭数据库
    
    mysqli_free_result($result);
    mysqli_close($link);

?>