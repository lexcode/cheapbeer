
<?php echo $this->Form->create(array('style'=>'hoz','id'=>'loginF','action'=>'users/login'),true, 'DoN@ti','karate2') ;?>

<div id="v-assistance_Modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="banner_Modal_title">banner </h3>
  </div>
   <div class="modal-body">
       	<?php echo $this->Form->input('industry',$tv['form_industry']) ; ?>
        <?php echo $this->Form->input('script',$tv['form_script'],array('type'=>'password')) ;?>
        <?php echo $this->Form->input('website',$tv['form_website'],array('type'=>'checkbox')) ;?>
        <?php echo $this->Form->input('lang',$tv['form_lang'],array('type'=>'password')) ; ?>
       <?php echo $this->Form->input('timezone',$tv['form_timezone']) ; ?>
        <?php echo $this->Form->input('schedule',$tv['form_schedule'],array('type'=>'textarea')) ;?>
        <?php echo $this->Form->input('description',$tv['form_desc'],array('type'=>'textarea')) ;?>
              <div class="form-group"  >
                <div class="col-lg-offset-2 col-lg-10 ">
		<a href="<?php echo Router::url('users/forgot') ;?>" ><?php echo $tv['vu_forgot'] ;?></a>
	        </div> 
              </div>
            
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