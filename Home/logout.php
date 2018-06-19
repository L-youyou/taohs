<?php
	/**
	* 退出登录功能
	*/
	header("content-type:text/html;charset=UTF-8");
  	// 引入文件
  	include_once '../Common/function.php';
    @session_start();
    //释放已经存在session里的值
    unset($_SESSION['user_id']);
    unset($_SESSION['user_name']);
    
    //判断是否还存在
    if(!isset($_SESSION['user_name']) || !isset($_SESSION['user_id'])){
        //清空localStorage里的值
        echo json_encode(['status'=>0,'msg'=>'退出成功']);
    }else{
        echo json_encode(['status'=>1,'msg'=>'退出失败']);
    }
?>