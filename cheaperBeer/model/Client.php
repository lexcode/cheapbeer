<?php
class Client extends Model{
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
                'type' => array(
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
              'keep' => array(
                            'regex' => array('rule' => '([0-1]|)',
			                     'message' => "Entrer votre mois de naissance")
                ),
               
              
'lang' => array('regex' => array('rule' =>'(en|fr|es|de)' , 'message' => $mus['mus_invalid_val']), 'empty'=>'Not empty valueS'),
 ) ;
                  
      }
      
      


}
