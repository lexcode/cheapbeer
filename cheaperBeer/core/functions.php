<?php 
function debug($var){

	if(Conf::$debug>0){
		$debug = debug_backtrace(); 
		echo '<p>&nbsp;</p><p><a href="#" onclick="$(this).parent().next(\'ol\').slideToggle(); return false;"><strong>'.$debug[0]['file'].' </strong> l.'.$debug[0]['line'].'</a></p>'; 
		echo '<ol style="display:none;">'; 
		foreach($debug as $k=>$v){ if($k>0){
			echo '<li><strong>'.$v['file'].' </strong> l.'.$v['line'].'</li>'; 
		}}
		echo '</ol>'; 
		echo '<pre>';
		print_r($var);
		echo '</pre>'; 
	}
	
}

function crop($img,$dest,$largeur=0,$hauteur=0,$comp=87){
        $dimension=getimagesize($img);
        $ratio = $dimension[0] / $dimension[1];
        // Création des miniatures
        if($largeur==0 && $hauteur==0){ $largeur = $dimension[0]; $hauteur = $dimension[1]; }
          else if($hauteur==0){ $hauteur = round($largeur / $ratio); }
        else if($largeur==0){ $largeur = round($hauteur * $ratio); }
  
        if($dimension[0]>($largeur/$hauteur)*$dimension[1] ){ $dimY=$hauteur; $dimX=round($hauteur*$dimension[0]/$dimension[1]); $decalX=($dimX-$largeur)/2; $decalY=0;}
        if($dimension[0]<($largeur/$hauteur)*$dimension[1]){ $dimX=$largeur; $dimY=round($largeur*$dimension[1]/$dimension[0]); $decalY=($dimY-$hauteur)/4; $decalX=0;}
        if($dimension[0]==($largeur/$hauteur)*$dimension[1]){ $dimX=$largeur; $dimY=$hauteur; $decalX=0; $decalY=0;}
        $miniature =imagecreatetruecolor ($largeur,$hauteur);
        
        $end = explode('.',$img); 
        $ext=end($end);
        if(in_array($ext,array('jpeg','jpg','JPG','JPEG'))){$image = imagecreatefromjpeg($img); }
        elseif(in_array($ext,array('png','PNG'))){$image = imagecreatefrompng($img); }
        elseif(in_array($ext,array('gif','GIF'))){$image = imagecreatefromgif($img); }
        else{ return false; }
        imagecopyresampled($miniature,$image,-$decalX,-$decalY,0,0,$dimX,$dimY,$dimension[0],$dimension[1]);
        imagejpeg($miniature,$dest,$comp);
          
        return true;
}



function age($dd , $mm , $yy){
    $d=intval($dd);
    $y=intval($yy);
    $m=intval($mm);
    
    if($mm<date('M') && isset($yy) && isset($mm)){
     $old= date('Y')-$y ;   
    }elseif($mm==date('M') && isset($yy)){
        if($dd<date('D') && isset($dd)){
        $old= date('Y')-$y ;      
        }
    }else{
        $old= date('Y')-$y-1;
    }
    return $old ;
}

function anniv($dd , $mm , $yy){
    $d=intval($dd);
    $y=intval($yy);
    $m=intval($mm);
    
    if($m==date('M') && $d==date('D') && $y==date('Y')){
     return true ;   
    }else{
        return false ;
    }
    
}

function sinceI($tmp){
    $tmp=intval($tmp);
    $e=time()-$tmp;
    $emin=floor($e/60);
    
    if($emin<1){
        return "1 min ago" ;
    }
    elseif(($emin>=1)&&($emin<=20)){
        return "$emin min ago" ;
    }
    elseif(($emin>20)&&($emin<=30)){
        return "30 min ago" ;
    }
    elseif(($emin>30)&&($emin<=60)){
        return "1 hour ago" ;
    }
    elseif(($emin>60)&&($emin<1380)){
        $ehour=floor($emin/60)+1 ;
        return "$ehour hours ago" ;
    }
    elseif(($emin>=1380)&&($emin<1440)){
        return "Today" ;
    }
    elseif(($emin>=1440)&&($emin<8640)){
        $eday=floor($emin/1440)+1 ;
        return "$eday days ago" ;
    }
    elseif(($emin>=8640)&&($emin<10080)){
        return "This week " ;
    }
    elseif(($emin>=10080)&&($emin<30240)){
        $eweek=floor($emin/10080)+1 ;
        return "$eweek weeks ago" ;
    }
    elseif(($emin>=30240)&&($emin<44640)){
        return "This month" ;
    }else{
        return "More than 1 month" ;
    }
 
}

function language(){
    $lang=$_SERVER['HTTP_ACCEPT_LANGUAGE'] ;
    $lg=array();
    $kv=array();
    $lgvers=array();
    $blang=array();
    $best=0;
    $i=0;
    $b=0;
    $lg=explode(',',$lang);
    foreach( $lg as $v){
        $kv[$i]=explode(';',$v);
        $q=0;
        if(empty($kv[$i][1])){
            $q=1;
        }else{
          $q=substr($kv[$i][1],3);  
        }
        if($best<$q){
            $b=$i;
            $best=$q;
        }
        
        $lgvers[$i]= explode('-',$kv[$i][0]) ;
        $blang[$i]['lang']=$lgvers[$i][0];
        if(count($lgvers[$i])==2){
        $blang[$i]['version']=$lgvers[$i][1];
        }else{
        $blang[$i]['version']='';    
        }
        $blang[$i]['score']=$q ;
        
        $i++ ;
    }
    
    return $blang[$b];
}

function loadLang($lang_select=array()){
   $lang='en';
   // choisir une langue par ordre de priorité : session(DB) , cookie(local) 
   // preference navigateur , puis par defautl en anglais
   
   //debug($_COOKIE);
   //$a=$this->Session->User('lang');
   
   if(isset($_SESSION['User']->lang)){
       $lang=$_SESSION['User']->lang;
   }
   if(isset($_COOKIE['atttlg2819'])&&!isset($_SESSION['User']->lang)){
       $lnn=decrypter($_COOKIE['atttlg2819'],'lan9');
       $lna=explode('.',$lnn);
       $lang=$lna[0];
       
   }
   if(!empty($l)&&!isset($_SESSION['User']->lang)&&!isset($_COOKIE['atttlg2819'])){
       $l=language();
       $lang=$l['lang'];
   }
   
    
   // tableau des langues supportées
   $support_lang=array('en','fr');
   
  // echo $lang ;
  // print_r($_SESSION['User']);
   if(in_array($lang, $support_lang)){
            return $lang ;   
           
           }else{
            return 'en' ;  
            }
           
          
}

function crypter($maChaineACrypter , $maCleDeCryptage="" ){
if($maCleDeCryptage==""){
$maCleDeCryptage='hh.74@f._22dSD#3@-YYwRv17_xehqjXj3yd@U@K#s6xtO5bN0';
}
$maCleDeCryptage = md5($maCleDeCryptage);
$letter = -1;
$newstr = '';
$strlen = strlen($maChaineACrypter);
for($i = 0; $i < $strlen; $i++ ){
$letter++;
if ( $letter > 31 ){
$letter = 0;
}
$neword = ord($maChaineACrypter{$i}) + ord($maCleDeCryptage{$letter});
if ( $neword > 255 ){
$neword -= 256;
}
$newstr .= chr($neword);
}
return str_replace('/','-', base64_encode($newstr));
}

function decrypter($maChaineCrypter ,$maCleDeCryptage=""){
if($maCleDeCryptage==""){
$maCleDeCryptage='hh.74@f._22dSD#3@-YYwRv17_xehqjXj3yd@U@K#s6xtO5bN0';
}
$maCleDeCryptage = md5($maCleDeCryptage);
$letter = -1;
$newstr = '';
$maChaineCrypter = base64_decode(str_replace('-','/',$maChaineCrypter));
$strlen = strlen($maChaineCrypter);
for ( $i = 0; $i < $strlen; $i++ ){
$letter++;
if ( $letter > 31 ){
$letter = 0;
}
$neword = ord($maChaineCrypter{$i}) - ord($maCleDeCryptage{$letter});
if ( $neword < 1 ){
$neword += 256;
}
$newstr .= chr($neword);
}
return $newstr;
}

function array_to_object($array) {
$arr=array();
            foreach($array as $k=>$v){
                $arr[$k]=new stdClass();
                foreach($v as $l=>$m){
                   $arr[$k]->$l=$m;
                }
            }
  return $arr;
}
function istokken($tok,$timer=null){
        
      ($_SESSION['tokket']==$tok)?$valide=true:$valide=false ;
                          
                    if(isset($timer)&&is_string($timer)){
                     for($i=-10;$i<=0;$i++){
           if($this->request->data->kentok==md5('587NFJF@SFFD'.$timer.'85#__.5sfDJ@@'.date('Y-m-d h:i:00',time()+ $i*60).'d5dsfFDS')){
            if($_SESSION['tokket']==$tok){
                            $valide=true;}
                            
                           }   
                    }               
                    }
      return $valide; 
              
}

function uid(){
    return floor(mt_rand()*1147483647/mt_getrandmax())+1000000000;
}

function random($car) {
$string = "";
$chaine = "abcdeDAQ91324ouiayfghij@#klmnpqrstuv#wxy0123456789@AZERTYUIOPQSDFGHJK8LMWXCVBN";
srand((double)microtime()*1000000);
for($i=0; $i<$car; $i++) {
$string .= $chaine[rand()%strlen($chaine)];
}
return $string;
}

function redirig($txt,$type='error'){
    $_SESSION['flash'] = array('message' => $txt,'type'	=> $type);
     header("Location: ".Router::url($_SESSION['prev_page']));
   die();
}


function in_set($value , $line_set){
   //  debug($value) ; die() ;
    $value=filter_var($value,FILTER_VALIDATE_INT,array('min_range'=>1));
    if(($value!=false)){
       $array_set = explode(',',$line_set);
      
   sort($array_set);
   
   if($array_set[0]==0){
        array_shift($array_set);
   }
   
   if(empty($array_set)){
       return 'empty';
   }else{
       
        if(count($array_set)==1){
     
       return ($value==$array_set[0]);
   }
   else
   {
   if(in_array($value,$array_set)){
       return 1;
   }else{
       return 0 ;
   }
           
       
   }
  
   } 
    }else{
        return 'null';
    }
    
}

function distanc($lat1 , $lon1, $lat2,$lon2){
    
    
    $lat1 = deg2rad($lat1);
$lon1 = deg2rad($lon1);
$lat2 = deg2rad($lat2);
$lon2 = deg2rad($lon2);

$dp= 2 * asin(
sqrt(
pow( sin(($lat1-$lat2)/2) , 2) + cos($lat1)*cos($lat2)* pow( sin(($lon1-$lon2)/2) , 2)
)

);
return  ceil($dp * 6371);

}

function urlname($str){
    $search=array('  ',' ','\'','\\','é','è','ê','?','!','à','ç','.');
    $replace=array('-','-','-','-','e','e','e','','','a','c','');
    return str_replace($search, $replace, strtolower(trim($str)));
}
