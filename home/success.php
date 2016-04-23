<!DOCTPPE html>
<html>
    <head>
        <title>订单火速处理中</title>
    </head>
    <body>
        <table width="980px">
        <tr>
            <td align="center">
                <img src="./include/images/success.png" >
                
            </td>
            <td>
            <span  style="color:wheat;font-size:40px;"><?php session_start(); echo $_SESSION['liubindaren']['name'];?>君,请耐心等待哦...</span>
            <!--跳转回首页-->
            <meta http-equiv=refresh content="3;url=./index.php">
            
            </td>
        </tr>
        </table>
    </body>
</html>