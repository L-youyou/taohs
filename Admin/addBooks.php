
<?php
  /*
  *登录页面功能代码
  */
  header("content-type:text/html;charset=UTF-8");

  // 引入文件
  include_once '../Common/function.php';
  include_once '../Common/mysql.php';

  //连接数据
  initDb();

  //判断用户登录
  checkLogin();

  //渲染分类
  $sql="SELECT * FROM booktype2";
  $booktype2=findAll($sql);
    
    // var_dump($_POST);
    if(!empty($_POST)){
        //判断数据的合法性
        if(empty($_POST['bookname'])){back("书名不能为空");}
        if(empty($_POST['auther'])){back("作者不能为空");}
        if(empty($_POST['pubname'])){back("出版社不能为空");}
        if(empty($_POST['pubdate'])){back("出版时间不能为空");}
        if(empty($_POST['isbn'])){back("isbn不能为空");}
        if(empty($_POST['booksize'])){back("开本不能为空");}
        if(empty($_POST['bookpages'])){back("页数不能为空");}
        if(empty($_POST['stockqty'])){back("库存不能为空");}
        if(empty($_POST['price'])){back("原始价格不能为空");}
        if(empty($_POST['discount'])){back("折扣价不能为空");}
        if(empty($_POST['digest'])){back("摘要不能为空");}
        if(empty($_POST['smalltype'])){back("书本分类不能为空");}
    
        // var_dump($_FILES);
        if(!empty($_FILES)){
            //判断图片到底有没有上传成功
            // var_dump($_POST);
            if($_FILES['bookpic']['error']==0){
                //图片上传成功
                //修改图片的名称  事件戳+四位随机数+后缀名
                // echo $_FILES['pic']['name'];
                //获取后缀名
                $ext = strrchr($_FILES['bookpic']['name'],'.');
                //生成新的图片名
                $newPicName=time().mt_rand(1000,9999).$ext;
                // echo $newPicName;
                //实现图片的转存
                $rs = move_uploaded_file($_FILES['bookpic']['tmp_name'],'../Public/Upload/'.$newPicName );
                if($rs){
                    //查找isbn
                    $sql="SELECT * FROM stock WHERE ISBN = '{$_POST['isbn']}' LIMIT 1";
                    $arr=find($sql);
                    if($arr){
                        back("该书本已经存在");
                    }
                    //组装sql语句插入books表
                    $bookNum=time().mt_rand(10,99);
                    $sql="INSERT INTO books VALUES ('{$bookNum}','{$_POST['bookname']}','{$newPicName}','{$_POST['auther']}','{$_POST['pubname']}','{$_POST['pubdate']}','{$_POST['isbn']}','{$_POST['booksize']}','{$_POST['bookpages']}','{$_POST['digest']}',{$_POST['smalltype']})";
                    $rs1=mysql_query($sql);
                    //组装sql语句插入stock表
                    $sql="INSERT INTO stock VALUES ('{$_POST['isbn']}',{$_POST['stockqty']},'{$_POST['price']}','{$_POST['discount']}')";
                    $rs2=mysql_query($sql);
                    if($rs1&&$rs2){
                        back('上传成功');
                    }else{
                        back('上传失败');
                    }
                }
            }
        }
        
        //组合入库的数据
    }
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>发布图书</title>
    <link rel="stylesheet" href="../Public/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Public/assets/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="../Public/assets/nprogress/nprogress.css">
    <link rel="stylesheet" href="../Public/css/admin_index.css">
</head>
<body>
    
    <!-- 侧边栏 -->
    <?php include_once './aside.php';?>
    <!-- 主体 -->
    <div class="main">
        <div class="container-fluid">
            <!-- 头部 -->
            <?php include_once './header.php';?>
            <!-- 讲师资料 -->
            <div class="body teacher-profile">
                <div class="settings">
                    <form action="" class="form-horizontal" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">书名</label>
                            <div class="col-md-5">
                                <input type="text" name="bookname" class="form-control input-sm">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">书本封面</label>
                            <div class="col-md-2 preview">
                                <img src="/Public//images/coo.png">
                                <input type="file" name="bookpic" multiple id="upfile">
                                <div class="cover">
                                    <i class="fa fa-upload"></i>                  
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">作者</label>
                            <div class="col-md-2">
                                <input type="text" name="auther" class="form-control input-sm">
                            </div>
                            <label for="" class="col-md-2 control-label">出版社名称</label>
                            <div class="col-md-2">
                                <input type="text" name="pubname" class="form-control input-sm">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">出版日期</label>
                            <div class="col-md-2">
                                <input type="date" name="pubdate" class="form-control input-sm">
                            </div>
                            <label for="" class="col-md-2 control-label">ISBN</label>
                            <div class="col-md-2">
                                <input type="text" name="isbn" class="form-control input-sm">
                            </div>
                        </div>
                        
            
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">开本</label>
                            <div class="col-md-2">
                                <input type="text" name="booksize" class="form-control input-sm">
                            </div>
                            <label for="" class="col-md-2 control-label">书本页数</label>
                            <div class="col-md-2">
                                <input type="text" name="bookpages" class="form-control input-sm">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">库存数</label>
                            <div class="col-md-2">
                                <input type="text" name="stockqty" class="form-control input-sm">
                            </div>
                            <label for="" class="col-md-2 control-label">优惠价</label>
                            <div class="col-md-2">
                                <input type="text" name="price" class="form-control input-sm">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">原价</label>
                            <div class="col-md-2">
                                <input type="text" name="discount" class="form-control input-sm">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">内容摘要</label>
                            <div class="col-md-5 ckeditor">
                                <textarea  rows="15" name="digest" class="form-control input-sm"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">籍贯</label>
                            <div class="col-md-5">
                                <select name="smalltype" class="form-control input-sm">
                                    <?php 
                                        if(!empty($booktype2)){
                                            foreach($booktype2 as $key =>$books){      
                                    ?>
                                            <option value="<?php echo $books['smalltype_id']?>"><?php echo $books['smalltype_name']?></option>
                                    <?php
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8">
                                <a href="javascript:;" class="btn btn-success btn-sm pull-right"><input type="submit" style="background: transparent;
    border: 0;" value="发布"/></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="../Public/assets/jquery/jquery.min.js"></script>
    <script src="../Public/assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>