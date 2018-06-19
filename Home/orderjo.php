<?php
    /**
	* 生成订单功能能
	*/
    header("content-type:text/html;charset=UTF-8");
	// 引入文件
	include_once '../Common/function.php';
	include_once '../Common/mysql.php';

	//连接数据库
    initDb();

    //先生成订单
    @session_start();
    //当前时间
    $now=time();
    //生成订单号
    $orderNum=time().mt_rand(10,99);
    //组装sql语句
    $sql="INSERT INTO orders VALUES (null,'{$orderNum}',{$_SESSION['user_id']},'{$now}',0)";
    // echo $sql;die;
    $rs=mysql_query($sql);
    $getID=mysql_insert_id();
    if($rs){
        echo json_encode(['status'=>0,'msg'=>'订单生成成功','id'=>$getID]);
    }else{
        echo json_encode(['status'=>1,'msg'=>'订单生成失败']);
    }
    
    
?>