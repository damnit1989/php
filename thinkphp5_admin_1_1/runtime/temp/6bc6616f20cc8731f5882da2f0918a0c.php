<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:35:"./themes/default/visitor\index.html";i:1518236332;s:28:"./themes/default/layout.html";i:1518496023;}*/ ?>
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
	<script src="__JS__/jquery.min.js"></script>
<script>
$(document).ready(function(){

	$.ajax({
		type:"GET",
		url:"/index/visitor/visitorlist",
		dataType:"json",     
		success:function(data){
			<!-- console.log(data); -->
			//json字符串转换成json对象
			//var obj = eval('(' + data + ')');
			var obj = $.parseJSON(data); //由JSON字符串转换为JSON对象
			//var obj = JSON.parse(data); //由JSON字符串转换为JSON对象
			if(obj.status){
				$("#test").html(obj.msg);
			}else{
				$("#test").html("验证未通过:"+ obj.msg);
			}
		},
		error:function(jqXHR){
			$("#test").html("发生错误:"+jqXHR.status);
		}
		<!-- return false; -->
	});

});
</script>


<div class="layui-body">
    <!--tab标签-->
    <div class="layui-tab layui-tab-brief">
        <ul class="layui-tab-title">
            <li class="layui-this">访客管理</li>
            <li class=""><a href="<?php echo url('index/visitor/add'); ?>">添加</a></li>
            <li class=""><a href="<?php echo url('index/visitor/export'); ?>">导出</a></li>
            <li class=""><a href="<?php echo url('index/visitor/import'); ?>">导入</a></li>
            <!--<li class=""><a href="<?php echo url('index/member/edit'); ?>">修改</a></li>
            <li class=""><a href="<?php echo url('index/member/delete'); ?>">删除</a></li>-->
        </ul>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">

                <form class="layui-form layui-form-pane" action="<?php echo url('index/visitor/index'); ?>" method="get">
                    <div class="layui-inline">
                        <label class="layui-form-label">关键词</label>
                        <div class="layui-input-inline">
                            <input type="text" name="keyword" value="<?php echo $keyword; ?>" placeholder="请输入关键词" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <button class="layui-btn">搜索</button>
                    </div>
                </form>
                <hr>

                <table class="layui-table">
                    <thead>
                    <tr>
                        <th style="width: 30px;">ID</th>
                        <th>来访人姓名</th>
                        <th>来访人手机</th>
                        <th>来访人邮箱</th>
                        <th>被访问人姓名</th>
                        <th>被访问人电话</th>
                        <th>来访目的</th>
                        <!--<th>状态</th>-->
                        <th>来访时间</th>
						<th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "" ;else: foreach($list as $key=>$vo): ?>
                    <tr>
                        <td><?php echo $vo['id']; ?></td>
                        <td><?php echo $vo['visitor_name']; ?></td>
                        <td><?php echo $vo['visitor_phone']; ?></td>
                        <td><?php echo $vo['visitor_email']; ?></td>
                        <td><?php echo $vo['name']; ?></td>
                        <td><?php echo $vo['phone']; ?></td>
                        <td><?php echo $vo['visitor_type']; ?></td>

                        <td><?php echo $vo['create_time']; ?></td>

                        <td>
                            <a href="<?php echo url('index/visitor/edit',['id'=>$vo['id']]); ?>" class="layui-btn layui-btn-normal layui-btn-mini">编辑</a>
                            <a href="<?php echo url('index/visitor/delete',['id'=>$vo['id']]); ?>" class="layui-btn layui-btn-danger layui-btn-mini ajax-delete">删除</a>
                        </td>
                    </tr>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                    </tbody>
                </table>
                <!--分页-->
                <?php echo $list->render(); ?>
            </div>
        </div>
    </div>
</div>



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