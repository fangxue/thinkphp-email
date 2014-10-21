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
    <h1>修改密码</h1>
    <form class="form-horizontal" role="form"  id="myprofile" action="" method="POST"  onsubmit="return check_form()" >
      <div class="form-group">
        <label for="input-staff_num" class="col-sm-2 control-label">旧密码</label>
        <div class="col-sm-4">
        <input type="password" class="form-control" id="password" name="pass1" required="">
        </div>
      </div>
      <div class="form-group">
        <label for="input-password" class="col-sm-2 control-label">新密码</label>
        <div class="col-sm-4">
          <input type="password" class="form-control" id="password2" name="pass2" required="">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">确认密码</label>
        <div class="col-sm-4">
          <input type="password" class="form-control" id="password3" name="pass3" required="">
          <em for="password" generated="true" class="error" id="errorpass"></em>
        </div>
      </div>
      <label id="label1"></label> 
       <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
        <td class="text"><input type="hidden" name="id" id="userId" value="<?php echo ($info["id"]); ?>"/></td>
          <input type="submit" class="btn btn-primary" value="提交">
        </div>
      </div>
      
    </form>
  </div>
  <script type="text/javascript">
	function check_form(){
		var pass1 = document.getElementById("password").value;
		var pass2 = document.getElementById("password2");
		var pass3 = document.getElementById("password3").value;
		var userId = document.getElementById("userId").value;
		var errorpass = document.getElementById("errorpass");
		if(pass1 == ""){
			errorpass.innerHTML='请输入旧密码';
			return false;
		}
		if(pass2.value==""){
			errorpass.innerHTML='请输入新密码';
			return false;
		}
		if(pass3==""){
			errorpass.innerHTML='请输入确认密码';
			return false;
		}
		
		if (pass2.value != pass3){
			errorpass.innerHTML='两次密码 不一致'
			return false;
		}
		 var flag = true;
		 $.ajax({
            	url : "/public/checkPassword",
            	dataType : "json",
            	type: "post", 
            	async:false,
            	data:{uid:userId,pass2:pass2.value,pass1:pass1}, 
            	success : function(data){
            		var result = data.result;
            		if(result == 1){
            			errorpass.innerHTML = data.msg;
            			flag = false;
            		}else{
            			errorpass.innerHTML = "";
            			flag = true;
            		}
            	}
            });
		return flag;
	}
</script>  

        </div>
      </div>
    </div>
 <script src="/assets/js/vendor/bootstrap.js"></script>
  </body>
</html>