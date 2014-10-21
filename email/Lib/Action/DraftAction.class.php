<?php

class DraftAction extends BaseAction {

    public function index() {
    	$user_id = $this->getParam('session','user_id');
    	$email_info = M("email")->where(array('addresser'=>$user_id,"is_delete"=>0,"is_draft"=>1))->select();
    	$count = count($email_info);
    	$page = new Page($count,15);
    		
    	$list = M("email")->where(array('addresser'=>$user_id,"is_delete"=>0,"is_draft"=>1))->order("sent_time DESC")->limit($page->firstRow.','.$page->listRows)->select();
    	if($list){
    		foreach ($list as $key=>$val){
    			$receiver_name = M("user")->where(array("id"=>$val["receiver"]))->find();
    			$list[$key]["receiver_name"] = $receiver_name["name"];
    		}
    	}
    	
    	$this->assign("list",$list);
    	$this->displayPage($page);
    	$this->assign("title","草稿箱");
    	$this->display();
    }

}
