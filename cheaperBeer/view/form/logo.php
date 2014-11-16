
<?php echo $this->Form->create(array('style'=>'hoz','id'=>'loginF','action'=>'users/login'),true, 'DoN@ti','karate2') ;?>

<div id="logo_Modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="banner_Modal_title">banner </h3>
  </div>
   <div class="modal-body">
       
       <?php echo $this->Form->input('description',$tv['form_desc'],array('type'=>'textarea')) ;?>
       	<?php echo $this->Form->input('website',$tv['form_wsite']) ; ?>
       <?php echo $this->Form->input('color',$tv['form_color']) ;?>
        <?php echo $this->Form->input('delivery',$tv['form_delivery'],array('type'=>'checkbox')) ;?>
             
            
   </div>	              
  <div class="modal-footer">
    <input type="submit" value="<?php echo $this->s['g_login'] ;?>" class="btn btn-success btn-lg">
   <button class="btn  btn-lg" data-dismiss="modal" aria-hidden="true"><?php echo $this->s['g_close'] ;?></button>
							</div>	
  </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
							
					
</div>
  

</form> 