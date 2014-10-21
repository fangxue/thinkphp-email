<?php

class UserAction extends BaseAction {

    public function profile() {
    	$user_id = $this->getParam('session','user_id');
    	 
    	$list = M("email")->where(array('receiver'=>$user_id,"is_delete"=>0,"last_date"=>1))->count();
    
    	$this->assign("list",$list);
    
    	$this->assign('title', 'Email');
    
    	$this->display();
    }
    
    
    public function unread() {
    	$user_id = $this->getParam('session','user_id');
    	$email_info =  M("email")->where(array('receiver'=>$user_id,"is_delete"=>0,"last_date"=>1))->select();
    	$count = count($email_info);
    	$page = new Page($count,15);
		 
    	$list = M("email")->where(array('receiver'=>$user_id,"is_delete"=>0,"last_date"=>1))->order("sent_time DESC")->limit($page->firstRow.','.$page->listRows)->select();
    	if($list){
	    	foreach ($list as $key=>$val){
	    		$addresser_name = M("user")->where(array("id"=>$val["addresser"]))->find();
	    		$list[$key]["addresser_name"] = $addresser_name["name"];
	    	}
    	}
		$this->assign("list",$list);
		$this->displayPage($page);
		$this->assign("title","未读邮件");
    	$this->display();  	
    }
    public function changePassword() {
     if ($this->getParam('post')) {
            $data = $this->getParam('post');
            $userId = $this->getParam("session", "user_id");
            $user = M("user")->where(array("id"=>$userId))->find();
            if ($user['password'] != md5($data['pass1'])) {
                $this->error('旧密码不正确！');
            }
            $user['password'] = md5($data['pass2']);
            $user['update_time'] = time();
            $result = M("user")->where(array("id"=>$userId))->save($user);
            if ($result == 1) {
            	session('user_id',null);
            	session('user_info',null);
            	$this->success("修改密码成功，请重新登录",'/User/profile');
            } else {
                $this->error("修改密码失败");
            }
        } else {
            $userId = $this->getParam("session", "user_id");
            $user = M("user")->where(array("id"=>$userId))->find();

            $this->assign('title', "修改个人密码");
            $this->assign('info', $user);
            $this->assign('userId', $userId);
            $this->display();
        }
    }


}
