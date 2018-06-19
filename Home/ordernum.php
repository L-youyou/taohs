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

    $bookNum=$_POST['bookNum'];
    $quantity=$_POST['quantity'];
    $orderId=$_POST['id'];

    //插入数据库
    $sql="INSERT INTO orderdetail VALUES ('{$bookNum}','{$quantity}',$orderId)";
    $rs=mysql_query($sql);
    if($rs){
        echo json_encode(['status'=>0,'msg'=>'订单生成成功']);
    }else{
        echo json_encode(['status'=>1,'msg'=>'订单生成失败']);
    }
?>