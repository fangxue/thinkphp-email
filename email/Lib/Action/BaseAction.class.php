<?php
import("ORG.Util.Page");// 导入分页类

class BaseAction extends Action {

	public  $department;
	public  $position;
	
    function _initialize() {
        if ( 'public' != strtolower(MODULE_NAME)) {
            $user_id = $this->getParam('session','user_id');     	
        	if(!$user_id) {
        		redirect('/Public/login');
        	}
        }
       $this->_checkUserPri();
        $this->_setTemplate();
    }
    private function _checkUserPri(){
    	$user = $this->getParam('session','user_info');
    	if($user['is_admin']!=1 && 'admin' == strtolower(MODULE_NAME)){
    		$this->error('您没有权限查看此页面');
    	}
    }
    
    /**
     * 根据type的值来获取相应的数值
     * @param string $type 可以是'post','get','session','put','cookie','server','request','globals'
     * @param string $name 如果不为空则返回相应的数据，若为空则返回对应类型的数组数据
     * @return $value 如果不为空则返回相应的数据，若为空则返回对应类型的数组数据
     */
    protected function getParam($type,$name=""){
    	$name = (!empty($name))? $name : null;
    	if($type == 'post'){
    		$value = $this->_post($name);
    	}else if($type == 'get'){
    		$value = $this->_get($name);
    	}else if($type == 'session'){
    		$value = $this->_session($name);
    	}else if($type == 'put'){
    		$value = $this->_put($name);
    	}else if($type == 'cookie'){
    		$value = $this->_cookie($name);
    	}else if($type == 'server'){
    		$value = $this->_server($name);
    	}else if($type == 'request'){
    		$value = $this->_request($name);
    	}else if($type == 'globals'){
    		$value = $this->_globals($name);
    	}
    	return $value;
    }
    
	/**
	 * 
	 * 给模板文件公共的内容设置数据
	 * 
	 */
	private function  _setTemplate(){
		$current = "";
		SWITCH(strtolower(MODULE_NAME)){
			CASE 'user':
				$current = "user";
			BREAK;
			CASE 'inbox':
				$current = "inbox";
			BREAK;
			CASE 'outbox':
				$current = "outbox";
			BREAK;
			CASE 'write':
				$current = "write";
			BREAK;
			CASE 'recycle':
				$current = "recycle";
			BREAK;
			CASE 'draft':
				$current = "draft";
				BREAK;
			CASE 'admin':
				$current = "admin";
				BREAK;
			default:
				$current = "user";
			BREAK;
			
		}
		$user = $this->getParam('session','user_info');
		$this->assign('current',$current);
		$this->assign('current_user',$user);
	
	}	

	/**
	 * 
	 * 公用的分页格式
	 * @param Object $page
	 */
	protected function displayPage($page){
		$show = $page->show();// 分页显示输出
		$this->assign('page',$show);// 赋值分页输出
	}

}
    

	
