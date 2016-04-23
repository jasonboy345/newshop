<?php
  session_start();  //开启对话
  //订单的详情确认页,信息确认好后点击跳转到订单执行页
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
 //打印用户订单确认表
 echo "<center><span style='color:#ccc;font-size:35px'><caption>订单确认表</caption></span></center>";
 echo "<br/>";
 echo "<table align='center' width='980px' border='1' cellspacing='0' cellpadding='10' frame='above' rules='rows'>";
    echo "<tr>";
    echo "<th>图书名称</th>";
    echo "<th>图书封面</th>";
    echo "<th>图书价格</th>";
    echo "<th>出版社名</th>";
    echo "<th>所购数量</th>";
    echo "<th>金额总计</th>";
    echo "</tr>";
    foreach($_SESSION['shoplist'] as $vals){
        echo "<tr>";
            echo "<td>{$vals['goods']}</td>";
            echo "<td><img src=\"../public/uploads/s_{$vals['picname']}\"></td>";
            echo "<td>{$vals['price']}</td>";
            echo "<td>{$vals['company']}</td>";
            echo "<td>{$vals['m']}</td>";
            //计算每一条书的单书合计
            $littlePrice  = $vals['price']*$vals['m'];
            echo "<td>{$littlePrice}</td>";
        echo "</tr>";
    } 
 echo "</table>";
 echo "<br/>";
 echo "<table align='center' width='980px' border='1' cellspacing='0' cellpadding='10' frame='above' rules='rows' >";
        echo "<tr>";
          echo "<td colspan='2'>图书总数量</td>";
          //echo "<td></td>";
          echo "<td>{$_SESSION['VIP']}&nbsp;本</td>";
          echo "<td colspan='1'>金额总计</td>";
          $pricee=$_SESSION['xujing'];
          echo "<td>￥".number_format($pricee,2,'.',',')."</td>";
          echo "<td><a href='confirmaction.php'><button>确认订单</button></a><td>";
        echo "</tr>";
 echo "</table>";
 
 
 //-----------用户信息核对------------------
 
 echo "<br/>";
 echo "<br/>";
 echo "<br/>";
 echo "<center><span style='color:#fff;font-size:30px;background-color:silver';font-weight:'bold'><caption>用户信息核对</caption></span></center>";
 echo "<br/>";
 
 echo "<table align='center' width='980px' border='1' cellspacing='1' cellpadding='10'rules='rows'>";
       echo "<tr>";
       echo "<td>用户ID：</td>";
       echo "<td colspan='2'>{$_SESSION['liubindaren']['username']}</td>";
       //echo "<td>1</td>";
       echo "</tr>";
       
       echo "<tr>";
       echo "<td>购买姓名：</td>";
       echo "<td colspan='2'>{$_SESSION['liubindaren']['name']}</td>";
       //echo "<td>1</td>";
       echo "</tr>";
       
       echo "<tr>";
       echo "<td>快递地址：</td>";
       echo "<td colspan='2'>{$_SESSION['liubindaren']['address']}</td>";
       //echo "<td>1</td>";
       echo "</tr>";
       
       echo "<tr>";
       echo "<td>邮政编码：</td>";
       echo "<td colspan='2'>{$_SESSION['liubindaren']['code']}</td>";
       //echo "<td>1</td>";
       echo "</tr>";
       
       echo "<tr>";
       echo "<td>联系电话：</td>";
       echo "<td colspan='2'>{$_SESSION['liubindaren']['phone']}</td>";
       //echo "<td>1</td>";
       echo "</tr>";
       
       echo "<tr>";
       echo "<td>电子邮箱：</td>";
       echo "<td colspan='2'>{$_SESSION['liubindaren']['email']}</td>";
       //echo "<td>1</td>";
       echo "</tr>";
       
       echo "<tr>";
       echo "<td>下单时间</td>";
       $addtime = $_SESSION['liubindaren']['addtime'];
       echo "<td colspan='2'>".date("Y-m-d H:i:s",$addtime)."</td>";
       //echo "<td>1</td>";
       echo "</tr>";
       
 echo "</table>";
 
 
 
 
 
 
 
 
 
 
 

 