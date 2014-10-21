<?php
class WriteAction extends BaseAction {

    public function index() {
    	$user = $this->getParam('session','user_info');
    	$this->assign("user",$user);
        $this->assign("title","写信");
        $this->display();
    }
    
    //邮件保存
    public function save() {
    	$info_id = $this->getParam('post','info_id');
    	$receiver = $this->getParam('post','receiver');
    	$receiver_user = M("user")->where(array("email"=>$receiver))->find();
    	$data['receiver'] = $receiver_user["id"];
    	$data['title'] = $this->getParam('post','title');
    	$data['content'] = $this->getParam('post','editor');
    	$data['addresser'] =  $this->getParam('session','user_id');
    	$data['sent_time'] = time();
    	$data['last_date'] = time();
    	$data['is_draft'] = 0;
    	if($info_id){
    		$result = M("email")->where(array("id"=>$info_id))->save($data);
    	}else{
    		$result = M("email")->add($data);
    	}
    	
		if(is_numeric($result)){
			$this->success('发送成功','/Outbox/index');
		}
    }
    
    //草稿箱
    public function saveDraft() {
    	$receiver = $this->getParam('post','receiver');
    	$title = $this->getParam('post','title');
    	$editor = $this->getParam('post','editor');
    	$info_id = $this->getParam('post','info_id');

    	$user_info = M("user")->where(array("email"=>$receiver))->find();
    	if(empty($user_info)){
    		echo json_encode(array('result' => 2,"msg"=>"没有此人"));exit;
    	}
    	
    	$data["receiver"] = $user_info["id"];
    	$data["title"] = $title;
    	$data["content"] = $editor;
    	$data['addresser'] =  $this->getParam('session','user_id');
    	$data['sent_time'] = time();
    	$data['last_date'] = 1;
    	$data['is_draft'] = 1;
	
    	if($info_id){
    		M("email")->where(array("id"=>$info_id))->save($data);
    		$result = $info_id;
    	}else{
    		$result = M("email")->add($data);
    	}
    	
		if(is_numeric($result)){
			echo json_encode(array('result' => 1,"info_id"=>$result));exit;
		}else{
			echo json_encode(array('result' => 2,"msg"=>"邮件存入草稿箱失败"));exit;
		}
    }
    
    public function edit() {
    	$id = $this->getParam('get','id');
    	if(empty($id)){
    		$this->error("参数错误");
    	}
    	$info = M("email")->where(array("id"=>$id))->find();
    
    	$receiver_name = M("user")->where(array("id"=>$info["receiver"]))->find();
    
    	$info["receiver_name"] = $receiver_name["email"];
    	$this->assign("info",$info);
    	 
    	$user = $this->getParam('session','user_info');
    	$this->assign("user",$user);
    
    	$this->assign('title', '编辑');
    	$this->display('Write:index');
    }
    
 

}
