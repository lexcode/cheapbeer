<?php

class ParamsController extends Controller {
     
  
      public $access = array();
   
    
    /**
     * Permet de récup la liste des catégories pour le blog
     * */
    
    function index() {
        
        $this->loadModel('User');
        $id = $this->Session->user('id');
        $rl = $this->Session->user('role');
        
        $d=array();
        //debug($_SESSION) ; die() ;
        $this->loadModel('User');
        $condition=array();
        
       
            $condition['fields']=array('email' , 'pseudo' , 'lang' ,'role' , 'noti_msg','noti_important',
                                     'noti_visit','noti_mut_attrac','noti_ask_friend','noti_invit',
                                     'noti_publi_gep','noti_comment','noti_friend_accepted',
                                     'noti_recommended','noti_favorite',
                                     'prof_comm','prof_cam','prof_view','prof_msg');
        
                                                
        $condition['conditions']=array('id'=>$id);
        $d['params']=$this->User->findFirst($condition);
        $d['filtab']=array('filter_type' , 'filter_role', 'filter_my_type','filter_explicit','filter_ads', 'filter_hidden', 'filter_nb_show',
                                      'filter_distance', 'filter_min_old',
                                      
                                      'filter_max_old',/*, 'filter_link_type', 'filter_ambiance', 'filter_relationship_statut', 'filter_orientation', 'filter_living',
                                      'filter_body_type', 'filter_hair_color', 'filter_eye_color', 'filter_ethnic', 'filter_children', 'filter_smoking', 'filter_drinking',
                                     'filter_education', 'filter_income',*/ 'filter_languages' );
        
        $this->set($d);
       
        
    }
    
    
    function notification(){
                  
                 $k=$this->Session->User('id');
                 $p=$this->Session->User('pseudo');
            
		$this->loadModel('User');
                
   if($this->request->data){
  
    $whitelist=array('kentok' , 'tokken' ,'noti_msg','noti_visit','noti_favorite','noti_mut_attrac','noti_ask_friend','noti_friend_accepted','noti_recommended','noti_invit','noti_publi_gep','noti_important' );
      if($this->User->verify($this->request->data,$whitelist,'DoN@tienne'))
    {
     $this->request->data->id = $k ;
                                $this->User->save($this->request->data);
                                $this->Session->setFlash($this->t('cpa_updatesucces')); 
				$this->redirect('params/index');
    }
    else
    {
    $this->Session->setFlash($this->t('ct_correctinfo'),'error'); 
    }
                
                }
                else{
			$this->request->data = $this->User->findFirst(array(
				'conditions' => array('id'=>$k)
                                ));
                }
                       
		
    }
    
    function privacy(){
         
        $id=$this->Session->User('id');
               
            
		$this->loadModel('User');
		if($this->request->data){
                      $whitelist=array('kentok','tokken','prof_view' , 'prof_msg' , 'prof_comm' , 'prof_cam');
                                    
                            
       if($this->User->verify($this->request->data,$whitelist,'DoN@tienne')){
           
                   // debug($this->request->data) ; die() ;
                                $this->request->data->id = $id ;
                                $this->User->save($this->request->data);
                                $this->Session->setFlash($this->t('cpa_updatesucces')); 
				$this->redirect('params/index'); 
                             }
                             else
                           {
                            $this->Session->setFlash($this->t('cpa_correctinfo'),'error');
                           }
                                
                }
                else{
			$this->request->data = $this->User->findFirst(array(
				'conditions' => array('id'=>$id),
                                'fields'=>' prof_view , prof_msg , prof_comm , prof_cam '
                                ));
                               // debug($this->request->data) ; die() ;
                        $d=array();
                $d['priv']=$this->request->data;
               
                $this->set($d);
                }
                
        
        
        
    }
    
    
    function password(){
        
        $id=$this->Session->User('id');
        
        $this->loadModel('User');
        $b=$this->User->findFirst(array('conditions' => array('id'=>$id),
                                            'fields'  => ' password ')) ;
        if($this->request->data){
            $this->loadModel('User');
            $whitelist=array('kentok' , 'tokken' ,'password','new_password','conf_password' );
            if($this->User->verify($this->request->data,$whitelist,'DoN@tienne'))
    {
    $psw=sha1($this->request->data->password) ;
            if($b->password==$psw){
                $this->loadModel('User');
                
                $this->request->data->id=$id ;
                $this->request->data->password=sha1($this->request->data->new_password) ;
                unset($this->request->data->new_password);
                unset($this->request->data->conf_password);
                $this->User->save($this->request->data);
                        $this->Session->setFlash($this->t('cpa_paswordchanged'));
                $this->redirect('params/index'); 
            }else{
                        $this->Session->setFlash($this->t('cpa_passwordincorrect'),'error');
            }
    }
    else
    {
    $this->Session->setFlash($this->t('ct_correctinfo'),'error'); 
    }

        }
        
      
        
    }
    
    function emailedit(){
        
        $id=$this->Session->User('id');
        
        $this->loadModel('User');
        $b=$this->User->findFirst(array('conditions' => array('id'=>$id),
                                            'fields'  => ' password ')) ;
        if($this->request->data){
            $this->loadModel('User');
            $whitelist=array('kentok' , 'tokken' ,'new_email','password' );
            if($this->User->verify($this->request->data,$whitelist,'DoN@tienne'))
    {
     $psw=sha1($this->request->data->password) ;
            
            if($b->password==$psw){
                $this->loadModel('User');
                
                $this->request->data->id=$id ;
                $this->request->data->email=$this->request->data->new_email ;
                unset($this->request->data->new_email);
                unset($this->request->data->password);
                $this->User->save($this->request->data);
                        $this->Session->setFlash($this->t('cpa_emailchanged'));
                $this->redirect('params/index'); 
            }else{
                        $this->Session->setFlash($this->t('cpa_passwordincorrect'));
            }
    }
    else
    {
    $this->Session->setFlash($this->t('ct_correctinfo'),'error'); 
    }
         
        }
        
        
    }
    
    function language(){
        
        $id=$this->Session->User('id');
        if($this->request->data){
            $this->loadModel('User');
           
             $whitelist=array('kentok','tokken','lang');
                
                
            if($this->User->verify($this->request->data,$whitelist,'DoN@tienne')){
            
           
                $this->loadModel('User');
                
                $this->request->data->id=$id ;
                $this->User->save($this->request->data);
                
                
                $_SESSION['User']->lang=$this->request->data->lang;
               setcookie('atttlg2819',crypter($this->request->data->lang.'.ntBjUdfZ11fOyKiFnqKu15mjz','lan9'),time()+(60*60*24*15),'/','simplewebagency.com');
                        
                
                        $this->Session->setFlash($this->t('cpa_languagechanged',$this->request->data->lang));
                $this->redirect('params/index'); 
           
            
            }else{
                        $this->Session->setFlash($this->t('cpa_correctinfo'),'error');
            }
        }else{
            $this->loadModel('User');
            $this->request->data = $this->User->findFirst(array(
				'conditions' => array('id'=>$id),
                                'fields'=>'lang'
                                ));
                    
        }
              
    }
    

    
}