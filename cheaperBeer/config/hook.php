<?php
if($this->request->prefix == 'admin'){
    
$this->layout = 'admin'; 

     if(!$this->Session->isLogged() || $this->Session->user('id') != 2){
      //  debug($this->request); die();
		$this->redirect('users/login'); 
                
	}
}
?>