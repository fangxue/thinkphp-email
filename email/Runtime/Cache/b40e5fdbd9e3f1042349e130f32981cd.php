<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php echo ($title); ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="/assets/css/bootstrap.css">
    <link rel="stylesheet" href="/assets/css/main.css">
    <script src="/assets/js/vendor/jquery-1.9.1.min.js"></script>
    <script src="/assets/js/project.js"></script>
  </head>
  <body>
    <header class="navbar navbar-inverse navbar-fixed-top wj-navbar" role="banner">
      <div class="container">
        <div class="navbar-header">
          <a href="/" class="navbar-brand logo-container">Email</a>
        </div>
        <div class="navbar-text pull-right mobile-pulldown">
        	<?php echo ($current_user["name"]); ?>
          <?php if(($current_user)): ?><a href="/User/changePassword">修改密码</a>
             <a href="/Public/logout" class="">退出</a> 
          <?php else: ?>
            <a href="/Public/login" class="">登录</a><?php endif; ?>
        </div>
      </div>
    </header>

    <div class="container" id="content" >
      <div class="row">
        
          <div class="col-sm-3">
          
            <nav class="clearfix navbar-togglable" role="navigation">
                <ul class="nav">
                  <li <?php if(($current == 'write')): ?>class="active"<?php endif; ?> >
                    <a href="/Write/index">写信</a>
                  </li>
                 
                  <li <?php if(($current == 'inbox')): ?>class="active"<?php endif; ?> >
                    <a href="/Inbox/index">收件箱</a>
                  </li>
                   <li <?php if(($current == 'outbox')): ?>class="active"<?php endif; ?> >
                    <a href="/Outbox/index">发件箱</a>
                  </li>
                  <li <?php if(($current == 'draft')): ?>class="active"<?php endif; ?> >
                    <a href="/Draft/index">草稿箱</a>
                  </li>
                  <li <?php if(($current == 'recycle')): ?>class="active"<?php endif; ?> >
                    <a href="/Recycle/index">回收站</a>
                  </li>
                  <?php if(($current_user["is_admin"] == 1)): ?><li <?php if(($current == 'admin')): ?>class="active"<?php endif; ?> >
	                    <a href="/Admin/index">管理员</a>
	                  </li><?php endif; ?>
                </ul>
            </nav>
          </div>
        
        <div class="col-sm-9">
          
<script src="/assets/js/main.js"></script>
<div id="content-main">
<div class="row" style="margin-top:15px;margin-bottom:15px;">
 	<div class="col-xs-1">
      &nbsp;&nbsp;<input type="checkbox" id="js_all">
    </div>
    <div class="col-xs-1">
      <span class="btn btn-primary btn-xs add_new" id="delete">删&nbsp;&nbsp;除</span>
    </div>
    <div class="col-xs-1">
      <span class="btn btn-primary btn-xs add_new" id="read">标记为已读</span>
    </div>
     <div class="col-xs-1">
      <span class="btn btn-primary btn-xs add_new" id="unread">标记为未读</span>
    </div>
</div>

<table class="table table-hover">
  <tbody>
 	<input type="hidden" value="" id="js_num" />
 	<tr>
  		<th style="width:8%"></th>
  		<th style="width:20">收件人</th>
  		<th style="width:42%">标题</th>
  		<th style="width:20%">时间</th>
  		<th style="width:10%">操作</th>
  	</tr>
    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$in): $mod = ($i % 2 );++$i;?><tr id="tr<?php echo ($in["id"]); ?>" style="font-weight: bold">
      	<td><input type="checkbox" name="id[]" value="<?php echo ($in["id"]); ?>" id="<?php echo ($in["id"]); ?>" /></td>
        <td><?php echo ($in["receiver_name"]); ?></td>
        <td><?php echo (mb_substr($in["title"],0,20,'utf-8')); ?></td>
        <td><?php echo (date('Y-m-d H:i',$in["sent_time"])); ?></td>
        <td><a class="btn btn-default btn-xs" href="/Write/edit/id/<?php echo ($in["id"]); ?>">继续编辑</a></td>
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    <tr><td colspan="5">
    <ul class="pagination">
    <?php echo ($page); ?>
    </ul>
    </td></tr>
  </tbody>
</table>

<script>
//全选
$("#js_all").click(function(){
	var obj = $(this);
	var check_obj = $("input[name='id[]']");
	
	if (obj.prop('checked')) {
		check_obj.prop('checked', true);
	} else {
		check_obj.prop('checked', false);
	}
});
$("#delete").click(function(){
	var check_obj = $("input[name	='id[]']");
	var flag = false;
	for(i=0;i<check_obj.length;i++){
		 if(check_obj[i].checked == true){
			   flag = true;
			   break;
		  }
	}
	if(!flag){
		 $.Alert('没有选中任何邮件，请重新选择');
		 return false;
	}else{
		var num = ""
		for(i=0;i<check_obj.length;i++){
			if(check_obj[i].checked == true){
				num+= check_obj[i].value+','
			}
		}
		$("#js_num").val(num);

		var js_num = $("#js_num").val()
		$.ajax({
			type:'POST',
			url:"/Inbox/delete",
			dataType : "json",
			data:{"js_num":js_num},
			success: function(data) {
				var result = data.result;
				if(result==1){
					$.Alert('成功移动邮件到 回收站 ');
					for(i=0;i<check_obj.length;i++){
						if(check_obj[i].checked == true){
							str = check_obj[i].value
							 $("#tr"+str).remove();
						}
					}
				}else{
					$.Alert('删除 失败 ');
				}
			}
		});
	}
})
</script>

        </div>
      </div>
    </div>
 <script src="/assets/js/vendor/bootstrap.js"></script>
  </body>
</html>