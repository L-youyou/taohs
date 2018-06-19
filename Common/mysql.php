<?php
	/**
	* 数据库相关的自定义函数
	*/
	function initDb(){
		//连接数据库
		$link=@mysql_connect("localhost","root","199667") or die("数据库连接失败");
		// 选择blog数据库
		$rs = mysql_select_db("taohs",$link);
		//设置编码
		mysql_query("set names utf8");
	}

	/**
	* 查询多条记录
	* @param  $sql  查询语句
	* @param  $rows 返回数组
	*/
	function findAll($sql){
		if(empty($sql)) return false;
		$query = mysql_query($sql);
		if(is_resource($query)){
			while ($row = mysql_fetch_array($query,MYSQL_ASSOC)) {
				$rows[]=$row;
			}
			return @$rows;
		}else{
			return false;
		}	
	}


	/**
	* 获取单条数据
	* @param  $sql  查询语句
	* @param  array 返回数组
	*/
	function find($sql){
		if(empty($sql)){
			return false;
		}
		$query = mysql_query($sql);
		return mysql_fetch_array($query,MYSQL_ASSOC);
	}
?>