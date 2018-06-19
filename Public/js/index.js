$(function () {
    //轮播图
    var index = 0;
    setInterval(function () {
        index++;
        $(".module li").eq(index).show().siblings("li").hide();
        if (index >= $(".module li").length - 1) {
            index = 0;
        }
    }, 3000);
    // 购物车显示隐藏
    $("#cart").hover(function () {
        $("#cartBox").show();
    }, function () {
        $("#cartBox").hide();
    });
    // 登录注册
    $("#nickName").hover(function () {
        $("#loginWin").show();
    }, function () {
        $("#loginWin").hide();
    });

    // 登录注册页面
    // 登录
    $(".login-btn").on("click", function () {
        // 遮罩层显示
        $(".cover").show();
        // 登录窗口显示
        $("#register").hide();
        $("#login").show();
    });
    // 注册
    $(".register-btn").on("click", function () {
        // 遮罩层显示
        $(".cover").show();
        // 登录窗口显示
        $("#register").show();
        $("#login").hide();
    });
    //关闭弹框
    $(".cover .close").on("click", function () {
        $(".cover").hide();
    });
    // 商品推荐切换
    // 默认显示第一个
    $(".recommended-book_left .content").hide().eq(0).show();
    $("#recommendTab li").eq(0).addClass("on");
    $("#recommendTab li").mouseover(function () {
        $(this).addClass("on").siblings("li").removeAttr("class");
        //切换分类内容
        var id = $(this).children("a").eq(0).attr("href");
        $(".content").hide();
        $(id).show();
    });

    //特价清仓
    //默认
    $("#clearance li>.name").eq(0).hide();
    $("#clearance li").eq(0).find(".detail").show();
    $("#clearance li").mouseover(function () {
        //其他样式恢复
        $(this).siblings("li").find(".detail").hide();
        $(this).siblings("li").children(".name").show();
        //当前样式改变
        $(this).children().eq(1).hide();
        $(this).find(".detail").show();
    });

    //商品详情分类

});













