<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>我的购物车</title>
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
            <h2>我的购物车</h2>
        </div>
        <!-- 内容-->
        <div class="content">
            <!--购物车列表-->
            <div class="commodit">
                <table class="items" id='goodTable'>
                <thead>
                    <tr class="table_title">
                        <th width="30"><input type="checkbox" style="display: none"></th>
                        <th width="80">商品图片</th>
                        <th width="350">商品名称</th>
                        <th width="150">商品单价</th>
                        <th width="120">购买数量</th>
                        <th width="150">小计</th>
                        <th width="150">操作</th>
                    </tr>
                </thead>
                <!-- 商品列表-->
                <tbody>
                </tbody>
                    
                </table>
            </div>
            <!-- 结算-->
            <div class="settle_accounts">
                <div class="cart_operation">
                    <!-- 全选按钮-->
                    <div class="all_checked">
                        <input type="checkbox" /><span>全选</span>
                    </div>
                    <!-- 批量操作-->
                    <div class="all_del">
                        <a href="#">批量删除</a>
                    </div>
                </div>
                <div class="cart_statistics">
                    <!-- 结算信息-->
                    <div class="cart_stat_box">
                        <span>已选 <span id="checkedAmount">0</span> 件商品,</span>
                        <span>合计（不含运费）：</span><span class="red">¥<span  id="totalPrice">0</span></span>
                    </div>
                    <!-- 结算按钮-->
                    <div class="btn_submit_box">
                        <a href="javascript:;" class="btn_pay">去结算</a>
                    </div>
                </div
            </div>
        </div>
    </div>
</div>
<!--尾部-->
<?php include_once './footer.php';?>
</body>
</html>