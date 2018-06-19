<?php
	/**
	* 公共函数代码
	**/

	/**
	* auth：liuhuan
	* @param  $msg 提示信息
	* desc : 返回上一步
	**/

	function back($msg){
		echo $msg;
		$back = <<<eof
		<script type="text/javascript">
			setTimeout('window.history.go(-1);',1000);
		</script>
eof;
		echo $back;
		exit();
	}

	/**
	* 跳转函数
	* @param  $msg 提示信息
	* @param  $url 跳转地址
	* @param  $time延迟时间
	* desc : 跳转函数
	**/
	function jump($msg,$url,$time=1){
		$url= 'http://www.taohs.com/'.$url;
		//跳转提示功能
		header("Refresh:{$time};url='{$url}'");
		echo $msg . "系统将在{$time}面后自动跳转到{$url}";
		//终止脚本
		exit();
	}
	// 后台管理
	function checkLogin(){
		//判断用户是否登录
		@session_start();
		if(!isset($_SESSION['admin_name']) || !isset($_SESSION['admin_id'])){
		   jump("暂未登录，请先去登录",'Admin/login.php',3);
		}
	}
	
?>