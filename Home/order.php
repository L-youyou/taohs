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
    @session_start();
    if(!empty($_SESSION)){
        // var_dump($_SESSION);
        $sql="SELECT * FROM orders WHERE user_id = {$_SESSION['user_id']}";
        $arr=findAll($sql);
        if(!empty($arr)){
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>我的订单</title>
    <link rel="stylesheet" href="../Public/css/base.css">
    <link rel="stylesheet" href="../Public/css/style.css"/>
    <link rel="stylesheet" href="../Public/css/personal.css">
    <script src="../Public/js/jquery-1.12.2.min.js"></script>
    <script src="../Public/js/index.js"></script>
</head>
<body>
<!--头部-->
<?php include_once './header.php';?>
<!--内容-->
<div class="personal_main w" style="margin-top: 30px;">
    <!-- 左边部分-->
    <?php include_once './pers_slider.php';?>
    <!-- 右边部分-->
    <div class="personal_right">
        <!-- 标题-->
        <div class="title">
            <h2>我的购物车</h2>
        </div>
        <!-- 内容-->
        <div class="content">
            <!--购物车列表-->
            <div class="commodit">
                <table class="items">
                    <tr class="table_title">
                        <th width="100">订单标号</th>
                        <th width="150">收货人</th>
                        <th width="150">支付方式</th>
                        <th width="120">订单状态</th>
                        <th width="350">下单时间</th>
                        <th width="150">操作</th>
                    </tr>
                    <!-- 商品列表-->
                    <?php
                        foreach($arr as $key => $value){
                    ?>
                    <tr class="cate_list" style="height: 50px;">
                        <!-- 订单标号-->
                        <td width="100" align="center" >
                            <div class="commodit_name">
                            <?php echo $value['order_num'];?>	
                            </div>
                        </td>
                        <!-- 收货人-->
                        <td width="150" align="center">
                            <span class="commodit_price"><span><?php echo $_SESSION['user_name'];?></span></span>
                        </td>
                        <!-- 支付方式-->
                        <td width="150" align="center">
                            <span class="commodit_price">扫码支付</span>
                        </td>
                        <!-- 订单状态-->
                        <td width="120" align="center">
                        <?php 
                        if($value['status']==0){
                        ?>
                            <span>未支付</span>
                        <?php 
                        }else{
                        ?>
                            <span>已支付</span>
                            <?php
                        }
                        ?>
                        </td>
                        <!-- 下单时间-->
                        <td width="350" align="center">
                            <span class="commodit_price"><span><?php echo(date('Y-m-d H:i:s',$value['order_date'] ));?></span></span>
                        </td>
                        <!-- 操作-->
                        <td width="150" align="center">
                            <input type="submit" value="删除" id="<?php echo $value['order_id'] ?>" class="commodit_del">
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
   }
}
?>
<!--尾部-->
<?php include_once './footer.php';?>
</body>

</html>