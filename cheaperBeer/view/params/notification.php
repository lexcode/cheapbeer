<?php $title_for_layout = $tv['cpa_title_notification']; ?>
<?php $role=$this->Session->User('role') ;?>
         <ul class="nav nav-tabs" id="myj">
     
  <li><a href="<?php echo Router::url('params/index'); ?>"><?php echo $tv['cpa_general'] ;?></a></li>
            <li class="active"><a href="<?php echo Router::url('params/notification'); ?>"><?php echo $tv['cpa_notification'] ;?></a></li>
            <li><a href="<?php echo Router::url('params/privacy'); ?>"><?php echo $tv['cpa_privacy'] ;?></a></li>
            <?php  if(isset($role)&&($role==3)):?>
            <li><a href="<?php echo Router::url('params/premium'); ?>"><?php echo $tv['cpa_filter'] ;?></a></li>
            <?php endif ;?>
            <!--  <li class="well"><a href="#secu">SECURITY</a></li>
            <li class="well"><a href="#paym">PAYMENT</a></li> -->
</ul>
<div class="row">


<div class="col-md-12">


<div class="page-header">
	<h2><?php echo $tv['cpa_editnotification'] ; ?></h2>
</div>

<?php echo $this->Form->create(array('style'=>'hoz','id'=>'form_1','action'=>'params/notification'),true, 'DoN@tienne') ;?>

    <fieldset>
<?php echo $this->Form->input('noti_msg',$tv['cpa_when_newmessage'],array('type'=>'checkbox')); ?> 
<?php echo $this->Form->input('noti_visit',$tv['cpa_when_newvisite'],array('type'=>'checkbox')); ?> 
<?php echo $this->Form->input('noti_favorite',$tv['cpa_when_like'],array('type'=>'checkbox')); ?> 
<?php echo $this->Form->input('noti_mut_attrac',$tv['cpa_when_mutualattraction'],array('type'=>'checkbox')); ?>
<?php echo $this->Form->input('noti_ask_friend',$tv['cpa_when_friendrequest'],array('type'=>'checkbox')); ?> 
<?php echo $this->Form->input('noti_friend_accepted',$tv['cpa_when_friendaccept'],array('type'=>'checkbox')); ?> 
<?php echo $this->Form->input('noti_recommended',$tv['cpa_when_recommended'],array('type'=>'checkbox')); ?> 
<?php echo $this->Form->input('noti_invit',$tv['cpa_when_invitation'],array('type'=>'checkbox')); ?> 
<?php echo $this->Form->input('noti_publi_gep',$tv['cpa_when_publication'],array('type'=>'checkbox')); ?> 
<?php echo $this->Form->input('noti_important',$tv['cpa_when_atttunenews'],array('type'=>'checkbox')); ?> 
        <div class="actions">
		<input type="submit" class="btn primary" value="<?php echo $tv['g_update'] ; ?>">
	</div> 
        
        </fieldset>
</form>

</div>
    </div>