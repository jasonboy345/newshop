            <!--头部开始-->
			<div id="header">
				<!--header_top开始-->
				<div class="header_top">
					<div class="hearder_top_gun"><marquee direction="left" height="26" onMouseOut="this.start()" onMouseOver="this.stop()" scrollAmount="3.2"><font color="red"><u></u></font></marquee></div>
					<div class="hearder_top_link">
						<ul>
                           <li><a href="./mymarket.php">查看购物车</a></li>
                           <li><a href="./shopAction.php?a=clear">清空购物车</a></li>
							<li><a href="./info.php">个人中心</a></li>
							<li><a href="./log.php">我的订单</a></li>
							<li><a href="./list.php">进口图书</a></li>
							<li><a href="./list.php">优秀图书</a></li>
							
							<?php 
                                if($_SESSION['liubindaren']['username']){
                                    echo "<li><span style=\"color:maroon\">欢迎您 {$_SESSION['liubindaren']['name']}</span></li>";
                                    echo "<li><a style=\"color:red;font-weight:bold;\" href=\"userAction.php?hello=exit\" target=\"_top\">退出</a></li>";
                                    
                                }else{
                                    echo "<li><a href=\"login.php\" target=\"_top\">登陆</a></li>";
                                    echo "<li><a style=\"color:red;font-weight:bold;\" href=\"register.php\" target=\"_top\">注册</a></li>";
                                }
                            ?>
							
							
							
						</ul>
					</div>
				</div>
				<!--header_top结束-->
				<!--header_top2开始-->
                
				<div class="header_top2">
					<div class="header_top2_logo"><a href="./index.php"><img src="./include/images/logo.jpg" alt="口袋书店" title="口袋书店" width="400" height="112"></a></div>
					<div class="header_top2_ri">
						
					</div>
				</div>
				<!--header_top2结束-->
				<!--header_nav开始-->
				<div class="header_nav">
					<ul id="jsddm">
                        
						<li class="home zong"><a href="index.php">首页</a></li>
                        
                        <?php
                            //加载商品类别信息，并输出到导航栏中
                            //1.加载配置文件
                            require("../public/config.php");
                            //2.连接数据库，并判断数据库是否连接成功,//PS:技术是自己的，别人是抢不走的
                            $link = @mysqli_connect(HOST,USER,PASSWORD) or die("数据库连接失败！");
                            //3.连接数据库，并设置字符集
                            mysqli_select_db($link,DBNAME);
                            mysqli_set_charset($link,"utf8");
                            //4.定义SQL语句，并发送执行
                            $sql = "select * from type where pid=0";
                             //echo "<br/>";
                              //var_dump($sql);
                            //exit();
                            $result = mysqli_query($link,$sql);
                            //var_dump($result);
                            //exit();
                            //var_dump($result);
                            //5.解析结果集，并遍历输出结果
                            while($row = mysqli_fetch_assoc($result)){
                                echo "<li class=\"zong\">";
                                echo "<a href=\"list.php?tid={$row['id']}\">{$row['name']}</a>";
                                
                                //尝试获取子类别
                                $sql = "select * from type where pid={$row['id']}";
                                $res = mysqli_query($link,$sql);
                                if(mysqli_num_rows($res)>0){
                                    //有子类别
                                    echo "<ul class=\"zi\">";
                                    while($ob = mysqli_fetch_assoc($res)){
                                        echo "<li><a href=\"list.php?tid={$ob['id']}\">{$ob['name']}</a></li>";
                                    }
                                    echo "</ul>";
                                }
                                echo "</li>";
                            }
                            
                            //6.关闭结果集
                            mysqli_free_result($result);
                        ?>
                        <!--
						<li class="zong"><a href="list">鲜花</a>
							<ul class="zi">
								<li><a href="#">恋人</a></li>
								<li><a href="#">朋友</a></li>
								<li><a href="#">送母亲</a></li>
								<li><a href="#">送父亲</a></li>
								<li><a href="#">同事</a></li>
								<li><a href="#">老师</a></li>
								<li><a href="#">客户</a></li>
								<li><a href="#">病人</a></li>
								<li><a href="#">领导</a></li>
							</ul>
						</li>
                        -->
						<li class="zong"><a href="list.php">在线帮助</a></li>
						<li class="zong"><a href="list.php">网上留言</a></li>
					</ul>
					<a href=""><img src="./include/images/english.jpg" width="80" height="27" style="margin-top:6px;"></a>
				</div>
				<!--header_nav结束-->
				<!--header_search开始-->
				<div class="header_search">
                    <form action="list.php" >
					<input type="search" size="25" name="keyword" value="" class="search"><input type="image" name="submit" class="sousuo" src="./include/images/sousuo.gif"><span style="float:left;margin-left:15px;"><font color="red"><b>热门词：</b></font>冰与火之歌  英语四级</span><a href="mymarket.php"><span style="float:right; padding-right:30px;">购物车中有 <font color="red"><?php echo @$_SESSION['VIP']; ?></font> 件商品</span></a>
                    </form>
                </div>
				<!--header_search结束-->
			</div>
			<!--头部结束-->