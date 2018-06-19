<?php 
    header("content-type:text/html;charset=UTF-8");
	// 引入文件
	include_once '../Common/function.php';
	include_once '../Common/mysql.php';

	//连接数据库
    initDb();
    
	//判断用户登录
    @session_start();
    
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>头部</title>
    <link rel="stylesheet" href="../Public/css/base.css">
    <link rel="stylesheet" href="../Public/css/style.css"/>
    <link rel="stylesheet" href="../Public/font/iconfont.css"/>
    <script src="../Public/js/jquery-1.12.2.min.js"></script>
    <script src="../Public/js/index.js"></script>
    <script src="../Public/js/ajax.js"></script>
</head>
<body>
<!-- 遮盖层 -->
<div class="cover hide">
    <!-- 登录 -->
    <div class="overTip" id="login">
        <div class="close"><i class="iconfont icon-close"></i></div>
        <div class="over-win">
            <h3 class="">登录</h3>
            <div class="overWinText">
                <div class="input_box">
                    <input type="text" name="username" class="useraccount" placeholder="用户名/手机号">
                </div>
                <div class="input_box ">
                    <input type="password" name="password" class="password" placeholder="密码">
                </div>
                <div class="input_info" style="margin-bottom: 15px;padding: 0 5px;color: #d80808;"></div>
                <div class="input_box input_login_box">
                    <input type="button" name="login" id="login_btn" value="登录">
                </div>
            </div>
        </div>
    </div>
    <!-- 注册 -->
    <div class="overTip" id="register">
        <div class="close"><i class="iconfont icon-close"></i></div>
        <div class="over-win">
            <h3>注册</h3>
            <div class="overWinText">
                <div class="input_box">
                    <input type="text" placeholder="手机号" class="userphone" name="userphone">
                </div>
                <div class="input_box ">
                    <input type="text" placeholder="用户名（注册后不可修改）" class="username" name="username"> 
                </div>
                <div class="input_box ">
                    <input type="password" placeholder="设置密码" class="password" name="password">
                </div> 
                <div class="input_info" style="margin-bottom: 15px;padding: 0 5px;color: #d80808;"></div>
                <div class="input_box input_login_box">
                    <input type="button" id="regis_btn" name="login"  value="注册">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 头部 -->
<div class="nav-header-box">
    <div class="w clearfix">
        <div class="slogan-box">您好，欢迎光临淘书吧书城！</div>
        <div class="user-info-box clearfix">
            <!-- 购物车 -->
            <div class="item-info" id="cart">
                <?php 
                    if(isset($_SESSION['user_name']) && isset($_SESSION['user_id'])){
                ?>
                <a href="/Home/cart.php">
                    <span class="info-text"><i class="iconfont icon-cart"></i> 购物车</span>
                </a>
                <?php
                    }else{
                ?>
                <a href="#">
                    <span class="info-text"><i class="iconfont icon-cart"></i> 购物车</span>
                </a>
                <?php
                    }
                ?>
                <div id="cartBox" class="cart-win hide">
                    <?php 
                        if(isset($_SESSION['user_name']) && isset($_SESSION['user_id'])){
                    ?>
                        <!-- 购物车状态 购物车为空 -->
                        <div class="cart none-box ">
                            <div class="iconfont icon-gouwuche11"></div>
                            <div class="tip">您的购物车是空的，快去挑点好书放进来吧。</div>
                        </div>
                    <?php
                        }else{
                    ?>
                        <!-- 购物车状态 未登录状态 -->
                        <div class="cart no-login-box ">
                            <div class="tip">
                                <span class="text">您的购物车是空的，</span>
                                <span class="text">登录后可以同步购物车中的商品哦</span>
                            </div>
                            <div class="login-btn">登录</div>
                        </div>
                    <?php
                        }
                    ?>
                </div>

                <!-- 购物车状态 购物车不为空 -->
                <div class="cart list-box hide">
                    <div class="title">最近加入的商品:</div>
                    <ul class="item-list">
                        <li class="item clearfix">
                            <a class="img-box" href="#" target="_blank">
                                <img src="../Public/images/9787040264487.jpg" alt="">
                            </a>
                            <a href="#" class="name" target="_blank">诺贝尔文学奖文集：奥林匹斯的春天·梦中的佳丽－伊玛果·卡尔费尔德诗选</a>

                            <div class="info">
                                <div class="price">￥6.85</div>
                                <div class="del-box">
                                    <span class="del-btn">删除</span>
                                </div>
                            </div>
                        </li>
                        <li class="item clearfix">
                            <a class="img-box" href="#" target="_blank">
                                <img src="../Public/images/9787040264487.jpg" alt="">
                            </a>
                            <a href="#" class="name" target="_blank">诺贝尔文学奖文集：奥林匹斯的春天·梦中的佳丽－伊玛果·卡尔费尔德诗选</a>

                            <div class="info">
                                <div class="price">￥6.85</div>
                                <div class="del-box">
                                    <span class="del-btn">删除</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="btn-box clearfix">
                        <a href="#" class="btn" target="_blank">查看我的购物车</a>
                    </div>
                </div>
            </div>
            <!-- 我的订单 -->
            <div class="item-info">
                <?php 
                    if(isset($_SESSION['user_name']) && isset($_SESSION['user_id'])){
                ?>
                <a href="/Home/order.php">
                    <span class="info-text"><i class="iconfont icon-dingdan"></i>我的订单</span>
                </a>
                <?php
                    }else{
                ?>
                <a href="#">
                    <span class="info-text"><i class="iconfont icon-dingdan"></i>我的订单</span>
                </a>
                <?php
                    }
                ?>
            </div>
            <!-- 个人中心 -->
            <div class="item-info">
                <?php 
                    if(isset($_SESSION['user_name']) && isset($_SESSION['user_id'])){
                ?>
                <a href="/Home/personal.php">
                    <span class="info-text"><i class="iconfont icon-user"></i>个人中心</span>
                </a>
                <?php
                    }else{
                ?>
                <a href="#">
                    <span class="info-text"><i class="iconfont icon-user"></i>个人中心</span>
                </a>
                <?php
                    }
                ?>
                </a>
            </div>
            <div class="line"></div>
            <!-- 登录注册 -->
            <div class="item-info login-win" id="nickName">
            <?php 
                if(isset($_SESSION['user_name']) && isset($_SESSION['user_id'])){
            ?>
                    <span class="info-text">您好，<?php echo $_SESSION['user_name']?></span>
                    <div class="login-box hide" id="loginWin">
                        <div class="logout-btn" id="loginout">退出</div>
                    </div>
            <?php
                }else{
            ?>
                    <span class="info-text">登录/注册</span>
                    <div class="login-box hide" id="loginWin">
                        <div class="login-btn">登录</div>
                        <div class="register-btn">免费注册</div>
                    </div>
            <?php
                }
            ?>
            </div>
        </div>
    </div>
</div>
<!-- 头部广告 -->
<!-- <div class="temp_ads_index">
    <a href="#" class="ads_img"></a>
</div> -->
<!-- 搜索栏 -->
<div class="header-search-box">
    <div class="w clearfix">
        <!-- logo -->
        <div class="logo">
            <a href="#">
                <img src="../Public/images/logo.png" alt="">
            </a>
        </div>
        <!-- 搜素框 -->
        <div class="search-box clearfix">
            <div class="search">
                <input type="text" placeholder="商品名" class="search-put">
                <input type="button" value="搜索" class="search-btn">
            </div>
            <div class="hot-key">
                <em>热门关键字：</em>
                <ul>
                    <li><a href="#">时间简史</a></li>
                    <li><a href="#">果壳中的宇宙</a></li>
                    <li><a href="#">李敖自传</a></li>
                    <li><a href="#">刺杀骑士团</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- 导航栏 -->
<div class="nav">
    <div class="w">
        <div class="interaction-menu">
            <h2><span class="unfold">全部商品分类</span></h2>
            <!-- 商品分类 -->
            <div class="left_category ">
                <ul class="category_items">
                    <?php 
                    //查找商品大分类
                    $sql='SELECT * FROM booktype1';
                    $bookBigType=findAll($sql);
                    // var_dump($bookBigType);
                        if($bookBigType){
                            foreach ($bookBigType as $key => $bigCate) {
                    ?>
                    <li class="category_item">
                        <a href="/Home/goodslist.php?big_id=<?php echo $bigCate['bigtype_id'];?>"><?php echo $bigCate['bigtype_name'];?></a>
                        <?php 
                            //根据大分类id找小分类
                            $sql="SELECT * FROM booktype2 WHERE bigtype_id = '{$bigCate['bigtype_id']}'";
                            // print_r($sql);
                            $bookSmallType=findAll($sql);
                            if($bookSmallType){
                        ?>
                        <div class="sub_category">
                            <ul>
                                <?php 
                                    foreach ($bookSmallType as $key => $smallCate) {
                                ?>
                                <li><a href="/Home/goodslist.php?big_id=<?php echo $bigCate['bigtype_id'];?>&small_id=<?php echo $smallCate['smalltype_id'];?>"><?php echo $smallCate['smalltype_name'];?></a></li>
                                <?php 
                                    }
                                ?>
                            </ul>
                        </div>
                        <?php
                            }
                        ?>
                    </li>
                    <?php
                            }
                        }
                    ?>
                </ul>
            </div>
        </div>
        <div class="cf">
            <ul class="master-nav-list">
                <li><a href="/Home/index.php">首页</a></li>
                <li><a href="#">图书专栏</a></li>
                <li><a href="#">旧书回收</a></li>
                <li><a href="#">满35包邮</a></li>
                <li><a href="#">代理合作</a></li>
            </ul>
        </div>
    </div>
</div>

</body>
<script>
    
</script>
</html>