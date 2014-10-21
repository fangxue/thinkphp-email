<?php
class PublicAction extends BaseAction {
    public function login() {
        if(!$this->getParam('session','user_id')) {
            $this->assign('title',"Email");
            $this->display();
        }else{
            $this->redirect('User/profile');
        }
    }

    public function logout() {
        if($this->getParam('session','user_id')){
        	session('user_id',null); // 删除user_id
        	session('user_info',null); // 删除user_info
    
            $this->redirect('Public/login');
        }else {
            $this->error('已经登出！');
        }
    }

    public function checkLogin() {
    	
    	$email = $this->getParam('post','email');
    	$email = trim($email);
    	$password = $this->getParam('post','password');

        if(empty($email)) {
            $this->error('帐号不能为空');
        }elseif (empty($password)){
            $this->error('密码不能为空');
        }
        
        $map = array();
        $map['email'] = $email;
        
        $authInfo = M('User')->where($map)->find();

        if($authInfo) {
        	//密码错误
            if($authInfo['password'] != md5($password)) {
        		$this->error('帐号或密码错误','/Public/login');
            }
            
            session('user_id',$authInfo['id']);  //设置session
            session('user_info',$authInfo);  //设置session

            $data["last_date"] = time();
            $data["update_time"] = time();
            M("user")->where('id='.$authInfo['id'])->save($data);

          
            $this->success('登录成功！','/User/profile');
           
        }else {
        	$this->error('帐号或密码错误');
        }
    }
    
    public function show(){
    	$id = $this->getParam('get','id');
    	if(empty($id)){
    		$this->error("参数错误");
    	}
    	$info = M("email")->where(array("id"=>$id))->find();
    	$addresser_name = M("user")->where(array("id"=>$info["addresser"]))->find();
    	$receiver_name = M("user")->where(array("id"=>$info["receiver"]))->find();
    
    	$info["addresser_name"] = $addresser_name["name"]." < ".$addresser_name["email"]." > ";
    	$info["receiver_name"] = $receiver_name["name"]." < ".$receiver_name["email"]." > ";
    
    	$info["content"] = html_entity_decode($info["content"]);
    	M("email")->where(array("id"=>$id))->save(array("last_date"=>time()));
    	$this->assign("info",$info);
    	$this->assign("title",$info["title"]);
    	$this->display('Public:show');
    }
    
    public function delete(){
    	$js_num = $this->getParam('post','js_num');
    	$js_num = rtrim($js_num, ",");
    	$js_num_array = explode(",",$js_num);
    	$flag = false;
    	foreach ($js_num_array as $key=>$val){
    		$data["is_delete"] = 1;
    		$result = M("email")->where(array("id"=>$val))->save($data);
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
    
    public function signRead(){
    	$js_num = $this->getParam('post','js_num');
    	$js_num = rtrim($js_num, ",");
    	
    	
    	if(!is_numeric($js_num)){
    		$js_num_array = explode(",",$js_num);
    		foreach ($js_num_array as $key=>$val){
    			$data["last_date"] = time();
    			$result = M("email")->where(array("id"=>$val))->save($data);
    		}
    			echo json_encode(array('result' => 1));exit;
    	}else{
    		$info = M("email")->where(array("id"=>$js_num))->find();
    		
    		if($info["last_date"] !== "1"){
    			echo json_encode(array('result' => 2));exit;
    		}
    		$data["last_date"] = time();
    		$result = M("email")->where(array("id"=>$js_num))->save($data);
    		echo json_encode(array('result' => 1));exit;
    		
    	}
    	
    }
    public function signUnRead(){
    	$js_num = $this->getParam('post','js_num');
    	$js_num = rtrim($js_num, ",");
    	
    	if(!is_numeric($js_num)){
    		$js_num_array = explode(",",$js_num);
    		foreach ($js_num_array as $key=>$val){
    			$data["last_date"] = 1;
    			$result = M("email")->where(array("id"=>$val))->save($data);
    		}
    		echo json_encode(array('result' => 1));exit;
    	}else{
    		$info = M("email")->where(array("id"=>$js_num))->find();
    		if($info["last_date"] == "1"){
    			echo json_encode(array('result' => 2));exit;
    		}
    		$data["last_date"] = 1;
    		$result = M("email")->where(array("id"=>$js_num))->save($data);
    		echo json_encode(array('result' => 1));exit;
    	}
    }
    public function checkPassword() {
    	$uid = $this->getParam('post','uid');
    	$pass1 = $this->getParam('post','pass1');
    	$pass2 = $this->getParam('post','pass2');
    
    	$user_info = M("user")->where(array("id"=>$uid))->find();
    	if($user_info['password'] != md5($pass1)){
    		echo json_encode(array('result' =>1,'msg'=>'旧密码不正确'));exit;
    	}
    	if(!preg_match("/^[a-zA-Z\d_]{8,15}$/",$pass2)){
    		echo json_encode(array('result' =>1,'msg'=>'密码不能少于8位，不能多于15位'));exit;
    	}else{
    		echo json_encode(array('result' =>2));exit;
    	}
    
    }
    
}