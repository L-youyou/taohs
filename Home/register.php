<?php
    /**
	* 注册功能
	*/
    header("content-type:text/html;charset=UTF-8");
	// 引入文件
	include_once '../Common/function.php';
	include_once '../Common/mysql.php';

	//连接数据库
    initDb();
    
    //接收参数
    //手机号
    $userPhone=$_POST['userphone'];
    //用户名  必填 不可修改不可重复
    $userName=$_POST['username'];
    //密码
    $passWord=$_POST['password'];

    //查询数据库
    //手机号唯一性
    $sql="SELECT * FROM user WHERE phone = '{$userPhone}' LIMIT 1;";
    $rs=find($sql);
    if($rs){
        echo json_encode(['status'=>1,'msg'=>'该手机号已经注册，请重新输入']);
    }else{
        //判断用户名唯一性
        //查询数据库
        $sql="SELECT * FROM user WHERE user_name = '{$userName}' LIMIT 1;";
        $rs=find($sql);
        if($rs){
            echo json_encode(['status'=>1,'msg'=>'该用户名已存在，请重新输入']);
        }else{
            //满足条件，存入数据库
            //sql语句
            $sql="INSERT INTO user values(null,'{$userPhone}','{$passWord}','{$userName}')";
            $rs=mysql_query($sql);
            if($rs){
                echo json_encode(['status'=>0,'msg'=>'注册成功']);
            }
        }
    }
?>