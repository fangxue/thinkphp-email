<?php
class RecycleAction extends BaseAction {
	
	public function index(){
		$user_id = $this->getParam('session','user_id');
    	$email_info = M("email")->where('(receiver='.$user_id.' OR addresser='.$user_id.') and is_delete=1')->select();
    	$count = count($email_info);
    	$page = new Page($count,15);
		 
    	$list = M("email")->where('(receiver='.$user_id.' OR addresser='.$user_id.') and is_delete=1')->order("sent_time DESC")->limit($page->firstRow.','.$page->listRows)->select();
    	if($list){
    		foreach ($list as $key=>$val){
    			if($val["receiver"] == $user_id){
    				$addresser_name = M("user")->where(array("id"=>$val["addresser"]))->find();
    				$list[$key]["name"] = $addresser_name["name"];
    				if($val["last_date"] == 1){
    					$list[$key]["unread"] = 1;
    				}
    			}else{
    				$list[$key]["name"] = "我";
    			}
    		
    		}
    	}
    	
		$this->assign("list",$list);
		$this->displayPage($page);
		$this->assign("title","回收站");
    	$this->display();  	
	}
	//撤销
	public function revocation(){
		$js_num = $this->getParam('post','js_num');
		$js_num = rtrim($js_num, ",");
		$js_num_array = explode(",",$js_num);
		$flag = false;
		foreach ($js_num_array as $key=>$val){
			$data["is_delete"] = 0;
			$result .= M("email")->where(array("id"=>$val))->save($data);
			if($result == '1'){
				$flag = true;
			}
		}
		if(flag == true){
			echo json_encode(array('result' => 1));exit;
		}else{
			echo json_encode(array('result' => 2));exit;
		}
	}
	//彻底删除
	public function delete(){
		$js_num = $this->getParam('post','js_num');
		$js_num = rtrim($js_num, ",");
		$js_num_array = explode(",",$js_num);
		$flag = false;
		foreach ($js_num_array as $key=>$val){
			$result = M("email")->where(array("id"=>$val))->delete();	
			if($result == 1){
				$flag = true;
			}
		}
		if(flag == true){
			echo json_encode(array('result' => 1));exit;
		}else{
			echo json_encode(array('result' => 2));exit;
		}
	}
}
	
	
?>
