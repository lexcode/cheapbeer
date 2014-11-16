<?php
class Model{
	
	static $connections = array(); 

	public $conf = 'default';
	public $table = false; 
	public $db; 
	public $primaryKey = 'id'; 
	public $id; 
	public $errors = array();
	public $form; 
	public $validate = array();

	/**
	* Permet d'initialiser les variable du Model
	**/
	public function __construct(){
		// Nom de la table
		if($this->table === false){
			$this->table = strtolower(get_class($this)).'s'; 
		}
		
		// Connection à la base ou récupération de la précédente connection
		$conf = Conf::$databases[$this->conf];
		if(isset(Model::$connections[$this->conf])){
			$this->db = Model::$connections[$this->conf];
			return true; 
		}
		try{
			$pdo = new PDO(
				'mysql:host='.$conf['host'].';dbname='.$conf['database'].';',
				$conf['login'],
				$conf['password'],
				array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')
			);
			$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);

			Model::$connections[$this->conf] = $pdo; 
			$this->db = $pdo; 
		}catch(PDOException $e){
			if(Conf::$debug >= 1){
				die($e->getMessage()); 
			}else{
				die('Impossible de se connecter à la base de donnée'); 
			}
		}	 
	}

	/**
	* Permet de valider des données
	* @param $data données à valider 
	**/

        
         public function verify($data,$whitelist,$timer=null,$flag=null,$reqr=array()){
            
            //debug($_SESSION) ; 
            
            $errors = array(); 
                        
                        if(in_array('kentok', $whitelist)){
                        $sha=filter_var($data->kentok, FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => "/^[a-z0-9]+$/")));
                        $lng=strlen($sha);
                        $sha2=filter_var($data->tokken, FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => "/^[a-z0-9]+$/")));
                        $lng2=strlen($sha2);
                        //echo $lng ; die();
                        if(!isset($data->kentok)||!$sha||($lng!=32)||!isset($data->tokken)||!$sha2||($lng2!=32)){
                            // debug('$condition test kentok et tokken => false') ; die() ;
                            return false ;          
                           }
                        }
                        if(isset($reqr)&&!empty($reqr)){
                          $key_tab=array_keys($data);
                        foreach($reqr as $v){
                            if(!in_array($v,$key_tab)){
                            //    debug('$cas reqs ') ; die() ;
                                return false ;
                            }
                        }  
                        }
                        
            		foreach($data as $k=>$v){
                           if(!in_array($k, $whitelist))
                           {
                          //     debug('data '.$k.' not in whitelist') ; die() ;
                               return false  ;      
                                
                           }
                           else
                           {
                if($k=='tokken'){
                            $valide=false ;
                            if(isset($flag)){
                               
                               if($_SESSION['toksur'.$flag]==$data->tokken){
                                   $valide=true ;}
                                   else{
                                  //     debug('hi'); die();
                                      $valide=false ;
                                   }
                            }else{
                              if($_SESSION['toksur']==$data->tokken){$valide=true;}
                              else{
                                  $valide=false ; 
                                  }  
                            }
                              
                                 
                            if($valide==false){
                                return false;
                            }
                               
                                
                               }
                       elseif($k=='kentok')
                           {
                                 $valide=false ;
    
                            if(isset($timer)&&is_string($timer))
                                {
                                 for($i=-10;$i<=0;$i++)
                                    {
                                        if($data->kentok==hash('md5','587NFJF@SFFD'.$timer.'85#__.5sfDJ@@'.date('Y-m-d h:i:00',time()+ $i*60).'d5dsfFDS'))
                                            {$valide=true;}
                                     }               
                                 }
                                 else
                                 {  
                                     if(isset($flag)){
                                            if($_SESSION['tokket'.$flag]==$data->kentok)
                                               {$valide=true;}
                                            else
                                                {$valide=false ;}
                                     }else
                                     {      if($_SESSION['tokket']==$data->kentok)
                                               {$valide=true;}
                                            else
                                               {$valide=false ;}    
                                     }
                                  }
                                  
                            if($valide==false){ return false ;}
                          }

                    else{
                              $x=$this->validate[$k];
                                if(isset($this->Form->errors[$k]))
                                        {
                                        $errors[$k]=$this->Form->errors[$k];
                                        }
                                
				if(empty($data->$k))
                                        {
                                        if(isset($x['empty']))
                                            {
                                            $errors[$k] = $x['empty'];
                                            continue ;
                                            }
                                        }
                                if(is_array($data->$k))
                                        {
                                        if(isset($x['regex']))
                                            {
                                             $ar_val=$data->$k;
                                             $tab=true;
                                             
                                                foreach($ar_val as $lk=>$lv)
                                                    {
                                        if(!preg_match('/^'.$x['regex']['rule'].'$/',$lv))
                                                $tab=false;
                                    } 
                                    if($tab==false)$errors[$k] = $x['regex']['message'];
                                    }
                                    
                                }
                                else{
                                if((isset($x['regex']))&& (!preg_match('/^'.$x['regex']['rule'].'$/',$data->$k)) ){
                                    $errors[$k] = $x['regex']['message'];
                                }
                                if(isset($x['idem']) && (($data->$k)!=($data->$x['idem']['row']))){
                                    $errors[$k]= $x['idem']['message'];
                                    
                                    }
                               }  
                               
                               }
                           }               
                            
                                
                        }
                if(in_array('tokken',$whitelist)){
                unset($data->kentok);
                unset($data->tokken);
                }     
                      $this->errors = $errors; 
                      
		if(isset($this->Form)){
			$this->Form->errors = $errors; 
                         
		}
            //    debug($errors) ; die() ;
		if(empty($errors)){
                    
			return true;
		}
		return false;                                          
        }
        
  
        /**
	* Permet de récupérer plusieurs enregistrements
	* @param $req Tableau contenant les éléments de la requête
	**/
	public function find($req = array()){
		$sql = 'SELECT ';

		if(isset($req['fields'])){
			if(is_array($req['fields'])){
				$sql .= implode(', ',$req['fields']);
			}else{
				$sql .= $req['fields']; 
			}
		}else{
			$sql.='*';
		}

		$sql .= ' FROM '.$this->table.' as '.get_class($this).' ';

		// Liaison
		if(isset($req['join'])){
			foreach($req['join'] as $k=>$v){
				$sql .= 'LEFT JOIN '.$k.' ON '.$v.' '; 
			}
                      
		}
                
                if(isset($req['inner_join'])){
			foreach($req['inner_join'] as $k=>$v){
				$sql .= 'INNER JOIN '.$k.' ON '.$v.' '; 
			}
                        
		}
                 if(isset($req['inner_join2'])){
			foreach($req['inner_join2'] as $k=>$v){
				$sql .= ' INNER JOIN '.$k.' ON '.$v.' '; 
			}
                        
		}

		// Construction de la condition
		if(isset($req['conditions'])){
			$sql .= 'WHERE ';
			if(!is_array($req['conditions'])){
				$sql .= $req['conditions']; 
                                
			}else{
				$cond = array(); 
                                
				foreach($req['conditions'] as $k=>$v){
                                    if(!is_array($v)){
                                        if(!is_numeric($v)){
						$v = '"'.$v.'"'; 
					}
					
					$cond[] = "$k=$v";
                                    }else{
                                       $cond2 = array(); 
                                
				foreach($v as $oo=>$pp){
                                    
					$cond2[] = $pp;
                                   } 
                                   $cond[].= ' `'.$k.'` IN( '.implode(',',$cond2).' )';
                                    }
					
				}
				$sql .= implode(' AND ',$cond);
			}

		}
                // Construction de la condition or
		if(isset($req['or'])){
			$sql .= ' AND ( ';
			if(!is_array($req['or'])){
				$sql .= $req['or']; 
                                
			}else{
				$or = array(); 
                                
				foreach($req['or'] as $k=>$v){
					if(!is_numeric($v)){
						$v = '"'.$v.'"'; 
					}
					
					$or[] = "$k=$v";
				}
				$sql .= implode(' OR ',$or);
			}
                           $sql .=' ) ';
		}
                if(isset($req['diff'])){
			$sql .= ' AND ( ';
			if(!is_array($req['diff'])){
				$sql .= $req['diff']; 
                                
			}else{
				$or = array(); 
                                
				foreach($req['diff'] as $k=>$v){
					if(!is_numeric($v)){
						$v = '"'.$v.'"'; 
					}
					
					$or[] = "$k!=$v";
				}
				$sql .= implode(' OR ',$or);
			}
                           $sql .=' ) ';
		}
                
                if(isset($req['in']) && !empty($req['in'])){
                    if(isset($req['conditions']) && !empty($req['conditions'])){
                        $sql .= ' AND ';
                        
                        }else{
                            $sql .= 'WHERE ';
                            }
                            
			if(!is_array($req['in'])){
				$sql .= $req['in']; 
			}else{
				$in = array(); 
                               
				foreach($req['in'] as $k=>$v){
                                     $li = array(); 
                                     if($k=='type_set'){
                                         foreach($v as $l=>$m){
					$li[]=' FIND_IN_SET('.$m.',type_set) ' ;
				}
				$la=implode(' OR ',$li);
                                $la = '('.$la.')' ;
                                $in[]=$la ;
                                
                                     }
                                     else{
                                    foreach($v as $l=>$m){
					$li[]=$m ;
				}
				$la=implode(',',$li);
                                $la='('.$la.')';
                                $in[]=$k.' IN '.$la ;
                                }}
                                $sql .= implode(' AND ',$in);
			}
                         
		}
                 if(isset($req['tmp'])){
			$sql .= ' AND '.$req['tmp'];
		}
                if(isset($req['orend'])){
			$sql .= ' OR '.$req['orend'];
		}
                
                 if(isset($req['group'])){
			$sql .= ' GROUP BY '.$req['group'];
		}
                
		if(isset($req['order'])){
			$sql .= ' ORDER BY '.$req['order'];
		}


		if(isset($req['limit'])){
			$sql .= ' LIMIT '.$req['limit'];
		}
                
               
          //   echo $sql.'<br>' ;
		$pre = $this->db->prepare($sql); 
                
		$pre->execute(); 
		return $pre->fetchAll(PDO::FETCH_OBJ);
	}


	public function findFirst($req){
		return current($this->find($req)); 
	}

	/**
	* Récupère le nombre d'enregistrement
	**/
	public function findCount($conditions){
		$res = $this->findFirst(array(
			'fields' => 'COUNT('.$this->primaryKey.') as count',
			'conditions' => $conditions
			));
		return $res->count;  
	}

	
	/**
	* Permet de supprimer un enregistrement
	* @param $id ID de l'enregistrement à supprimer
	**/	
	public function delete($id){
		$sql = "DELETE FROM {$this->table} WHERE {$this->primaryKey} = $id";
		$this->db->query($sql); 
	}

        public function del($id){
                        
                        $sql = "UPDATE {$this->table} SET `archive`='1' WHERE {$this->primaryKey} = $id";
			$this->db->query($sql); 
	}

	/**
	* Permet de sauvegarder des données
	* @param $data Données à enregistrer
	**/
	public function save($data){
		$key = $this->primaryKey;
		$fields =  array();
		$d = array(); 
                
		foreach($data as $k=>$v){
                        $v=htmlspecialchars($v) ;
			if($k!=$this->primaryKey){
				$fields[] = "$k=:$k";
				$d[":$k"] = $v; 
			}elseif(!empty($v)){
				$d[":$k"] = $v; 
			}
		}
		if(isset($data->$key) && !empty($data->$key)){
			$sql = 'UPDATE '.$this->table.' SET '.implode(',',$fields).' WHERE '.$key.'=:'.$key;
			$this->id = $data->$key; 
			$action = 'update';
                        
		} else{
                   // debug($fields) ; die() ;
			$sql = 'INSERT INTO '.$this->table.' SET '.implode(',',$fields);
			$action = 'insert'; 
		}
                
               
		$pre = $this->db->prepare($sql); 
                
                 //  echo $sql ; die();
                $pre->execute($d);
		if($action == 'insert'){
			$this->id = $this->db->lastInsertId(); 
		}
	}
        
             
        
}