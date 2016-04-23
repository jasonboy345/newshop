<?php
/**
 *上传文件处理函数
 *@param array $upfile 被上传文件的信息，如$_FILES['pic'];
 *@param string $path 上传文件存储目录
 *@param array $typeList 允许的上传文件类型，默认空数组表示不限制
 *  如：$typeList = array("image/jpeg","image/gif","image/png");
 *@param int $maxSize 允许上传文件大小限制，默认0表示不限制
 *@return array 返回一个数组，内有两个单元：
 *      下标"error":返回true表示上传成功，false表示失败
 *      下标"info"： 返回成功的文件名，或失败的信息。
 *
 */
 function uploadFile($upfile,$path,$typeList=array(),$maxSize=0){
    //1. 初始化上传文件信息
    $path = rtrim($path,"/")."/"; //处理上传文件存储目录
    $res = array("error"=>false,"info"=>""); //初始化返回值
   
    //2. 判断上传错误信息
    if($upfile['error']>0){
        switch($upfile['error']){
            case 1: $info = "上传文件超过了php.ini选项限制"; break;
            case 2: $info = "上传文件的大小超过了HTML表单中MAX_FILE_SIZE 选项指定的值"; break;
            case 3: $info = "文件只有部分被上传。"; break;
            case 4: $info = "没有文件被上传。"; break;
            case 6: $info = "找不到临时文件夹"; break;
            case 7: $info = "上传文件写入失败"; break;
            default: $info = "未知上传错误！"; break;
        }
        $res['info']=$info;
        return $res;
    }

    //3. 判断过滤上传文件类型
    if(count($typeList)>0){
        if(!in_array($upfile['type'],$typeList)){
            $res['info']="文件类型错误！";
            return $res;           
        }
    }

    //4. 判断过滤上传文件大小约束
    if($maxSize>0){
        if($upfile['size']>$maxSize){ 
            $res['info']="文件大小超出限制！";
            return $res;
        }
    }

    //5. 随机上传文件名称
    $ext = pathinfo($upfile['name'],PATHINFO_EXTENSION); //获取上传文件的后缀名。
    do{
        $newName = date("YmdHis").rand(1000,9999).".".$ext; //随机上传文件名
    }while(file_exists($path.$newName)); //判断文件是否已存在。

    //6. 执行上传文件移动
    //判断是否是一个有效的上传文件
    if(is_uploaded_file($upfile['tmp_name'])){
        //移动上传文件
        if(move_uploaded_file($upfile['tmp_name'],$path.$newName)){
            $res['error']=true;
            $res['info']=$newName;
        }else{
            $res['info']="移动上传文件失败！";
            
        }
    }else{
        $res['info']="无效的上传文件！";
    }
    return $res;
}


/**
 *自定义一个图片等比缩放函数
 *@param string $picname 被缩放图片名
 *@param string $path 被缩放图片路径
 *@param int $maxWidth 图片被缩放后的最大宽度
 *@param int $maxHeight 图片被缩放后的最大高度
 *@param string $pre 缩放后的图片名前缀，默认为"s_"
 *@param boolen 返回布尔值表示成功与否。
 */
 function imageResize($picname,$path,$maxWidth,$maxHeight,$pre="s_"){
    $path = rtrim($path,"/")."/";
    //1获取被缩放的图片信息
    $info = getimagesize($path.$picname);
    //获取图片的宽和高
    $width = $info[0];
    $height = $info[1];
    
    //2根据图片类型，使用对应的函数创建画布源。
    switch($info[2]){
        case 1: //gif格式
            $srcim = imagecreatefromgif($path.$picname);
            break;
        case 2: //jpeg格式
            $srcim = imagecreatefromjpeg($path.$picname);
            break;
        case 3: //png格式
            $srcim = imagecreatefrompng($path.$picname);
            break;
       default:
            return false;
            //die("无效的图片格式");
            break;
    }
    //3. 计算缩放后的图片尺寸
    if($maxWidth/$width<$maxHeight/$height){
        $w = $maxWidth;
        $h = ($maxWidth/$width)*$height;
    }else{
        $w = ($maxHeight/$height)*$width;
        $h = $maxHeight;
    }
    //4. 创建目标画布
    $dstim = imagecreatetruecolor($w,$h); 

    //5. 开始绘画(进行图片缩放)
    imagecopyresampled($dstim,$srcim,0,0,0,0,$w,$h,$width,$height);

    //6. 输出图像另存为
    switch($info[2]){
        case 1: //gif格式
            imagegif($dstim,$path.$pre.$picname);
            break;
        case 2: //jpeg格式
            imagejpeg($dstim,$path.$pre.$picname);
            break;
        case 3: //png格式
            imagepng($dstim,$path.$pre.$picname);
            break;
    }
    

    //7. 释放资源
    imagedestroy($dstim);
    imagedestroy($srcim);
    
    return true;
}