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
<!--     <link rel="stylesheet" href="/assets/css/jquery-ui-1.10.3.custom.min.css"> -->
    <link rel="stylesheet" href="/assets/css/main.css">
    <script src="/assets/js/vendor/jquery-1.9.1.min.js"></script>
    <script src="/assets/js/project.js"></script>
<!--     <script src="/assets/js/vendor/jquery-ui-1.10.3.custom.min.js"></script>
    <script src="/assets/js/vendor/jquery.validate.js"></script>
    <script src="/assets/js/vendor/jquery-form.js"></script>  -->
  </head>
  <body>
    <header class="navbar navbar-inverse navbar-fixed-top wj-navbar" role="banner">
      <div class="container">
        <div class="navbar-header">
          <a href="/" class="navbar-brand logo-container">Email<span class="glyphicon glyphicon-home"></span></a>
        </div>
        <div class="navbar-text pull-right mobile-pulldown">
        
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
                  <li <?php if(($current == 'recycle')): ?>class="active"<?php endif; ?> >
                    <a href="/Recycle/index">回收站</a>
                  </li>
                  <li <?php if(($current == 'draft')): ?>class="active"<?php endif; ?> >
                    <a href="/Draft/index">草稿箱</a>
                  </li>
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
          		<input type="text" class="form-control input-sm" id="receiver"  name="receiver" style="width:90%;" required="" value="<?php echo ($info["receiver_name"]); ?>" > 	
        	</div>
       </div>
        <div class="col-xs-6" style="margin-bottom:10px;width:100%;margin-top:5px;" id="list">
        	<div>
          		<span style="font-size:14px;padding-top:15px;" >主&nbsp;&nbsp;&nbsp;&nbsp;题：</span>
          		<input type="text" class="form-control input-sm" id="title"  name="title" style="width:90%;" required="" value="<?php echo ($info["title"]); ?>"> 	
        	</div>
       </div>
      	<div class="col-xs-6" style="margin-bottom:15px;clear:both;width:100%;margin-top:10px;" id="list">
        	<div>
          	<textarea class="ckeditor" name="editor"  id="editor" style="min-height:350px;width:100%;" required=""><?php if(isset($info)): echo ($info["content"]); endif; ?></textarea>
        	</div>
		</div>
		<div class="row" style="margin-left:10px">
        	<div class="bt-group" >
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
        			url:"/Recycle/delete",
        			dataType : "json",
        			data:{"js_num":js_num},
        			success: function(data) {
        				var result = data.result;
        				if(result==1){
        					$.Alert('删除 成功 ');
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
<!--     <script src="/assets/js/main.js"></script>
    
    <script src="/assets/js/common.js"></script>
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-43657027-1', 'ucfgroup.com');
        ga('send', 'pageview');
        
        var _ncf={"prd":"who","pstr":"","pfunc":null,"pcon":"","pck":{"whoid":"whoid"}};

(function(p,h,s){var o=document.createElement(h);o.src=s;p.appendChild(o)})(document.getElementsByTagName("HEAD")[0],"script","http://zcs1.ncfstatic.com/js/ncfpb.1.1.min.js");
    </script> -->
    
  </body>
</html>