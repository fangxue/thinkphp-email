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
          <?php if(($current_user)): ?><a href="/Public/logout" class="">退出</a> 
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
                </ul>
            </nav>
          </div>
        
        <div class="col-sm-9">
          

  <div id="content-main" class="main clearfix">
 
 	
	<ul class="list-group">
	  <li class="list-group-item" style="font-size: 15px;line-height: normal;font-weight: bold;"><?php echo ($info["title"]); ?></li>
	  <li class="list-group-item">发件人：<?php echo ($info["addresser_name"]); ?></li>
	  <li class="list-group-item">收件人：<?php echo ($info["receiver_name"]); ?></li>
	  <li class="list-group-item">时间：<?php echo (date('Y-m-d H:i',$info["sent_time"])); ?></li>
	</ul>

      </div>
    <div>
      <?php echo ($info["content"]); ?>
    </div>
  </div>
<script>
$(".col-sm-3").hide();
$(".col-sm-9").css("width", "100%");
</script>

        </div>
      </div>
    </div>
 <script src="/assets/js/vendor/bootstrap.js"></script>
  </body>
</html>