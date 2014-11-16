<?php $title_for_layout = $tv['cpa_title_password']; ?>
<?php $role=$this->Session->User('role') ;?>
<ul class="nav nav-tabs" id="myj">
     
            <li><a href="<?php echo Router::url('params/index'); ?>" class="active"><?php echo $tv['cpa_general'] ;?></a></li>
            <li><a href="<?php echo Router::url('params/notification'); ?>"><?php echo $tv['cpa_notification'] ;?></a></li>
            <li><a href="<?php echo Router::url('params/privacy'); ?>"><?php echo $tv['cpa_privacy'] ;?></a></li>
            <?php  if(isset($role)&&($role==3)):?>
            <li><a href="<?php echo Router::url('params/filter'); ?>"><?php echo $tv['cpa_filter'] ;?></a></li>
            <?php endif ;?>
            <!--  <li class="well"><a href="#secu">SECURITY</a></li>
            <li class="well"><a href="#paym">PAYMENT</a></li> -->
          <li class="active"><a href="#password"><?php echo $tv['cpa_password'] ;?></a></li>
</ul>
    
<div class="row">
    
  

<div class="col-md-12">


<div class="page-header">
	<h2><?php echo $tv['cpa_editpassword'] ;?></h2>
</div>	

<?php echo $this->Form->create(array('style'=>'hoz','id'=>'form_1','action'=>'params/password'),true, ' PASWne') ;?>

    <fieldset>
      
<?php echo $this->Form->input('password',$tv['cpa_enterpassword'],array('type'=>'password')); ?> 
<?php echo $this->Form->input('new_password',$tv['cpa_enternewpassword'],array('type'=>'password')); ?> 
<?php echo $this->Form->input('conf_password2',$tv['cpa_confirmpassword'],array('type'=>'password')); ?> 
        
        <div class="actions">
		<input type="submit" class="btn primary" value="<?php echo $tv['g_modify'] ;?>">
	</div> 
        
        </fieldset>
</form>

</div>
    </div>