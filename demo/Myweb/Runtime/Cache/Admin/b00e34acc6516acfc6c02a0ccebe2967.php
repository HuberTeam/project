<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="/demo/Public/Admin/H-ui/lib/html5shiv.js"></script>
<script type="text/javascript" src="/demo/Public/Admin/H-ui/lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/demo/Public/Admin/H-ui/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/demo/Public/Admin/H-ui/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/demo/Public/Admin/H-ui/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/demo/Public/Admin/H-ui/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/demo/Public/Admin/H-ui/static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="/demo/Public/Admin/H-ui/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>公司列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 公司 <span class="c-gray en">&gt;</span> 公司列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius del"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a href="/demo/index.php/admin/Member/add_group_show?cid=<?php echo ($cid['cid']); ?>" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加公司分组</a>   </div>
	<div class="mt-20" id="uid">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25">	
				</th>
				<th width="100">公司组名</th>
				<th width="100">添加组成员</th>
				<th width="100">查看组成员</th>
				<th width="100">编辑</th>
			</tr>
		</thead>
		<tbody>
		<?php if($result != ''): if(is_array($result)): foreach($result as $key=>$row): ?><tr class="text-c">
				<td><input type="checkbox" value="<?php echo ($row["id"]); ?>" name="list_id[]"></td>
				<td><?php echo ($row["group_name"]); ?></td>
				<td><a href="/demo/index.php/admin/Member/show_add_group_member?cid=<?php echo ($row['cid']); ?>&gid=<?php echo ($row["id"]); ?>">添加组成员</a></td>
				<td><a href="/demo/index.php/admin/Member/show_group_member?cid=<?php echo ($row['cid']); ?>&gid=<?php echo ($row["id"]); ?>">查看组成员</a></td>
				<td class="td-manage"> <a title="编辑" href="/demo/index.php/admin/user/edit/id/<?php echo ($row["id"]); ?>" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> &nbsp;&nbsp; <a title="删除" href="javascript:;" onclick="member_del(this,<?php echo $row['id'];?>)" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
			</tr><?php endforeach; endif; ?>
			<?php else: ?>
			<tr><td colspan="4">没有数据</td></tr><?php endif; ?>
		</tbody>
	</table>
	</div><br>
	
</div>
	
<div style="margin-left:30px">
	<button class="btn btn-success alldel">全选</button><button class="btn btn-success nodel">全不选</button><button class="btn btn-success fdel">反选</button>
</div>
			<div class="btn-group" style="margin-left:800px;margin-top:-40px;>
			  <!-- <span class="btn btn-primary radius">左边按钮</span> -->
			<?php if(is_array($page)): $i = 0; $__LIST__ = $page;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="javascript:void(0)" onclick="page(<?php echo ($vo); ?>)">
			 <span class="btn btn-default radius" style="margin-left:5px"><?php echo ($vo); ?></span>
			</a><?php endforeach; endif; else: echo "" ;endif; ?>
			  <!-- <span class="btn btn-primary radius">右边按钮</span> -->
			</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/demo/Public/Admin/H-ui/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/demo/Public/Admin/H-ui/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/demo/Public/Admin/H-ui/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/demo/Public/Admin/H-ui/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/demo/Public/Admin/H-ui/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="/demo/Public/Admin/H-ui/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/demo/Public/Admin/H-ui/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">


</script> 
</body>
</html>