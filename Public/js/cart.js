$(function(){
    //点击减购买数
    $(".reduce-btn").on("click",function(){
        if($("#input_buy_num").val()>2){
            //减一操作
            $("#input_buy_num").val($("#input_buy_num").val()-1);
        }else if($("#input_buy_num").val()>1){
            //减一操作
            $("#input_buy_num").val($("#input_buy_num").val()-1);
            //禁止使用
            $(this).addClass("disabled");
        }
    });
    //点击加购买数
    $(".add-btn").on("click",function(){
        //去除减号的disable属性
        $(".reduce-btn").removeClass("disabled");
        $("#input_buy_num").val($("#input_buy_num").val()-0+1);
    });

    //点击加入购物车按钮加入购物车
    $("#buyBtn").on("click",function(){
        //获取需要的值
        //1.商品编号 book_num
        var book_num=$(".book_num").text();
        //2.商品封面
        var book_pic=$(".book_pic").text();
        //3.商品名称
        var book_name=$(".book_name").text();
        //4.商品价格
        var discount=$(".discount").text();
        //5.购买数量
        var amount=Number($("#input_buy_num").val());
        //数据获取好，放入localStorage中
        var good={
            'book_num':book_num,
            'book_pic':book_pic,
            'book_name':book_name,
            'discount':discount,
            'amount':amount,
        };
        // console.log("a");
        //1.约定好用名称为goods的localStorage来存放购物车里的数据信息  goods里所存放的就是一个json字符串
        var goods = localStorage.getItem("goods");
        /*判断一下本地是否有一个购物车（goods），没有的话，创建一个空的购物车，有的话就直接拿来使用*/
        if(!goods) { //没有购物车     goods  json
            localStorage.setItem( "goods", "");
        }
        //添加数据
        setItem(good);
        
    });
    //1.0 获取数据
    function getItem(){
        //jsonString是一个标准的json格式
        var jsonString = localStorage.getItem("goods");
        //将json格式字符串转换成js对象
        jsonString=jsonString || "[]";
        return JSON.parse(jsonString);
    }
    //2.0 实现数据的增加
    function setItem(obj){
        var arr =getItem();
        //先将数据加入到arr数组中
        arr.push(obj);
        //判断刚加入的数据的book_num 原来的arr中是否存在，存在需要合并
        for(var i = 0;i < arr.length-1; i++){
            if(arr[i]['book_num']==obj['book_num']){
                //说明存在相同的商品，将原有的amount+现在的amount ，arr最后一项去掉
                arr[i]['amount']=arr[i]['amount'] + obj['amount'];
                //重新赋值
                arr.splice(arr.length-1,1);
            }
        }
        //2.0 将arr转换成json字符串保存起来
        localStorage.setItem("goods",JSON.stringify(arr));
        alert("添加商品成功");
    }
    //3.0 实现数据的删除
    function removeItem(goodsid){
        var arr=getItem();
        //查找arr中的goodsid和传入的参数goodsid一致的数据全部移除
        for (var i= arr.length-1; i>=0;i--){
            if(arr[i].goodsid==goodsid){
                arr.splice(i,1);
            }
        }
        //3.0 将arr转换成json字符串保存起来
        localStorage.setItem("goods",JSON.stringify(arr));
    }

    //首次进入刷新页面
    var goods=getItem();
    cartShow(goods);

    // 购物车页面的渲染
    function cartShow(goods){
        $.each(goods,function (index,item) {
            var tag='<tr class="cate_list">'
                            +'<!-- 选择框-->'
                            +'<td class="btn_box" width="30" align="center">'
                            +'<input type="checkbox"  value='+index+'>'
                            +'</td>'
                            +'<!-- 商品图片-->'
                            +'<td width="80" align="center">'
                            +'<span class="commodit_span">'
                            +'<a href="/Home/goodsdetail.php?good_id='+item.book_num+'" target="_blank">'
                            +'<img class="max60" src="/Public/Upload/'+item.book_pic+'">'
                            +'</a>'
                            +'</span>'
                            +'</td>'
                            +'<!-- 商品名称-->'
                            +'<td width="350" align="left" >'
                            +'<div class="commodit_name">'
                            +'<a href="/Home/goodsdetail.php?good_id='+item.book_num+'" target="_blank">'+item.book_name+'</a>'
                            +'</div>'
                            +'</td>'
                            +'<!-- 商品价格-->'
                            +'<td width="150" align="center">'
                            +'<span class="commodit_price">￥<span>'+item.discount+'</span></span>'
                            +'</td>'
                            +'<!-- 购买数量-->'
                            +'<td width="120" align="center">'
                            +'<span class="num sub" >'
                            +'<a href="#">-</a>'
                            +'</span>'
                            +'<input type="text" value="'+item.amount+'" class="cart_txtbuynum"  >'
                            +'<span class="num add" >'
                            +'<a href="#" ">+</a>'
                            +'</span>'
                            +'</td>'
                            +'<!-- 小计-->'
                            +'<td width="150" align="center">'
                            +'<span class="commodit_price">￥<span class="subtotal">'+(item.discount*item.amount).toFixed(2)+'</span></span>'
                            +'</td>'
                            +'<!-- 删除-->'
                            +'<td width="150" align="center">'
                            +'<input type="submit" value="删除" class="commodit_del" id='+index+'>'
                            +'</td>'
                            +'</tr>';
            $("#goodTable").append(tag);
        });
    }
    

   //购物车详情代码
   //所有商品的选择框
   var checkInputs=$(".btn_box input");
   //选择全部的按钮
   var checkAllInput=$(".all_checked input");
   //购买数量
   var amounts=$(".cart_txtbuynum");
   //购买的小计
   var subTotal=$(".subtotal");
   //计算
   function getTotal(){
        var seleted = 0;
        var price=0;
        $.each(checkInputs,function(index,item){
            if(item.checked){
                seleted+= Number(amounts.eq(index).val());
                price+=Number(subTotal.eq(index).html());
            }
        });
        //插入到结构
        $("#checkedAmount").html(seleted);
        $("#totalPrice").html(price.toFixed(2));
   }
   
   //遍历所有选择框添加点击事件
   $.each(checkInputs,function(index,item){
       $(item).on("click",function(){
            checkAllInput.prop('checked',true);   
            getTotal();
            //全选了需要全选按钮选择状态
            $.each(checkInputs,function(index,item){
                if(!item.checked){
                    checkAllInput.prop('checked',false);   
                }
            });
       });
   })

   //点击全选按钮控制

   checkAllInput.on("click",function(){
        var isChecked = $(this).prop('checked');  
        $.each(checkInputs,function(index,item){
            item.checked=isChecked; 
        });   
        getTotal();
   });

   //进行加减操作
   $(".num").on("click",function(){
       //对应索引值
        var index = $(this).parent().parent().index() ;
        // console.log(index);
        var goods=getItem();
        // console.log(goods);
        //增加数量操作
        if($(this).hasClass('add')){
            //改变对应的localStorage里的数量
            goods[index]['amount']++;
        }
        //减去数量操作
        if($(this).hasClass('sub')){
            //改变对应的localStorage里的数量
            goods[index]['amount']--;
        }
        //新数组存入localStorage，并重新渲染数据
        //重新渲染数据
        $(".cart_txtbuynum").eq(index).val(goods[index]['amount']);
        $(".subtotal").eq(index).text((goods[index]['amount']*goods[index]['discount']).toFixed(2));
        //技术总数
        getTotal();
        //将arr转换成json字符串保存起来
        localStorage.setItem("goods",JSON.stringify(goods));
        
        return false;
   });
   //删除操作
   $(".commodit_del").on("click",function(){
        console.log($(this).attr("id"));
   });

   //点击去结算操作
   $(".btn_pay").on("click",function(){ 
       var order=[];
       //获取localStorage里的 goods
       var goods=getItem();
    //    console.log(goods);
       //获取所有的购物车商品
        var inputs = $(".btn_box input");
        //匹配勾选想结算时，将对应的goodslode值转存
        $.each(inputs,function (index,item) { 
            if($(this).prop('checked')){
                //存入一个订单的数组中
                order.push(goods[$(this).val()]);
            }
        });
        //将goods里加入到订单的里书本删除
        var goods = array_diff(goods,order);

        //将数据存到localStorage中
        // console.log(goods);
        localStorage.setItem("goods",JSON.stringify(goods));
        // console.log(order);
        localStorage.setItem("order",JSON.stringify(order));

        //数据处理后，跳转到下一个页面
        window.location.href="/Home/confirmOrder.php";
    });

    //去除a数组中与b数组中的值相同的元素
    function array_diff(a, b) {  
        for(var i=0;i<b.length;i++)  
        {  
          for(var j=0;j<a.length;j++)  
          {  
            if(a[j]==b[i]){  
              a.splice(j,1);  
              j=j-1;  
            }  
          }  
        }   
      return a;  
    } 
});