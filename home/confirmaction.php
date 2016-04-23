<?php
  session_start();  //开启对话
  //订单的详情确认页执行confirmaction.php
  //首先获取订单表最新添加的id
  //1.导入配置文件
    require("../public/config.php");
  //2.连接数据库并判断是否连接成功
  $link = @mysqli_connect(HOST,USER,PASSWORD) or die("对不起，数据库连接失败");
  //3.连接库并设置字符集
  mysqli_select_db($link,DBNAME);
  mysqli_set_charset($link,"utf8");
  //3.拼装SQL查询语句并发送执行
  $sql = "select id from orders order by id desc limit 1";
  $result = mysqli_query($link,$sql);
          
  //4.解析遍历结果集
  $row = mysqli_fetch_assoc($result);
  
  //5.清空结果集并关闭数据库
  mysqli_free_result($result);
  
  //echo $row['id'];//测试获取最新订单id的编号
  
  //获取所需要的参数信息
  $orderid = $row['id'];
  //echo $orderid;
  //遍历$_SESSION['shoplist']中的所有数据
  foreach($_SESSION['shoplist'] as $val){
    echo "<pre>";
   // var_dump ($val);
     //将包含每条信息的数组遍历，注入到数据库中
     $goodid=$val['id'];  // 商品id
     $name = $val['goods'];
     $price = $val['price'];
     $num = $val['m'];
     //拼装SQL语句，并发送执行
     $sql = "insert into detail values(null,'{$orderid}','{$goodid}','{$name}','{$price}','{$num}')";
     //echo $sql;
    $result = mysqli_query($link,$sql);
    
    
  }
  
  if($result && mysqli_insert_id($link)>0){
        //$_SESSION['superman']=$orderid;
        echo "<script>alert(\"恭喜您，订单提交成功!\");location=\"./success.php\"</script>";
  
  }else{
        echo "<script>alert(\"很抱歉，订单提交失败！\");location=\"./confirmlist.php\"</script>";
  }
  //释放结果集
    mysqli_free_result($result);
    mysqli_close($link);
 
  
  