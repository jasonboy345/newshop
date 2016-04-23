<?php
		//导入配置文件
		require("../../public/config.php");
		//连接数据库，并判断
		$link=mysqli_connect(HOST,USER,PASSWORD)or die("数据库连接失败");
		//选择库设置字符编码
		mysqli_select_db($link,DBNAME);
		mysqli_set_charset($link,"utf8");
		$sql="select * from orders where id={$_GET['id']}";
		$r=mysqli_query($link,$sql);
		$g=mysqli_fetch_assoc($r);
		switch($_GET['a']){
		case 'd':
				//执行sql语句
				if($g['status']==0){
		$sql="update orders set status='1' where id={$_GET['id']}";
		$result=mysqli_query($link,$sql);
		
		if($result){
			header("location:index.php");
		}
		}else{
			echo "不是新订单不可发货";
		}
		break;
		case 'q':
						//执行sql语句
		$sql="update orders set status='3' where id={$_GET['id']}";
		$result=mysqli_query($link,$sql);
		
		if($result){
			header("location:index.php");
		}
		
		break;
		
		}


?>