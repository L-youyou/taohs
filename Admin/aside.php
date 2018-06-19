<?php
  /*
  *后台左侧栏功能代码
  */
  header("content-type:text/html;charset=UTF-8");
  // 引入文件
  include_once '../Common/function.php';
  include_once '../Common/mysql.php';

  checkLogin();

  initDb();

?>
<!-- 侧边栏 -->
<div class="aside">
        <!-- 个人资料 -->
        <div class="profile">
            <!-- 头像 -->
            <div class="avatar img-circle">
                <img src="/Public/images/monkey.png">
            </div>
            <h4><?php echo $_SESSION['admin_name'];?></h4>
        </div>
        <!-- 导航菜单 -->
        <div class="navs">
            <ul class="list-unstyled">
                <li>
                    <a href="/Admin/index.php" class="active">
                        <i class="fa fa-home"></i>
                        主页
                    </a>
                </li>
                <li>
                    <a href="javascript:;">
                        <i class="fa fa-bell"></i>
                        用户管理
                    </a>
                </li>
                <li>
                    <a href="/Admin/addBooks.php">
                        <i class="fa fa-bell"></i>
                        发布图书
                    </a>
                </li>
            </ul>
        </div>
    </div>