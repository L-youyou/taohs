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
            <!-- 收获地址 -->
            <div class="contentarea">
                <?php
                    //查询数据库的地址
                    $sql="SELECT * FROM address WHERE user_id = {$_SESSION['user_id']}";
                    $addressArr=findAll($sql);
                    if(!empty($addressArr)){
                ?>
                <table class="address-items" cellspacing="0" cellpadding="0" border="0">
                    <thead>
                        <tr >
                            <th>收货人</th>
                            <th>所在地区</th>
                            <th>手机号码</th>
                            <th>操作</th>
                            <th>选择</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php
                    foreach($addressArr as $key => $value){
                    
                ?>
                        <tr class="address-item">
                            <td><?php echo $value['goods_name'];?></td>
                            <td><?php echo $value['goods_address'];?></td>
                            <td><?php echo $value['tel_phone'];?></td>
                            <td>
                                <a href="" style="color: #36c;" >删除</a>
                            </td>
                            <td><span id='<?php echo $value['address_id'];?>'></span></td>
                        </tr>
                <?php
                    }
                ?>
                    </tbody>
                </table>
                <?php
                    }else{

                    }
                ?>
               

                <!-- 新增收获地址 -->
                <div class="add_address">
                    <div class="item ">
                        <span  class="item-label tsl">新增收货地址　</span>
                        <span class="tsl"> *最多只能添加 5 个收货地址</span>
                     </div>
                    <form action="" method="post">
                        <div class="add_box">
                            <label for="">
                                <span> 收货人：</span><input type="text" name="goodsName"></label>
                        </div>
                        <div class="add_box">
                            <label for="">
                                <span> 所在地址：</span><select name="province" id="province">
                                    <option value="请选择">请选择</option>
                                </select>
                                <select name="city" id="city">
                                    <option value="请选择">请选择</option>
                                </select>
                                <select name="town" id="town">
                                    <option value="请选择">请选择</option>
                                </select>
                            </label>
                        </div>
                        <div class="add_box">
                            <label for="">
                                <span> 详细地址：</span><input type="text" name="detailAdress">
                            </label>
                        </div>
                        <div class="add_box">
                            <label for="">
                                <span> 手机号：</span><input type="text" name="telPhone"></label>
                        </div>
                        <div class="add_box">
                            <input type="submit" value="保存并使用" class="btn_style_bar">
                        </div>
                    </form>
                </div>
            </div>   
            <!-- 商品清单 -->
            <div class="order-box">
                <!-- 标题 -->
                <div class="order-title">
                    <h3>商品清单</h3>
                    <ul id="order-items">
            
                    </ul>
                </div>
            </div>
            <!-- 总计 -->
            <div class="total_box">
                <div>
                    <span>共计 <span class="red" id="totalNum">2</span> 件商品，应付总金额</span><span class="red" id="totalPre">—</span>  
                </div>
                <div class="pos"> 
                    <a href="/Home/lightpay.php" class="submit_order" id="submit_order">确认并提交订单</a> 
                </div>
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
    $(function(){
        //选择地址
        $(".address-item").on("click",function () { 
            $.each($('.address-item'),function (index,item) {
                $(item).children().last().children().removeAttr('class');
            });
            $(this).children().last().children().attr("class", "check");
        });
        
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
            var tag='<li>'+
                    '<div class="goods_detail">'+
                    '<a href="/Home/goodsdetail.php?good_id='+order.book_num+'" class="goods_img">'+
                    '<img src="/Public/Upload/'+order.book_pic+'" alt="">'+
                    '</a>'+
                    '<a href="/Home/goodsdetail.php?good_id='+order.book_pic+'" class="goods_name">'+order.book_name+'</a>'+
                    '</div>'+
                    '<div class="cart_detail">'+
                    '<div class="univalent">￥'+order.discount+'</div>'+
                    '<div class="goods_account">x'+order.amount+'</div>'+
                    '<div class="sub_total">￥'+(order.discount*order.amount).toFixed(2)+'</div>'+
                    '</div>'+
                    '</li>';
            $("#order-items").append(tag);
        }
        $("#totalNum").html(num);
        $("#totalPre").html("￥"+total);


        //订单生成
        $(".pos .submit_order").on("click",function(){
            //jsonString是一个标准的json格式
            var jsonString = localStorage.getItem("order");
            jsonString=jsonString || "[]";
            var order=JSON.parse(jsonString);
            $.ajax({
                url:'/Home/orderjo.php',
                type:'post',
                data:{
                    data:jsonString
                },
                traditional: true,
                datatype:'json',
                success:function(data){
                    var data=JSON.parse(data);
                    //订单生成成功
                    if(data.status==0){
                        // console.log(typeof(data.id));
                        //批量插入详情
                        for(var i = 0;i<order.length;i++){
                            var item=order[i];
                            ajaxOrder(item['book_num'],item['amount'],data.id);
                        }
                    }
                }
            });
        });
    });
    //ajax插入订单详情
    function ajaxOrder(bookNum,amount,id){
        $.ajax({
            url:'/Home/ordernum.php',
            type:'post',
            data:{
                bookNum:bookNum,
                quantity:amount,
                id:id
            },
            datatype:'json',
            success:function(data){
                var data=JSON.parse(data);
                //订单生成成功
                if(data.status==0){
                    setTimeout(() => {
                        localStorage.removeItem("order");
                    }, 3000);;
                }
            }
        });
    }
    

</script>
</html>