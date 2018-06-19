<?php 
    header("content-type:text/html;charset=UTF-8");
	// 引入文件
	include_once '../Common/function.php';
	include_once '../Common/mysql.php';

	//连接数据库
    initDb();

    // var_dump($_GET);
    
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>商品列表</title>
    <link rel="stylesheet" href="../Public/css/base.css">
    <link rel="stylesheet" href="../Public/css/style.css"/>
    <link rel="stylesheet" href="../Public/css/article.css">
    <script src="../Public/js/jquery-1.12.2.min.js"></script>
    <script src="../Public/js/index.js"></script>
</head>
<body>
<!-- 头部 -->
<?php include_once './header.php';?>
<!-- 内容-->
<!-- 图书所属分类-->
<div class="breadcrumb w">
    <span>您现在的位置：</span>
    <a href="/Home/index.php" target="_blank" title="全部分类">首页</a>
    <span class="spacer">&gt;</span>
    <a href="#" target="_blank" title="全部分类">全部分类</a>
    <?php 
        if($_GET){
            if($_GET['big_id']){
                $sql="SELECT * FROM booktype1 WHERE bigtype_id = '{$_GET['big_id']}' lIMIT 1";
                $arr=find($sql);
    ?>  
        <span class="spacer">&gt;</span>
        <a href="/Home/goodslist.php?big_id=<?php echo $arr['bigtype_id'];?>" target="_blank" title="文学小说"><?php echo $arr['bigtype_name']?></a>
    <?php
                if($_GET['small_id']){
                    $sql="SELECT * FROM booktype2 WHERE smalltype_id = '{$_GET['small_id']}' lIMIT 1";
                    // echo $sql;
                    $arr=find($sql);
    ?>
        <span class="spacer">&gt;</span>
        <a href="/Home/goodslist.php?big_id=<?php echo $arr['bigtype_id'];?>&small_id=<?php echo $arr['smalltype_id'];?>" target="_blank" title="文学小说"><?php echo $arr['smalltype_name']?></a>
    <?php
                }
            }
        }
    ?>
</div>
<!-- 内容 -->
<div class="category w">
    <!-- 商品左侧栏-->
    <div class="category_l">
        <h2>商品分类</h2>
        <!-- 商品分类列表-->
        <div class="oh" id="categoryMenu">
            <dl>
                <?php 
                    //查找商品大分类
                    $sql='SELECT * FROM booktype1';
                    $bookBigType=findAll($sql);
                    // var_dump($bookBigType);
                    if($bookBigType){
                        foreach ($bookBigType as $key => $bigCate) {
                ?>
                <dt><a href="/Home/goodslist.php?big_id=<?php echo $bigCate['bigtype_id'];?>"><?php echo $bigCate['bigtype_name'];?></a></dt>
                <?php 
                    //根据大分类id找小分类
                    $sql="SELECT * FROM booktype2 WHERE bigtype_id = '{$bigCate['bigtype_id']}'";
                    $bookSmallType=findAll($sql);
                    //小分类
                    if($bookSmallType){
                ?>
                <dd>
                    <?php 
                        foreach ($bookSmallType as $key => $smallCate) {
                            // var_dump($smallCate);
                    ?>
                        <a href="/Home/goodslist.php?big_id=<?php echo $bigCate['bigtype_id'];?>&small_id=<?php echo $smallCate['smalltype_id'];?>"><?php echo $smallCate['smalltype_name'];?></a>
                    <?php
                        }
                    ?>
                </dd>
                <?php
                            }
                        }
                    }
                ?>
                
            </dl>
        </div>
    </div>
    <!-- 商品容器-->
    <div class="category_r">
        <div class="cont">
            <ul>
                <?php
                    if(isset($_GET['small_id'])){
                        //查询books表
                        $sql="SELECT * FROM books WHERE smalltype_id = '{$_GET['small_id']}'";
                        $goods=findAll($sql);
                        if($goods){
                            foreach($goods as $key => $good){
                                // var_dump($good);
                                //查询stock表  利用查询到的鼠标信息的isbn查
                                $sql="SELECT * FROM stock WHERE ISBN = '{$good['ISBN']}' LIMIT 1";
                                $arr=find($sql);
                                // var_dump($arr);
                                if($arr){
                ?>
                <li>
                    <div class="cell ">
                        <div class="img">
                            <a href="/Home/goodsdetail.php?good_id=<?php echo $good['book_num']?>" target="_blank" title="<?php echo $good['book_name']?>">
                                <img  width="160" height="160" src="/Public/Upload/<?php echo $good['book_pic']?>" alt="<?php echo $good['book_name']?>" style="display: inline;">
                            </a>
                        </div>
                        <div class="name">
                            <a href="/Home/goodsdetail.php?good_id=<?php echo $good['book_num']?>" target="_blank"  title="<?php echo $good['book_name']?>"><?php echo $good['book_name']?></a>
                        </div>
                        <div class="price">
                            <span class="price-n"><?php echo $arr['discount']?></span>
                            <span class="price-o"><?php echo $arr['price']?></span>
                        </div>
                    </div>
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
</div>、

<!-- 尾部-->
<?php include_once './footer.php';?>
<script>
    
    $("#categoryMenu dt").on("click",function(){
        //当前dt样式改变
        $(this).addClass("cur").siblings("dt").removeAttr("class");
        //显示dd
        $(this).next("dd").slideDown().siblings("dd").hide();
        return false;
    });
    
</script>
</body>
</html>