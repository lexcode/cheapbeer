<?php
class Iplocation extends Model{
    public function ip2contry($ip){
        $iplong=ip2long($ip);
        $sql='SELECT contry , MIN(`ip_end`-`ip_start`) as spre  FROM `iplocations` WHERE `ip_start`<'.$iplong.' AND `ip_end`>'.$iplong.'  ';
    
        $pre = $this->db->prepare($sql); 
            
		$pre->execute(); 
		return current($pre->fetchAll(PDO::FETCH_ASSOC));
        
    }
}