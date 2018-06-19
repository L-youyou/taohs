<?php 
    header("content-type:text/html;charset=UTF-8");
	// 引入文件
	include_once '../Common/function.php';
	include_once '../Common/mysql.php';

	//连接数据库
    initDb();

    // var_dump($_GET);
    
    if($_GET['good_id']){
        //查询books表
        $sql="SELECT * FROM books WHERE book_num = '{$_GET['good_id']}' LIMIT 1";
        $good=find($sql);
        if($good){
        
 ?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>商品详情</title>
    <link rel="stylesheet" href="../Public/css/base.css">
    <link rel="stylesheet" href="../Public/css/style.css"/>
    <link rel="stylesheet" href="../Public/css/goods.css">
    <script src="../Public/js/jquery-1.12.2.min.js"></script>
    <script src="../Public/js/index.js"></script>
    <script src="../Public/js/cart.js"></script>
</head>
<body>
<!-- 头部 -->
<?php include_once './header.php';?>

<?php 
    //根据good['smalltype_id']查出分类名
    $sql="SELECT * FROM booktype2 WHERE smalltype_id = '{$good['smalltype_id']}' LIMIT 1";
    $small=find($sql);
    if($small){
        //查大分类名
        $sql="SELECT * FROM booktype1 WHERE bigtype_id = '{$small['bigtype_id']}' LIMIT 1";
        $big=find($sql);
        if($big){
?>  
<!-- 图书所属分类-->
<div class="breadcrumb w">
    <span>您现在的位置：</span>
    <a href="/Home/index.php" target="_blank" title="首页">首页</a>
    <span class="spacer">&gt;</span>
    <a href="#" target="_blank" title="文学小说">全部分类</a>
    <span class="spacer">&gt;</span>
    <a href="#" target="_blank" title="小说集"><?php echo $big['bigtype_name'];?></a>
    <span class="spacer">&gt;</span>
    <a href="#" target="_blank" title="小说集"><?php echo $small['smalltype_name'];?></a>
</div>
<?php
        }
    }
?>

<div class="container w">
    <!-- 猜你喜欢-->
    <div class="similar-rank">
        <div class="hd"><h3>猜你也喜欢</h3></div>
        <div class="bd">
            <ul>
                <?php 
                    //根据id查询同类书籍
                    $sql="SELECT * FROM books WHERE smalltype_id = '{$good['smalltype_id']}'";
                    $likes=findAll($sql);
                    if($likes){
                        foreach($likes as $key => $like){
                            if($key<=10){     
                ?>
                <li>
                    <div class="pic">
                        <div class="subpic">
                            <a href="/Home/goodsdetail.php?good_id=<?php echo $like['book_num']?>" target="_blank">
                                <img alt="<?php echo $like['book_name'];?>"
                                     src="/Public/Upload/<?php echo $like['book_pic'];?>"
                                     style="width: 85px; height: 85px;">
                            </a>
                        </div>
                    </div>
                    <p class="title">
                        <a href="/Home/goodsdetail.php?good_id=<?php echo $like['book_num']?>" target="_blank" title="<?php echo $like['book_name'];?>"><?php echo $like['book_name'];?></a>
                    </p>
                    <p class="price">
                        <?php 
                        // var_dump($like['ISBN']);
                            //查询stock表查价格
                            $sql="SELECT * FROM stock WHERE ISBN = '{$like['ISBN']}' LIMIT 1";
                            $price=find($sql);
                            if($price){
                                // var_dump($price);
                        ?>
                        <span class="price_d">¥<em><?php echo $price['discount'];?></em></span>
                    </>
                </li>
                <?php
                                }
                             }
                        }
                    }
                ?>
            </ul>
        </div>
    </div>
    <?php 
        //查询stock表  利用查询到的鼠标信息的isbn查
        $sql="SELECT * FROM stock WHERE ISBN = '{$good['ISBN']}' LIMIT 1";
        $arr=find($sql);
        if($arr){
    ?>
    <!-- 图书购买区-->
    <div class="product-intro " id="box">
        <!-- 图片-->
        <div class="show-pic">
            <!-- 放大镜-->
            <div class="box">
                <div id="smallBox" class="small">
                    <img src="/Public/Upload/<?php echo $good['book_pic'];?>" width="350" alt=""/>

                    <div id="mask" class="mask"></div>
                </div>
                <div id="bigBox" class="big">
                    <img src="/Public/Upload/<?php echo $good['book_pic'];?>" id="bigImg" width="800" alt=""/>
                </div>
            </div>
        </div>
        <!-- 摘要 -->
        <div class="summary">
            <!-- 标题-->
            <div class="name">
                <h2 class="book_name"><?php echo $good['book_name'];?></h2>
            </div>
            <div class="detail_wrap">
                <!-- 书本信息-->
                <div class="detail-info">
                    <ul>
                        <span class="book_pic hide"><?php echo $good['book_pic'];?></span></li>
                        <li class="t1">商品标号：<span class="book_num"><?php echo $good['book_num'];?></span></li>
                        <li class="t2">作者：<span><?php echo $good['author'];?></span></li>
                        <li class="t2">分类：<span><?php echo $good['book_pic'];?></span></li>
                        <li class="t2">出版社: <span><?php echo $good['pub_name'];?></span></li>
                        <li class="t2">开本：<span><?php echo $good['book_size'];?></span></li>
                        <li class="t2">出版日期：<span><?php echo $good['pub_date'];?></span></li>
                        <li class="t2">页数：<span><?php echo $good['book_pages'];?></span></li>
                        <li class="t2">ISBN：<span><?php echo $good['ISBN'];?></span></li>
                    </ul>
                </div>
                <!-- 销售详情-->
                <div class="buy-wrap">
                    <!-- 销售价格-->
                    <div class="sale-wrap">
                        <p><span class="attr-title letter3">促销价</span><span class="current-price">¥ <i class="discount"> <?php echo $arr['discount'];?></i></span></p>

                        <p><span class="attr-title letter2">定价</span><span class="price ">¥<?php echo $arr['price'];?></span></p>
                    </div>
                    <!-- 购买区-->
                    <div class="buy-area">
                        <div class="buy-num ">
                            <div class="attr-title"> 购买数量</div>
                            <div class="attr-con">
                                <div class="buy-num-active">
                                    <a href="javascript:;" class="reduce-btn disabled" title="减少">-</a>
                                    <input type="text" class="buy-num-text" id="input_buy_num" value="1" max="<?php echo $arr['stock_qty'];?>">
                                    <a href="javascript:;" class="add-btn" title="增加">+</a>
                                </div>
                                <div class="stock">
                                    库存：<span id="yl_good_stock"><?php echo $arr['stock_qty'];?></span>
                                </div>
                            </div>
                        </div>
                        <!-- 按钮-->
                        <div class="buy-active">
                            <a href="javascript:void(0);" class="collect-but " rel="nofollow">收藏</a>
                            <?php 
                                //判断session
                                @session_start();
                                if(!empty($_SESSION)){
                                    // var_dump($_SESSION);
                            ?>
                                <a href="javascript:void(0);" class="buy-but " id="buyBtn" rel="nofollow">加入购物车</a>
                            <?php
                                }else{
                            ?>
                                <a href="javascript:void(0);" class="buy-but login-btn " rel="nofollow">点击先登录</a>
                            <?php
                                }
                            ?>
                            
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <!-- 图书详情信息-->
    <div class="detail-wrap">
        <!-- 内容提要 -->
        <div class="section">
            <div class="txt-hd"><h5>内容提要</h5></div>
            <div class="txt-bd">
                <div class="content" style="height: auto; overflow: hidden;">
                    <?php echo $good['digest'];?>
                </div>
                <a href="javascript:void(0);" class="view-all" style="display: none;">查看全部&gt;&gt;</a>
            </div>
        </div>
    </div>
    <?php 
        }
    ?>
</div>
<?php
        }
    }
?>
<!-- 尾部-->
<?php include_once './footer.php';?>
</body>

<script>
    var box = document.getElementById("box");
    var smallBox = document.getElementById("smallBox");
    var bigBox = document.getElementById("bigBox");
    var bigImg = document.getElementById("bigImg");
    var mask = document.getElementById("mask");
    //1.鼠标经过小盒子 显示遮罩和大盒子 鼠标离开后隐藏
    smallBox.onmouseover = function () {
        mask.style.display = "block";
        bigBox.style.display = "block";
    };
    smallBox.onmouseout = function () {
        mask.style.display = "none";
        bigBox.style.display = "none";
    };
    //2.遮罩跟随鼠标坐标
    //鼠标在smallBox上移动的时候 获取鼠标在盒子中的坐标 然后设置mask的位置
    smallBox.onmousemove = function (event) {
        var event = event || window.event;
        //获取鼠标在页面中的坐标
        var pageX = event.pageX || event.clientX + document.documentElement.scrollLeft;
        var pageY = event.pageY || event.clientY + document.documentElement.scrollTop;
        //获取鼠标在盒子中的坐标
        //这里不能用smallBox.offsetLeft因为smallBox的offsetParent是box
        //而smallBox到box的offsetLeft是0 所以这里要用box.offsetLeft
        var boxX = pageX - box.offsetLeft;
        var boxY = pageY - box.offsetTop;
        //计算mask的坐标
        var maskX = boxX - mask.offsetWidth / 2;
        var maskY = boxY - mask.offsetHeight / 2;
        //3.限制遮罩的运动范围
        if (maskX < 0) {
            maskX = 0;
        }
        if (maskX > smallBox.offsetWidth - mask.offsetWidth) {
            maskX = smallBox.offsetWidth - mask.offsetWidth;
        }
        if (maskY < 0) {
            maskY = 0;
        }
        if (maskY > smallBox.offsetHeight - mask.offsetHeight) {
            maskY = smallBox.offsetHeight - mask.offsetHeight;
        }
        //console.log(maskX + "--" + maskY);
        //设置mask的位置

        mask.style.left = maskX + "px";
        mask.style.top = maskY + "px";
        //4.按照比例移动大图

        //大图能够移动的总距离 = 大图的宽度-大盒子的宽度
        var bigToMove = bigImg.offsetWidth - bigBox.offsetWidth;
        //mask能够移动的总距离 = 小盒子的宽度-mask的宽度
        var maskToMove = smallBox.offsetWidth - mask.offsetWidth;
        //rate = 大图能够移动的总距离/mask能够移动的总距离
        var rate = bigToMove / maskToMove;
        //大图应该到的位置  = rate * mask当前的位置 (移动方向相反所以是负数)
        bigImg.style.left = -rate * maskX + "px";
        bigImg.style.top = -rate * maskY + "px";

    };


   
</script>
<script>
    
</script>

</html>