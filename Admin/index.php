<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>首页</title>
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
            <!-- 个人资料 -->
            <div class="body teacher-profile">
                <div class="profile">
                    <div class="row survey">
                        <div class="col-md-3">
                            <div class="cell money">
                                <i class="fa fa-money"></i>
                                <span>我的收入</span>
                                <h5>￥11.11</h5>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="cell th">
                                <i class="fa fa-th"></i>
                                <span>课程数量</span>
                                <h5>12</h5>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="cell user">
                                <i class="fa fa-user"></i>
                                <span>用户数量</span>
                                <h5>236</h5>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="cell eye">
                                <i class="fa fa-eye"></i>
                                <span>浏览量</span>
                                <h5>22435</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../Public/assets/jquery/jquery.min.js"></script>
    <script src="../Public/assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>