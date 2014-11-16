<?php
/**
* Dispatcher
* Permet de charger le controller en fonction de la requête utilisateur
**/
class Dispatcher{
	
	var $request;	// Object Reques

	/**
	* Fonction principale du dispatcher
	* Charge le controller en fonction du routing
	**/
	function __construct(){
		$this->request = new Request(); 
		Router::parse($this->request->url,$this->request); 
               
		$controller = $this->loadController();
                $action = $this->request->action;
		if($this->request->prefix){
			$action = $this->request->prefix.'_'.$action;
		}
                
                
                $par=true;
                foreach($this->request->params as $k=>$v){
                    $v=filter_var($v,FILTER_VALIDATE_INT);
                    if($v===false){
                        $par=false;
                    }
                }
                if(($this->request->action=='confirm')&&($this->request->controller=='users')){
                  $par=true ; 
                }
                if(($this->request->action=='index')&&($this->request->controller=='users')){
                  $par=true ; 
                }
                if($par===true){
                call_user_func_array(array($controller,$action),$this->request->params);   
                
                }
                else{
                    $this->error($controller->s['l_error']) ;
                }
		
               
                //modifier cette partie pour avoir un appel direct au model sans l'intermédiare du controlleur
                
                $this->aclick($this->request);
               
                if ($this->request->norend==false)
                {
                   
                $controller->render($action);    
                }
                
                
		
	}

	/**
	* Permet de générer une page d'erreur en cas de problème au niveau du routing (page inexistante)
	**/
	function error($message){
		$controller = new Controller($this->request);
		$controller->e404($message); 
	}

	/**
	* Permet de charger le controller en fonction de la requête utilisateur
	**/
	function loadController(){
                
		$name = ucfirst($this->request->controller).'Controller'; 
		$file = ROOT.DS.'controller'.DS.$name.'.php';
		if(!file_exists($file)){
			$this->error(' :~/ There isn\'t an CheaperBeer Page here. Check your url again!!'); 
		} 
                require $file; 
		$controller = new $name($this->request); 
		return $controller;  
	}
        
        function aclick($reqs){
            
            
            require_once(ROOT . DS . 'model' . DS . 'Click.php');
            $aclick = new Click();
            if(isset($_SESSION['User']->id)){
              $id=$_SESSION['User']->id;  
            }
            
        $ref='';
        $id_owner=null;
        if(isset($_SERVER['HTTP_REFERER'])){
         $ref=$_SERVER['HTTP_REFERER'];   
        }else{
            $ref='';
        }
        
        $ip=$_SERVER['REMOTE_ADDR'] ;
        if(isset($id)){
            $id_owner=$id;
        }else{
            $id_owner='01010101';
        }
            
            $g=explode('/',$ref);

            $a= explode('/',$reqs->url);
            
            $c = new stdClass();
             if(isset($g[3])&&($g[3]=='mvc')){
              
            if(isset($g[4])){$c->ref_controller=$g[4];}else{$c->ref_controller='';}
            
            if(isset($g[5])){$c->ref_action=$g[5];}else{$c->ref_action='';}
            
            
            for($i=6; $i<=11 ; $i++){
                $b='ref_param'.($i-5) ;
              if(isset($g[$i])){$c->$b=$g[$i];}else{$c->$b='';}  
            }
                 
           
       }
            $c->id_owner=$id_owner ;
            $c->referer=$ref ;
            
            $c->IP=$ip;
            
            
            if(isset($a[1])){$c->controller=$a[1];}else{$c->controller='';}
            
            if(isset($a[2])){$c->action=$a[2];}else{$c->action='';}
            
            
            for($i=3; $i<=8 ; $i++){
                $b='param'.($i-2) ;
              if(isset($a[$i])){$c->$b=$a[$i];}else{$c->$b='';}  
            }
            
            
            $c->date_locale=time();
            $c->date_gmt=time();
            
            $aclick->save($c);
        }


}