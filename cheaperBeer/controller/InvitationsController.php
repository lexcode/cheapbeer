<?php

require LIB.DS.'facebook-sdk'.DS.'autoload.php';
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;

class InvitationsController extends Controller{
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
    
    public $access = array('connect','appfacebook','join','facebook');
    
    function facebook(){      
       $this->request->norend= true ;

// init app with app id and secret
FacebookSession::setDefaultApplication('858274290870795','942db6309d15d129271e09d851ffb43b');
$tokken= $this->request->data->token ;
  //   debug($tokken) ; 
        // If you already have a valid access token:
$session = new FacebookSession($tokken);

// To validate the session:
try {
  $ok=$session->validate('858274290870795','942db6309d15d129271e09d851ffb43b');
  if($ok){
    $request = new FacebookRequest($session, 'GET', '/me');
$response = $request->execute();
$me = $response->getGraphObject();

$request2 = new FacebookRequest(
  $session,
  'GET',
  '/me/friendlists'
);
$response2 = $request2->execute();
$friends = $response2->getGraphObject();
$_SESSION['friends'] = $friends ;
if(!empty($me)){
    
    $this->LoadModel('User');
    $user=$this->User->findFirst(array('conditions'=>array('facebook_id'=>$me->getProperty('id')),
                                    'fields'=>'id, pseudo , email , img , lang , created,password'));
    if(!empty($user)){
        
        $auth= sha1('bhd_f78#'.$user->password.'754QQ'.$user->email.'ffd--bd'.urlname(php_uname())).'.'.$user->id; 
         unset($user->password);
        setcookie('qwylg2819',crypter($user->lang.'.ntBjUdfZ11fOyKiFnqKu15mjz','lan9'),time()+(60*60*24*15),'/','wegaphone.com');
       setcookie('qwyvt3829',crypter($user->email,'3ma1l'),time()+(60*60*24*15),'/','wegaphone.com');
      
          setcookie('qwykp4839',$auth,time()+(60*60*24*7),'/','wegaphone.com');
          $_SESSION['User']=$user;
        $this->redirect('users/index');
    }else{
       
       $request = new FacebookRequest(
  $session,
  'GET',
  '/me/picture',
  array (
    'redirect' => false,
    'height' => '200',
    'type' => 'normal',
    'width' => '200',
  )
);
$response = $request->execute();
$graphObject = $response->getGraphObject();

        $new_user = new stdClass();
        $new_user->pseudo=$me->getProperty('name');
        $new_user->facebook_id=$me->getProperty('id');
        $new_user->email=$me->getProperty('email');
        $new_user->city=$me->getProperty('city');
        $new_user->contry=$me->getProperty('country');
        $new_user->region=$me->getProperty('state');
        $new_user->lat=$me->getProperty('latitude');
        $new_user->lng=$me->getProperty('longitude');
        //telechargement image
        $url = $graphObject->getProperty('url');
        $img_name= urlname($new_user->pseudo).'_'.random(9).'.jpg' ;
        $img = '/var/www/wegaphone.com/webroot/img/profile_pictures/'.$img_name;
        file_put_contents($img, file_get_contents($url));

        $new_user->img=$img_name;
        //envoyer les passord au client
        $your_pwd =random(9);
        //enregistrer le password provisoirement pour l envoyer lors de la confirmation
        $data_to_mail = array('pseudo'=>$new_user->pseudo,'email'=>$new_user->email);
        $this->notificate('welcome',$new_user->email,$data_to_mail);
        $new_user->password= hash('whirlpool','kaK@t0utb3t'.$your_pwd);
        $new_user->lang= substr($me->getProperty('local'),0,2);
        $new_user->created=time();
        
                                
        
        $this->User->save($new_user);
        $new_user->id=$this->User->id ;
        //ajout des cookies
        setcookie('qwylg2819',crypter($new_user->lang.'.ntBjUdfZ11fOyKiFnqKu15mjz','lan9'),time()+(60*60*24*15),'/','wegaphone.com');
       setcookie('qwyvt3829',crypter($new_user->email,'3ma1l'),time()+(60*60*24*15),'/','wegaphone.com');
       $auth= sha1('bhd_f78#'.$new_user->password.'754QQ'.$new_user->email.'ffd--bd'.urlname(php_uname())).'.'.$new_user->id;
        setcookie('qwykp4839',$auth,time()+(60*60*24*7),'/','wegaphone.com');
           
        
        unset($new_user->password);
        $_SESSION['User']=$new_user;
        $this->redirect('users/client');
        
    }
    
                }
      
  }
  

} catch (FacebookRequestException $ex) {
  // Session not valid, Graph API returned an exception with the reason.
  echo $ex->getMessage();
} catch (\Exception $ex) {
  // Graph API returned info, but it may mismatch the current app or have expired.
  echo $ex->getMessage();
    }
	
}
	
    function connect(){

// On importe l'API Facebook
require LIB.DS.'facebook-api/facebook.php';

// On initialise l'objet Facebook
$facebook = new Facebook(array(
    'appId' => '348020895300791',
    'secret' => '11e0d0a2bff11b53da2896ba7a0b3a95',
    'cookie' => true
));

// On récup la session Facebook
$uid = $facebook->getUser();

 


// L'utilisateur n'est logué
if(empty($uid)){
    // On redirige l'utilisateur vers le panneau de login Fb
    header('Location:'.$facebook->getLoginUrl(array(
        'locale' => loadLang(),
        'scope'=>'email , user_location ,user_birthday ,user_friends ,user_activities, user_likes , read_stream',
        
        'display'=>'popup')));
        
    
}
else{
    try{
           // Id utilisateur de Facebook
        $me = $facebook->api('/me');    // Infos utilisateurs
    } catch (FacebookApiException $e){ 
        $this->Session->setFlash('error occur with facebook connect. Please refresh the page and try again','error'); 
        $this->redirect();
        }
}
 //debug($me) ; die() ;  
// On récupère les infos utilisateurs avec FQL
if(isset($me)){
  //  echo 'me';
    $fql = "select uid,first_name,last_name,pic_big, sex , email ,activities, movies, music, books, tv, games, sports, favorite_athletes, favorite_teams, inspirational_people,current_location, birthday_date ,website from user where uid=$uid";
    $param = array(
        'method' => 'fql.query',
        'query' => $fql,
        'callback' => ''
    );
    $fb = $facebook->api($param);
    $fb=$fb[0];
     

    $fuid=$fb['uid'];
    $this->loadModel('User');
    // On vérifie si cet utilisateur est déja inscrit
    $user = $this->User->findFirst(array('fields'     => 'id, pseudo ,password,img,contry, email,lang, created, role ,my_type ,type_set, few_words, city, lat ,lng,dd1,dm1,dy1',
                                          'conditions'=>array('facebook_id'=>$uid))) ;
    
   // debug($user) ; die() ;
    //$user = $user->fetchAll();
    // On n'a aucun utilisateur qui correspond
    if(empty($user)){
       // echo 'here1';
       // debug($fb) ; die() ;
        $birth=explode('/',mysql_escape_string($fb['birthday_date']));
        
        $mtype=array( 'female'=>1,'male'=>2) ; 
        
        $nuser= new stdClass();
        $nuser->dm1 = $birth[0];
        $nuser->dd1 = $birth[1];
        $nuser->dy1 = $birth[2];
        $nuser->facebook_id=$fuid;
        $nuser->lang=loadLang();
        $nuser->password = hash('whirlpool','kaK@t0utb3t'.uniqid());
        $nuser->email =mysql_escape_string($fb['email']);
        $nuser->pseudo = mysql_escape_string($fb['first_name']);
        $nuser->second_name =  mysql_escape_string($fb['last_name']);
        $nuser->lat = mysql_escape_string($fb['current_location']['latitude']); 
        $nuser->lng =  mysql_escape_string($fb['current_location']['longitude']); 
        $nuser->city = mysql_escape_string($fb['current_location']['city']); 
        $nuser->contry =  mysql_escape_string($fb['current_location']['country']);
        $nuser->region =  mysql_escape_string($fb['current_location']['state']);
        $nuser->my_type = $mtype[mysql_escape_string($fb['sex'])];
        
        $nuser->created = time() ;
        
        $parid =$this->User->snuser($nuser);
       
        //add interest from facebook via fql
         $interest=array('hobbies','movies', 'music', 'books', 'tv', 'games');
        
        foreach($interest as $i=>$j){
            
            $taglist=array();
          if(isset($fb[$j])&&!empty($fb[$j])) {
              
              if(is_array($fb[$j])){
           $taglist = $fb[$j];
                }
          if(is_string($fb[$j])){
           $delim=',';
           if(isset($delimiter)&&in_array($delimiter, array(';',',','|',':'))){
               $delim=$delimiter;
           }
           
           $taglist=explode($delim, $fb[$j]);
            }
          //  debug($taglist) ; die() ;
                foreach($taglist as $k=>$v){
                    $v=mysql_escape_string(trim($v)); 
                    if($v!=''){
                      $this->newtag($v,$parid,$i);  
                    }
                    
                        } 
          }
            
         
          } 
        
               
                //creation d'une gallerie pour recevoir les images
                                $don= new stdClass ;
                                $don->name= $this->t('u_my_gallery') ;
                                $don->level=1;
                                $don->id_owner=$parid;
                                $don->id_ownerentity=$parid;
                                $don->id_entity=$parid;
                                $don->entityp=0;
                                $don->created=time() ;   
                                $this->loadModel('Album');
				$this->Album->create($don);
                                
                                 //creation d'un tokken d'inscription
                                $this->loadModel('Confirme');
                                $conf=new stdClass();
                                $conf->tokken = sha1(random(30)) ;
                                $conf->email = $nuser->email ;
                                $conf->id_user = $parid ;
                                $conf->ip = ip2long($_SERVER['REMOTE_ADDR']) ;
                                $conf->created = time();
                                $conf->expire=time()+3600;
                                $conf->grt=0;
                                //debug($conf);die();
                                $this->Confirme->save($conf);
                               
                                $dati=str_repeat($nuser->email.'==',4);
                                $dati=crypter($dati);
                                $data=array('pseudo'=>$nuser->pseudo, 'data'=>$dati , 'key'=>$conf->tokken);
                                $this->notificate('confirmation',$nuser->email,$data);
                                //$this->notificate('confirmation','guizmauh@hotmail.com',$data);
                                $this->Session->setFlash($this->t('cu_registrationsucces'));
                                $this->redirect();  
				
    }
    // Utilisateur déja inscrit, on récup ses infos
    else{
       $auth= sha1('bhd_f78#'.$user->password.'754QQ'.$user->email.'ffd--bd'.$_SERVER['REMOTE_ADDR']).'.'.$user->id;
                                    setcookie('atttkp4839',$auth,time()+(60*60*24*7),'/','simplewebagency.com',false,true);
                                    
                           unset($user->password);
                   //si l'user est premium
               /*    if($user->role>2){
                       $filtre=array();
                       $filtre = $this->User->findFirst(
                array('fields'=> 'filter_type , filter_role,  filter_my_type, filter_contry, filter_region, filter_department, filter_city , filter_lat, filter_lng, filter_distance, 
                                 filter_ads, filter_hidden, filter_nb_show,
                                  filter_link_type, filter_ambiance, filter_relationship_statut, filter_orientation, filter_living,
                                 filter_body_type, filter_hair_color, filter_eye_color, filter_ethnic, filter_children, filter_smoking, filter_drinking,
                                 filter_education, filter_income, filter_languages, filter_explicit',
                                                        'conditions' => array('id' => $user->id)));
                   
                     if(!empty($filtre)){
                         $this->Session->write('Premium',$filtre);
                     } 
                   }*/
                   
               // $this->redirect();        
    }
      $this->Session->write('User',$user); 
                   $this->redirect();    
}
    }
    
    
    function gmail(){
      
      define('ClientID', '63755550496-0ld25o5cq8ckmv9j75uhh4nrn77jfqc8.apps.googleusercontent.com');
      define('Secret', 'bmoFKAQDiWHQnG9GjqTb6nAA');
      require LIB.DS.'google-api-client/Google_Client.php';
      $client = new Google_Client();
      $client->setApplicationName('Atttune');
      $client->setClientId(ClientID);
      $client->setClientSecret(Secret);
      $client->setScopes('https://www.google.com/m8/feeds');
      $client->setRedirectUri('http://www.simplewebagency.com/invitations/gmail');
      $client->setAccessType('online');
      if(isset($_GET['code'])){
        $client->authenticate();
        $_SESSION['token_gmail'] = $client->getAccessToken();
        $this->redirect('invitations/gmail');
      }
//unset($_SESSION['token_gmail']);
      if(!isset($_SESSION['token_gmail'])){
        //$url = $client->createAuthUrl();
        $d=array();
        $d['url']=$client->createAuthUrl();
        $this->set($d);
       
      }else{
        $client->setAccessToken($_SESSION['token_gmail']);
        $token = json_decode($_SESSION['token_gmail']);
        $token->access_token;
        $curl = curl_init("https://www.google.com/m8/feeds/contacts/default/full?alt=json&max-results=50&access_token=" . $token->access_token);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);
        $contacts_json = curl_exec($curl);
        curl_close($curl);
        $contacts = json_decode($contacts_json, true);
        if(empty($contacts))
            {unset($_SESSION['token_gmail']);
            $this->redirect('invitations/gmail');
            }
        $return = array();
        $this->loadModel('Invited');
        $i=0;
        $id= $this->Session->User('id');
        
        foreach($contacts['feed']['entry'] as $contact){
            
            $return[$i] = array(
              'name' => $contact['title']['$t'],
              'email'=> isset($contact['gd$email'][0]['address']) ? $contact['gd$email'][0]['address'] : false,
              'phone'=> isset($contact['gd$phoneNumber'][0]['$t']) ? $contact['gd$phoneNumber'][0]['$t'] : false,
            );
            $invitation=$this->Invited->findFirst(array('conditions'=>array('id_inviter'=>$id,'email'=>$return[$i]['email'])));
                    if(empty($invitation)){
            $inv=new stdClass();
            $inv->id_inviter=$id;
            $inv->email=$return[$i]['email'];
            $inv->name=$return[$i]['name'];
            $inv->phone=$return[$i]['phone'];
            
            $uuid=uid();
            $return[$i]['uid']=$uuid;
            $inv->id=$uuid;
            $inv->via='gmail';
            $inv->time=time();
            $this->Invited->nsave($inv); 
                    }else{
                       $return[$i]['uid']=$invitation->id; 
                    }
            
            $i++;
        }
        
        $d=array();
        $d['contact']=$return ;
       // debug($d);
        $this->set($d);
        
      }
      
    }
    
    
    function outlook(){
        
        require LIB.DS.'hotmail-api/LiveOauthApp.php' ;
        
        $oapp = new LiveOauthApp ;
        $d=array();
        if(!isset($_GET['code'])){
       
        $d['url']= $oapp->getAuthorizationUrl() ;
        
        
        }
        
                
          if(isset($_GET['code'])){
              $code = htmlspecialchars($_GET['code']);
              $code = mysql_real_escape_string($code); 
              $tokken = $oapp->getAccessToken($code);
              
              
             $dco=$oapp->getContacts($tokken->access_token);
              $d['json']=json_decode($dco);
              
            //  debug($d) ;
              $id=$this->Session->User('id');
              $i=0;
              $this->loadModel('Invited');
              foreach($d['json']->data as $k=>$v){
            $inv=new stdClass();
            $inv->email=filter_var($v->name,FILTER_VALIDATE_EMAIL);
            if($inv->email!=false){
                  //  debug($inv->email) ; die() ;
                 $inv->id=uid();
            
            $inv->name=$v->first_name;
            $inv->name2=$v->last_name;
            $inv->phone=substr($v->id, 8);
            $inv->time=time();
                $d['contacts'][$i]->email=$inv->email;
                $d['contacts'][$i]->name=$inv->name;
                $d['contacts'][$i]->name2=$inv->name2;
                $d['contacts'][$i]->uid=$inv->id;
              
            $invitation=$this->Invited->findFirst(array('conditions'=>array('id_inviter'=>$id,'email'=>$inv->email)));
                 
            if(empty($invitation)){
            $inv->id_inviter=$id;
                $inv->time=time(); 
                $inv->via='outlk';
            $this->Invited->nsave($inv);    
                    }  
                   $i++; 
                    }
            }
          }      
                
        $this->set($d);
    }
    
    
    
    
    
    // YAHOO INVITATION CORE MODULE
    function yahoo(){

require LIB.DS.'yahoo5-api/Yahoo/YahooOAuthApplication.class.php';

$yahoo_key = "dj0yJmk9MkloMmZHNXR4c1I1JmQ9WVdrOVVVOVRVbE5aTkhNbWNHbzlNQS0tJnM9Y29uc3VtZXJzZWNyZXQmeD0wMQ--";
$yahoo_secret = "02fdab2d8292083daa2d43674d00e36616d9ad17";
$yahoo_callback = "http://www.simplewebagency.com/invitations/yahoo"; //Then, here is the initial and rather strange looking ReST call using the yahoo.inc function .
$yahoo_appID = "QOSRSY4s" ;

$oauthapp      = new YahooOAuthApplication($yahoo_key, $yahoo_secret, $yahoo_appID, $yahoo_callback);

$tokk=$this->Session->read('tokken_yahoo');
if(!isset($tokk)||empty($tokk)||($tokk=='')){
  # Fetch request token
$request_token = $oauthapp->getRequestToken($yahoo_callback);
$ob=new stdClass();
foreach($request_token as $k=>$v){
    $ob->$k = $v;
}
# Redirect user to authorization url
$redirect_url  = $oauthapp->getAuthorizationUrl($request_token);
$this->Session->write('tokken_yahoo', $ob);

$d=array();
$d['url']=$redirect_url ;
$this->set($d);
}else{
    
# Exchange request token for authorized access token
$access_token  = $oauthapp->getAccessToken($tokk, $_REQUEST['oauth_verifier']);

# update access token
$oauthapp->token = $access_token;

# fetch user profile

$d=array();
$id=$this->Session->User('id');
            $d['contact']= $oauthapp->getContacts();
            
            $dec=$d['contact']->contact;
            if(isset($dec)&&!empty($dec)){
             $i=0;
            $this->loadModel('Invited');
            foreach($dec as $k=>$v){
                $inv=new stdClass();
                foreach($v->fields as $l=>$m){
                    if($m->type=='email'){
                       $inv->email=$m->value; 
                    }
                    if($m->type=='phone'){
                      $inv->phone=$m->value;   
                    }
                    if($m->type=='nickname'){
                        $inv->name2=$m->value; 
                    }
                    if($m->type=='name'){
                         $inv->name=$m->value->middleName; 
                         $inv->name2=$m->value->familyName; 
                    }
                  
                }
                $inv->id=uid();
                $d['contact_tab'][$i]->email=$inv->email;
                $d['contact_tab'][$i]->name=$inv->name;
                $d['contact_tab'][$i]->mname2=$inv->name2;
                $d['contact_tab'][$i]->uid=$inv->id;
                $invitation=$this->Invited->findFirst(array('conditions'=>array('id_inviter'=>$id,'email'=>$inv->email)));
                    if(empty($invitation)){
                $inv->id_inviter=$id;
                $inv->time=time(); 
                $inv->via='yahoo';
                $this->Invited->nsave($inv);       
                    }
                  $i++;
            }   
            }
            
           // debug($d) ; die() ;
$this->set($d);
unset($_SESSION['tokken_yahoo']);

}


    }
    
    function join($id_invit=null){
        $this->Session->setFlash($this->t('n-welcome'),'info');
                $this->redirect('');  
    }
    
    function set_visitor_cookie(){
        if(!isset($_COOKIE['atttvt5849'])){
          setcookie('atttvt5849',crypter($_SERVER['REMOTE_ADDR'].'__'.time(),'3ma1l'),time()+(60*60*24*15),'/','simplewebagency.com');
              
        }
                                
    }
    
    function code_creation($via=null,$url=''){
        if($url==''){
          $url= 'http://localhost/cheaperBeer/?ivtc=';  
        }else{
            $url=Router::url($url).'?ivtc=' ;
        }
        
        $id=$this->Session->User('id');
        $this->loadModel('Referer');
        $n_referer = new stdClass();
        $n_referer->id_owner=$id;
        $n_referer->time=time();
        if(isset($via)){
          $n_referer->via=$via;  
        }
        $id_ref=$this->Referer->save($n_referer);
        
        return $url.$id_ref;
    }
    
    function connect_first(){
        //if check if i have a invitation get code
        if(isset($_GET['ivtc'])){
            if(is_double($_GET['ivtc'])&&($_GET['ivtc']>MIN_V)&&($_GET['ivtc']<MAX_V)){
                
                $ip=$_SERVER['REMOTE_ADDR'];
                $referer=$_GET['ivtc'];
                
                if(!isset($_COOKIE['atttrf6859']))
                    {
                    $keys=random(13);
                    setcookie('atttrf6859',crypter($ip.'__'.$referer.'__'.time().'__'.$keys,'3ma1l'),time()+(60*60*24*15),'/','simplewebagency.com');
                     
                    
                     //find if someone with this ip was first refered
                    
                    $this->loadModel('Ipvisitor');
                    $ref=$this->Ipvisitor->find(array('conditions'=>array('ip'=>$ip),'fields'=>'id,keys'));
                    $nb_ip=count($ref);
                    if(empty($ref)){
                        
                    $this->loadModel('Referer');
                    $ref=$this->Referer->findFirst(array('conditions'=>array('id'=>$referer),'fields'=>'id_owner'));

                    $this->loadModel('Invited');
                    $n_invited= new stdClass();
                    $n_invited->time=time();
                    $n_inited->keys=$keys;
                    $n_invited->ip=$ip;
                    $n_invited->inviter=$ref->id_owner;
                    $n_invited->lang=loadLang();
                    $this->Invited->save($n_invited);
                    }else{
                        if($nb_ip===1){
                            
                        }
                    }
                

                     }
                     /*else {
                    $ck_reference=decrypter($_COOKIE['atttrf6859'], '3ma1l');
                    $ck_ref=explode('__',$ck_reference);
                    $ck_ip=$ck_ref[0];
                    $ck_refid=$ck_ref[1];
                    $ck_time=$ck_ref[2];
                    $ck_keys= $ck_ref[3];
                   }*/
                     
    
                }
        }
    }
    
    function confirm(){
        
        //mail('guizmauh@simplewebagency.com','hello de christophe','comment vas tu'); die();
        $data=array();
        $id= $this->Session->User('id');
        $data['psd']= $this->Session->User('pseudo');
        $data['img']= $this->Session->User('img');
        $data['city']= $this->Session->User('city');
        $data['contry']= $this->Session->User('contry');
        
        if($this->request->data){
            $this->loadModel('Invited');
            $whitelist=array('kentok','tokken','invit');
         //  debug($this->request->data) ;
            if($this->Invited->verify($this->request->data,$whitelist,'vegetAAble')){
                
                foreach($this->request->data->invit as $k=>$v){
                    $invitation=$this->Invited->findFirst(array('conditions'=>array('id'=>$v,'id_inviter'=>$id)));
                  
                    if(isset($invitation)&&!empty($invitation)){
                      
                       $inv=new stdClass();
                    $inv->id=$v;
                    $inv->invnb=1;
                    $this->Invited->save($inv);
                    $data['name']=$inv->name ;
                    $data['theid']=$v;
                   // debug($invitation) ; die() ;
                    $this->notificate('invitation', 'guizmauh@simplewebagency.com' , $data); 
                    }
                    
                }
                
                $this->Session->setFlash($this->t('invit_send'));
                $this->redirect();
                }else{
                 $this->Session->setFlash($this->t('invit_failed'),'error');
                $this->redirect();   
                }
                
        }
    }
    
    
     function appfacebook($t_tag=null,$name=null){
          
            $role=0;
            $d=array();   // d comme data
            $this->searchBar=true ;
            if($t_tag){
                $t_tag=filter_var($t_tag,FILTER_VALIDATE_INT);
                if($t_tag==false){
                   $this->Session->setFlash($this->t('invalid_address'),'error');
                   $this->redirect(); 
                }else{
                    $d['t3tag']=$t_tag;
                }
            }
            
             
            
                  
                   $lat='0';
                   $lng='0';
                   //verifier si l'user n'est pas logger
              if(isset($_COOKIE['atttvt3829']) && isset($_COOKIE['atttkp4839']) && empty($_SESSION['User']->id)){
                    
                  $this->redirect('users/login');
                  
                  }
                  //  debug($_SESSION['User']) ;
                    // voir si l'user est en session
                    
                if(isset($_SESSION['User'])&&!empty($_SESSION['User'])&&!empty($_SESSION['User']->id))
                    {
                    // création des variables users utile localisation et id
                     // il n'est pas en session le rediriger vers login
                       $lat= $this->Session->User('lat');      
                       $lng= $this->Session->User('lng');                  
                       $id = $this->Session->User('id') ; 
                       $role = $this->Session->User('role') ;                
                       $d['myid'] =$id ; 
                    }else{
                        $this->loadModel('Iplocation');
            $vdf=$this->Iplocation->ip2contry($_SERVER['REMOTE_ADDR']);
            
          
           $this->loadModel('Citie');
           $vu=$this->Citie->findFirst(array('conditions'=>array('contry'=>$vdf['contry']),'order'=>'population DESC','limit'=>' 1'));
            
          $lat=$vu->latitude;
          $lng=$vu->longitude;
          if(!$lat){$lat='0';}
          if(!$lng){$lng='0';}
                    }
                 // UTILISATEUR EST DONC EN SESSION IL PEUT  ACCERDER AU INFOS
                    
               
                          
                       // collecte des tags de l'user en session
                       if(isset($id)){
                                $this->loadModel('Tag');
                                $usertag= $this->Tag->find(array('conditions'=>array('id_owner'=>$id , 'archive'=>0)));
                              
                                if(!empty($usertag))
                                    {
                                    $tagtab=array();
                                    foreach($usertag as $v)
                                        {
                                        $tagtab[]=$v->id_tag ;
                                        }
                                     $this->Session->write('mytag',$tagtab); // save tag en session
                                    }
                                }

                        // appel ajax pour lister des villes par caractères
                        if(isset($_GET['city']))
                            {
                                $e=array();
                                $q=array();
                                //faire u traitement de $_GET ici
                                
                                $kword=mysql_real_escape_string($_GET['city']); 
                                $q['fields']='id , city , latitude , longitude';
                                $q['conditions']=array('city'=>$kword);
                                $q['order']=' population DESC '.
                                $this->loadModel('Citie');
                                $a=$this->Citie->like($q);
                                //si une ville est trouvée
                                if(isset($a)&&!empty($a)){
                                header('Content-Type: application/json');
                                echo json_encode($a, JSON_FORCE_OBJECT) ;
                                }
                                else
                                {
                                   $e='notfound';
                                   header('Content-Type: application/json');
                                   echo json_encode($e, JSON_FORCE_OBJECT) ;
                                }
                
                            }
            
            
                         //cette partie permet d'initialiser les params de pagination
                         if(!$this->request->page){
                              $this->request->page=1;  
                            }
                            $perPage = 15;
                            if($role>2){
                            $perPage = $this->Session->filtr('nb_show');
                            }
                             // nombre de profil par page
                            // ici on cherche le nombre d'user total pour donner le nombre de page
                            //mauvaise idee
                            $this->loadModel('User');
                            $total = $this->User->Total(); 
                            $d['page'] = ceil($total / $perPage);
                            //s l'user demande plus de page qu'il y en a le mettre a la page 1
                                        if($this->request->page>$d['page'])
                                                {
                                                  $this->request->page=1;  
                                                }
                     
                        
                          //ON VA GERER LES INFOS ENVOYER VIA AJAX POST 
                          // 1: l'user choisi le statut presentiel (all , news , online)
                          // 2: l'user modifie ses critères de recherche (age, lieu , envoie de texte)
                          
                         //definition de variables utiles                       
                            $dus=array();      //tableau des users  
                            $s=array();        //tableau des conditions
                            $tex=false ;        //si la variable tex a été posté
                            $ltag=false;
                            $lpseudo=false;
                        
                            
                            /**
                             * On traite le cas ou un id de tag est envoyer pour aficher
                             * les users en foonction
                             */
                           if(isset($t_tag)){
                          
                               
                            $this->loadModel('Categorie');
                            $tg=$this->Categorie->findFirst(array('fields'=>'name','conditions'=>array('id'=>$t_tag)));
                            
                            if(!empty($tg)){
                               if(isset($_SESSION['taglist_n'])&&!in_array($t_tag,$_SESSION['taglist_id'])){
                    $_SESSION['taglist_id'][]=$t_tag;
                    $_SESSION['taglist_n'][]=$tg->name;
                } 
                                
                                $tttag=array($t_tag);
                            $s['in']= array('id_tag'=>$tttag) ;
                            $s['inner_join2']  = array('tags as Tag'=>'Tag.id_owner=User.id'); 
                            $d['thetag']=$t_tag;
                            $d['thetag_name']=$tg->name;
                            }else{
                                $this->e404($this->t('l_error'));
                            }
                       
                              }else{
                unset($_SESSION['taglist_n']);
                unset($_SESSION['taglist_id']);
                unset($_SESSION['tagpin']);
                              }
  
                                if(!$this->request->data&&isset($id)){
                     //charger le formulaire de recherche multicritère avec les données sauvegardées
                $this->loadModel('Req');
                 $last_req=array('conditions'=>array('id_owner'=>$id),'order'=>'time DESC');
                 $this->request->data=$this->Req->findFirst($last_req);  
                 unset($this->request->data->tex) ;
                    }
                
                 //set de statut 
                 if(isset($this->request->data)&&!empty($this->request->data)){
                   $d['sta'] = $this->request->data->state ;  
                 }
                            //verification des information reçu
                            //$this->request->data = $_POST
                            // les traitements sont à réaliser ici
                            
                        if($this->request->data){
                            
                            //tableau des champs autorisés
                            $rqd_auth=array('my_type1','my_type2','my_type3','relationship_statut1',
                                            'relationship_statut2','relationship_statut3',
                                            'relationship_statut4','orientation1','orientation2','orientation3',
                                            'orientation4','children1','children2','children3',
                                            'children4','body_type1','body_type2','body_type3',
                                            'body_type4','body_type5','hair_color1','hair_color2',
                                            'hair_color3','hair_color4','hair_color5','hair_color6',
                                            'hair_color7','hair_color8','hair_color9','eye_color1',
                                            'eye_color2','eye_color3','eye_color4','eye_color5',
                                            'eye_color6','ethnic1','ethnic2','ethnic3','ethnic4',
                                            'ethnic5','ethnic6','ethnic7','ethnic8','ethnic9',
                                            'ethnic10','living1','living2','living3','living4',
                                            'living5','education1','education2','education3',
                                            'education4','smoking1','smoking2','smoking3',
                                            'drinking1','drinking2','drinking3');
            
          
            
            
                  $a=array();
                 
              // objet reqs servira a acceuillir les request->data    
            $reqs=new stdClass() ;
            $reqs=$this->request->data ;
            
            // state contient la recherche presentielle
            $state=false;
            
            //si l'utilisateur clique sur (all, new ou online)
            if(isset($this->request->data->state)){
                $state =true ;
                
                //on ira recuperer les paramètres de la dernière requète 
                $this->loadModel('Req');
                $last_req=array('conditions'=>array('id_owner'=>$id),
                                                    'order'=>'time DESC');
                
                //$reqs est modifié
                $reqs=$this->Req->findFirst($last_req);
                 
                //on donne a tr la valeur servant pour la condition dans la requete finale
                if($this->request->data->state==1){$tr='new';}
                elseif($this->request->data->state==2){$tr='online';}
                
                //on remodifie reqs->state pour ne pas avoir la condition précédante
                $reqs->state=$this->request->data->state;
                
                //on retire id et tex pour ne pas réécrire le paramètre 
                //et gardé que les conditions de bases
                unset($reqs->id);
                unset($reqs->tex);
                
                
            }else{
                //si il n'y a pas de state en reqs->data
            //on prend le statut de la dernière requete
            //on l'enregistre dans $reqs
            
                       $this->loadModel('Req');
                       $last_req=array('conditions'=>array('id_owner'=>$id),
                                       'fields'=>'state',
                                       'order'=>'time DESC');
                       $rqst=$this->Req->findFirst($last_req);
                      // print_r($rqst);
                       if($rqst->state==1){$tr='new';}
                       elseif($rqst->state==2){$tr='online';}  
                       $reqs->state=$rqst->state;
                   unset($reqs->id);
            }
            
            //ici on boucle $reqs pour parcourir tout les params
            //a intégré dans !rq->data->state
            foreach($reqs as $k=>$v){
               
               if(in_array($k, $rqd_auth)){
                   if($k=='ethnic10'&&$v==1){
                       $a['ethnic'][0]=10;
                   }elseif($v==1){
                       
                       $scp=substr($k,0,-1);
                       $scv=substr($k,-1);
                       $a[$scp][]=$scv;
                        }
                       }
                            }
            if(isset($a) && !empty($a)){
            $s['in']=$a;}
            
          //  debug($a);
            $reqs->id_owner=$id ;
            $reqs->lat=$lat;
            $reqs->lng=$lng;
            $reqs->time=time();
            unset($reqs->signed_request);
            unset($reqs->fb_locale);
            unset($reqs->state);
           // on enregistre en base la requète executé
            $this->loadModel('Req');
            $this->Req->save($reqs);
            
            $ps_sql=array();
            
          if(isset($this->request->data->tex)&&($this->request->data->tex!='')){
              $word=$this->request->data->tex ;
              $tex=true;
              $trans = array("," => " ",";" => " ");
              $word= strtr($word, $trans);
              $words = preg_split('/\s+/', $word);
              $u=array();
              $wd=array();
              $wd_pseudo=array();
              foreach($words as $k=>$v){
                  if($v!=''){
                      $vt=trim($v);
                 $wd[]= " Tag.name LIKE '%$vt%'"; 
                 $wd_pseudo[] =" User.pseudo LIKE '%$vt%'"; 
                  }
                  
                }
              
              $w= "Tag.archive=0 AND (".implode(' OR ', $wd)." )";
             
              $wd_pseudo=implode(' OR ',$wd_pseudo);
              
              
              // on doit intégré le resultat de state 
             $u['fields']='DISTINCT User.id, disPts('.$lat.','.$lng.',lat,lng) as dist , User.pseudo ,User.img, User.few_words, city ,role, dy1 , dm1 , dd1';
                    $u['limit'] = ($perPage*($this->request->page-1)).','.$perPage;
                    $u['order'] = ' dist ASC' ;
                    $u['conditions']= " $wd_pseudo ";
              $this->loadModel('User');
              $dus=$this->User->findA($u);
              
                      $this->loadModel('Tag');
                      
                      $tg=$this->Tag->find(array('fields'=>' DISTINCT id_tag , name','conditions'=>$w));
                      //si il y a des tags pour cette requète
                      if(!empty($dus)){
                          $lpseudo=true ;
                      }
                      if(!empty($tg)){
                        
                        foreach($tg as $k=>$v){
                          $d['tags_list_name'][]=$v->name ;
                          $d['tags_list_id'][]=$v->id_tag ;
                          //$tagkey[]=$v->id_tag ;
                      }  
              $s['in']= array('id_tag'=>$d['tags_list_id']) ;
              $s['inner_join2']  = array('tags as Tag'=>'Tag.id_owner=User.id'); 
                         $ltag=true ;
                      }
  
              }
            
                        //si il y a un appel a tex c'est que des tag correspondant son
              // renvoyé qu'on appelle la partie advance du formulaire
              if(($tex==true&&$ltag==true)||($tex==false)){
                 
           if(isset($reqs->min_age)){
              $word=$reqs->min_age ;
              $ps_sql[]= "dy1 <= ".(date('Y')-$word);
          }
          if(isset($reqs->max_age)){
              $word=$reqs->max_age ;
              $ps_sql[]= "dy1 >= ".(date('Y')-$word);
          }
          if(isset($reqs->city)&&($reqs->city!='')){
              $ps_sql[]= " city ='$reqs->city'";
          }
          if(isset($reqs->dist)&&($reqs->dist>0)){
              $distance=$reqs->dist ;
              $ps_sql[]= " disPts($lat,$lng,lat,lng) <= $distance ";
          }    
              }
     

            if(!empty($ps_sql)){  $s['conditions']=implode(' AND ', $ps_sql); }     
}
        
                    //lecture du statut presentiel
                    if(isset($tr)){
                        if($tr=='online'){
                            $s['inner_join']  = array('connecteds as Connect'=>'Connect.id=User.id');
                    
                        }elseif($tr=='new'){
                           $s['conditions']=" User.created >= ".(time()-(3600*24*7));
                                        }
                                    }  
                         
                         //conditions de recherche de base
                    $s['fields']='DISTINCT User.id, disPts('.$lat.','.$lng.',lat,lng) as dist , User.pseudo ,User.img, User.few_words, city ,role, dy1 , dm1 , dd1';
                    $s['limit'] = ($perPage*($this->request->page-1)).','.$perPage;
                    $s['order'] = ' dist ASC' ;
        
             
                 
                
                 
                // debug($this->request->data);
            $this->loadModel('User') ;  
                
                $d['users']   =array(); 
                  //  print_r($s);
                
                //si des données sont envoyer en tex
            if($tex){
                if($ltag){
                    if($lpseudo){
                            $o_user=$this->User->findA($s) ;
                            $dus = array_merge($dus,$o_user);
                            $dus = array_map("unserialize", array_unique(array_map("serialize", $dus)));
                             }
                 else{
                             $dus=$this->User->findA($s);  
                 }
                }
              $d['users']= array_to_object($dus) ;
                
            }else{
                
                    $d['users']=$this->User->find($s);
                
            }
            
                /// OOOOOOOOOOOOOOOOOOOOOOOOOOOOOO
                
                
                //print_r($d['total']);
                $lui=array();
                $my_tag=array();
                $m=$this->Session->Read('mytag');
                if(isset($m)&&is_array($m)){
                    $my_tag=$this->Session->Read('mytag');
                }
                $ak= array_map('current',$d['users']) ;
                $d['nbitem']= count($d['users']) ;
                
                //get number of pics for user
               
               $d['nb_pics']= $this->getNbPics($ak);
               $d['apps_list']=$this->myapps($ak);
               $d['connected']=$this->cnx($ak);
               $d['mtags']=$this->getTags($ak);
             //$jj=0;
               
             
           //debug($d['mtags1']) ;
             
             
             foreach ( $d['users'] as $k=>$v){
                 
                 
                        $this->loadModel('Tag');
                       // $d['mtags'][$k]=$this->Tag->find(array('conditions'=>array('id_owner'=>$v->id , 'archive'=>0)));
                        $d['tagnb'][$k]=count($d['mtags'][$k]);
                        if($d['tagnb'][$k]>0){
                          $d['intag'][$k]= array_fill(0,$d['tagnb'][$k],false) ;   
                        }else{
                            $d['intag'][$k]=array(0);
                        }
                         
                        if(isset($id)){
                        foreach($d['mtags'][$k] as $l=>$m){
                            if($m->id_owner!=$id&&is_array($my_tag)){
                               $d['intag'][$k][$l]= in_array($m->id_tag,$my_tag); 
                            }
                           
                        }}
                        
                    
                        if($v->role==3){
                          $d['auth'][$k]=$this->in_criteria($v->id);  
                        }
                        
            
             $lui[]=$v->id ;
        }
        
       //debug($this->request->page) ; 
                $this->Session->write('lui',$lui) ;
              
           
                $this->set($d);
        	
                
		
	}  
    
 

}
?>
