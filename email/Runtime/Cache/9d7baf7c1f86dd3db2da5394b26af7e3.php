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
          
<div id="content-main">
<div class="row">
  <div class="col-xs-6" style="margin-bottom:15px">
    <h1>员工列表</h1>
    <a class="btn btn-primary btn-xs" href="/Admin/edit/">增加员工</a>
  </div>
</div>
<?php if(empty($list)): ?><div class="clearfix empty-box">
    没有找到符合条件的记录
  </div>
<?php else: ?>
<table class="table">
  <tbody>
  	<tr>
  		<th>姓名</th>
  		<th>邮箱</th>
  		<th>操作</th>
  	</tr>
    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$user): $mod = ($i % 2 );++$i;?><tr>
        <td><?php echo ($user["name"]); ?></td>
        <td><?php echo ($user["email"]); ?></td>
        	<td><a class="btn btn-default btn-xs" href="/Admin/edit/uId/<?php echo ($user["id"]); ?>">编辑</a>
        		<a class="btn btn-default btn-xs" href="/Admin/resetPassword/uId/<?php echo ($user["id"]); ?>">重置密码</a>
        		<a class="btn btn-default btn-xs" href="/Admin/delete/uId/<?php echo ($user["id"]); ?>">删除</a>
       	</td>
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    <tr><td colspan="3">
    <ul class="pagination">
    <?php echo ($page); ?>
    </ul>
    </td></tr>
  </tbody>
</table><?php endif; ?>


        </div>
      </div>
    </div>
 <script src="/assets/js/vendor/bootstrap.js"></script>
  </body>
</html>