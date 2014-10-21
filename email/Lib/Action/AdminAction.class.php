<?php

class AdminAction extends BaseAction {

    public function index() {
    	$email_info = M("user")->select();
    	$count = count($email_info);
    	$page = new Page($count,15);
    		
    	$list =  M("user")->limit($page->firstRow.','.$page->listRows)->select();

    	$this->assign("list",$list);
    	$this->displayPage($page);
    	$this->assign("title","员工列表");
    	$this->display();;
    }
    
    public function edit() {
    	if($this->getParam('post')){
    		$data = $this->getParam('post');
    		//添加
    		if(!$this->getParam('post','id')){
    			$info['password'] = md5(123456);
    		}
    		$info['name'] = $data['name'];
    		$info['email'] = $data['email'];
    		$info['last_date'] = 1;
    		$info['update_time'] = time();
    		
    		if($data['is_admin'] == 1){
    			$info['is_admin'] = 1;
    		}

    		$uId = $this->getParam('get',"uId");
    		$this->assign("title","用户管理");
    		if($uId){
    			
    			$result = M("user")->where(array("id"=>$uId))->save($info);
    			if($result == 1){
    				$this->success("编辑用户信息成功","/Admin/index");
    			}else{
    				$this->error("编辑用户信息失败");
    			}
    		}else{
    			$result = M("user")->add($info);
    			if(is_numeric($result)){
    				$this->success("添加用户成功","/Admin/index");
    			}else{
    				$this->error("添加用户失败");
    			}
    		}
    	}else{
    		$uId = $this->getParam('get',"uId");
    		if($uId){
    			$info = M("user")->where(array("id"=>$uId))->find();
    			$this->assign("uId",$uId);
    			$this->assign("info",$info);
    		}
    		
    		$this->is_admin = array(1=>'管理员');
    		$this->assign("title","用户管理");
    		$this->display();
    	}
    
    }
    
    public function resetPassword() {
    	$uId = $this->getParam('get',"uId");
    	if(empty($uId)){
    		$this->error("参数错误");
    	}
    	$info['password'] = md5(123456);
    	$info['update_time'] = time();
    	$result = M("user")->where(array("id"=>$uId))->save($info);
    	if($result == 1){
    		$this->success("重置成功","/Admin/index");
    	}else{
    		$this->error("重置失败");
    	}
    }
    
    public function delete() {
    	$uId = $this->getParam('get',"uId");
    	if(empty($uId)){
    		$this->error("参数错误");
    	}
    
    	$result = M("user")->where(array("id"=>$uId))->delete();
    	if($result == 1){
    		$this->success("删除成功","/Admin/index");
    	}else{
    		$this->error("删除失败");
    	}
    }
    

}
