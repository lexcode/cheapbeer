<?php

Class CitiesController extends Controller{
    


    function geo(){
        $this->request->norend=true;
        foreach($_GET as $k=>$v){
            $_GET[$k]=mysql_escape_string($v);
        }
        
        if(isset($_GET['city'])){
                $d=array();
                $q=array();
                $kword=mysql_real_escape_string($_GET['city']); 
                $kword=htmlspecialchars($kword);
                $q['conditions']=array('city'=>$kword);
                $q['order']=' population DESC '.
                $this->loadModel('Citie');
                $a=$this->Citie->like($q);
                if(isset($a)&&!empty($a)){
                header('Content-Type: application/json');
                echo json_encode($a, JSON_FORCE_OBJECT) ;
                }
                else
                {
                   $d='notfound';
                   header('Content-Type: application/json');
                   echo json_encode($d, JSON_FORCE_OBJECT) ;
                }
                
            }
            if(isset($_GET['latitude'])&&isset($_GET['longitude'])&&is_numeric($_GET['latitude'])&&is_numeric($_GET['longitude'])){
                $lat=$_GET['latitude'];
                $lng=$_GET['longitude'];
                $d=array();
                $q=array();
                
                $q['dist']=10;
                $q['spread']=0.8;
                $q['order']=' dist ASC '.
                $this->loadModel('Citie');
                $a=$this->Citie->near($lat,$lng,$q);
               
                if(isset($a)&&!empty($a)){
                
                header('Content-Type: application/json');
                echo json_encode($a, JSON_FORCE_OBJECT) ;
                }
                else
                {
                   $d='notfound';
                   header('Content-Type: application/json');
                   echo json_encode($d, JSON_FORCE_OBJECT) ;
                   
                }
                
            }
            if(isset($_GET['pseudo'])){
                
                $q=array();
                $psd=$_GET['pseudo'] ;
                $q['fields']='pseudo';
                $q['conditions']=array('pseudo'=>$psd);
                
                $this->loadModel('User');
                $a=$this->User->find($q);
                if(isset($a)&&!empty($a)){
                    $res='used';
                    echo $res;
                }
                else
                {
                   echo "notfound" ;
                }
                
            }  
    }
    
   
}
?>