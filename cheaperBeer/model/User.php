<?php

class User extends Model{
      public function __construct(){
          parent::__construct();
          
          
          $this->lang=trim(loadLang());
          require LANG.DS.$this->lang.DS.'model_user.php';
          
          $this->validate=array(	
         
              'second_name' => array(
                           'regex' => array('rule' => '([a-zA-Z-]{2,20})',
                                             'message' => "second name n'est pas valide")
                           
                           //'empty' => $mus['email']
			
		),
              'pseudo' => array(
                           'regex' => array('rule' => '([a-zA-Z0-9€$@%#._-]{2,20})',
                                             'message' => "Invalid pseudo"),
                           'used'  => 'Le pseudo que vous avez choisi est déja utilisé',
                           'empty' => $mus['email']
			
		),

                'email' => array(
                            'regex' => array('rule' => '([a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-z]{2,4})',
                                             'message' => "L'adresse email n'est pas valide"),
                            
                            'empty' => ''
		),
                                    
                'password' => array(
                            'regex' => array('rule' => '([a-zA-Z0-9€$@%#._-]{6,50})',
                                             'message' => "Le mot de passe n'est pas valide"),
                            
                            'empty' => 'entrer un mot de passe'
		),
             /*   'conf_password' => array(
                            'regex' => array('rule' => '([a-zA-Z0-9€$@%#]{6,20})',
                                             'message' => "Le mot de passe n'est pas valide"),
                            
                            'empty' => 'entrer un mot de passe',
                    
                            'idem' => array('row' => "password" ,
                                            'message' => "Le mot de passe doit etre identique")
		),*/
              
              'captcha' => array(
                            'empty' => $mus['captcha_empty'],
                            'regex' => array('rule' => '([0-9a-zA-Z]{5,20})',
			                     'message' => $mus['captcha_invalid'])
		),
                'city' => array(
                            'empty' => $mus['captcha_empty'],
                            'regex' => array('rule' => '([^<>%$]*)',
			                     'message' => $mus['captcha_invalid'])
		),
                'region' => array(
                            'empty' => $mus['captcha_empty'],
                            'regex' => array('rule' => '([0-9a-zA-Z]{1,10})',
			                     'message' => $mus['captcha_invalid'])
		),
              'ccity' => array(
                            'empty' => $mus['captcha_empty'],
                            'regex' => array('rule' => '([^<>%$]*)',
			                     'message' => $mus['captcha_invalid'])
		),
              'contry' => array(
                            'empty' => $mus['captcha_empty'],
                            'regex' => array('rule' => '([a-zA-Z-]{1,5})',
			                     'message' => $mus['captcha_invalid'])
		),
              'idc' => array(
                            'empty' => $mus['captcha_empty'],
                            'regex' => array('rule' => '([0-9]{1,10})',
			                     'message' => $mus['captcha_invalid'])
		),
                'my_type' => array(
                            'regex' => array('rule' => '([1-2]{1,2})',
			                     'message' =>  $mus['mus_invalid_val'])
		),
              
              'lat' => array(
                            'regex' => array('rule' => '(^$|[0-9.-]+).+?([0-9.-]+)',
			                     'message' =>  $mus['mus_invalid_val'])
		),
              
              'lng' => array(
                            'regex' => array('rule' => '(^$|[0-9.-]+).+?([0-9.-]+)',
			                     'message' =>  $mus['mus_invalid_val'])
		),
              
              'my_tags' => array(
                            'regex' => array('rule' => '([^<>%$]*)',
			                     'message' =>  $mus['mus_invalid_val'])
		),
              
                'dy1' => array(
                            'regex' => array('rule' => '([0-9]{4})',
			                     'message' => "Entrer votre année de naissance")
		),
                'dm1' => array(
                            'regex' => array('rule' => '([0-9]{1,2})',
			                     'message' => "Entrer votre mois de naissance")
                ),
                'keep' => array(
                            'regex' => array('rule' => '([0-1]|)',
			                     'message' => "Entrer votre mois de naissance")
                ),
                'dd1' => array(
                            'regex' => array('rule' => '([0-9]{1,2})',
			                     'message' => "Entrer un jour")
		),
                'type_set@@1' => array(
                            'regex' => array('rule' => '([0-2])',
			                     'message' =>  $mus['mus_invalid_val'])
		),
                'type_set@@2' => array(
                            'regex' => array('rule' => '([0-2])',
			                     'message' =>  $mus['mus_invalid_val'])
		),
   
                'few_words' => array(
                            'regex' => array('rule' => '([^<>%$]*)',
			                     'message' =>  $mus['mus_invalid_val'])
		),
                'role' => array(
                            'regex' => array('rule' => '([0-4])',
			                     'message' =>  $mus['mus_invalid_val'])
		),
              
              //parti parametre
              
'new_email' => array('regex' => array('rule' =>'([0-4])' , 'message' => $mus['mus_invalid_val']), 'empty'=>''),


'filter_type' => array('regex' => array('rule' =>'([0-4]){0,10}' , 'message' => $mus['mus_invalid_val'])),

'filter_role' => array('regex' => array('rule' =>'([0-4])' , 'message' => $mus['mus_invalid_val'])),
'filter_languages' => array('regex' => array('rule' =>'(0|en|fr|de|es|ko|pt|da|ru|zn)' , 'message' => $mus['mus_invalid_val'])),
'filter_distance' => array('regex' => array('rule' =>'(-10|[0-9]{0,4})' , 'message' => $mus['mus_invalid_val']), 'empty'=>''),
'filter_contry' => array('regex' => array('rule' =>'(^$|[a-zA-Z.-]{0,20})' , 'message' => $mus['mus_invalid_val'])),
'filter_region' => array('regex' => array('rule' =>'([a-zA-Z.-]{0,20}?)' , 'message' => $mus['mus_invalid_val'])),
'filter_department' => array('regex' => array('rule' =>'(^$|[a-zA-Z.-]{0,20})' , 'message' => $mus['mus_invalid_val'])),
'filter_city' => array('regex' => array('rule' =>'(^$|[a-zA-Z.-]{0,20})' , 'message' => $mus['mus_invalid_val'])),
'filter_min_old' => array('regex' => array('rule' =>'([1-9]{2})' , 'message' => $mus['mus_invalid_val'])),
'filter_max_old' => array('regex' => array('rule' =>'([1-9]{2})' , 'message' => $mus['mus_invalid_val'])),


'filter_my_type' => array('regex' => array('rule' =>'([0-4])' , 'message' => $mus['mus_invalid_val'])),
'filter_explicit' => array('regex' => array('rule' =>'([0-4])' , 'message' => $mus['mus_invalid_val'])),
'filter_ads' => array('regex' => array('rule' =>'([0-1])' , 'message' => $mus['mus_invalid_val'])),
'filter_hidden' => array('regex' => array('rule' =>'([0-1])' , 'message' => $mus['mus_invalid_val'])),
'filter_nb_show' => array('regex' => array('rule' =>'([0-9]{0,3})' , 'message' => $mus['mus_invalid_val'])),

'lang' => array('regex' => array('rule' =>'(en|fr|es|de)' , 'message' => $mus['mus_invalid_val']), 'empty'=>'Not empty valueS'),
'noti_msg' => array('regex' => array('rule' =>'' , 'message' => $mus['mus_invalid_val']), 'empty'=>''),
'noti_visit' => array('regex' => array('rule' =>'' , 'message' => $mus['mus_invalid_val']), 'empty'=>''),
'noti_favorite' => array('regex' => array('rule' =>'' , 'message' => $mus['mus_invalid_val']), 'empty'=>''),
'noti_mut_attrac' => array('regex' => array('rule' =>'' , 'message' => $mus['mus_invalid_val']), 'empty'=>''),
'noti_ask_friend' => array('regex' => array('rule' =>'' , 'message' => $mus['mus_invalid_val']), 'empty'=>''),
'noti_friend_accepted' => array('regex' => array('rule' =>'' , 'message' => $mus['mus_invalid_val']), 'empty'=>''),
'noti_recommended' => array('regex' => array('rule' =>'' , 'message' => $mus['mus_invalid_val']), 'empty'=>''),
'noti_invit' => array('regex' => array('rule' =>'' , 'message' => $mus['mus_invalid_val']), 'empty'=>''),
'noti_publi_gep' => array('regex' => array('rule' =>'' , 'message' => $mus['mus_invalid_val']), 'empty'=>''),
'noti_important' => array('regex' => array('rule' =>'' , 'message' => $mus['mus_invalid_val']), 'empty'=>''),
'new_password' => array('regex' => array('rule' =>'' , 'message' => $mus['mus_invalid_val']), 'empty'=>''),
'conf_password2' => array('regex' => array('rule' =>'' , 'message' => $mus['mus_invalid_val']), 'empty'=>''),
            ) ;
                  
      }
      
        public function Total(){
		$res = $this->findFirst(array(
			'fields' => 'COUNT(id) as count'
			));
		return $res->count;  
	}
        
        public function UpdatePre(){
		$sql='';
                $t=time();
			$sql = "UPDATE $this->table SET `role`='2' WHERE expire<$t AND role>1 AND role<=3;";
		
		$pre = $this->db->exec($sql); 
                
                
		return $sql;
	
        }
        
        public function snuser($data){
		
		$fields =  array();
		$d = array(); 
                
		foreach($data as $k=>$v){
                        $v=htmlspecialchars($v) ;
			
				$fields[] = "$k=:$k";
				$d[":$k"] = $v; 
			
		}
		$fields[]="id=:id";
                $d[":id"]=uid();
			$sql = 'INSERT INTO users SET '.implode(',',$fields);
			 
		
		$pre = $this->db->prepare($sql); 
                
                  //  echo $sql ; die();
                $pre->execute($d);
		
                        return $d[":id"]; 
		
	}


}