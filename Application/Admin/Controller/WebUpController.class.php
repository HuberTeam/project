<?php
/**
 * 上传文件文件控制器
 */
namespace Admin\Controller;

class WebUpController extends CommonController
{

    // private $_uploadObj;
    // public function __construct() {

    // }

    /**
     * webuploader 上传图片 缩略图
     */
    public function ajax_uploadImages()
    {
        // 根据自己的业务调整上传路径、允许的格式、文件大小 10MB
        $res = ajax_upload('/Upload/image/thumb', image, 1024 * 1024 * 10);
        header('Content-type:application/json;charset=UTF-8');
        exit(json_encode($res));
    }

    /**
     * webuploader 上传视频
     */
    // public function ajax_uploadVideo()
    // {
    //     // 根据自己的业务调整上传路径、允许的格式、文件大小   5G
    //     $res = ajax_upload('/Upload/video', video, 1024 * 1024 * 1024 * 5);
    //     header('Content-type:application/json;charset=UTF-8');
    //     exit(json_encode($res));
    // }

    /**
     * webuploader 上传图片（KindEditor编辑器）封装
     */
    public function ajax_uploadImagesK()
    {
        // 根据自己的业务调整上传路径、允许的格式、文件大小
        $res = ajax_upload('/Upload/image/contentK', image, 1024 * 1024 * 50);
        header('Content-type:application/json;charset=UTF-8');
        if ($res && is_array($res)) {
            exit(json_encode(array('error' => 0, 'url' => $res[name])));
        } else {
            exit(json_encode(array('error' => 1, 'message' => '上传失败')));}
    }

    //uploadify只有FLASH……弃了

    // public function ajaxuploadify() {
    //     $upload = D("UploadImage");
    //     $res = $upload->imageUpload();
    //     if($res===false) {
    //         return show(0,'上传失败','');
    //     }else{
    //         return show(1,'上传成功',$res);
    //     }

    public function ajax_uploadVideo()
    {
// Make sure file is not cached (as it happens for example on iOS devices)
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");

        @set_time_limit(5 * 60);
        $checkSize = 1024 * 1024 * 1024 * 2; //允许上传的单个文件大小 单位B 默认2G
        /**
         * 验证
         */
// Get a file Hex 获得Hex  !!不是文件Hex 仅用作识别
        if (isset($_REQUEST["hex"])) {
            $fileVid = $_REQUEST["hex"];
        } else {
            return showlayer(0, '无法获得文件验证信息');
        }
// Get a file Size
        if (isset($_REQUEST["size"])) {
            $fileSize = $_REQUEST["size"];
            if ($fileSize > $checkSize) {
                return showlayer(0, '只允许上传2G大小以内的文件');
            }
        } else {
            return showlayer(0, '无法获得文件大小信息');
        }
        // p($fileVid);p($fileSize);
        // Uncomment this one to fake upload time
        // usleep(5000);
        // Settings
        // $targetDir = ini_get("upload_tmp_dir") . DIRECTORY_SEPARATOR . "plupload";
        $targetDir        = 'upload/cache/' . getLoginSessionUsername(); //临时缓存目录
        $uploadDir        = 'upload/video/' . getLoginSessionUsername(); //最终存放目录
        $cleanupTargetDir = true; // Remove old files //删除旧缓存文件
        $maxFileAge       = 6 * 60 * 60; // Temp file age in seconds //缓存最大存活时间 默认6H
        // Create target dir 创建缓存目录
        if (!file_exists($targetDir)) {
            @mkdir($targetDir);
        }
// Create target dir 创建存放目录
        if (!file_exists($uploadDir)) {
            @mkdir($uploadDir);
        }
// Get a file name 获得文件名
        if (isset($_REQUEST["name"])) {
            $fileName = $_REQUEST["name"];
        } elseif (!empty($_FILES)) {
            $fileName = $_FILES["file"]["name"];
        } else {
            $fileName = uniqid("file_");
        }
        // 文件最终地址  以Hex命名 避免重复
        $filePath   = $targetDir . DIRECTORY_SEPARATOR . $fileVid;
        $uploadPath = $uploadDir . DIRECTORY_SEPARATOR . $fileVid;
// Chunking might be enabled   获取分片设置
        $chunk  = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 1;
        $chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 1;

// Remove old temp files  打开缓存文件夹 删除旧的缓存文件
        if ($cleanupTargetDir) {
            if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
                die('无法打开缓存文件夹 100');
            }
            while (($file = readdir($dir)) !== false) {
                $tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;
                // If temp file is current file proceed to the next
                if ($tmpfilePath == "{$filePath}_{$chunk}.part" || $tmpfilePath == "{$filePath}_{$chunk}.parttmp") {
                    continue;
                }
                // Remove temp file if it is older than the max age and is not the current file
                if (preg_match('/\.(part|parttmp)$/', $file) && (@filemtime($tmpfilePath) < time() - $maxFileAge)) {
                    @unlink($tmpfilePath);
                }
            }
            closedir($dir);
        }
        // Open temp file 获取数据存放到缓存
        // // fopen函数创建临时缓存文件  wb 只写模式打开或新建一个二进制文件；只允许写数据。
        if (!$out = @fopen("{$filePath}_{$chunk}.parttmp", "wb")) {
            return showlayer(101, '无法开启文件写入流');
        }
        //获取上传的文件(分片)
        if (!empty($_FILES)) {
            if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
                return showlayer(102, '没有上传的文件');
            }
            // Read binary input stream and append it to temp file
            // fopen函数创建临时缓存文件  rb+ 读写打开一个二进制文件，只允许读写数据。
            if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) {
                return showlayer(103, '无法创建临时缓存');
            }
        } else {
            // php://input读取未处理的POST？数据
            if (!$in = @fopen("php://input", "rb")) {
                return showlayer(104, '无法创建临时缓存');
            }
        }

        while ($buff = fread($in, 4096)) {
            fwrite($out, $buff);
        }
        @fclose($out);
        @fclose($in);
        $sha1 = "{$filePath}_{$chunk}.parttmp";
        $sha1 = str_replace('/', '\\', $sha1);
        $sha1 = sha1_file($sha1);

        rename("{$filePath}_{$chunk}.parttmp", "{$filePath}_{$chunk}.part");
        if ($chunk !== $chunks) {
            return showlayer(200, '总进度' . $chunks . '/当前进度' . $chunk );
        }
        $index = 1;
        $done  = true;
        for ($index = 1; $index <= $chunks; $index++) {
            if (!file_exists("{$filePath}_{$index}.part")) {
                // $done = false;
                exit;
            }
        }

        // 所有分块上传完成后合并
        if ($done) {
            if (!$out = @fopen($uploadPath . '.mp4', "wb")) {
                return showlayer(101, '无法开启文件写入流');
            }
            if (flock($out, LOCK_EX)) {
                for ($index = 1; $index <= $chunks; $index++) {
                    if (!$in = @fopen("{$filePath}_{$index}.part", "rb")) {
                        break;
                    }
                    while ($buff = fread($in, 4096)) {
                        fwrite($out, $buff);
                    }
                    @fclose($in);
                    @unlink("{$filePath}_{$index}.part");
                }
                flock($out, LOCK_UN);
            }
            @fclose($out);
            // $sha1 = "{$uploadPath}";
            // $sha1 = str_replace('/','\\',$sha1);
            //  $sha1 = sha1_file($sha1);
            //  p($sha1);
            //添加视频信息进入数据库
            // $videoData['hex'] = $sha1;
            // D('video_s')->insert($videoData);
            return showlayer(201, $uploadPath . '.mp4');
        }
// Return Success JSON-RPC response
    }
}
