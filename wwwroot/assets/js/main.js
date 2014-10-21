$(function() {
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
			url:"/public/delete",
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
$("#read").click(function(){
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
			url:"/public/signRead",
			dataType : "json",
			data:{"js_num":js_num},
			success: function(data) {
				var result = data.result;
				if(result==1){
					$.Alert('成功设置邮件为已读');
					for(i=0;i<check_obj.length;i++){
						if(check_obj[i].checked == true){
							str = check_obj[i].value
							 $("#tr"+str).css("font-weight","normal");
						}
					}
				}else{
					$.Alert('选择的邮件已是需要设置的状态');
				}
			}
		});
	}
})
$("#unread").click(function(){
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
			url:"/public/signUnRead",
			dataType : "json",
			data:{"js_num":js_num},
			success: function(data) {
				var result = data.result;
				if(result==1){
					$.Alert('成功设置邮件为未读');
					for(i=0;i<check_obj.length;i++){
						if(check_obj[i].checked == true){
							str = check_obj[i].value
							$("#tr"+str).css("font-weight","bold");
						}
					}
				}else{
					$.Alert('选择的邮件已是需要设置的状态');
				}
			}
		});
	}
})
});