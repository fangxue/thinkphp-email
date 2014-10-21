<?php
class InboxAction extends BaseAction {
	
	public function index(){
		$user_id = $this->getParam('session','user_id');
    	$email_info = M("email")->where(array('receiver'=>$user_id,"is_delete"=>0))->select();
    	$count = count($email_info);
    	$page = new Page($count,15);
		 
    	$list = M("email")->where(array('receiver'=>$user_id,"is_delete"=>0))->order("sent_time DESC")->limit($page->firstRow.','.$page->listRows)->select();
    	if($list){
	    	foreach ($list as $key=>$val){
	    		$addresser_name = M("user")->where(array("id"=>$val["addresser"]))->find();
	    		$list[$key]["addresser_name"] = $addresser_name["name"];
	    		if($val["last_date"] == 1){
	    			$list[$key]["unread"] = 1;
	    		}
	    	}
    	}
		$this->assign("list",$list);
		$this->displayPage($page);
		$this->assign("title","收件箱");
    	$this->display();  	
	}
}
	
	
?>
