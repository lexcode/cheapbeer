<?php 
class MediasController extends Controller{
	


        function pics($id=null){
            
            if(isset($id)){
                $id=filter_var($id,FILTER_VALIDATE_INT);
                if($id==false){
                   $this->Session->setFlash($this->t('invalid_address'),'error');
                   $this->redirect(); 
                }
            }
            
                
                
                $d=array();
		
                 if(!isset($id)){
                 $id=$this->Session->user('id'); 
                 $d['user_id'] = $id;
                  }else{
                      $d['user_id'] = $id;
                  }
                $ik=$this->Session->user('id');
                if($ik==$id){
                $d['me']=true;
            }else{
                $d['me']=false;
            }
                
                
                 $a=$this->gtAlbum($id);
                /* $alb_list=array_map('current',$a);
                 debug($alb_list);
                 
                 $this->loadModel('Media');
		        $bif = $this->Media->find(array(
			'conditions' => array('user_id' => $id,
                                               'id_alb' =>$alb_list,
                                               'archive'=>0
                                                ))); 
                        
                        debug($bif);*/
                   $d['album']=$a ;
                   foreach($a as $k=>$v){
                       if(($v->level)==7){
                           if(($v->id_owner)==$ik){
                               $v->auth=true;
                           }else{
                               $this->loadModel('Albumpriv');
                              $auth=$this->Albumpriv->find(array('conditions'=>array(
                                                             'id_req'=>$ik,
                                                              'id_albm'=>$v->id_alb ,
                                                               'id_tgt'=>$v->id_owner ,
                                                                'type'=>4)));
                              if(!empty($auth)){
                                $v->auth=true;
                              }else{
                                  $v->auth=0 ;
                              }
                           }
                       }
                       $this->loadModel('Media');
		        $d['images'][$v->id_alb] = $this->Media->find(array(
			'conditions' => array('user_id' => $id,
                                               'id_alb' =>$v->id_alb,
                                               'archive'=>0
                                                ))); 
                        
                       
                }
               // debug($d['images']);
                $this->loadModel('Media');
                
                $dmain = $this->Media->find(array(
			'conditions' => array('user_id' => $id,
                                              'role' =>'main_pics',
                                              'archive'=>0
		))); 
                if(empty($dmain)){
                            $common = $this->Media->find(array(
                        'conditions' => array('user_id' => $id,
                                              'role' =>'common_pics',
                                               'archive'=>0
		         ))); 
                            if(empty($common)){
                              $this->Session->write('pics_ok','main_pics');  
                            }else{
                                $fto_main = $this->Media->findFirst(array(
                                                    'conditions' => array('user_id' => $id,'role' =>'common_pics','archive'=>0),
                                                    'order' =>'created DESC'
                                    ));
                                
                                $dat2=new stdClass;
                                $dat2->role='main_pics';
                                $dat2->id=$fto_main->id;
                                $this->Media->save($dat2);
                                $this->Session->write('pics_ok','common_pics');
                                $this->redirect('medias/pics');
                            }
                            
                         }else{
                    $this->Session->write('pics_ok','common_pics');
                }
                
		//debug($d);
		$this->set($d); 
               
	}
        function view_pics($a,$b){
            
            $a=filter_var($a,FILTER_VALIDATE_INT);
                if($a==false){
                   $this->Session->setFlash($this->t('invalid_address'),'error');
                   $this->redirect(); 
                }
                $b=filter_var($b,FILTER_VALIDATE_INT);
                if($b==false){
                   $this->Session->setFlash($this->t('invalid_address'),'error');
                   $this->redirect(); 
                }
                
            $id=$this->Session->User('id');
            $d=array();
            $this->loadModel('Media');
            $da= $this->Media->find(array('conditions' => array('user_id' => $a, 'private' =>0,'archive'=>0))) ;
            $nb=count($da);
           // debug($nb);
           // debug($da);
           // debug($da);
            for($i=0;$i<$nb;$i++){
                $pv=$i-1;
                $nx=$i+1;
                if($i==0){ $pv=$nb-1;}
                if($i==$nb-1){ $nx=0;}
                if($da[$i]->id==$b){
                    $d['prev']=$da[$pv]->id;
                    $d['next']=$da[$nx]->id;
                    $d['thid']=$da[$i]->id;
                    $d['img_adress']=$da[$i]->file_large;
                    $dim=getimagesize(WEBROOT.DS.'img/'.$da[$i]->file_large);
                    $d['xx']=$dim[0];
                    $d['yy']=$dim[1];
                }
                
            }
            
            $d['user_id']=$a;
            $this->set($d);
            
        }
        
        function add_pics($id_alb=null){
             $this->request->norend=true;
            if(isset($id_alb)){
                $id_alb=filter_var($id_alb,FILTER_VALIDATE_INT);
                if($id_alb==false){
                   $this->Session->setFlash($this->t('invalid_address'),'error');
                   $this->redirect(); 
                }
            }
                $d=array();
            
            
                if($this->request->data){
$this->loadModel('Media');
$whitelist=array('kentok' , 'tokken');
        if($this->Media->verify($this->request->data,$whitelist,'DoN@tienne','kuhj'.$id_alb))
                     {
                        $extensions_valides = array( 'image/jpg' , 'image/jpeg' , 'image/png', 'image/gif' );
                
                $file_name=$_FILES['file']['name'];
                
                 if(isset($_FILES['file']['name'])){
                   
                 $nb_data=count($_FILES['file']['name']);
                
                 for($i=0;$i<$nb_data;$i++){
		if(!empty($_FILES['file']['name'][$i])){
                    
                    $finfo= finfo_open(FILEINFO_MIME_TYPE);
                     $extension_upload= finfo_file($finfo, $_FILES['file']['tmp_name'][$i]) ;
                    
                      if($extension_upload=='')
                               { 
                                $this->Session->setFlash($this->t('cmd_nofile')); 
                                }
                      elseif(!in_array($extension_upload,$extensions_valides))
                               { echo $extension_upload ; die();
                                $this->Session->setFlash($this->t('cmd_incorrectextension')); 
                                }
                      elseif(in_array($extension_upload,$extensions_valides)){
                            
                               $ext=explode('/',$extension_upload);
                                $pics_ok=$this->Session->read('pics_ok');
                                
                                $this->Session->write('pics_ok','common_pics');
                               
				$dir = WEBROOT.DS.'img'.DS.date('Y-m');
				if(!file_exists($dir)) mkdir($dir,0777); 
                                $n=rand(100,999).'.'.$ext[1] ;
				move_uploaded_file($_FILES['file']['tmp_name'][$i],$dir.DS.$n);
                                
                                crop( $dir.'/'.$n , $dir.'/xlarge'.$n,250,0) ;
                                crop( $dir.'/'.$n , $dir.'/sq_mini50'.$n,50,50,70) ;
                                crop( $dir.'/'.$n , $dir.'/sq_med100'.$n,100,100) ;
                                 $myimg=$this->Session->User('img');
                                if($myimg=='def.png'){
                                    $pics_ok='main_pics';
                                    $this->loadModel('User');
                                    $uimg=new stdClass();
                                    $uimg->id=$id;
                                    $uimg->img=date('Y-m').'/xlarge'.$n;
                                    $this->User->save($uimg);
                                    $this->loadModel('Media');
                                }
                                
				$this->Media->save(array(
					'name' => ($alname),
					'file' => date('Y-m').'/'.$n,
                                        
                                        'file_large' => date('Y-m').'/xlarge'.$n,
                                        'file_sq_mini' => date('Y-m').'/sq_mini50'.$n,
                                        'file_sq_med' => date('Y-m').'/sq_med100'.$n,
                                        
                                        'user_id' => $id,
                                        'id_alb' => $id_alb,
					'type' => 'img',
                                        'role' => $pics_ok,
                                        'created' => date('Y'.'-'.'m'.'-'.'d H'.':'.'i'.':'.'s') 
				));
                                
                               
                                        $this->Session->setFlash($this->t('cmd_succesuploadimg'));
                                
                                
		}}}
                $this->redirect('medias/pics');
                
                }
                     }
                     else
                     {
                      $this->Session->setFlash($this->t('ct_correctinfo'),'error'); 
                     }
                                                            
                                           }
                
              
                $d['albm']=$id_alb;
                $this->set($d);
            
        }

        
        
         function add_new_pic(){
           
            //debug($this->request->data);
             $id_alb=0;
             if($this->request->data->albumd){
                 $id_alb=$this->request->data->albumd;
             }else{
                 $id_alb=false;
             }
            
            if(isset($id_alb)){
                $id_alb=filter_var($id_alb,FILTER_VALIDATE_INT);
                if($id_alb==false){
                   $this->Session->setFlash($this->t('invalid_address'),'error');
                   $this->redirect(); 
                }
            }
                $d=array();
            
              if($this->request->data){
		$this->loadModel('Album');
              
                $id=$this->Session->user('id');
                $lg=$this->Session->user('pseudo');
                
                $a=$this->Album->findFirst(array(
				'conditions' => array('id_owner'=>$id,'id_alb'=>$id_alb)
                                ));
                if(empty($a)){
                  $this->Session->setFlash($this->t('cmd_addpicimpossible')); 
				$this->redirect(); 
                }
                $alname=$a->name ;
                
               
                    unset($this->request->data->albumd);
$this->loadModel('Media');
$whitelist=array('kentok' , 'tokken');
        if($this->Media->verify($this->request->data,$whitelist,'DoN@tienne','PO541'))
                     {
            
                        $extensions_valides = array( 'image/jpg' , 'image/jpeg' , 'image/png','image/gif' );
                
                $file_name=$_FILES['file']['name'];
                
                 if(isset($_FILES['file']['name'])){
                   
                 $nb_data=count($_FILES['file']['name']);
                
                 for($i=0;$i<$nb_data;$i++){
		if(!empty($_FILES['file']['name'][$i])){
                    
                    $finfo= finfo_open(FILEINFO_MIME_TYPE);
                     $extension_upload= finfo_file($finfo, $_FILES['file']['tmp_name'][$i]) ;
                    
                      if($extension_upload=='')
                               { 
                                $this->Session->setFlash($this->t('cmd_nofile')); 
                                }
                      elseif(!in_array($extension_upload,$extensions_valides))
                               { echo $extension_upload ; die();
                                $this->Session->setFlash($this->t('cmd_incorrectextension')); 
                                }
                      elseif(in_array($extension_upload,$extensions_valides)){
                            
                               $ext=explode('/',$extension_upload);
                                $pics_ok=$this->Session->read('pics_ok');
                                
                                $this->Session->write('pics_ok','common_pics');
				$dir = WEBROOT.DS.'img'.DS.date('Y-m');
				if(!file_exists($dir)) mkdir($dir,0777); 
                                $n=rand(100,999).'.'.$ext[1] ;
				move_uploaded_file($_FILES['file']['tmp_name'][$i],$dir.DS.$n);
                                
                                crop( $dir.'/'.$n , $dir.'/xlarge'.$n,250,0) ;
                                crop( $dir.'/'.$n , $dir.'/sq_mini50'.$n,50,50,70) ;
                                crop( $dir.'/'.$n , $dir.'/sq_med100'.$n,100,100) ;
                                
				$this->Media->save(array(
					'name' => ($alname),
					'file' => date('Y-m').'/'.$n,
                                        
                                        'file_large' => date('Y-m').'/xlarge'.$n,
                                        'file_sq_mini' => date('Y-m').'/sq_mini50'.$n,
                                        'file_sq_med' => date('Y-m').'/sq_med100'.$n,
                                        
                                        'user_id' => $id,
                                        'id_alb' => $id_alb,
					'type' => 'img',
                                        'role' => $pics_ok,
                                        'created' => date('Y'.'-'.'m'.'-'.'d H'.':'.'i'.':'.'s') 
				));
                                
                               
                                        $this->Session->setFlash($this->t('cmd_succesuploadimg'));
                                        
                                
		}}}
                $this->redirect('');
                
                }
                     }
                     else
                     {
                      $this->Session->setFlash($this->t('ct_correctinfo'),'error'); 
                     }
                                                            
                                           }
               $this->Session->setFlash($this->t('ct_correctinfo'),'error');                
               $this->redirect();
                $d['albm']=$id_alb;
             
            $this->set($d);
        }
    
        
        function pics_main($id){
            
            $id=filter_var($id,FILTER_VALIDATE_INT);
                if($id==false){
                   $this->Session->setFlash($this->t('invalid_address'),'error');
                   $this->redirect(); 
                }
                
		$this->loadModel('Media');
                $ik=$this->Session->user('id');
                $res = $this->Media->find(array(
                    'fields'=>'user_id, file_large',
                    'conditions'=> array('id'=>$id,'archive'=>0)
                )) ;
                if(($res[0]->user_id)==$ik){
                    $this->Media->primaryKey = 'user_id';
		    $dat=new stdClass;
                    $dat->role='common_pics';
                    $dat->user_id=$ik;
                    $this->Media->save($dat);
                    
                    $this->Media->primaryKey = 'id';
		    $dat2=new stdClass;
                    $dat2->role='main_pics';
                    $dat2->id=$id;
                    $this->Media->save($dat2);
                    $this->loadModel('User');
                    $dat3=new stdClass;
                    $dat3->img=$res[0]->file_large;
                    $dat3->id=$ik;
                   // debug($dat3) ; die() ;
                    $this->User->save($dat3);
                    
                        $this->Session->setFlash($this->t('cmd_mainpic'));
                
                }else{
                            $this->Session->setFlash($this->t('cmd_notinalbum'));
                }
		$this->redirect('medias/pics');
               
	}
        
        
        	function pics_delete($id){
                    
                    $id=filter_var($id,FILTER_VALIDATE_INT);
                if($id==false){
                   $this->Session->setFlash($this->t('invalid_address'),'error');
                   $this->redirect(); 
                }
                
		$this->loadModel('Media');
                $ik=$this->Session->user('id');
                $res = $this->Media->find(array(
                    'fields'=>'user_id',
                    'conditions'=> array('id'=>$id,'archive'=>0)
                )) ;
                if(($res[0]->user_id)==$ik){
		
		$this->Media->del($id);
                        $this->Session->setFlash($this->t('cmd_deletesucces'));
                }else{
                         $this->Session->setFlash($this->t('cmd_selectyoualbum'));   
                }
		$this->redirect('medias/pics');
	}
   
        
        function like_picture($idevt,$res){
            
            $idevt=filter_var($idevt,FILTER_VALIDATE_INT);
                if($idevt===false){
                   $this->Session->setFlash($this->t('invalid_address'),'error');
                   $this->redirect(); 
                }
            $res=filter_var($res,FILTER_VALIDATE_INT);
                if($res===false){
                   $this->Session->setFlash($this->t('invalid_address'),'error');
                   $this->redirect(); 
                }
            
            
             $this->loadModel('Likee');
            $id= $this->Session->User('id');
            $ok=array();
            $like=array();
            $like=array('conditions'=>array('id_owner'=>$id, 'id_entity'=>$idevt, 'entitype'=>10,'id_res'=>$res) ) ;
           
            $ok=$this->Likee->findFirst($like);
          // debug($ok) ; die() ;
            if(empty($ok)){
              $love = new stdClass() ;
              $love->id_owner=$id;
              $love->id_entity=$idevt;
              $love->entitype=10;
              $love->created=time();
              $love->modified=time();
              $love->id_res=$res;   
              
              $this->Likee->save($love)   ;
              $this->Session->setFlash($this->t('cf_likeadded')); 
              $this->redirect() ;
            }else{
               // debug($ok->read) ; die() ;
                $this->loadModel('Likee');
            if($ok->readed==0){
              $love = new stdClass() ;
              $love->id=$ok->id;
              $love->modified=time();
              $love->readed=1;   
              
              $this->Likee->save($love)   ;
                $this->Session->setFlash($this->t('cf_likeadded')); 
                $this->redirect() ;
            }elseif($ok->readed==1){
             // debug($ok) ; die() ;
              $love = new stdClass() ;
              $love->id=$ok->id;
              $love->modified=time();
              $love->readed=0;   
              
              $this->Likee->save($love)   ;
                $this->Session->setFlash($this->t('cf_likeremoved')); 
                $this->redirect() ;
            }
            }
                
               
           
            
        }
        
  
}