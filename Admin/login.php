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

  if(!empty($_POST)){
    // 判断数据的合法性
    if(empty($_POST['adminaccount'])) back("用户名不能为空");
    if(empty($_POST['password'])) back("密码不能为空");

    //开始实现用户登录
    $sql="SELECT * FROM admin WHERE admin_account= '{$_POST['adminaccount']}' LIMIT 1";
    $query= mysql_query($sql);
    $admin=mysql_fetch_array($query,MYSQL_ASSOC);
    
    if($admin){
      // 2.密码不正确
      var_dump($admin);
    //   die;
      if($admin['admin_password']!==$_POST['password']){

        back('密码错误');
      }
      // 3.登录成功，把用户持久化   存入到SESSION
      @session_start();
      $_SESSION['admin_name']=$admin['admin_name'];
      $_SESSION['admin_id']=$admin['admin_id'];
      jump("登录成功","Admin/index.php",3);
    }else{
      // 1.用户不存在
      back("用户不存在");
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>登录</title>
    <link rel="stylesheet" href="../Public/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Public/assets/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="../Public/assets/nprogress/nprogress.css">
    <link rel="stylesheet" href="../Public/css/admin_index.css">
</head>
<body>
    <!-- 登录 -->
    <div class="login">
        <div class="login-wrap">
            <form action="" class="col-md-offset-1 col-md-10" method="post">
                <div class="input-group input-group-lg">
                    <span class="input-group-addon">
                        <i class="fa fa-user"></i>
                    </span>
                    <input type="text" name="adminaccount" class="form-control" placeholder="用户名">
                </div>
                <div class="input-group input-group-lg">
                    <span class="input-group-addon">
                        <i class="fa fa-key"></i>
                    </span>
                    <input type="password" name=password class="form-control" placeholder="密码">
                </div>
                <button type="submit" class="btn btn-lg btn-primary btn-block">登 录</button>
            </form>
        </div>
    </div>
    
    <script src="../Public/assets/jquery/jquery.min.js"></script>
    <script src="../Public/assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>