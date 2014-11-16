<?php
class Request{
	

	public $url; 				// URL appellé par l'utilisateur
	public $page = 0; 			// pour la pagination 
	public $prefix = false; 	// Prefixage des urls /prefix/url
	public $data = false; 		// Données envoyé dans le formulaire
        public $norend = false;

	function __construct(){
            $req=str_replace(BASE_URL."/", "", $_SERVER['REQUEST_URI']);
            $contain_get=strpos( $req ,'?');
            if($contain_get!==false){
              $req=strstr($req,'?',true);  
            }
           
		$this->url = isset($req)?$req:'/'; 
              //debug($_SERVER) ;die();
		// Si on a une page dans l'url on la rentre dans $this->page
		if(isset($_GET['page'])){
			if(is_numeric($_GET['page'])){
				if($_GET['page'] > 0){
					$this->page = round($_GET['page']); 
				}
			}
		}
                if(!empty($_GET)){
			$this->gget = new stdClass(); 
			foreach($_GET as $k=>$v){
				$this->gget->$k=htmlspecialchars($v);
			}
		}
		// Si des données ont été postées ont les entre dans data
		if(!empty($_POST)){
			$this->data = new stdClass(); 
			foreach($_POST as $k=>$v){
				$this->data->$k=$v;
			}
		}
                
                
	}


}
?>