<?php
class IndexAction extends BaseAction {
	
	public function index()
	{
        if($this->getParam('session','user_id'))
            $this->redirect('User/profile');
        else
            $this->redirect('Public/login');
	}
}
	
	
?>
