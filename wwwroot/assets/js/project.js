//alert弹窗
$.Alert = function(msg, callback){
	
	var html = '';
	html += '<div class="vfycode_tip">';
	html += msg;
	html += '</div>';
	$("body").append(html);
	$(".vfycode_tip").show();
	
	if (callback) {
		$(".vfycode_tip").bind("click", function(){
			callback();
			$(".vfycode_tip").remove();
		});
	} else {
		$(".vfycode_tip").bind("click", function(){
			$(".vfycode_tip").remove();
		});
	}
	// 3秒后自动关闭
	setTimeout(function(){
		if (callback) {
			callback();
		}
		$(".vfycode_tip").remove();
	}, 4000);
};

