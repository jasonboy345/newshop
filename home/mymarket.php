<?php  session_start(); //开启会话跟踪?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>口袋书店</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="./include/css/common.css">
		<link rel="stylesheet" type="text/css" href="./include/css/register.css">
		<script src="./include/js/index.js" type="text/javascript"></script>
		<script src="./include/js/jquery.min.js" type="text/javascript"></script>
        <script type="text/javascript">
        var timeout         = 500;
        var closetimer		= 0;
        var ddmenuitem      = 0;

        function jsddm_open()
        {	jsddm_canceltimer();
            jsddm_close();
            ddmenuitem = $(this).find('ul').eq(0).css('visibility', 'visible');}

        function jsddm_close()
        {	if(ddmenuitem) ddmenuitem.css('visibility', 'hidden');}

        function jsddm_timer()
        {	closetimer = window.setTimeout(jsddm_close, timeout);}

        function jsddm_canceltimer()
        {	if(closetimer)
            {	window.clearTimeout(closetimer);
                closetimer = null;}}

        $(document).ready(function()
        {	$('#jsddm > li').bind('mouseover', jsddm_open);
            $('#jsddm > li').bind('mouseout',  jsddm_timer);});

        document.onclick = jsddm_close;
        </script>
        <style type="text/css">
        
            a{
                text-decoration:none;
            }
        </style>
       
	</head>
	</head>
	<body>
		<div id="container">
		<?php include("./include/header.php"); ?>
			<!--主体开始-->
                <?php 
                   
                    //遍历购物车
                     //var_dump($_SESSION['shoplist']['4']); //查看购物车是否可以使用
                    // echo "<hr/>";
                    // var_dump($_SESSION); //查看session是否可以使用
                    if(isset($_SESSION['shoplist'])){
                        //如果$_SESSION['shoplist']，有值，则遍历购物车
                        //遍历输出表格
                        //echo "<center>";---居中的一种方式---
                        echo "<center><span style='color:#aaa;font-size:35px'><caption>{$_SESSION['liubindaren']['name']}购物车</caption></center>";
                        echo "<table align='center' width='980px' border='1' cellspacing='0' cellpadding='10' bgcolor='#CAE8F8'>";
                            //设置表头样式
                            echo "<tr bgcolor='silver'>";
                                echo "<th style='color:maroon;font-size:25px'>图书编号</th>";
                                echo "<th style='color:maroon;font-size:25px'>图书名称</th>";
                                echo "<th style='color:maroon;font-size:25px'>图书图片</th>";
                                echo "<th style='color:maroon;font-size:25px'>商图书单价</th>";
                                echo "<th style='color:maroon;font-size:25px'>购买数量</th>";
                                echo "<th style='color:maroon;font-size:25px'>金额总计</th>";
                                echo "<th style='color:maroon;font-size:25px'>图书操作</th>";
                            echo "</tr>";
                            //遍历session['shoplist']里的数据,session中是三维数组结构
                             $totalPrice = 0;  //初始化总金额
                             $bookNumber = 0;  //初始化图书总数量
                            foreach($_SESSION['shoplist'] as $value){
                                //通过遍历成一维数组结构
                                //var_dump($value);//将数组堆，分成一个个单独的数组
                                //设置表的主体
                                echo "<tr>";
                                    echo "<td style='color:#D91516;font-size:20px'  align='center'>{$value['typeid']}</td>";
                                    echo "<td style='color:#D91516;font-size:20px'  align='center'>{$value['goods']}</td>";
                                    echo "<td align='center'><img src=\"../public/uploads/s_{$value['picname']}\"></td>";
                                    echo "<td style='color:#D91516;font-size:20px'  align='center'>{$value['price']}</td>";
                                    echo "<td style='color:#D91516;font-size:20px'  align='center'>
                                            <a href=\"./shopAction.php?a=update&id={$value['id']}&num=-1\">
                                            <button>-</button>
                                            </a>
                                            &nbsp;{$value['m']}&nbsp;
                                            <a href=\"./shopAction.php?a=update&id={$value['id']}&num=1\">
                                            <button>+</button>
                                            </a>
                                          </td>";
                                    //计算总金额
                                    $onlyPrice = $value['price']*$value['m'];
                                    echo "<td style='color:##D91516;font-size:20px'  align='center'>￥{$onlyPrice}</td>";
                                    $totalPrice +=$onlyPrice; 
                                    $bookNumber +=$value['m'];
                                    echo "<td style='color:##D91516;font-size:20px'  align='center'><a href='./shopAction.php?a=del&id={$value['id']}'><button>删除商品</button></a></td>";
                                echo "</tr>";
                                
                            }
                                //将图书数量放到session数组中
                                $_SESSION['VIP']=$bookNumber;
                                //将总金额放到session数组中
                                $_SESSION['xujing']=$totalPrice;
                                
                            //手动添加最后一行
                            echo "<tr bgcolor='silver'>";
                            echo "<td  style='color:maroon;font-size:20px' align='center'><a href=\"./shopAction.php?a=clear\"><button>清空购物车</button></a></td>";
                            echo "<td style='color:maroon;font-size:20px'  align='center'><a href='./list.php'><button>继续购买</button></a></td>";
                            //echo "<td></td>";
                            echo "<td style='color:maroon;font-size:20px' align='center'>图书总数量：{$bookNumber}</td>";
                            //echo "<td>&nbsp</td>";
                            echo "<td colspan='2' style='color:maroon;font-size:20px' align='center'>总金额：{$totalPrice}元</td>";
                            //echo "<td>&nbsp</td>";
                            //echo "<td>&nbsp</td>";
                            //这一步，必须验证登陆了
                            echo "<td colspan='2' style='color:maroon;font-size:20px' align='center'><a href=\"./detaillist.php\"><button>去结算</button></a></td>";
                        echo "</tr>";
                        echo "</table>";
                       // echo "</center>";
                        
                    }else{
                        echo "<center><span style=\"color:red\"><a href=\"./list.php\">您还没有选购商品，请您挑选您中意的商品</a></span></center>";
                    }
                
                ?>
                
            
			<!--主体结束-->
            <?php include("./include/footer.php"); ?>
		</div>
	</body>
</html>