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
 	<?php if(($uId == 0)): ?><h1>增加用户</h1>
	<?php else: ?>
	<h1>编辑用户信息</h1><?php endif; ?>
    <form class="form-horizontal" role="form"  id="myprofile"  method="POST">
     <div class="form-group">
        <label for="input-name" class="col-sm-2 control-label">姓名 <span class="required">*</span></label>
        <div class="col-sm-4">
          <input type="text" class="form-control" id="input-name" name="name" value="<?php echo ($info["name"]); ?>" required>
        </div>
      </div>
        <div class="form-group">
        <label for="input-email" class="col-sm-2 control-label">E-mail <span class="required">*</span></label>
        <div class="col-sm-4">
          <input type="email" class="form-control" id="input-email" name="email" value="<?php echo ($info["email"]); ?>" required>
        </div>
      </div>
       <div class="form-group">
        <label for="select-is_admin" class="col-sm-2 control-label">是否为管理员</label>
        <div class="col-sm-4">
          <select id="is_admin" name="is_admin" onchange="" ondblclick="" class="form-control" ><option value="" >否</option><?php  foreach($is_admin as $key=>$val) { if(!empty($info['is_admin']) && ($info['is_admin'] == $key || in_array($key,$info['is_admin']))) { ?><option selected="selected" value="<?php echo $key ?>"><?php echo $val ?></option><?php }else { ?><option value="<?php echo $key ?>"><?php echo $val ?></option><?php } } ?></select>
          
        </div>
      </div>
      <?php if((!$info)): ?><div class="form-group">
        <label for="input-staff_num" class="col-sm-2 control-label">密码</label>
        <div class="col-sm-4">
          <input type="password" class="form-control" id="input-pass" name="pass" value="password" readonly>
        </div>
      </div><?php endif; ?>
        
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
        <td class="text"><input type="hidden" name="id" value="<?php echo ($info["id"]); ?>"/></td>
          <input type="submit" class="btn btn-primary" value="提交">
        </div>
      </div>
    </form>
  </div>

        </div>
      </div>
    </div>
 <script src="/assets/js/vendor/bootstrap.js"></script>
  </body>
</html>