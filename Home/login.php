<?php
    /**
	* 登录功能
	*/
    header("content-type:text/html;charset=UTF-8");
	// 引入文件
	include_once '../Common/function.php';
	include_once '../Common/mysql.php';

	//连接数据库
    initDb();
    //接收参数
    //手机号
    $userAccount=$_POST['useraccount'];
    //密码
    $passWord=$_POST['password'];

    //查询数据库
    //查询用户是否存在
    $sql="SELECT * FROM user WHERE phone = '{$userAccount}' or user_name= '{$userAccount}' LIMIT 1;";
    $user=find($sql);
    if($user){
        //匹配密码是否正确
        // echo json_encode($user);die;
        if($user['password']!==$passWord){
            echo json_encode(['status'=>1,'msg'=>'密码错误']);
        }else{
            // 3.登录成功，把用户持久化   存入到SESSION
            @session_start();
            $_SESSION['user_name']=$user['user_name'];
            $_SESSION['user_id']=$user['user_id'];
            //返回数据
            echo json_encode(['status'=>0,'msg'=>'登录成功']);
        }
    }else{
        echo json_encode(['status'=>1,'msg'=>'该用户不存在，请重新输入']);
    }
?>