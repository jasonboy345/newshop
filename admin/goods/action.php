<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>口袋书店网后台管理</title>
    </head>
    <body>
        <center>
            <h3>图书信息的操作</h3>
            <?php 
                //执行商品信息的增、删、改操作
                
                //1.导入配置文件
                require("../../public/config.php");  
                require("../../public/functions.php");  //带入函数库文件
                $path = "../../public/uploads/";   //上传文件存储目录
                $typelist = array("image/jpeg","image/pjpeg","image/gif","image/png");  //上传图片的允许类型
                
                //2.连接数据库，并判断
                $link = @mysqli_connect(HOST,USER,PASSWORD) or die("对不起，您连接数据库失败！");
                
                //3.选择数据库，设置字符集
                mysqli_select_db($link,DBNAME);
                mysqli_set_charset($link,"utf8");
                
                //4.判断参数'goods'的值执行对应的操作
                switch($_GET['goods']){
                    //---------------执行数据添加----------------------
                    case "insert": //执行图书信息添加操作
                    
                        //1.获取要添加的信息
                        $typeid = $_POST['typeid'];
                        $goods = $_POST['goods'];
                        $company = $_POST['company'];
                        $price = $_POST['price'];
                        $store = $_POST['store'];
                        $descr = $_POST['descr'];
                        
                        $state = 1;  //1：新添加、2：在售、3：下架  
                        $num = 0;  //销售量
                        $clicknum = 0;  //点击量
                        $addtime = time();  //添加系统默认时间
                            //print_r($_FILES['pic']);
                            //exit();
                            
                        //*******验证提交的数据*******
                        if(empty($goods)){
                            die("对不起,图书书名未填写");
                        }
                        if(empty($company)){
                            die("对不起,发行出版未填写");
                        }
                          if(empty($price)){
                            die("对不起,图书单价未填写");
                        }
                          if(empty($store)){
                            die("对不起,图书库存未填写");
                        }
                          if(empty($descr)){
                            die("对不起,图书简介未填写");
                        }
                     
                        //2.执行图片上传
                        $res = uploadFile($_FILES['pic'],$path,$typelist);
                        //判断图片上传是否失败
                        if(!$res['error']){
                            //图片上传失败
                            die("图书封面图片上传失败！原因：".$res['info']);
                        }
                        //*获取上传成功的新文件名
                        $picname = $res['info'];
                        
                        //执行图片缩放
                        imageResize($picname,$path,90,90,"s_");
                        imageResize($picname,$path,300,300,"m_");
                        imageResize($picname,$path,400,400,"");
                        
                        //拼装SQL语句
                        $sql = "insert into goods values (null,'{$typeid}','{$goods}','{$company}','{$descr}','{$price}','{$picname}','{$state}','{$store}','{$num}','{$clicknum}','{$addtime}')";
                        //执行SQL语句
                            //echo $sql;
                            //exit();
                        mysqli_query($link,$sql);
                        
                        //判断输出的结果
                        if(mysqli_insert_id($link)>0){
                            echo "<span style=\"color:blue;\">图书信息添加成功</span>";
                        }else{
                            echo "<span style=\"color:red;\">图书信息添加失败</span>".mysqli_error();
                            @unlink($path."s_".$picname);
                            @unlink($path."m_".$picname);
                            @unlink($path.$picname);
                        }
                        
                        //点击跳转回添加页面或展示页
                        echo "<br/><br/>";
                        echo "<br/> <a href='add.php'>返回图书添加页</a>";
                        echo "<br/><br/><hr width=\"13%\">";
                        echo "<br/> <a href='index.php'>返回图书展示页</a>";
                        
                        break;
                        
                        //-------------------执行数据更新----------------------
                        case "update": //执行图书信息的更新操作
                            //1.获取要修改的信息
                            $typeid = $_POST['typeid'];
                            $goods = $_POST['goods'];
                            $company = $_POST['company'];
                            $price = $_POST['price'];
                            $state = $_POST['state'];
                            $store = $_POST['store'];
                            $descr = $_POST['descr'];
                            $id = $_POST['id'];
                            $picname = $_POST['oldpic'];
                           
                            //2.数据验证
                            if(empty($goods)){
                            die("对不起,图书书名未填写");
                            }
                            if(empty($company)){
                                die("对不起,发行出版未填写");
                            }
                              if(empty($price)){
                                die("对不起,图书单价未填写");
                            }
                              if(empty($store)){
                                die("对不起,图书库存未填写");
                            }
                              if(empty($descr)){
                                die("对不起,图书简介未填写");
                            }
                     
                            //3.判断有无图片上传
                            if($_FILES['pic']['error']!=4){
                                //执行上传
                                $res = uploadFile($_FILES['pic'],$path,$typelist);
                                //判断图片上传是否失败
                                if(!$res['error']){
                                    //图片上传失败
                                    die("图书封面图片上传失败！原因：".$res['info']);
                                }else{
                                    //*获取上传成功的新文件名
                                    $picname = $res['info'];
                                    //.有图片上传，执行缩放
                                    imageResize($picname,$path,90,90,"s_");
                                    imageResize($picname,$path,300,300,"m_");
                                    imageResize($picname,$path,400,400,"");
                                    
                                }
                                
                            }
                            
                            //4.执行修改
                            $sql = "update goods set state='{$state}', typeid='{$typeid}', goods='{$goods}',company='{$company}',descr='{$descr}',price='{$price}',picname='{$picname}',store='{$store}' where id='{$id}'";
                            //echo $sql;
                            mysqli_query($link,$sql);
                            
                            //5.判断修改是否成功
                            if(mysqli_affected_rows($link)>0){
                                if($_FILES['pic']['error']!=4){  //代表有图片上传
                                    //若有图片上传则删除旧图片
                                    @unlink($path."s_".$_POST['oldpic']);
                                    @unlink($path."m_".$_POST['oldpic']);
                                    @unlink($path.$_POST['oldpic']);
                                }
                                echo "<span style=\"color:maroon; font-weight:bold;\">恭喜您，修改成功！</span>";
                            }else{
                                echo "<span style=\"color:black; font-weight:bold;\">很抱歉，修改失败！</span>".mysqli_error();
                                
                            }
                            echo "<br/> <a href='index.php'>查看图书信息</a>";
                            
                            break;
                            
                        //------------------执行数据删除-----------------------------------    
                        case "delete": //执行图书信息的删除操作
                            $state = $_GET['state'];
                            
                             //判断是否是新书
                            if($state!=1){
                             die("对不起,图书不能删除");
                            }
                            
                            $sql = "delete from goods where id={$_GET['id']}";
                            mysqli_query($link,$sql);
                            //执行图片删除(缩略图、中号图、原图)
                            if(mysqli_affected_rows($link)>0){
                                @unlink($path."s_".$_GET['picname']);
                                @unlink($path."m_".$_GET['picname']);
                                @unlink($path.$_GET['picname']);
                            }
                            //跳转回浏览界面
                            header("Location:index.php");
                            
                            break;
                        
                }
                        //四、关闭数据库
                        mysqli_close($link);
            ?>
        </center>
    </body>
</html>