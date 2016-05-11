$(function(){
    //侧边栏
    $("#left-menu li .active").parent().find("ul").slideToggle("fast");
    $("#left-menu li .nav-top-item").click(function(){
        $(this).parent().siblings().find("a").removeClass('active');
        $(this).addClass('active');

        $(this).parent().siblings().find("ul").slideUp("fast");
        $(this).next().slideToggle("fast");
        return false;
    });
    $("#left-menu li ul li a").click(function(){
        $(this).parent().siblings().find("a").removeClass('active');
        $(this).addClass('active');
    });

    // 全选
    $('.check-all').click(
        function(){
            $(this).parent().parent().parent().parent().find("input[type='checkbox']").prop('checked', $(this).is(':checked'));
            //改变选中行的背景色
            if($(this).is(':checked') == true){
                $('.tbody tr').addClass("alt-row-select");
            }else{
                $('.tbody tr').removeClass("alt-row-select");
            }
        }
    );
    //删除
    $('.delete-delete').click(function(){
        if(confirm('确认要执行删除操吗？')){
            window.location.href = $(this).next('input').val();
        }
    });

    //批量删除
    $('.delete-batch').click(function(){
        if(confirm('确认要执行批量删除操作吗？')){
            $('.batch-form').submit();
        }
    });
    //开关操作
    $('.on-off').click(function(){
        var arr = $(this).next('input').val().split('|');
        ajaxOnOff(arr[0],arr[1],arr[2],arr[3],this);
    });

    //排序
    $('.only-num').blur(function(){
        var _this = $(this);
        var id = _this.attr('data-id');
        var value = _this.val();
        var field = _this.attr('data-field');
        var model = _this.attr('data-model');
        ajaxEditField(model,field,id,value);
    });
});

/**
 * @param model 模型名称
 * @param field 要修改的字段
 * @param id 条件id
 * @param flag 标记 1显示 0隐藏
 * @param obj
 * 开关操作
 */
function  ajaxOnOff(model,field,id,flag,obj){
    $.ajax({
        url: 'Admin-'+model+'-onOff',type: 'post',data: {model:model,id:id,flag:flag,field:field},dataType: 'JSON',
        success: function (data) {
            if(data.status == 1){
                showNotification('success',data.info);
                $(obj).parent().find('.on-off').show();
                $(obj).hide();
            }else{
                showNotification('error',data.info);
            }
        }
    });
}

/**
 * 显示提示框
 * @param type
 * @param txt
 */
function showNotification(type,txt){
    if(type == 'error'){
        $('.n-'+type).find('div').html(txt);
        $('.n-'+type).slideDown(400);
    }else{
        $('.'+type).find('div').html(txt);
        $('.'+type).slideDown(400);
    }
    setTimeout(function(){
        $('.notification').slideUp(400);
    },2500);
}

/**
 * 修改某一字段
 * @param model
 * @param id
 * @param value
 * @param field
 */
function ajaxEditField(model,field,id,value){
    $.ajax({
        url: 'Admin-'+model+'-editField',type: 'post',data: {model:model,field:field,id:id,value:value},dataType: 'JSON',
        success: function (data) {
            if(data.status == 1){
                showNotification('success',data.info);
            }else{
                showNotification('error',data.info);
            }
        }
    });
}