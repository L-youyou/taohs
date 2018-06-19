$(function(){
    //退出登录
    $("#loginout").on("click",function(){
        $.ajax({
            url:'/Home/logout.php',
            type:'post',
            success:function(data){
                var data=JSON.parse(data);
                if(data.status==0){
                    //清空localStorage里的值
                    localStorage.removeItem('goods');
                    //实现页面刷新
                    window.location.href='/Home/index.php';
                }
            }
        });
    });
    //登录
    $("#login_btn").on("click",function(){
        var useraccount=$("#login .useraccount").val();
        var password=$("#login .password").val();
        //判断合法性
        if(useraccount==""){
            $("#register .input_info").html('用户名不能为空');
            return;
        }
        if(password==""){
            $("#register .input_info").html('密码不能为空');
            return;
        }
        //函数调用
        loginAjax(useraccount,password);
    });
    //注册
    $("#regis_btn").on("click",function(){
        var userphone=$("#register .userphone").val();
        var username=$("#register .username").val();
        var password=$("#register .password").val();
        //判断合法性
        if(userphone==""){
            $("#register .input_info").html('手机号不能为空');
            return;
        }
        //11位合理手机号
        var myreg=/^[1][3,4,5,7,8][0-9]{9}$/;
        if(!myreg.test(userphone)){
            $("#register .input_info").html('手机号不合法');
            return;
        }
        if(username==""){
            $("#register .input_info").html('用户名不能为空');
            return;
        }
        if(password==""){
            $("#register .input_info").html('密码不能为空');
            return;
        }
        //密码大于8位
        //手机号
        $.ajax({
            url:'/Home/register.php',
            type:'post',
            data:{
                userphone:userphone,
                username:username,
                password:password
            },
            datatype:'json',
            success:function(data){
                console.log(JSON.parse(data));
                var data=JSON.parse(data);
                //注册失败
                if(data.status==1){
                    $("#register .input_info").html(data.msg);
                }
                //注册成功
                if(data.status==0){
                    $("#register .input_info").html(data.msg);
                    //注册成功后自动登录
                    loginAjax(userphone,password);
                }
            }
        });
    });
    //登录请求
    function loginAjax(useraccount,password){
        $.ajax({
            url:'/Home/login.php',
            type:'post',
            data:{
                useraccount:useraccount,
                password:password
            },
            datatype:'json',
            success:function(data){
                var data=JSON.parse(data);
                //登录失败
                if(data.status==1){
                    $("#login .input_info").html(data.msg);
                }
                //登录成功
                if(data.status==0){
                    //隐藏cover
                    $(".cover").hide();
                    //实现页面刷新
                    location.reload(true);
                }
            }
        });
    }
});