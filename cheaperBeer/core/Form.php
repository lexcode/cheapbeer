<?php
class Form{
	
	public $controller; 
	public $errors; 

	public function __construct($controller){
		$this->request = $controller; 
               
               
	}
        
        
        public function create($options = array(),$verified_token=false,$fixed_flag="default",$distinct_flag=null){
           
           
            $style='';
            $m='POST';
            
            $html='<form role="form" ';
            $action=$this->request->url;
            if(isset($options)&&is_array($options)&&!empty($options)){
            if(isset($options['style'])){
                if($options['style']=='inline'){
                    $style='form-inline';
                }
                if($options['style']=='hoz'){
                    $style='form-horizontal';
                }
                else{
                   
                    $style= $options['style'] ;
                }
               }
               if($style!=''){
                   $html.='class="'.$style.'" ';
               }
               if(isset($options['marge'])&&($options['marge']=='bottom')){
                    $html.=' style="margin-bottom:20px;" ';
                }
               
             if(isset($options['method'])){
                if($options['method']==('get'||'GET'||'G'||'g')){
                    $m='GET';
                }
                if($options['method']==('post'||'POST'||'P'||'p')){
                    $m='POST';
                }
               }
               $html.='method="'.$m.'" ';
             if(isset($options['action'])&&is_array($options['action'])&&!empty($options['action'])){
                 $cont='';
                 $act='';
                 $param='';
                 if(isset($options['action']['controller'])){
                    $cont=$options['action']['controller'];
                }else{
                    $cont=$this->request->controller;
                }
                 if(isset($options['action']['action'])){
                    $act=$options['action']['action'];
                }else{
                    $act=$this->request->action;
                }
                if(isset($options['action']['param'])&&!is_array($options['action']['param'])){
                    $param=$options['action']['param'];
                }elseif(isset($options['action']['param'])&&is_array($options['action']['param'])){
                    $p=array();
                    $p=array_values($options['action']['param']);
                    $param=implode('/',$p);
                }
                if($param!=''){
                  $action=$cont.'/'.$act.'/'.$param ;  
                }else{
                  $action=$cont.'/'.$act ;
                }
                
               }
               elseif(isset($options['action'])&&!is_array($options['action'])&&($options['action']!='')){
                $action= $options['action'];
                $param='';
                if(isset($options['param'])&&!is_array($options['param'])){
                    $param=$options['param'];
                }elseif(isset($options['param'])&&is_array($options['param'])){
                    $p=array();
                    $p=array_values($options['param']);
                    $param=implode('/',$p);
                }
                if($param!=''){
                  $action.=$param ;  
                }
               }
               $html.='action="'.Router::url($action).'" ';
               
               if(isset($options['id'])&&($options['id']!='')){
                $html.='id="'.$options['id'].'"' ;
               }
               if(isset($options['file'])&&($options['file']!='')){
                $html.='enctype="multipart/form-data"' ;
               }
               $html.=' >';
            }else{
              
               $html.=' action="'.Router::url($action).'" method="'.$m.'">';
             
            }
            
            if(isset($verified_token)&&($verified_token==true)&&empty($_SERVER['HTTP_X_REQUESTED_WITH']) ){
                
                $mdp='poj';
                if(isset($distinct_flag)&&is_string($distinct_flag)){
                 
                $shaf=hash('md5','4821##@'.rand(60000,90000).'dfde'.date('Y-m-d h:i:00').'d84#64S');
                
                $_SESSION['toksur'.$distinct_flag]=$shaf;
                
              
              // $this->Sess->write('toksur'.$distinct_flag,$shaf);
                if(isset($fixed_flag)){
                 $mdp=hash('md5','587NFJF@SFFD'.$fixed_flag.'85#__.5sfDJ@@'.date('Y-m-d h:i:00').'d5dsfFDS');
                   
                     $_SESSION['tokket'.$distinct_flag]=$mdp;
                }else{
                    $mdp=hash('md5','58shj##@'.rand(60000,9000000).date('Y-m-d h:i:00').'d_.@fF864S');
                    
                    $_SESSION['tokket'.$distinct_flag]=$mdp;
                }
                $html.='
                    <input type="hidden" name="tokken" value="'.$shaf.'">
                    <input type="hidden" name="kentok" value="'.$mdp.'">
                        ';  
                }else{
                    $mdp='tok';
                $sha=hash('md5','4821##@'.rand(60000,9000000000).'dfde'.date('Y-m-d h:i:00').'d84#64S');
                    $_SESSION['toksur']=$sha;
                    
                if(isset($fixed_flag)){
                 $mdp=hash('md5','587NFJF@SFFD'.$fixed_flag.'85#__.5sfDJ@@'.date('Y-m-d h:i:00').'d5dsfFDS');
                   
                     $_SESSION['tokket']=$mdp;
                }else{
                    $mdp=hash('md5','58shj##@'.rand(60000,9000000000).date('Y-m-d h:i:00').'d_.@fF864S');
                    
                    $_SESSION['tokket']=$mdp;
                }
                $html.='
                    <input type="hidden" name="tokken" value="'.$sha.'">
                    <input type="hidden" name="kentok" value="'.$mdp.'">
                        ';
                }
                
            }
            
            
            return $html ;
            
            
        }
        	public function inputfile($name,$label,$options = array()){
		$error = false; 
		$classError = ''; 
		if(isset($this->errors[$name])){
			$error = $this->errors[$name];
			$classError = ' error'; 
		}
		if(!isset($this->request->data->$name)){
			$value = ''; 
		}else{
			$value = $this->request->data->$name; 
		}
		
		$html = '<span class="file-wrapper">';
		$attr = ' '; 
		foreach($options as $k=>$v){ if($k!='type'){
			$attr .= " $k=\"$v\""; 
		}}
		if($options['type'] == 'file'){
			$html .= '<input type="file" class="input-file" id="input'.$name.'" name="'.$name.'"'.$attr.'>';
		}elseif($options['type'] == 'file_multiple'){
			$html .= '<input type="file" class="input-file" id="input'.$name.'[]" name="'.$name.'[]" multiple="multiple"'.$attr.'>';
		}
                $html .= '<span class="btn  btn-large btn-info">'.$label.' <i class="icon-paperclip"></i></span>';
		if($error){
			$html .= '<span class="help-inline">'.$error.'</span>';
		}
		$html .= '</span>';
		return $html; 
	}
        
        
	public function input($name,$label,$options = array()){
		$error = false; 
		$classError = ''; 
		if(isset($this->errors[$name])){
			$error = $this->errors[$name];
			$classError = ' error'; 
		}
		if(!isset($this->request->data->$name)){
			$value = ''; 
		}else{
			$value = $this->request->data->$name; 
		}
		if($label == 'hidden'){
			return '<input type="hidden" name="'.$name.'" value="'.$value.'">'; 
		}
		$html = '<div class="form-group'.$classError.'">
					<label class="col-lg-2 control-label" for="input'.$name.'">'.$label.'</label>
					<div class="col-lg-10">';
		$attr = ' '; 
		foreach($options as $k=>$v){ if($k!='type'){
			$attr .= " $k=\"$v\""; 
		}}
		if(!isset($options['type']) && !isset($options['options'])){
			$html .= '<input type="text"  class="input-large form-control" id="input'.$name.'" name="'.$name.'" value="'.$value.'"'.$attr.'>';
		}elseif(isset($options['options'])){
			$html .= '<select id="input'.$name.'" name="'.$name.'"'.$attr.' class="input-large form-control" >';
			foreach($options['options'] as $k=>$v){
				$html .= '<option value="'.$k.'" '.($k==$value?'selected':'').'>'.$v.'</option>'; 
			}
			$html .= '</select>'; 
		}elseif($options['type'] == 'textarea'){
			$html .= '<textarea  class="input-large form-control" id="input'.$name.'" name="'.$name.'"'.$attr.'>'.$value.'</textarea>';
		}elseif($options['type'] == 'checkbox'){
			$html .= '<input type="hidden" name="'.$name.'" value="0"><input type="checkbox" name="'.$name.'" value="1" '.(empty($value)?'':'checked').'>'; 
		}elseif($options['type'] == 'file'){
			$html .= '<input type="file" class="input-file" id="input'.$name.'" name="'.$name.'"'.$attr.'>';
		}elseif($options['type'] == 'file_multiple'){
			$html .= '<input type="file" class="input-file" id="input'.$name.'[]" name="'.$name.'[]" multiple="multiple"'.$attr.'>';
		}elseif($options['type'] == 'password'){
			$html .= '<input type="password" id="input'.$name.'" name="'.$name.'" value="'.$value.'"'.$attr.' class="input-large form-control" >';
		}
                elseif($options['type'] == 'date'){
			$html .= '<input type="date" id="input'.$name.'" name="'.$name.'" '.(isset($options['min'])?' min="'.$options['min'].'"':' ').(isset($options['step'])?' step="'.$options['step'].'"':' ').$attr.'>';
		}
                elseif($options['type'] == 'time'){
			$html .= '<input type="time" id="input'.$name.'" name="'.$name.'" '.(isset($options['min'])?' min="'.$options['min'].'"':' ').(isset($options['step'])?' step="'.$options['step'].'"':' ').$attr.'>';
		}
                elseif($options['type'] == 'radio'){
                    foreach($options['option'] as $k=>$v){
                        $html .= '<input type="radio" id="input_'.$k.'" name="'.$name.'" value="'.$k.'"'.$attr.'>
                                 <label for="input_'.$k.'">'.$v.'</label>';
                    }
                    
			
		}
		if($error){
			$html .= '<span class="help-inline">'.$error.'</span>';
		}
		$html .= '</div></div>';
		return $html; 
	}

        

        
         public function input3($name,$label,$options = array()){
		$error = false; 
		$classError = ''; 
		if(isset($this->errors[$name])){
			$error = $this->errors[$name];
			$classError = ' error'; 
		}
		if(!isset($this->request->data->$name)){
			$value = ''; 
		}else{
			$value = $this->request->data->$name; 
		}
		if($label == 'hidden'){
			return '<input type="hidden" name="'.$name.'" value="'.$value.'">'; 
		}
                if($label == 'hiddened'){
			return '<input type="hidden" name="ed" value="61">'; 
		}
		$html = '<div class="form-group '.$classError.'" >
					<label class="control-label col-lg-2" for="input'.$name.'">'.$label.'</label>
					<div class="col-lg-10 ">';
		$attr = ' '; 
		foreach($options as $k=>$v){ if($k!='type'){
			$attr .= " $k=\"$v\""; 
		}}
		if(!isset($options['type']) && !isset($options['options'])){
			$html .= '<input type="text"  class="form-control" id="input'.$name.'" name="'.$name.'" value="'.$value.'"'.$attr.'>';
		}elseif(isset($options['options'])){
			$n=1;
			foreach($options['options'] as $k=>$v){
                            if($k!=-1){
	                     $o=$name.'@'.$n ;
                            
                           if(!isset($this->request->data->$o)){
			$value = ''; 
		}else{
			$value = $this->request->data->$o; 
		}     
                                
                                
                        $html .= '<label class="checkbox">';
			$html .= '<input type="hidden" name="'.$name.'@'.$n.'" value="0"><input type="checkbox" name="'.$name.'@'.$n.'" value="'.$k.'" '.(empty($value)?'':'checked').'>'.$v.'<br></label>'; 
                   $n++;
                        }
                    
                    }
                        
                        
                }
		if($error){
			$html .= '<span class="help-inline">'.$error.'</span>';
		}
               
                $html .= '</div></div>';
		return $html; 
	}

        
                 public function input32($name,$label,$options = array()){
		$error = false; 
		$classError = ''; 
		if(isset($this->errors[$name])){
			$error = $this->errors[$name];
			$classError = ' error'; 
		}
		if(!isset($this->request->data->$name)){
			$value = ''; 
		}else{
			$value = $this->request->data->$name; 
		}
		if($label == 'hidden'){
			return '<input type="hidden" name="'.$name.'" value="'.$value.'">'; 
		}
		$html = '<div class="form-group'.$classError.'">
					<label class="control-label" for="input'.$name.'">'.$label.'</label>
					<div class="controls">';
		$attr = ' '; 
		foreach($options as $k=>$v){ if($k!='type'){
			$attr .= " $k=\"$v\""; 
		}}
		if(!isset($options['type']) && !isset($options['options'])){
			$html .= '<input type="text"  class="form-control" id="input'.$name.'" name="'.$name.'" value="'.$value.'"'.$attr.'>';
		}elseif(isset($options['options'])){
			$n=0;
			foreach($options['options'] as $k=>$v){
                            if($k!=-1){
	                     $o=$name.'['.$n.']' ;
                            
                           if(!isset($this->request->data->$o)){
			$value = ''; 
		}else{
			$value = $this->request->data->$o; 
		}     
                                
                                
                        $html .= '<label class="checkbox">';
			$html .= '<input type="checkbox" name="'.$name.'['.$n.']" value="'.$k.'" '.(empty($value)?'':'checked').'>'.$v.'<br></label>'; 
                   $n++;
                        }
                    
                    }
                        
                        
                }
		if($error){
			$html .= '<span class="help-inline">'.$error.'</span>';
		}
               
                $html .= '</div></div>';
		return $html; 
	}
        
        public function input4($name,$label,$options = array()){
		$error = false; 
		$classError = ''; 
		if(isset($this->errors[$name])){
			$error = $this->errors[$name];
			$classError = ' error'; 
		}
		if(!isset($this->request->data->$name)){
			$value = ''; 
		}else{
			$value = $this->request->data->$name; 
		}
		if($label == 'hidden'){
			return '<input type="hidden" name="'.$name.'" value="'.$value.'">'; 
		}
		$html = '<div class="form-group'.$classError.'">
					<label class="btn btn-success control-label" for="input'.$name.'" id="'.$name.'">'.$label.'</label>
					<div class="controls" id="'.$name.'-options" style="display:none;">';
		$attr = ' '; 
		foreach($options as $k=>$v){ if($k!='type'){
			$attr .= " $k=\"$v\""; 
		}}
		if(!isset($options['type']) && !isset($options['options'])){
			$html .= '<input type="text"  class="form-control" id="input'.$name.'" name="'.$name.'" value="'.$value.'"'.$attr.'>';
		}elseif(isset($options['options'])){
			$n=1;
			foreach($options['options'] as $k=>$v){
                            if($k!=-1){
                                $nm=$name.$n;
                                if(!isset($this->request->data->$nm)){
			$value = ''; 
		}else{
			$value = $this->request->data->$nm ; 
		}
	
                        $html .= '<label class="checkbox">';
			$html .= '<input type="checkbox" name="'.$name.$n.'" value="1" '.(empty($value)?'':'checked').'>'.$v.'<br></label>'; 
                   $n++;
                        }
                    
                    }
                        
                        
                }
		if($error){
			$html .= '<span class="help-inline">'.$error.'</span>';
		}
                //if(isset($options['inline'])&&(($options['inline'] == 'start')||($options['inline'] == 'in')))
		//{$html .= '';}
                //else{$html .= '</div></div>';}
                $html .= '</div></div>';
		return $html; 
	}
        

        
              public function input6($name,$label,$options = array()){
                  $ar=array();
		$error = false; 
		$classError = ''; 
		if(isset($this->errors[$name])){
			$error = $this->errors[$name];
			$classError = ' error'; 
		}
		if(!isset($this->request->data->$name)){
			$value = ''; 
		}else{
			$value = $this->request->data->$name; 
		}
		if($label == 'hidden'){
			return '<input type="hidden" name="'.$name.'" value="'.$value.'">'; 
		}
		$html = '<div class="form-group'.$classError.'">
					<label class="control-label" for="input'.$name.'">'.$label.'</label>
					<div class="controls">
                                        <input type="hidden" name="'.$name.'[0]" value="0">';
		$attr = ' '; 
		foreach($options as $k=>$v){ if($k!='type'){
			$attr .= " $k=\"$v\""; 
		}}
		if(!isset($options['type']) && !isset($options['options'])){
			$html .= '<input type="text" class="form-control" id="input'.$name.'" name="'.$name.'" value="'.$value.'"'.$attr.'>';
		}elseif(isset($options['options'])){
			$n=1;
                        if(isset($this->request->data->$name)){
                            if(is_array($this->request->data->$name)){
                                $ar=$this->request->data->$name;
                            }else{
                                  $ar=explode(',',$this->request->data->$name);
                            }
                             }
                               
			foreach($options['options'] as $k=>$v){
                            if($k!=-1){
	                    
                           if(in_array($k,$ar)){
                                  
                                  $value=true;
                               }else{
                                   
			$value = false; 
		}    
                                
                                
                        $html .= '<label class="checkbox">';
			$html .= '<input type="checkbox" name="'.$name.'['.$n.']" value="'.$k.'" '.(($value==false)?'':'checked').'>'.$v.'<br></label>'; 
                   $n++;
                        }
                    
                    }
                        
                        
                }
		if($error){
			$html .= '<span class="help-inline">'.$error.'</span>';
		}
               
                $html .= '</div></div>';
		return $html; 
	}
        
        private function generate_token(){
            
            return $token ;
        }
}