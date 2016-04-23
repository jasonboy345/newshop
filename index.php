<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>网站后台临时入口</title> 
        <style type="text/css">
            a{text-decoration:none;font-size:25px;color:maroon;}
            body{background-color:silver;font-weight:bold;font-family:微软雅黑;}    
        </style>
    </head>
    <body>
        <center>
        
            <table border="0" cellspacing="180" >
                <tr>
                    <td><a href="./admin/index.php">网站后台管理</a></td>
                </tr>
                    
                <tr>
                    <td><a href="./home/index.php">网站前台管理</a></td>
                </tr>
            </table>
            
            <?php
               // header("Location:./admin/index.php");
            ?>
        </center>
    </body>
</html>
