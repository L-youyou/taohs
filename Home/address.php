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
    <title>我的收获地址</title>
    <link rel="stylesheet" href="../Public/css/base.css">
    <link rel="stylesheet" href="../Public/css/style.css"/>
    <link rel="stylesheet" href="../Public/css/personal.css">
    <script src="../Public/js/jquery-1.12.2.min.js"></script>
    <script src="../Public/js/index.js"></script>
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
                            <input type="submit" value="保存" class="btn_style_bar">
                        </div>
                    </form>
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
</script>
</html>