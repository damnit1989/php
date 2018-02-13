<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:53:"E:\wamp\www\thinkphp5_admin_1_1\themes\error/404.html";i:1518503859;}*/ ?>

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
	<h1>sorry！页面找不到了</h1>

    <!--底部-->
    <div class="layui-footer footer">
        <div class="layui-main">
            <p>2016-2017 &copy; <a href="https://github.com/xiayulei/open_source_bms" target="_blank">© 幂聚科技(北京)有限公司</a></p>
        </div>
    </div>
</div>

</body>
</html>
