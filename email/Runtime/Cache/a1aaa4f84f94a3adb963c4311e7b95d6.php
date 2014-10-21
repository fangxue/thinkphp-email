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
          


   <script type="text/javascript" charset="utf-8" src="/assets/js/ueditor/ueditor.config.js"></script>
  <script charset="utf-8"  src="/assets/js/ueditor/ueditor.all.min.js"></script>
  <script charset="utf-8"  src="/assets/js/ueditor/lang/zh-cn/zh-cn.js"></script>

  
<div id="content-main">
	<form method="post" class="form-inline" id="doc_form" enctype="multipart/form-data" action='/write/save'>

	
       <div class="col-xs-6" style="margin-bottom:5px;width:100%;margin-top:10px;" id="list">
        	<div>
          		<span style="font-size:14px;padding-top:15px;" >发件人：</span>
          		<input type="text" class="form-control input-sm" disabled id="addresser"  name="addresser" style="width:30%;" required="" value="<?php echo ($user["name"]); ?><<?php echo ($user["email"]); ?>>"> 	
        	</div>
       </div>
        <div class="col-xs-6" style="margin-bottom:5px;width:100%;margin-top:5px;" id="list">
        	<div>
          		<span style="font-size:14px;padding-top:15px;" >收件人：</span>
          		<input type="text" class="form-control input-sm" id="receiver"  name="receiver" style="width:90%;" required="" <?php if(isset($info)): ?>value="<?php echo ($info["receiver_name"]); ?>"<?php endif; ?>> 	
        	</div>
       </div>
        <div class="col-xs-6" style="margin-bottom:10px;width:100%;margin-top:5px;" id="list">
        	<div>
          		<span style="font-size:14px;padding-top:15px;" >主&nbsp;&nbsp;&nbsp;&nbsp;题：</span>
          		<input type="text" class="form-control input-sm" id="title"  name="title" style="width:90%;" required="" <?php if(isset($info)): ?>value="<?php echo ($info["title"]); ?>"<?php endif; ?>> 	
        	</div>
       </div>
      	<div class="col-xs-6" style="margin-bottom:15px;clear:both;width:100%;margin-top:10px;" id="list">
        	<div>
          	<textarea class="ckeditor" name="editor"  id="editor" style="min-height:350px;width:100%;" required=""> <?php if(isset($info)): echo ($info["content"]); endif; ?></textarea>
        	</div>
		</div>
		<div class="row" style="margin-left:10px">
        	<div class="bt-group" >
        		<input type="hidden" id="info_id" name="info_id" <?php if(isset($info)): ?>value="<?php echo ($info["id"]); ?>"<?php endif; ?>>
        		<input type="submit" class="btn btn-primary" value="发送">
        		<a class="btn btn-primary " href="javascript:;" id="preview">预览</a>
        		<a class="btn btn-primary " href="javascript:;" id="draft">存草稿</a>  
        		<a href="/" class="btn btn-primary ">取消</a>
        		<span class="red f12"></span> 
      		</div>
      	</div>
	</form>
</div>
<script type="text/javascript">
        var ue = UE.getEditor('editor');
        $("#preview").click(function() {
            
            return $EDITORUI["edui272"]._onClick();
        });
        
        $("#draft").click(function(){

        		var info_id = $("#info_id").val()
        		var receiver = $("#receiver").val()
        		var title = $("#title").val()
        		var editor = $("#editor").val()
				var myDate = new Date();
        		$.ajax({
        			type:'POST',
        			url:"/Write/saveDraft",
        			dataType : "json",
        			data:{"receiver":receiver,"title":title,"editor":editor,"info_id":info_id},
        			success: function(data) {
        				var result = data.result;
        				if(result==1){
        					$("#info_id").val(data.info_id);
        					$.Alert('邮件已于 '+myDate.getHours()+':'+myDate.getMinutes()+' 成功保存到草稿箱');
        				}else{
        					$.Alert(data.msg);
        				}
        			}
        		});
        	
        })
    </script>

        </div>
      </div>
    </div>
 <script src="/assets/js/vendor/bootstrap.js"></script>
  </body>
</html>