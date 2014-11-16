<?php 

class UsersController extends Controller{
        
       public $access = array('view','client','index','drinker','company','loginer','company_info','company_login','company_edit','search', 'forgot','login','upload','sig','signup','signups','premium','cancel','logout', 'language','confirm');
	
	/**
	* Login
	**/  
       
       function drinker(){
           
       }
       
       function drinker_edit(){
           
       }
       
       function company(){
           
       }
       
       function company_login(){
          
           if($this->Session->isLoggedCompany()){
               $this->redirect('users/company_info') ;
           
               
               
           }
           
          
       }
        function going($id_company){
           $this->request->norend = true ;
           $id = $this->Session->User('id') ;
           if($this->Session->isLogged()){
               $this->LoadModel('Companie');
               
               $u=$this->Companie->findFirst(array('conditions'=>array('id'=>$id_company)));
               
               $comp= new stdClass();
               $comp->id = $id_company ;
               $comp->attendee= $u->attendee+1 ;
               $this->Companie->save($comp);
               $this->Session->setFlash('Chilling Tonight');
           $this->redirect();
               
           }else{
               $this->Session->setFlash('Sorry come back tomorrow to vote again','warning');
               $this->redirect();
               
           }  
       }
       
       function vote($id_company,$note){
           $this->request->norend = true ;
           $id = $this->Session->User('id') ;
           if($this->Session->isLogged()&&$this->hasVote($id,$id_company)){
               $this->LoadModel('User');
               
               $u=$this->User->findFirst(array('conditions'=>array('id'=>$id)));
               $this->LoadModel('Vote');
               $vote= new stdClass();
               $vote->id_company =$id_company ;
               $vote->note = $note ;
               $vote->id_user = $id ;
               $this->addNote($id_company,$note);
               $vote->company_name = $this->companyName($id_company) ;
               $this->LoadModel('Vote');
               $vote->name = $u->pseudo ;
               $vote->id_facebook= $u->facebook_id;
               $vote->lat = $u->lat ;
               $vote->lng = $u->lng ;
               $vote->city = $u->city ;
               $vote->contry = $u->contry ;
               $vote->region= $u->region;
               $vote->date= time();
               $this->Vote->save($vote);
               $this->Session->setFlash('Thanks for you vote');
           $this->redirect();
               
           }else{
               $this->Session->setFlash('Sorry come back tomorrow to vote again','warning');
               $this->redirect();
               
           }  
       }
       function addNote($id_company,$note){
           $this->LoadModel('Companie');
           $c=$this->Companie->findFirst(array('conditions'=>array('id'=>$id_company)));
           $comp = new stdClass();
           $comp->id=$id_company ;
           $nt='note'.$note ;
           $comp->$nt = ($c->$nt)+1 ;
           $num= $c->note1 + $c->note2 + $c->note3 + $c->note4 + $c->note5 ;
           $sum =  ($c->note1*1) + ($c->note2*2) + ($c->note3*3) + ($c->note4*4) + ($c->note5*5) ;
           if($num==0){$num=1;}
           $comp->rate = $sum/$num ;
           $this->Companie->save($comp);
       }
       function hasVote($id_user,$id_company){
           $this->LoadModel('Vote');
           $v=$this->Vote->findFirst(array('conditions'=>array('id_user'=>$id_user,'id_company'=>$id_company),'fields'=>'date'));
          if((($v->date)+(24*3600))>time()){
              return false;
          }else{
              return true;
          }
           
           
       }
       function companyName($id_company){
           $this->LoadModel('Companie');
           $c=$this->Companie->findFirst(array('conditions'=>array('id'=>$id_company),'fields'=>'company_name'));
           return $c->company_name ;
       }
       function company_info(){
           
           if(!$this->Session->isLoggedCompany()){
              $this->redirect() ;
           }
           $this->LoadModel('Companie');
           if($this->request->data){
               $comp = new stdClass();
               $comp = $this->request->data ;
               $comp->id=$_SESSION['Companie']->id ;
               $this->Companie->save($comp);
           }
           $d=array();
           
           $d['company']=$this->Companie->findFirst(array('id'=>$_SESSION['Companie']->id));
           //debug($d['company']);
           $this->set($d);
       }
       function company_edit(){
          // debug($this->request->data); die();
           $this->LoadModel('Companie');
          // $comp= new stdClass();
           $comp = $this->request->data ;
           unset($comp->conf_password);
           unset($comp->ccity);
           unset($comp->tokken);
           unset($comp->kentok);
           //debug($comp); die();
           $this->Companie->save($comp);
           $this->Session->setFlash('Company Added');
           $this->redirect();
       }
       
    
        function sig(){
            // ne pas renvoyer la vue appel ajax
                    $this->request->norend=true;
                   
                    
                    if(isset($_POST)&&!empty($_POST)){
                        $a=array();
                   
                        $g=array();
                        foreach($_POST as $k=>$v)
                        {
                            $tmp=$v;
                            $g[$k]=htmlspecialchars($tmp);
                        }
                        
                        if(isset($g['city'])){
                           $q=array();
                            $q['conditions']=array('city'=>$g['city']);
                            $q['order']=' population DESC '.
                            $this->loadModel('Citie');
                            $a=$this->Citie->like($q);
                        }  
                        
                        if(isset($g['latitude'])&&isset($g['longitude'])&&is_numeric($g['latitude'])&&is_numeric($g['longitude'])){
                            $lat=$g['latitude'];
                            $lng=$g['longitude'];
                            
                            $q=array();

                            $q['dist']=10;
                            $q['spread']=0.8;
                            $q['order']=' dist ASC '.
                            $this->loadModel('Citie');
                            $a=$this->Citie->near($lat,$lng,$q);

                        }
                        
                        
                        if(isset($g['email'])){
                
                            $q=array();
                            $psd=filter_var($g['email'],FILTER_VALIDATE_EMAIL) ;
                            if($psd!=false){
                             $q['fields']='email';
                            $q['conditions']=array('email'=>$psd);

                            $this->loadModel('User');
                            $u=$this->User->find($q);
                            if(!empty($u)){
                                $a[]='used';
                            }
                            }   
                        }
                        
                        
                        if(isset($g['tags'])){
                
                            $q=array();
                            $psd=$g['tags'] ;
                            if($psd!=false){
                             $q['fields']='name';
                            $q['conditions']=array('name'=>$psd);

                            $this->loadModel('Categorie');
                            $a=$this->Categorie->like($q);

                            }   
                        }
     
                    }
 
             if(isset($a)&&!empty($a)){
                
                header('Content-Type: application/json');
                echo json_encode($a, JSON_FORCE_OBJECT) ;
                   
                }
                else
                {
                   $d[]='notfound';
                   header('Content-Type: application/json');
                   echo json_encode($d, JSON_FORCE_OBJECT) ;
                
                }
        }
        
         function geo(){
         
         
            // ne pas renvoyer la vue appel ajax
                    $this->request->norend=true;
                   
                     
                     if($this->Session->isLogged()){
                         if(isset($_POST)&&!empty($_POST)){
                        $a=array();
                   
                        $g=array();
                        foreach($_POST as $k=>$v)
                        {
                            $tmp=mysql_escape_string($v);
                            $g[$k]=htmlspecialchars($tmp);
                        }
                         
                        if(isset($g['latitude'])&&isset($g['longitude'])&&is_numeric($g['latitude'])&&is_numeric($g['longitude']))
                        {
                            
                            
                            $q=array();

                            $q['dist']=10;
                            $q['spread']=0.8;
                            $q['order']=' dist ASC ';
                            $this->loadModel('Citie');
                            
                            $a=$this->Citie->near($g['latitude'],$g['longitude'],$q);
                            $save_geo=new stdClass();
                                
                            $save_geo->lng =$g['longitude'];  
                            $save_geo->lat =$g['latitude'];
                                
                             if(isset($a)&&!empty($a)){
                                 
                                if(($g['latitude']=="")||!isset($g['latitude'])){
                                  $save_geo->lat = $a[0]->latitude ;  
                                }
                                if(($g['longitude']=="")||!isset($g['longitude'])){
                                  $save_geo->lng = $a[0]->longitude ;
                                }
                                
                                
                                $save_geo->city = $a[0]->accity ;
                                $save_geo->region = $a[0]->region ;
                                $save_geo->contry = strtoupper($a[0]->contry) ;
                                }
                            $save_geo->id=$this->Session->User('id');
                            $this->loadModel('User');
                            $this->User->save($save_geo);
                            
                            $this->loadModel('Localisation');
                            unset($save_geo->id);
                            $save_geo->time=time();
                            $save_geo->user_id=$this->Session->User('id');
                            $this->Localisation->save($save_geo);
                                
                                $_SESSION['User']->lat=$save_geo->lat ;
                                $_SESSION['User']->lng=$save_geo->lng  ;
                                $_SESSION['User']->city=$save_geo->city ;
                                $_SESSION['User']->region=$save_geo->region  ;
                                $_SESSION['User']->contry=$save_geo->contry ;
                        }
                        
                        
                   
     
                    }
 
             if(isset($a)&&!empty($a)){
                $d['ok']='save ok';
                header('Content-Type: application/json');
                echo json_encode($d, JSON_FORCE_OBJECT) ;
                   
                }
                else
                {
                   $d[]='notfound';
                   header('Content-Type: application/json');
                   echo json_encode($d, JSON_FORCE_OBJECT) ;
                
                    }
                    
                }else{
                   $d[]='login first';
                   header('Content-Type: application/json');
                   echo json_encode($d, JSON_FORCE_OBJECT) ;
                 
                }
        }
        function index(){
          //  debug($_SESSION); 
            $d=array();
            $day = date('w');
            if($day==0){
                $beerF='SU_beer as beer, SU_price as price';
            }
            if($day==1){
                 $beerF='MO_beer as beer, MO_price as price';
            }
            if($day==2){
                 $beerF='TU_beer as beer, TU_price as price';
            }
            if($day==3){
                 $beerF='WE_beer as beer, WE_price as price';
            }
            if($day==4){
                 $beerF='TH_beer as beer, TH_price as price';
            }
            if($day==5){
                 $beerF='FR_beer as beer, FR_price as price';
            }
            if($day==6){
                 $beerF='SA_beer as beer, SA_price as price';
            }
            $this->loadModel('Companie');
            $d['beer_of_day']=$this->Companie->find(array('fields'=>'id, company_name ,attendee , city , lat, lng, region, contry , rate ,'.$beerF.' , MO_beer, MO_price, TU_beer, TU_price, WE_beer, WE_price, TH_beer, TH_price, FR_beer, FR_price, SA_beer, SA_price, SU_beer, SU_price ','order'=>'price ASC'));
          //debug($d); die();
            $this->set($d);
            
        }
   
        function confirm($data,$key){
            
            if(isset($data)&&isset($key)&&(strlen($key)==40)){
            $data=decrypter($data);
            $data=explode('==',$data);
            $em=filter_var($data[0],FILTER_VALIDATE_EMAIL);
            if($em){
              
                $this->loadModel('Confirme');
            $t=time();
            $ip=ip2long($_SERVER['REMOTE_ADDR']);
            
            $conf_user=array('fields'=>'id , id_user, grt','conditions'=>"email='$em' AND tokken='$key' AND created<$t AND expire>$t AND grt=0 AND ip=$ip ") ;
            //debug($conf_user); die();
            $nuser=$this->Confirme->findFirst($conf_user) ;   
            if(isset($nuser)&&!empty($nuser)){
                $nuser->grt=1;
                $this->Confirme->save($nuser) ; 
                $nuser->id=$nuser->id_user;
                unset($nuser->id_user);
                $this->loadModel('User');
                $this->User->save($nuser) ;
             
                //$pseudo=$this->gett(1,$nuser->id);
                
                $data2=array('email'=>$em,'pseudo'=>$pseudo);
                
                $this->notificate('welcome',$em, $data2);
                $this->Session->setFlash($this->t('welcome_success'));
                $this->redirect('users/login');
            }else{
                
                $this->Session->setFlash($this->t('welcome_failed'),'error');
                $this->redirect('users/login');
            }
            }
            
            }else{
                $this->Session->setFlash($this->t('activation_failed'));
                $this->redirect('users/login');
            }
            
        }
       
      
        function forgot(){
            
            if(isset($this->request->data->email)){
                $whitelist=array('kentok' , 'tokken' ,'email' );
                if($this->User->verify($this->request->data,$whitelist,'DoN@tienne'))
    {
     $email=htmlspecialchars($this->request->data->email);
                $email=filter_var($email,FILTER_VALIDATE_EMAIL);
                
                if($email){
                    $q=array();
                $q['fields']='email';
                $q['conditions']=array('email'=>$email);
                
                $this->loadModel('User');
                $a=$this->User->findFirst($q);
                if(isset($a)&&!empty($a)){
                    
                  //creation d'un tokken d'inscription
                                $this->loadModel('Confirme');
                                $conf=new stdClass();
                                $conf->tokken = sha1(random(30)) ;
                                $conf->email = $email ;
                                $conf->id_user = 10 ;
                                $conf->ip = ip2long($_SERVER['REMOTE_ADDR']) ;
                                $conf->created = time();
                                $conf->expire=time()+3600;
                                $conf->grt=4;
                                //debug($conf);die();
                                $this->Confirme->save($conf);
                                
                                 
                               $data=array('key'=>$conf->tokken);
                                $this->notificate('forgot',$email,$data);
                $this->Session->setFlash($this->t('redefine_email'));
                $this->redirect('users/login');
                }
                else
                {
                  $this->Session->setFlash($this->t('invalid_email'),'error');
                $this->redirect('users/forgot');
                }
                }
                else
                {
                  $this->Session->setFlash($this->t('enter_email'),'error');
                $this->redirect('users/forgot');
                }
    }
    else
    {
    $this->Session->setFlash($this->t('ct_correctinfo'),'error'); 
    }
                                                            
                                           
               
                
            }
        }
        
        function language($tr=null){
            $tr=filter_var($tr,FILTER_VALIDATE_INT,array('min_range'=>0,'max_range'=>10));
            $lg=array('en','fr','de','es','pt','it','ja','hi','ko','zh','ru') ;
                    if(isset($tr)&&in_array($lg[$tr],$lg)){
                        
                        setcookie('atttlg2819',crypter($lg[$tr].'.ntBjUdfZ11fOyKiFnqKu15mjz','lan9'),time()+(60*60*24*15),'/');
                        if(!isset($_SESSION['User'])||empty($_SESSION['User'])){
                           $_SESSION['User'] = new stdClass();
                            $_SESSION['User']->lang=$lg[$tr] ; 
                        }else{
                            $_SESSION['User']->lang=$lg[$tr] ; 
                        }
                        
                         
                         //echo $tr ; die();
                         $this->redirect($this->previous());
                    }else{
                        return false ;
                    }
            
        }

/*
 * function login 
 * $user=$client
 * 
 */       
        
  function loginer(){
       $this->request->norend = true ;//nrt debug($this->request->data); die();
        $d=array();
      
                if($this->request->data){
                        $this->loadModel('Companie');
                        
                        
                        $data = new stdClass();
			$data = $this->request->data;
			//$data->password = hash('whirlpool','kaK@t0utb3t'.$data->password); 
			 
			$user = $this->Companie->findFirst(array('conditions' => array('email' => $data->email, 'password' => $data->password )));

			if(!empty($user)){
                            
                        //    session_regenerate_id();
                                //debug($user) ; die() ;
                                setcookie('swatlg2819',crypter($user->lang.'.ntBjUdfZ11fOyKiFnqKu15mjz','lan9'),time()+(60*60*24*15),'/','simplewebagency.com');
                                setcookie('swatvt3829',crypter($user->email,'3ma1l'),time()+(60*60*24*15),'/','simplewebagency.com');
                                
                                if($data->keep==1){
                                    $auth= sha1('bhd_f78#'.$user->password.'754QQ'.$user->email.'ffd--bd'.$_SERVER['REMOTE_ADDR']).'.'.$user->id;
                                    setcookie('swatkp4839',$auth,time()+(60*60*24*7),'/','simplewebagency.com',false,true);
                                    
                                    }
                                unset($user->password);
                               
				$_SESSION['Companie']=$user; 
                                //debug($_SESSION) ; die() ;
                                
                               
                               
                   }else{
                     $this->Session->setFlash($this->t('error_pwd_login'),'error');  
                   }
			$this->request->data->password = ''; 
                        unset($this->request->data->password);
    
                        $this->redirect('users/company_info');
		}
                
                if(isset($_COOKIE['swavt3829']) && isset($_COOKIE['swatkp4839']) && empty($_SESSION['Company']->id)){
                 
                    $auth=explode('.',$_COOKIE['swatkp4839']);
                   if(count($auth)==2){
                    $this->loadModel('Companie'); 
                   // attention si un utilisateur enregistre sur forme de cookie une adresse d'un utilisateur , il 
                   //s'introduire a son insus
                   $user = $this->Companie->findFirst(array('conditions' => array('id' => $auth[1])));
                  
                 //  debug($user) ; die() ;
                   if(!empty($user)){
                    $key= sha1('bhd_f78#'.$user->password.'754QQ'.$user->email.'ffd--bd'.$_SERVER['REMOTE_ADDR']) ;
                //  unset($user->password);
                   if($key==$auth[0]){
                   unset($user->password);
                   
                   $this->Session->write('Companie',$user); 
                   
                  }     
                   }
                   }
                   $this->redirect('users/company_info');
                   }
                
            
  }
        
  function login(){
                $d=array();
                if($this->request->data){
                        $this->loadModel('Client');
                        $whitelist=array('kentok' , 'tokken' ,'email','password','keep' );
                        $verify1 = $this->Client->verify($this->request->data,$whitelist,'DoN@ti','karate');
                                if($verify1==false){
                           $verify1 = $this->Client->verify($this->request->data,$whitelist,'DoN@ti','karate2');
                                }
                        if($verify1){ 
                            
                        $data = new stdClass();
			$data = $this->request->data;
			//$data->password = hash('whirlpool','kaK@t0utb3t'.$data->password); 
			 
			$user = $this->Client->findFirst(array('fields'     => 'id, pseudo , email , password ,expense, lang , created, city,contry',
                                                             'conditions' => array('email' => $data->email, 'password' => $data->password )));

			if(!empty($user)){
                            
                        //    session_regenerate_id();
                                //debug($user) ; die() ;
                                setcookie('swatlg2819',crypter($user->lang.'.ntBjUdfZ11fOyKiFnqKu15mjz','lan9'),time()+(60*60*24*15),'/','simplewebagency.com');
                                setcookie('swatvt3829',crypter($user->email,'3ma1l'),time()+(60*60*24*15),'/','simplewebagency.com');
                                
                                if($data->keep==1){
                                    $auth= sha1('bhd_f78#'.$user->password.'754QQ'.$user->email.'ffd--bd'.$_SERVER['REMOTE_ADDR']).'.'.$user->id;
                                    setcookie('swatkp4839',$auth,time()+(60*60*24*7),'/','simplewebagency.com',false,true);
                                    
                                    }
                                unset($user->password);
                               
				$_SESSION['User']=$user; 
                                //debug($_SESSION) ; die() ;
                                
                                if($this->Session->isLogged()){
			if($this->Session->user('id') == 2){
                            
				$this->redirect('bwabrille');
			}else{
				$this->redirect('');
			}
                        }
                               
                   }else{
                     $this->Session->setFlash($this->t('error_pwd_login'),'error');  
                   }
			$this->request->data->password = ''; 
                        unset($this->request->data->password);
    }
    else
    {
    $this->Session->setFlash($this->t('ct_correctinfo'),'error'); 
    }
                        
		}
                
                if(isset($_COOKIE['swavt3829']) && isset($_COOKIE['swatkp4839']) && empty($_SESSION['User']->id)){
                 
                    $auth=explode('.',$_COOKIE['swatkp4839']);
                   if(count($auth)==2){
                    $this->loadModel('User'); 
                   // attention si un utilisateur enregistre sur forme de cookie une adresse d'un utilisateur , il 
                   //s'introduire a son insus
                   $user = $this->User->findFirst(array('fields'     => 'id, pseudo , email , password ,expense, lang , created, city,contry',
                                                        'conditions' => array('id' => $auth[1])));
                  
                 //  debug($user) ; die() ;
                   if(!empty($user)){
                    $key= sha1('bhd_f78#'.$user->password.'754QQ'.$user->email.'ffd--bd'.$_SERVER['REMOTE_ADDR']) ;
                //  unset($user->password);
                   if($key==$auth[0]){
                   unset($user->password);
                   
                   $this->Session->write('User',$user); 
                   if($this->Session->isLogged()){
			if($this->Session->user('id') == 2){
				$this->redirect('bwabrille');
			}else{
				$this->redirect('');
			}
		}
                  }     
                   }
                   }
                   }
                
            
        }
        
        function get_promo($promo){
            if(isset($promo)){//tofilt
                $this->loadModel('Promo');
                $discount=$this->Promo->findFirst(array('conditions'=>array('code'=>$promo)));
                if(!empty($discount)){
                  $delay=   $discount->date + 24*3600*($discount->delay);
                  if($delay<=time()){
                     return $discount->rate; 
                  }else{
                      return 0 ;
                  }
                      
                }
                return 0 ;
            }
            return 0 ;
        }
        
    private function server_price($rd){
               $j=0;
               $price_server=0;
               
           for($i=0;$i<10;$i++){
                $art='article'.$i;
                $this->loadModel('Article');
                $product=$this->Article->find();
              
                if(isset($rd->$art)&& ($rd->$art>0)){
                    $qt= $rd->$art;
                    $price_server+= $qt*$product[$i]->price ;
                    $j++;
                }
                }
            return $price_server ;
                         }
                         
       
                function signup(){
                    
                    $price_total=0;
                    if(isset($this->request->data)){
                        $id_client= $this->Session->User('id');
                        
                        //debug($id_client) ; die() ;
                        if($id_client==''||!isset($id_client)){
                       $this->loadModel('Client');
                       $client = new stdClass();
                       $client->email= $this->request->data->email;
                       $client->password = random(18) ;
                       isset($this->request->data->website)?$client->website=$this->request->data->website:$client->website="";
                       
                       $client->created=time();
                       $this->Session->write('email_temp',$client->email); 
                       //$this->notificate('welcome',$client->email);
                       $this->Client->save($client); 
                       $id_client= $this->Client->id;
                        }
                       
                       
                       
                       $job= new stdClass();
                       $price_total= $this->server_price($this->request->data);
                       $job->price=$price_total ;
                       $job->title= $this->request->data->title ;
                       $job->nb_item= $this->request->data->nb_item ;
                       $job->id_client=$id_client ;
                       //verfy promotion
                       if(isset($this->request->data->promo)){
                        $promotion= $this->request->data->promo ;
                        $discount=$this->get_promo($promotion);
                       if($discount>0 && $discount<=50){
                           $job->discount=$discount ;
                           $job->price=$job->price * (1-($discount/100));
                       }   
                       }
                       
                       $job->description = $this->request->data->description ;
                       isset($this->request->data->dela)?$job->delay= $this->request->data->delay:$job->delay = time() + 24*7*3600 ;
                       $job->date=time();
                       $this->loadModel('Job');
                       $this->Job->save($job);
                       $id_job= $this->Job->id ;     
                    
                       
                       
                     $j=0;
             $params=array();
            
            for($i=0;$i<10;$i++){
                $art='article'.$i;
                $this->loadModel('Article');
                $product=$this->Article->find();
              
                if(isset($this->request->data->$art)&& ($this->request->data->$art>0)){
                    $qt= $this->request->data->$art;
                    $parrq_str='PAYMENTREQUEST_'.$j.'_' ;
        $params[$parrq_str.'NAME'] = $product[$i]->name;
	$params[$parrq_str.'DESC'] = $product[$i]->description;
	$params[$parrq_str.'QTY'] = $qt;
       $this->save_job_items($qt,$i,$id_client,$id_job,$product);
        $j++;
                }
            }
            
            $params['PAYMENTREQUEST_0_id_client']=$id_client;
            $params['PAYMENTREQUEST_0_id_job']=$id_job;
    $this->Session->write('pvalue',$price_total);        
            $paypal = "#";
             require LIB.DS.'myap/paypal.php';
                
$paypal = new Paypal();
        
        $params['RETURNURL'] = 'http://localhost/cheaperBeer/users/process';
	$params['CANCELURL'] = 'http://localhost/cheaperBeer/users/cancel';

	$params['PAYMENTREQUEST_0_AMT'] = $price_total ;
	$params['PAYMENTREQUEST_0_CURRENCYCODE'] = 'USD' ;
	$params['PAYMENTREQUEST_0_ITEMAMT'] = $price_total;

$response = $paypal->request('SetExpressCheckout', $params);
if($response){
	$paypal = 'https://www.sandbox.paypal.com/webscr?cmd=_express-checkout&useraction=commit&token=' . $response['TOKEN'];
        header('Location:'.$paypal);
        
}else{
	$this->e404($paypal->errors);
}              
                       
                       
                       
                       }
        }
        
        
                function process(){
         
            $price_total = $this->Session->read('pvalue');
$paypal = "#";

  require LIB.DS.'myap/paypal.php';
$paypal = new Paypal();
$response = $paypal->request('GetExpressCheckoutDetails', array(
	'TOKEN' => $_GET['token']
));
if($response){
	if($response['CHECKOUTSTATUS'] == 'PaymentActionCompleted'){
		die('Ce paiement a déjà été validé');
	}
}else{
    $this->e404($paypal->errors);
	
}



$params = array(
	'TOKEN' => $_GET['token'],
	'PAYERID'=> $_GET['PayerID'],
	'PAYMENTACTION' => 'Sale',

	'PAYMENTREQUEST_0_AMT' => $price_total,
	'PAYMENTREQUEST_0_CURRENCYCODE' => 'USD',
	
	'PAYMENTREQUEST_0_ITEMAMT' => $price_total,
);

$response = $paypal->request('DoExpressCheckoutPayment',$params);
$email= $this->Session->read('email_temp');
if($response){
	
	$response['PAYMENTINFO_0_TRANSACTIONID'];
        if($response['ACK']=='Success'){
            $id= $this->Session->User('id');
            
                
            $this->loadModel('Job');
            $update_job= new stdClass();
            $update_job->id =$response['id_job'] ;
            $update_job->id_client =$response['id_client'] ;
            $update_job->statut=1;
            
            $this->Job->save($update_job);
           // $this->notificate('success_payment',$email);
            $this->loadModel('Payment');
            $pay = new stdClass();
            $pay->id_client = $response['id_client'] ;
            $pay->id_job =$response['id_job'] ;
            $pay->id_transaction = $response['PAYMENTINFO_0_TRANSACTIONID'];
            $pay->id_merchant = $response['PAYMENTINFO_0_SECUREMERCHANTACCOUNTID'];
            $pay->amont = $response['PAYMENTINFO_0_AMT'];
            $pay->date =time() ;
            $this->Payment->save($pay) ;
            $this->Session->setFlash($this->t('payment_succed'));
            $this->redirect();
        }

}else{
       // $this->notificate('failed_payment',$email);
	 $this->e404($paypal->errors);
}
        }

        
        function cancel(){
       
           $this->Session->setFlash($this->t('payment_cancelled'),'error');
            $this->redirect('users/premium');
       } 
        
        function logout(){
            
         $this->request->norend=true;
               setcookie('atttkp4839','',time()-2000,'/','simplewebagency.com',false,true);
		session_destroy();
                session_start();
                session_regenerate_id();
                $this->Session->setFlash($this->t('cu_youlogout'));
                //http_redirect('http://localhost/cheaperBeer');
		$this->redirect();
	}
        
        
        function upload($uid){
            $this->request->norend =true ;
            
            
            if($this->Session->isLogged()&&isset($uid)){
             $dir = WEBROOT.DS.'img'.DS.'upload';   
           
            if(!file_exists($dir)) mkdir($dir,0777); 
            //debug($_FILES['file']['tmp_name']) ; die() ;
            move_uploaded_file($_FILES['file']['tmp_name'], $dir.DS.$_FILES['file']['name']) ;
           
                $this->loadModel('File');
            $file=new stdClass();
            $file->date=time();
            $file->name =$_FILES['file']['name'] ;
            $file->location = $dir;
            $file->id_client = $this->Session->User('id');
            $file->id_jobs = $uid;
            $file->size = $_FILES['file']['size'] ;
            
            $this->File->save($file);
            }
            
                    
        }
      


}