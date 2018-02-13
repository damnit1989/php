<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:36:"./themes/default/visitor\import.html";i:1518504814;s:28:"./themes/default/layout.html";i:1518496023;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>访客系统</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="stylesheet" href="__JS__/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="__CSS__/font-awesome.min.css">
    <!--CSS引用-->
    
    <link rel="stylesheet" href="__CSS__/admin.css">
    <!--[if lt IE 9]>
    <script src="__CSS__/html5shiv.min.js"></script>
    <script src="__CSS__/respond.min.js"></script>
    <![endif]-->
	<style>
		.layui-layout-admin .layui-header {
			background-color: #317E50;
		}	
	</style>
<script src="__JS__/jquery.min.js"></script>	
</head>
<body>
<div class="layui-layout layui-layout-admin">
    <!--头部-->
    <div class="layui-header header">
        <!--<a href=""><img class="logo" src="__STATIC__/images/admin_logo.png" alt=""></a>-->

        <ul class="layui-nav" style="position: absolute;top: 0;right: 20px;background: none;">
			<li class="layui-nav-item"><a href="<?php echo url('/index'); ?>">首页</a></li>
			<li class="layui-nav-item"><a href="<?php echo url('/index/visitor'); ?>">访客记录</a></li>
			<li class="layui-nav-item"><a href="<?php echo url('/index/member'); ?>">人员管理</a></li>
			<li class="layui-nav-item"><a href="<?php echo url('/index/company'); ?>">企业设置</a></li>
			<li class="layui-nav-item"><a href="<?php echo url('/index/log'); ?>">日志管理</a></li>
			<li class="layui-nav-item"><a href="<?php echo url('/index/about'); ?>">关于我们</a></li>
            <li class="layui-nav-item">
                <a href="javascript:;"><?php echo session('admin_name'); ?></a>
                <dl class="layui-nav-child"> <!-- 二级菜单 -->
                    <dd><a href="<?php echo url('index/change_password/index'); ?>">修改密码</a></dd>
                    <dd><a href="<?php echo url('index/login/logout'); ?>">退出登录</a></dd>
                </dl>
            </li>
        </ul>
    </div>



    <!--主体-->
    <!---->
	<div class="layui-body">
    <!--tab标签-->
    <div class="layui-tab layui-tab-brief">
        <ul class="layui-tab-title">
            <li class="layui-this"><a href="">导入成员</a></li>

		</ul>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <form class="layui-form form-container" action="<?php echo url('index/company/save'); ?>" method="post">


                    <div class="layui-form-item">
                        <label class="layui-form-label">上传</label>
                        <div class="layui-input-block">
                            <!--<input type="text" name="logo_url" value="" class="layui-input layui-input-inline" id="thumb">-->
                            <input type="file" name="file" class="upload_excel">
                        </div>
                    </div>					
                    <div class="layui-form-item">
                        <label class="layui-form-label">模板文件</label>
                        <div class="layui-input-block">
							<a href="/public/down/visitor.xlsx"><i style="color:red">下载模板文件</i></a>
                        </div>
                    </div>

                    <!--<div class="layui-form-item">
                        <div class="layui-input-block">
                            <button class="layui-btn" lay-submit lay-filter="*">保存</button>
                            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                        </div>
                    </div>-->
                </form>
            </div>
        </div>
    </div>
</div>


<script src="__JS__/ueditor/ueditor.config.js"></script>
<script src="__JS__/ueditor/ueditor.all.min.js"></script>


<script>
    //$(function() {
    //    var ue = UE.getEditor('content'),
    //        uploadEditor = UE.getEditor('upload-photo-btn'),
    //        photoListItem,
    //        uploadImage;
    //
    //    uploadEditor.ready(function () {
    //        uploadEditor.setDisabled();
    //        uploadEditor.hide();
    //        uploadEditor.addListener('beforeInsertImage', function (t, arg) {
    //            $.each(arg, function (index, item) {
    //                photoListItem = '<div class="photo-list"><input type="text" name="photo[]" value="' + item.src + '" class="layui-input layui-input-inline">';
    //                photoListItem += '<button type="button" class="layui-btn layui-btn-danger remove-photo-btn">移除</button></div>';
    //
    //                $('#photo-container').append(photoListItem).on('click', '.remove-photo-btn', function () {
    //                    $(this).parent('.photo-list').remove();
    //                });
    //            });
    //        });
    //    });
    //
    //    $('#upload-photo-btn').on('click', function () {
    //        uploadImage = uploadEditor.getDialog("insertimage");
    //        uploadImage.open();
    //    });
    //});
</script>


    <!--底部-->
    <div class="layui-footer footer">
        <div class="layui-main">
            <p>2016-2017 &copy; <a href="https://github.com/xiayulei/open_source_bms" target="_blank">© 幂聚科技(北京)有限公司</a></p>
        </div>
    </div>
</div>

<script>
    // 定义全局JS变量
    var GV = {
        current_controller: "admin/<?php echo (isset($controller) && ($controller !== '')?$controller:''); ?>/",
        base_url: "__STATIC__"
    };
</script>
<!--JS引用-->

<script src="__JS__/layui/lay/dest/layui.all.js"></script>
<script src="__JS__/admin.js"></script>

<!--页面JS脚本-->

</body>
</html>