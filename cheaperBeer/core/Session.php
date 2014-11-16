<?php 
class Session{
	
	public function __construct(){
           if((session_id()=="")){
                   // echo 'nulite';
			session_start();
                       }
	}

	public function setFlash($message,$type = 'success'){
		$_SESSION['flash'] = array(
			'message' => $message,
			'type'	=> $type
		); 
	}

	public function flash(){
		if(isset($_SESSION['flash']['message'])){
			$html = '<div id="alert" class="alert alert-'.$_SESSION['flash']['type'].'"><a class="close">x</a><p>'.$_SESSION['flash']['message'].'</p></div>'; 
			$_SESSION['flash'] = array(); 
			return $html; 
		}
	}
        public function isLoggedCompany(){
		return isset($_SESSION['Companie']->id);
	}

	public function write($key,$value){
		$_SESSION[$key] = $value;
	}
        

	public function read($key = null){
		if($key){
			if(isset($_SESSION[$key])){
				return $_SESSION[$key]; 
			}else{
				return false; 
			}
		}else{
			return $_SESSION; 
		}
	}
        public function delete($key){
		
			if(isset($_SESSION[$key])){
				unset($_SESSION[$key]); 
                                return true ;
			}else{
				return false; 
			}
		
	}

	public function isLogged(){
		return isset($_SESSION['User']->id);
	}
        
                
        public function writecookie($key,$value){
            
                 
             setcookie($key,  $value , time()+(60*60*24*365*4),'/','simplewebagency.com');
            
        }
        
        public function readcookie($key){
                        if(isset($_COOKIE[$key])){
				return $_COOKIE[$key]; 
			}else{
				return false; 
			}
        }

	public function user($key){
		if($this->read('User')){
			if(isset($this->read('User')->$key)){
				return $this->read('User')->$key; 
			} else{
				return false;
			}
		}
		return false;
	}
        
}