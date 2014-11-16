<?php
class Auth{
    
    function __construct($a,$request){
     //  debug($a) ; die() ;
        $aut=array();
        if(!empty($a->access)){
            $aut=$a->access;
            
            }
         if(!isset($a->Session->Read('User')->id)){
            
            if(isset($request->url)&&($request->prefix!=='admin')){
                if(!in_array($request->action,$aut )||empty($aut)){
                    require_once LANG.DS.$a->lang.DS.'auth_user.php';
                   // $a->Session->setFlash($aus['indispo'],'info');
                    header("Location: " . Router::url('users/index'));
                    die();
                } 
            }
            
        }
       }

}
?>
