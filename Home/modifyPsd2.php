<?php
    header("content-type:text/html;charset=UTF-8");
	// 引入文件
	include_once '../Common/function.php';
	include_once '../Common/mysql.php';

    $password=$_POST['password'];
    $newPsd=$_POST['newPsd'];
	//连接数据库
    initDb();
    @session_start();
    // var_dump($_SESSION['user_id']);
    if(!empty($_SESSION['user_id'])){
        $sql="SELECT * FROM user WHERE user_id = {$_SESSION['user_id']} LIMIT 1";
        $arr=find($sql);
        //判断初始密码是否一致
        if($_POST['password']!==$arr['password']){
            echo json_encode(['status'=>0,'msg'=>'原密码不正确']);
        }else{
            //组装sql语句修改密码
            $sql="UPDATE user SET password = '{$newPsd}' WHERE user_id = {$_SESSION['user_id']}";
            $rs=mysql_query($sql);
            if($rs){
                echo json_encode(['status'=>1,'msg'=>'密码修改成功']);
            }else{
                echo json_encode(['status'=>2,'msg'=>'密码修改失败']);
            }
        }
    }
?>