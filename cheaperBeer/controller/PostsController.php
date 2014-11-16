<?php 
class PostsController extends Controller{
	
 public $access = array('privacy','contact', 'term','about');
	
        function about(){
            
        }
        
        function term(){
        }
        function privacy(){
            
        }
        function contact(){
            
        }
        function admin_index(){
            
        }
        
        /*
         * List of clients 
         */
        function admin_client(){
        
        $d=array();

        $this->LoadModel('Client');
        $d['clients']=$this->Client->find();

        $this->set($d);
        }
        
               
        function  admin_viewclient($id){
            $d=array();
            
            //$id=13;
             if(isset($id)&&($id!='')){
              $this->loadModel('Client');
            $d['client'] = $this->Client->findFirst(array('conditions'=>array('id'=>$id)));
            
            $this->loadModel('Job');
            $job=$this->Job->find(array('conditions'=>array('id_client'=>$id)));
                 
            $this->loadModel('Joblist');
            foreach($job as $k=>$v){
             $d['joblist'][$v->id]=$this->Joblist->find(array('conditions'=>array('id_client'=>$id,'id_job'=>$v->id)));
               
            }
            
            $this->loadModel('File');
            $d['files_list']=$this->File->find(array('conditions'=>array('id_client'=>$id)));
          // partie message  
            $this->loadModel('Message');
         $d['uid'] =$id;
         $condition='';
        
         $condition = 'id_my='.$id.' OR id_other='.$id ; 
        
        $tot = $this->Message->findCount($condition);
        $perPage=50;
       $d['page'] = ceil($tot / $perPage);
       if($d['page']>0){
        if($this->request->page<1||$this->request->page>$d['page']){$this->request->page=$d['page'];}
        
        $d['messages'] = $this->Message->find(array(
            'fields'=> ' id ,id_my,id_other,message, created , wtalk',
            'conditions' => $condition,
            'order' => 'created ASC', 
            //'limit' => ($perPage * ($this->request->page - 1)) . ',' . $perPage,
                ));
             
        if($this->request->page==$d['page']){
            $d['rqp']=2;}
            else{$d['rqp']=0;}
        
       }
       $rst=fmod($tot,$perPage);
     // print_r($tot);
        //print_r($d['messages']) ;
        if($rst-1>=0&&isset($d['messages'][$rst-1]->id)){
         $d['lid']=$d['messages'][$rst-1]->id;  
       }else{
          $d['lid']=1; 
       }
        
        if(!empty($job)){$d['job']=$job;}
        //debug($d) ; die() ;
        $this->set($d);   
             }     
            
        }
        
        
        function admin_job(){
            $d=array();

        $this->LoadModel('Job');
        $d['jobs']=$this->Job->find();
        
        $this->LoadModel('Joblist');
        $d['jobitems']=$this->Joblist->find();
        $this->set($d);
        }
        
        
        function admin_viewjob($id){
                $d=array();

        $this->LoadModel('Job');
        $d['jobs']=$this->Job->find(array('conditions'=>array('id'=>$id)));
        
        $this->LoadModel('Joblist');
        $d['jobitems']=$this->Joblist->find(array('conditions'=>array('id_job'=>$id)));
        $this->set($d);
        
        $this->LoadModel('File');
        $d['files']=$this->File->find(array('conditions'=>array('id_jobs'=>$id)));
        $this->set($d);
        }
        
        
        function admin_file(){
            $d=array();

        $this->LoadModel('File');
        $d['files']=$this->File->find();
        ;
        $this->set($d);
        }
        
        
        function admin_urgent(){
            $d=array();

        $this->LoadModel('Client');
        $d['priorities']=$this->Client->find();

        $this->set($d);
        }
        
        function admin_message(){
            $d=array();

        $this->LoadModel('Message');
        $d['messages']=$this->Message->find();

        $this->set($d);
        }
        function admin_finance(){
            $d=array();

        $this->LoadModel('Payment');
        $d['payments']=$this->Payment->find();

        $this->set($d);
        }

}