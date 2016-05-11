/**
 * Created with JetBrains PhpStorm.
 * User: Administrator
 * Date: 16-4-18
 * Time: 下午5:47
 * To change this template use File | Settings | File Templates.
 */
$(function(){
    $(".login-out").on("click",function(){
        layer.confirm('您确定要退出吗？', {
            btn: ['取消','退出'] //按钮
        },null,function(){
            window.location.href="Login-loginOut";
        });
    })
    $(".login-on").on("click",function(){
        $(this).next().toggle(500);
    })
    $("#weixinlogin").on("click",function(){
        var url=$(this).attr("data-url");
        //官网欢迎页
        layer.open({
            type: 2,
            title: '',
            shadeClose: true,
            area: ['300px', '65%'],
            content: url
        });
    })
    var a = $("#back_to_top");
    a.hide(),
    $(window).scroll(function() {
        $(window).scrollTop() > 100 ? a.fadeIn() : a.fadeOut()
    }),
    a.click(function() {
        return $("body,html").animate({
                scrollTop: 0
            },
            500),
            !1
    })
    
})