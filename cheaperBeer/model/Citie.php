<?php

class Citie extends Model{

 
    function near($lat,$lng,$req=array()){
        if(is_numeric($lat)&&($lat<=90)&&($lat>=-90)&&is_numeric($lng)&&($lng<=180)&&($lng>=-180)){
            
		$sql = "SELECT disPts($lat,$lng,latitude,longitude) as dist ,  ";

		if(isset($req['fields'])){
			if(is_array($req['fields'])){
				$sql .= ' , '.implode(', ',$req['fields']);
			}else{
				$sql .= ' , '.$req['fields']; 
			}
		}else{
                    $sql .= 'id ,city ,accity, contry , region , population , latitude , longitude  ';
                }

		$sql .= ' FROM '.$this->table.' as '.get_class($this).' ';


		// Construction de la condition
		if(isset($req['conditions'])){
			$sql .= 'WHERE '; 
			if(!is_array($req['conditions'])){
				$sql .= $req['conditions']; 
                                
			}else{
				$cond = array(); 
                                
				foreach($req['conditions'] as $k=>$v){
					if(!is_numeric($v)){
						$v = '"'.mysql_escape_string($v).'"'; 
					}
					
					$cond[] = "$k=$v";
				}
				$sql .= implode(' AND ',$cond);
			}

		}
                if(isset($req['spread'])){
                    if(isset($req['conditions'])){
                      $sql .=" AND latitude < ".($lat+$req['spread'])." AND latitude> ".
                              ($lat-$req['spread'])." AND longitude> ".($lng-$req['spread']).
                              " AND longitude < ".($lng+$req['spread']);  
                    }else{
                        $sql .=" WHERE latitude < ".($lat+$req['spread'])." AND latitude> ".
                              ($lat-$req['spread'])." AND longitude> ".($lng-$req['spread']).
                              " AND longitude < ".($lng+$req['spread']); 
                    }
                    
                }
                
                if(isset($req['dist'])&&is_numeric($req['dist'])&&($req['dist']>0)){
                    $d=$req['dist'];
                    if(isset($req['conditions'])||isset($req['spread'])){
                        
                      $sql .=" AND disPts($lat,$lng,latitude,longitude) <= $d";  
                    }else{
                        $sql .=" WHERE disPts($lat,$lng,latitude,longitude) <= $d"; 
                    }
                }
                // Construction de la condition or
		if(isset($req['or'])){
			$sql .= ' AND ( ';
			if(!is_array($req['or'])){
				$sql .= $req['or'].')'; 
                                
			}else{
				$or = array(); 
                                
				foreach($req['or'] as $k=>$v){
					if(!is_numeric($v)){
						$v = '"'.mysql_escape_string($v).'"'; 
					}
					
					$or[] = "$k=$v";
				}
				$sql .= implode(' OR ',$or);
			}
                           $sql .=' ) ';
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
                
               
               // echo $sql ;
		$pre = $this->db->prepare($sql); 
            
		$pre->execute(); 
		return $pre->fetchAll(PDO::FETCH_OBJ);
	}
        
        }
        
        
        public function like($req = array()){
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

		

		// Construction de la condition
		if(isset($req['conditions'])){
			$sql .= 'WHERE ';
			if(!is_array($req['conditions'])){
				$sql .= $req['conditions']; 
                                
			}else{
				$cond = array(); 
                                
				foreach($req['conditions'] as $k=>$v){
					if(!is_numeric($v)){
                                                 $v=trim($v);
						//$v = '"'.mysql_escape_string($v).'"'; 
					}
					
					$cond[] = "$k LIKE \"$v%\"";
				}
				$sql .= implode(' OR ',$cond);
			}

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
                
               
                //echo $sql ;
		$pre = $this->db->prepare($sql); 
            
		$pre->execute(); 
		return $pre->fetchAll(PDO::FETCH_OBJ);
	}

        

}
?>
