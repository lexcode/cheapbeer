<?php
class Invited extends Model{
	 public function __construct(){
          parent::__construct();
          
          $this->lang=trim(loadLang());
         // require LANG.DS.$this->lang.DS.'model_invited.php';
          
          $this->validate=array(	
                'invit' => array(
                            'regex' => array('rule' => '([0-9]{1,11})',
                                             'message' => "first name n'est pas valide"),
                           
                           'empty' => 'empty'
			
		));
         }
         
         public function nsave($data){
		
		$fields =  array();
		$d = array(); 
                
		foreach($data as $k=>$v){
                        $v=htmlspecialchars($v) ;
			
				$fields[] = "$k=:$k";
				$d[":$k"] = $v; 
			
		}
		
			$sql = 'INSERT INTO inviteds SET '.implode(',',$fields);
			$action = 'insert'; 
		
		$pre = $this->db->prepare($sql); 
                
                  //  echo $sql ; die();
                $pre->execute($d);
		if($action == 'insert'){
			$this->id = $this->db->lastInsertId(); 
		}
	}



}