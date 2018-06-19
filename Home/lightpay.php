<?php
    header("content-type:text/html;charset=UTF-8");
	// 引入文件
	include_once '../Common/function.php';
	include_once '../Common/mysql.php';

	//连接数据库
    initDb();
    @session_start();
    // var_dump($_SESSION);
    if(!empty($_POST)){
        //查询数据库中的数据
        $sql="SELECT * FROM address WHERE user_id = {$_SESSION['user_id']}";
        $addressArr=findAll($sql);
        if(count($addressArr)<5){
            //拼接地址
            $address=$_POST['province'].$_POST['city'].$_POST['town'].$_POST['detailAdress'];
            // echo $address;
            //组装sql语句
            $sql="INSERT INTO address VALUES (null,{$_SESSION['user_id']},'{$_POST['goodsName']}','{$address}','{$_POST['telPhone']}')";
            $rs=mysql_query($sql);
            if($rs){
                $reload = <<<eof
                <script type="text/javascript">
                    windows.location.href="/Home/address.php";
                </script>
eof;
                echo $reload;
            }
        }else{
            $overmuch = <<<eof
            <script type="text/javascript">
                alert("地址添加过多");
            </script>
eof;
            echo $overmuch;
        }
    }      
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>确认订单</title>
    <link rel="stylesheet" href="../Public/css/base.css">
    <link rel="stylesheet" href="../Public/css/style.css"/>
    <link rel="stylesheet" href="../Public/css/personal.css">
    <script src="../Public/js/jquery-1.12.2.min.js"></script>
    <script src="../Public/js/index.js"></script>
    <!-- <script src="../Public/js/ajax.js"></script> -->
</head>
<body>
<!--头部-->
<?php include_once './header.php'?>
<!--内容-->
<div class="personal_main w" style="margin-top: 30px;">
    <!-- 左边部分-->
    <?php include_once './pers_slider.php';?>
    <!-- 右边部分-->
    <div class="personal_right">
        <!-- 标题-->
        <div class="title">
            <h2>我的收获地址</h2>
        </div>
        <!-- 内容-->
        <div class="content">
            <!-- 支付 -->
            <div class="success">
                <div class="success_header">
                    <span class="bg_icon"></span>
                    <span class="bigandbold">确认付款</span>
                </div>
                <div class="order_info">
                    <span class="span_name">您的订单号：</span>
                    <span class="span_data blue">05280117904</span>
                    <span class="span_name">已支付金额：</span>
                    <span class="span_data red"> ¥0.00 </span>
                    <span class="span_name">未支付金额：</span>
                    <span class="span_data red">¥<span class="totalPri"></span></span>
                </div>
                <div class="resp-tab-content">
                    <div class="resp_left">
                        <p>支付方式：<img src="/Public//images/1.png"></p>
                        <p>未支付金额：<span class="red" >¥<span class="totalPri"></span> </span></p>
                    </div>
                    <div class="resp_right">
                        <img src="/Public/images/img.jpg" >
                    </div>
                </div>
            </div>
            <div class="go_order">
                <a href="#"><<查看订单</a>
            </div>
        </div>
    </div>
</div>
<!--尾部-->
<?php include_once './footer.php';?>
</body>
<script src="../Public/js/area.js"></script>
<script src="../Public/js/select.js"></script>
<script>
    //渲染数据
        //jsonString是一个标准的json格式
        var jsonString = localStorage.getItem("order");
        //将json格式字符串转换成js对象
        jsonString=jsonString || "[]";
        var order = JSON.parse(jsonString);
        var total=0;
        var num=0;
        for(var i = 0 ;i<order.length;i++){
            var order=order[i];
            //总数量
            num+=order.amount;
            //总价格
            (total+=order.discount*order.amount).toFixed(2);
        }
        $(".totalPri").html(total);
</script>
</html>