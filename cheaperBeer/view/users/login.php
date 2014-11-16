
<div class="page-header">
     <h2><?php echo $tv['vu_welcome'] ;?></h2>
</div>	


	<?php echo $this->Form->create(array('style'=>'hoz','action'=>'users/login'),true, 'DoN@ti','karate2') ;?>

    <div class="form-group"  >
                <div class="col-lg-offset-2 col-lg-10 ">
		<a href="<?php echo Router::url('users/signup') ;?>" ><?php echo $tv['vu_nmember'] ;?></a>
	        </div> 
             </div>
		<?php echo $this->Form->input('email',$tv['vu_email']) ; ?>
		<?php echo $this->Form->input('password',$tv['vu_psw'],array('type'=>'password')) ;?>
             
              <div class="form-group"  >
                <div class="col-lg-offset-2 col-lg-10 ">
		<a href="<?php echo Router::url('users/forgot') ;?>" ><?php echo $tv['vu_forgot'] ;?></a>
	        </div> 
              </div>
            
		<?php echo $this->Form->input('keep',$tv['vu_kcnx'],array('type'=>'checkbox')); ?>
            
            <div class="form-group"  >
            
                <div class="col-lg-offset-2 col-lg-10 ">
		<input type="submit" class="btn btn-success btn-lg" value="<?php echo $tv['vu_cnx'] ;?>">
	         </div> 
  
        </div>
	
	</form>

            <div class="page-header"></div>


     