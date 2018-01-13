// 监听全部上传文件按钮
$(document).on('click', '#upload-all-btn', function() {
    // 未选择文件
    if (!$('#fileup').val()) {
        $('#fileup').focus();
    }
    // 模拟点击其他可上传的文件
    else {
        $('#upload-list .upload-item-btn').each(function() {
            $(this).click();
        });
    }
});
//格式化文件大小输出
function formatFileSize(fileSize) {
    var sizeUnitArr = ['Byte', 'KB', 'MB', 'GB'];
    if (fileSize == 0) {
        return "0 B";
    }
    var i = parseInt(Math.floor(Math.log(fileSize) / Math.log(1024)));
    if (i == 0) {
        return fileSize + sizeUnitArr[i];
    }
    return (fileSize / Math.pow(1024, i)).toFixed(1) + sizeUnitArr[i];
}

//Hex 
//          file
//return    hex
            
function shaHex(file){
            var fr=new FileReader;
            var data = file.slice(0 , 8388608);//0，N需要确保和分片值相同
            fr.readAsArrayBuffer(data);
            fr.onload = function(){
                data = new Uint8Array(fr.result);
            var hex = sha1.hex(data);
            var ftype =file.type || file.name.match(/\.\w+$/) + '文件';
            var percent = undefined;
            var progress = '未开始上传';
            var uploadVal = '开始上传';
            // 计算文件大小
            size = formatFileSize(file.size);
            var input ='<input type="button" class="upload-item-btn" data-hex="'+hex+'" data-name="'+file.name+'" data-size="'+file.size+'" value="上传文件">';
            //更新到表格
            $('#upload-list').append("<tr align='center'>"
                +"<td>"+file.name+"</td>"
                // +"<td>"+ftype+"</td>"
                +"<td>"+size+"</td>"
                +"<td id="+hex+">"+progress+"</td>"
                +"<td>"+input+"</td>"
                +"</tr>");
            $('#upload-list').show();
            };                      
            };


//处理文件信息表
// 选择文件-显示文件信息
$('#fileup').change(function(e) {
    var file,   //文件对象
        size,   //大小
        percent, //上传百分比
        progress = '未开始上传',  //状态
        uploadVal = '开始上传';   //按钮文字
    //从files读取出文件信息
        for (var i = 0, j = this.files.length; i < j; ++i) {
            file = this.files[i];
            shaHex(file);
        };
});

//点击上传按钮后
//搜索对应的文件信息 然后上传
$(document).on('click', '.upload-item-btn', function() {
    var files = $('#fileup')[0].files, //获取文件列表
    name = $(this).attr('data-name'), //获取按钮对应的文件名
    size = $(this).attr('data-size'), //获取按钮对应的文件大小
    hex = $(this).attr('data-hex'),
    url = SCOPE.ajax_uploader_video_url, //上传服务器URL
    theFile;
    for (var i = 0, j = files.length; i < j; ++i) {
        //验证文件名信息 与 大小 
    if (files[i].name ===  name || files[i].size ===  size ) {
    theFile = files[i];
    break;
        }
    }
    if(!theFile){
        dialog.error('文件验证信息不正确');
    };
    ajax_uploadVideo(theFile,url,hex,0);
 });


function ajax_uploadVideo(file,url,hex,i) {
      var  name = file.name, //文件名
        size = file.size, //总大小shardSize   
        chunkSize = 8 * 1024 * 1024, // 分片大小
        chunkCount = Math.ceil(size / chunkSize); //总片数
    if (i >= chunkCount) {
        return false; //return上传结束 i >= chunkCount
    }
    // i = window.localStorage.getItem(hex + '_hex') || 0; //获取本地已上传的进度

    //构造一个表单，FormData是HTML5新增的
    var fd = new FormData();
    fd.append("size", size); //文件总大小
    //计算每一片的起始与结束位置
    var start = i * chunkSize,
        end = Math.min(size, start + chunkSize);
    var data = file.slice(start, end);
    fd.append("chunksize", data.size); //文件分块大小
    fd.append("file", data); //slice方法用于切出文件的一部分
    fd.append("hex", hex); //文件hex识别
    fd.append("name", name); //文件名
    fd.append("chunks", chunkCount); //总片数 chunks
    fd.append("chunk", i + 1); //当前是第几片 chunk
    //Ajax提交
    $.ajax({
        url: url,
        type: "POST",
        data: fd, //FormData
        async: true, //异步
        processData: false, //很重要，告诉jquery不要对form进行处理
        contentType: false, //很重要，指定为false才能形成正确的Content-Type
        success: function(result) {
            var result = eval("(" + result.replace(/\"/g, "'") + ")");
            if(result.status == 201) {
                $("#"+hex).text(result.message);
                return false;
            }
            if (result.status == 200) {
                i++;
                var num = Math.ceil(i * 100 / chunkCount);
                $("#"+hex).text(num + '%');
                ajax_uploadVideo(file,url,hex,i);
                return false;
            }
            if (result) {   //各种报错……
                $("#"+hex).text(result.message);
                return false;
            }
        }
    });
}
