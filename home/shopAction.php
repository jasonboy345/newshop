<?php
    session_start();
    //判断上一个页面传来的方法
    switch($_GET['a']){
        case 'add';
                add();  //回调函数！！
                break;
        case 'update';
                update(); //调用update的方法
                break;
        case 'del';
                //删除当个商品
                unset($_SESSION['shoplist'][$_GET['id']]);
                header("Location:./mymarket.php");
                break;
        case 'clear';
               //清空购物车
               unset($_SESSION['shoplist']);
               //header("Location:./list.php");
               echo "<script>alert(\"购物车已清空,返回继续购买\");location=\"./index.php\"</script>";
               break;
    }
    //添加到购物车功能 
    function add(){
         //通过用户点击商品，传过来的id来查询当前id号对应的路径数据
         //1.导入配置文件
         require("../public/config.php");
         
         //2.连接数据库并判断是否连接成功
         $link = @mysqli_connect(HOST,USER,PASSWORD) or die ("对不起，数据库连接失败！");
         //3.连接具体的库，并设置字符集
         mysqli_select_db($link,DBNAME);
         mysqli_set_charset($link,"utf8");
         //4.拼装SQL语句，并发送执行
         $sql = "select * from goods where id={$_GET['id']}";
         $result = mysqli_query($link,$sql);
         //5.解析SQL语句
         if($result && mysqli_num_rows($result)>0){
                //将结果集放回成【关联数组】后放入购物车（购物车用$_SESSION，因为可以跨页面使用）
                //返回一行数据
                $row = mysqli_fetch_assoc($result);
                $row['m']=1; //只有将原数组中
                //将商品放入购物车
                //session和数组一样！
                //并使用商品id做下标
                if(isset($_SESSION['shoplist'][$row['id']])){
                    $_SESSION['shoplist'][$row['id']]['m'] +=1;
                }else{
                    $_SESSION['shoplist'][$row['id']] = $row;
                }
                //$_SESSION['shoplist'][$row['id']]['m'] =1; //'m' => int 1
                //输出然后跳转
                echo "<center><span style=\"color:blue\">成功添加到购物车！3秒后返回继续购物,<a href=\"./mymarket.php\"><span style=\"color:grey\">等不急了,查看购物车</span></a></span></center>";
                //sleep(5);
                //header("location:./index.php");
                //header('refresh:5;./list.php');  //跳转的另一种方式
                echo "<meta http-equiv=refresh content=\"3;url=./list.php\">";
            }
            //var_dump($_SESSION['shoplist']);
            
         }
         
         //制作所修改数量的方法
         function update(){
            $_SESSION['shoplist'][$_GET['id']]['m'] += $_GET['num'];
            
            //数量 +=1; 加一
            //数量 +=-1; 减一
            if($_SESSION['shoplist'][$_GET['id']]['m']<=1){
                //当数量小于等于一时，限制等于一
               $_SESSION['shoplist'][$_GET['id']]['m']=1;
                }
                //数量范围控制
            if($_SESSION['shoplist'][$_GET['id']]['m']>=$_SESSION['shoplist'][$_GET['id']]['store']){
               $_SESSION['shoplist'][$_GET['id']]['m']=$_SESSION['shoplist'][$_GET['id']]['store'];
               echo "<script>alert(\"很抱歉，您购买已超最大库存量\");location=\"./mymarket.php\"</script>";exit();
            }
           
            header('location:./mymarket.php'); 
         }
         
         
    
    