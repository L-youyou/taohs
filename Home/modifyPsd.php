
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>修改密码</title>
    <link rel="stylesheet" href="../Public/css/base.css">
    <link rel="stylesheet" href="../Public/css/style.css"/>
    <link rel="stylesheet" href="../Public/css/personal.css">
    <script src="../Public/js/jquery-1.12.2.min.js"></script>
    <script src="../Public/js/index.js"></script>
    <script src="../Public/js/cart.js"></script>
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
            <h2>修改密码</h2>
        </div>
        <!-- 内容-->
        <div class="content">
        <form action="" method="post">
                        <div class="add_box">
                            <label for="">
                                <span> 原始密码：</span><input id="password" type="password" name="password"></label>
                        </div>
                        <div class="add_box">
                            <label for="">
                                <span> 新密码：</span><input id="newPsd" type="password" name="newPsd">
                            </label>
                        </div>
                        <div class="add_box">
                            <label for="">
                                <span> 确认密码：</span><input type="password" id="confPsd" name="confPsd"></label>
                        </div>
                        <div class="info" style="line-height: 30px; margin-left: 70px;color: red;"></div>
                         <div class="add_box">
                            <input type="button" value="保存" class="btn_style_bar">
                        </div>
                    </form>
        </div>
    </div>
</div>
<!--尾部-->
<?php include_once './footer.php';?>
</body>
<script>
    $(".btn_style_bar").on("click",function(){
        var password=$("#password").val();
        var newPsd = $("#newPsd").val();
        var confPsd = $("#confPsd").val();
        if(password.length<8){
            $(".info").html('密码长度必须大于8位');
            return
        }
        if(newPsd.length<8){
            $(".info").html('密码长度必须大于8位');
            return;
        }
        if(newPsd != confPsd){
            $(".info").html('密码不一致，请重新输入');
            return;
        }
        $.ajax({
            url:'/Home/modifyPsd2.php',
            type:'post',
            data:{
                password:password,
                newPsd:newPsd
            },
            datatype:'json',
            success:function(data){
                var data=JSON.parse(data);
                $(".info").html(data.msg);
            }
        });
        //清空
        $("#password").val('');
        $("#newPsd").val('');
        $("#confPsd").val('');
    });
</script>
</html>