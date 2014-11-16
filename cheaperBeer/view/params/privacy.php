<?php $title_for_layout = $tv['cpa_title_privacy']; ?>
<?php $role=$this->Session->User('role') ;?>
         <ul class="nav nav-tabs" id="myj">
     
  <li><a href="<?php echo Router::url('params/index'); ?>"><?php echo $tv['cpa_general'] ;?></a></li>
            <li><a href="<?php echo Router::url('params/notification'); ?>"><?php echo $tv['cpa_notification'] ;?></a></li>
            <li class="active"><a href="<?php echo Router::url('params/privacy'); ?>"><?php echo $tv['cpa_privacy'] ;?></a></li>
            <?php  if(isset($role)&&($role==3)):?>
            <li><a href="<?php echo Router::url('params/premium'); ?>"><?php echo $tv['cpa_filter'] ;?></a></li>
            <?php endif ;?>
            <!--  <li class="well"><a href="#secu">SECURITY</a></li>
            <li class="well"><a href="#paym">PAYMENT</a></li> -->
</ul>
<div class="row">
 

<div class="col-md-7">


<div class="page-header">
	<h2><?php echo $tv['cpa_editprivacy'] ;?></h2>
</div>
<?php $priv_opt=array(0=>'  <i class="icon-warning-sign"></i>',
                      1=>'  <i class="icon-user"></i>',
                      2=>'  <i class="icon-user"></i><i class="icon-ok-sign"></i>',
                      3=>'  <i class="icon-user"></i><i class="icon-star"></i>',
                      4=>'  <i class="icon-user"></i><i class="icon-star"></i><i class="icon-ok-sign"></i>') ;?>
<?php echo $this->Form->create(array('style'=>'inline','id'=>'form_1','action'=>'params/privacy'),true, 'DoN@tienne') ;?>

    <fieldset>
      
   <?php   
          $html='';
          $classError='';
          $label=array('prof_view'=>$tv['cpa_view_me'] , 'prof_msg'=>$tv['cpa_message_me'],'prof_comm'=>$tv['cpa_comment_me'] , 'prof_cam'=>$tv['cpa_cam_me'] );
          foreach($priv as $x=>$z){
          $i=0;
            $html.= '<div class="form-group'.$classError.'">
					<label class="control-label" for="input'.$x.'">'.$label[$x].'</label>
					<div class="controls">';
           foreach($priv_opt as $k=>$v){
                        $html .= '  <input type="radio" id="input_'.$k.'" name="'.$x.'" value="'.$k.'"'.($i==$z?'checked':'').'>
                                 <label for="input_'.$k.'">   '.$v.'   </label>';
                        $i++;
                    }
                    $html.='</div></div>' ;
         }
   
   echo $html ;
                    ?>     
        <div class="actions">
		<input type="submit" class="btn primary" value="<?php echo $tv['g_update'] ;?>">
	</div> 
        
        </fieldset>
</form>

</div>
    </div>