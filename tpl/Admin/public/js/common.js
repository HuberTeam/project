/**
 * Add 添加按钮操作跳转指定URL
 */
$("#button-add").click(function() {
    var url = 'admin.php?c=' + SCOPE.typec + '&a=add';
    window.location.href = url;
});
/**
 * Submit form 提交表单至指定URL
 */
$("#poicms-button-submit").click(function() {
    var data = $("#poicms-form").serializeArray();
    postData = {};
    $(data).each(function(i) {
        postData[this.name] = this.value;
    });
    var save_url = 'admin.php?c=' + SCOPE.typec + '&a=add';
    var jump_url = 'admin.php?c=' + SCOPE.typec;
    // console.log(postData);
    $.post(save_url, postData, function(result) {
        if (result.status == 1) {
            return dialog.success(result.message, jump_url);
        } else if (result.status == 0) {
            return dialog.error(result.message);
        }
    }, "JSON");
});
/**
 *  Edit 
 */
$('.poicms-table #poicms-edit').on('click', function() {
    var id = $(this).attr('attr-id');
    var url = 'admin.php?c=' + SCOPE.typec + '&a=edit' + '&id=' + id;
    window.location.href = url;
});
/**
 *  toggleOperate 状态切换方法
 */
function toggleOperate(url, data) {
    $.post(url, data, function(s) {
        if (s.status == 1) {
            return dialog.success(s.message, '');
            // Skip
        } else {
            return dialog.error(s.message);
        }
    }, "JSON");
}
/**
 *  toggleStatus  快捷按钮切换状态 开启或关闭
 */
$('.poicms-table #toggleStatus').on('click', function() {
    var status = $(this).attr("attr-status");
    if (status == 0) {
        status = 1;
        $message = "开启";
    } else {
        status = 0;
        $message = "关闭";
    }
    var name = $(this).attr('attr-name');
    var url = '/admin.php?&a=setStatus',
        postData = {};
    postData['id'] = $(this).attr('attr-id');
    postData['modeltype'] = SCOPE.typec;
    postData['status'] = status;
    layer.open({
        type: 0,
        title: '请确认~',
        btn: ['yes', 'no'],
        icon: 3,
        closeBtn: 2,
        content: "是否将" + name + "切换为" + $message + "状态",
        scrollbar: true,
        yes: function() {
            // Skip
            console.log(postData);
            toggleOperate(url, postData);
        },
    });
});
/**
 *  Delete  删除操作
 */
$('.poicms-table #poicms_delete').on('click', function() {
    var name = $(this).attr('attr-name');
    var url = '/admin.php?&a=setStatus',
        postData = {};
    postData['id'] = $(this).attr('attr-id');
    postData['status'] = -1;
    postData['modeltype'] = SCOPE.typec;
    layer.open({
        type: 0,
        title: '请确认~',
        btn: ['yes', 'no'],
        icon: 3,
        closeBtn: 2,
        content: "是否将" + name + "删除",
        scrollbar: true,
        yes: function() {
            // Skip
            console.log(postData);
            toggleOperate(url, postData);
        },
    });
});
/**
 * 关标题栏提示信息
 */
$("#title").focus(function() {
    layer.tips('标题，不能为空', $(this));
});
/**
 * 颜色代码提示信息
 */
$("#title_font_color").focus(function() {
    layer.tips('推荐填写十六进制颜色码，如默认的黑色#000000', $(this));
});
/**
 * 关键字栏提示信息
 */
$("#keywords").focus(function() {
    layer.tips('关键字，不能为空', $(this));
});
/**
 * 备注栏提示信息
 */
$("#description").focus(function() {
    layer.tips('记录一些小笔记的备注，可以为空', $(this));
});
/**
 * 文章来源提示信息
 */
$("#copyfrom").focus(function() {
    layer.tips('来源，如引用自XX网，可以为空', $(this));
});
/**
 * Listorder 提示信息
 */
$(".listorder").focus(function() {
    layer.tips('排序数值只能是数字 范围0~255', $(this));
});
/**
 * Listorder 排序
 */
$('#button-listorder').on('click', function() {
    // Acquire listorder
    var data = $("#tableListOrder").serializeArray();
    postData = {};
    $(data).each(function(i) {
        if (isNaN(this.value)) {
            console.log(this.value);
            data = -1;
            return false;
        }
        if (this.value < 0 || this.value > 255) {
            console.log(this.value);
            data = -1;
            return false;
        }
        postData[this.name] = this.value;
    });
    if (data == -1) {
        return dialog.error("排序数值只能是数字 范围0~255");
        return false;
    }
    postData['modeltype'] = SCOPE.typec;
    var url = '/admin.php?&a=listorder';
    $.post(url, postData, function(result) {
        if (result.status == 1) {
            return dialog.success(result.message, result['data']['jump_url']);
        } else if (result.status == 0) {
            return dialog.error(result.message, result['data']['jump_url']);
        }
    }, "JSON");
});

/**
 * Push JS
 */
$("#poicms-push").click(function() {
    var id = $("#select-push").val();
    if (id == 0) {
        return dialog.error("请选择推荐位");
    }
    push = {};
    postData = {};
    $("input[name='pushcheck']:checked").each(function(i) {
        push[i] = $(this).val();
    });
    postData['push'] = push;
    postData['position_id'] = id;
    //console.log(postData);return;
    var url = SCOPE.push_url;
    $.post(url, postData, function(result) {
        if (result.status == 1) {
            // TODO
            return dialog.success(result.message, result['data']['jump_url']);
        }
        if (result.status == 0) {
            // TODO
            return dialog.error(result.message);
        }
    }, "json");
});