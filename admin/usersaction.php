<?php
session_start();   //����session�Ự����
//��Ա��Ϣ����������½��֤���͡��˳�������

//����login.php��ֵ����element�����ж�Ӧ�Ĳ���

switch($_GET['element']){
    case "welcome":   //ִ�е�½��֤
        //����֤�����Ч��
        if($_POST['onlycode']!==$_SESSION['turecode']){
            header("Location:login.php?error=1");
                exit();
        }
        //ִ���˺�������֤
        $username = $_POST['username'];
        $userpass = $_POST['pass'];
        //----Mysql���ݿ����------------
        //1.���������ļ�
        require("../public/config.php");
        //2.����Mysql���ݿⲢ�����Ƿ����ӳɹ��ж�
        $link = @mysqli_connect(HOST,USER,PASSWORD) or die("�Բ������ݿ�����ʧ�ܣ�");
        //3.ѡ�����ݿⲢ�����ַ���
        mysqli_select_db($link,DBNAME);
        mysqli_set_charset($link,"utf8");
        //4.�����ѯSQL���(�û��ӱ��������ֵ���Ҵ����ݿ��п���ƥ�䵽)
        $sql = "select * from users where state=0 and username='{$username}'";
        $result = mysqli_query($link,$sql);
        //5.�ж��Ƿ��ѯ�����
        if(mysqli_num_rows($result)>0){
            //��ȡ�û���¼��Ϣ,$user��һ���������ʽ����
            $user = mysqli_fetch_assoc($result);
            //�ж������Ƿ���ȷ
            
            //===================������½ģ��=========================================
            
            //1���������ļ�
            require("../public/config.php");
            //2�������ݿⲢ�ж��Ƿ����ӳɹ�
            $link = @mysqli_connect(HOST,USER,PASSWORD) or die("�Բ������ݿ�����ʧ��");
            //3���ӿⲢ�����ַ���
            mysqli_select_db($link,DBNAME);
            mysqli_set_charset($link,"utf8");
            $sql = "select * from number where id=1";
            $result = mysqli_query($sql,$link);
            while($row=mysqli_fetch_assoc($result)){
                $num = $row['num'];    
            }
            if($user['pass']==md5($userpass)){
                //�����ж�
               $num = $num+1 ;
               $sqls= "update number set num= {$num} where id=1";//����½�ԼӺ�д�����ݿ�
               $results = mysqli_query($link,$sqls);
            //===============================================================
                //*�˴���ʾ��¼�ɹ�*
                $_SESSION['sakura']=$user;  //��������Ա��Ϣ���õ�session��
                header("Location:index.php");  //���ڣ���ת��ҳ������
                exit();
            }else{
                header("Location:login.php?error=3");
                exit();
            }
        }else{
            header("Location:login.php?error=2");
                exit();
        }
        
        
        
        break;
    case "thanks":   //ִ���˳�����
        //���ٵ�¼��Ϣ
        unset($_SESSION['sakura']);
        header("Location:index.php"); 
        break;
}