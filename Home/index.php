<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>淘书吧首页</title>
    <link rel="stylesheet" href="../Public/css/base.css">
    <link rel="stylesheet" href="../Public/css/style.css"/>
    <link rel="stylesheet" href="../Public/css/index.css">
    <script src="../Public/js/jquery-1.12.2.min.js"></script>
    <script src="../Public/js/index.js"></script>
</head>
<body>
<!-- 头部 -->
<?php include_once './header.php';?>
<!-- 轮播图 -->
<div class="module">
    <ul>
        <li><a href="#" style="background-image: url('../Public/images/banner.jpg');"></a></li>
        <li><a href="#" style="background-image: url('../Public/images/banner-2.jpg');"></a></li>
        <li><a href="#" style="background-image: url('../Public/images/banner-3.jpg');"></a></li>
        <li><a href="#" style="background-image: url('../Public/images/banner-4.jpg');"></a></li>
        <li><a href="#" style="background-image: url('../Public/images/banner-5.jpg');"></a></li>
    </ul>
</div>
<!-- 主体内容 -->
<div class="container w">
    <!-- 为你推荐 -->
    <div class="recommended-book">
        <!-- 左边内容 -->
        <div class="recommended-book_left">
            <div class="headtuijian">
                <h3 class="title">为你推荐</h3>
                <ul id="recommendTab">
                <?php
                    $sql="SELECT * FROM booktype1";
                    $type1=findAll($sql);
                    foreach($type1 as $key => $bigType){
                        if($key<=6){
                ?>        
                    <li><a href="#<?php echo $bigType['bigtype_name'];?>"><?php echo $bigType['bigtype_name']?></a></li>
                <?php
                        }
                    }
                ?>
                </ul>
            </div>
            <div class="tab_content">
                <?php
                    foreach($type1 as $key => $bigType){
                        if($key<=6){
                ?>
                <div class="content" id="<?php echo $bigType['bigtype_name'];?>">
                    <ul class="list">
                        <?php
                            // var_dump($bigType);
                            //查询小分类
                            $sql="SELECT * FROM booktype2 WHERE bigtype_id = {$bigType['bigtype_id']}";
                            $types=findAll($sql);
                            if($types){
                                foreach($types as $key => $type){
                                    // var_dump($type);
                                //     //根据小分类查商品
                                    $sql="SELECT * FROM books WHERE smalltype_id = {$type['smalltype_id']};";
                                    // echo $sql;
                                    $goods=findAll($sql);
                                    if($goods){
                                         foreach($goods as $key => $good){
                                             if($key<=10){   
                                                //  var_dump($good);
                                                // 查询库存
                                                $sql="SELECT * FROM stock WHERE ISBN = '{$good['ISBN']}' LIMIT 1";
                                                $stock=find($sql);
                                                if($stock){
                        ?>
                        <li>
                            <a title="<?php echo $good['book_name'];?>" class="img" href="/Home/goodsdetail.php?good_id=<?php echo $good['book_num'];?>">
                                <img src="/Public/Upload/<?php echo $good['book_pic'];?>" alt="<?php echo $good['book_name'];?>">
                            </a>

                            <p class="name" ddt-src="25233927">
                                <a title="<?php echo $good['book_name'];?>" href="/Home/goodsdetail.php?good_id=<?php echo $good['book_num'];?>" target="_blank"><?php echo $good['book_name'];?></a>
                            </p>

                            <p class="author"><span class="author_t"></span><?php echo $good['author'];?></p>

                            <p class="price">
                                    <span class="rob">
                                        <span class="sign">¥</span>
                                        <span class="num"><?php echo $stock['discount'];?></span>
                                    </span>
                                    <span class="price_r">
                                        <span class="sign">¥</span>
                                        <span class="num"><?php echo $stock['price'];?></span>
                                    </span>
                            </p>

                            <div class="icon_pop"></div>
                        </li>
                        <?php
                                                }
                                            }
                                         }
                                    }
                                }
                            }
                        ?>
                        
                    </ul>
                </div>
                <?php
                        }
                    }
                ?>
            </div>
        </div>
        <!-- 右边公告栏 -->
        <div class="recommended-book_right">
            <div class="title">特价清仓</div>
            <div class="book_content">
                <ul id="clearance">
                    <?php
                        //按照库存排序
                        $sql="SELECT * FROM stock ORDER BY stock_qty ASC;";
                        $stock=findAll($sql);     
                        if($stock){
                            // var_dump($stock);    
                            foreach($stock as $key => $value){
                                if($key<=10){
                                    //按照ISBN查询图书信息
                                    $sql="SELECT * FROM books WHERE ISBN = '{$value['ISBN']}' LIMIT 1;";
                                    $book=find($sql);
                                    if($book){
                    ?>
                    <li class="">
                        <span class="num"><?php echo $key+1;?></span>
                        <!-- 书名-->
                        <p class="name"><a title="<?php echo $book['book_name']?>" href="/Home/goodsdetail.php?good_id=<?php echo $book['book_num'];?>" target="_blank"><?php echo $book['book_name']?></a></p>
                        <!--书详情-->
                        <div class="detail">
                            <a class="img" href="/Home/goodsdetail.php?good_id=<?php echo $book['book_num'];?>" target="_blank">
                                <img src="/Public/Upload/<?php echo $book['book_pic']?>"
                                     alt="<?php echo $book['book_name']?>"/>
                            </a>

                            <p class="name">
                                <a title="<?php echo $book['book_name']?>" href="/Home/goodsdetail.php?good_id=<?php echo $book['book_num'];?>"><?php echo $book['book_name']?></a>
                            </p>

                            <p class="price">
                            <span class="rob">
                                <span class="sign">¥</span>
                                <span class="num"><?php echo $value['discount']?></span>
                            </span>
                            </p>

                            <!-- <p class="link ">
                                <span></span>
                                <a target="_blank" href="#">220</a>条评论
                            </p> -->
                        </div>
                    </li>
                    <?php
                                    }
                                }
                            }
                        }    
                    ?>
                    
                </ul>
                <a href="#" target="_blank" title="查看完整榜单>>" class="more_top">查看完整榜单&gt;&gt;</a>
            </div>
        </div>
    </div>
    <!-- 好书推荐-->
    <div class="storey_three">
        <a class=" _1  pic" href="#">
            <img src="http://img57.ddimg.cn/9003260069940647.jpg" title="时代华语" alt="时代华语">
        </a>
        <a class=" _2  pic" href="#" title="北大社" target="_blank">
            <img src="http://img62.ddimg.cn/topic_img/gys_04083/aoshu382140.jpg" title="北大社" alt="北大社">
        </a>
        <a class=" _3  pic" href="#" title="童书" target="_blank">
            <img src="http://img50.ddimg.cn/9001530037679970.jpg" title="童书" alt="童书">
        </a>
    </div>
</div>
<!-- 尾部 -->
<?php include_once './footer.php';?>
</body>
<script>
    $(function () {
        $(".left_category").show();
    });
</script>
</html>

































