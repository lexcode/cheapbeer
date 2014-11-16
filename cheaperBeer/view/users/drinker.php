
<script type="text/javascript" src="http://localhost/cheaperBeer/js/signup.js"></script>
<script type="text/javascript">
  var RecaptchaOptions = { theme : 'clean'}</script>
<?php if(empty($_SERVER['HTTP_X_REQUESTED_WITH'])): ;?>
<a href="<?php echo Router::url('users/index'); ?>" class="btn"><i class="icon-arrow-left"></i><?php echo $tv['g_back'] ;?></a>
<?php endif ;?>
<div class="page-header">
	<h2><?php echo $tv['vu_Signup'] ;?></h2>
</div>	
<?php echo $this->Form->create(array('style'=>'hoz','id'=>'form_1','action'=>'users/signup'),true, '1987paka','777kikju') ;?>
<div class="form-group"  >
<div class="col-lg-offset-2 col-lg-10 ">
   <a href="<?php echo Router::url('invitations/connect'); ?>" class="btng btn-lg btn-fcbk" >Connect with Facebook</a>
</div>
</div>
        <?php echo $this->Form->input('pseudo',$tv['vu_first_name']); ?>
        <?php echo $this->Form->input('second_name',$tv['vu_second_name']); ?>
    	<?php echo $this->Form->input('my_type',$tv['uare'],array('options' => $mtype)); ?>
        
 <div class="form-group " id="startd1">   
    <label class="col-lg-2 control-label" for="inputdd1"><?php echo $tv['vu_birthdate'] ;?></label>
					<div class="col-lg-10">
                                            <div class="row">
    <div class="col-lg-2">
        <select id="inputdd1" name="dd1" class="input-small form-control" >
	   <?php foreach($jour as $k=>$v): ?>
            <option value="<?php echo $k ;?>"><?php echo $v ;?></option>
            <?php endforeach ;?>
	</select>
    </div>
    <div class="col-lg-2">
        <select id="inputdm1" name="dm1" class="input-small form-control" >
	   <?php foreach($mois as $k=>$v): ?>
            <option value="<?php echo $k ;?>"><?php echo $v ;?></option>
            <?php endforeach ;?>
	</select>
    </div>
    <div class="col-lg-2" id="endd1">
        <select id="inputdy1" name="dy1" class="input-small form-control " >
	   <?php foreach($annee as $k=>$v): ?>
            <option value="<?php echo $k ;?>"><?php echo $v ;?></option>
            <?php endforeach ;?>
	</select>
    </div>
        </div>
                                        </div>
</div>
               
        
    <div class="form-group" id="localisation" >
            <label class="col-lg-2 control-label" for="inputdd1"><?php echo $tv['vu_geolocation'] ;?></label>
                <div class="col-lg-2">
                    <button class="btn btn-info" id="geoloc"><i class="icon-screenshot"></i></button>
                </div>

        </div>
     
    <div class="form-group">
	<label class="col-lg-2 control-label" for="inputccity"><?php echo $tv['vu_city'] ;?></label>
	<div class="col-lg-10"><input type="text" class="input-large form-control" id="inputccity" name="ccity"  autocomplete="off">
           <div class="panel panel-default" id="result" style="display:none; position:absolute ; top:100%; width: 50%; z-index: 100;"> 
                 <ul id="reslist" class="list-unstyled" style="margin-left:12px;margin-top:4px;"></ul>
                  <p id="resmsg"></p>
        </div>
        
        </div>
     
    
    
    </div>
        
    <div> 
     <?php echo $this->Form->input('city','hidden'); ?>
    <?php echo $this->Form->input('region','hidden'); ?>
    <?php echo $this->Form->input('contry','hidden'); ?>
    <?php echo $this->Form->input('idc','hidden'); ?>
    </div>
      <?php echo $this->Form->input('email',$tv['vu_email']); ?>
        <?php echo $this->Form->input('password',$tv['vu_password'],array('type'=>'password')); ?>
        <?php echo $this->Form->input('conf_password',$tv['vu_confpassword'],array('type'=>'password')); ?> 
    <?php require_once LIB.DS.'captcha'.DS.'recaptchalib.php'; ?>

    <div class="form-group">
                
                <div class="col-lg-offset-2 col-lg-10">
                 <?php echo recaptcha_get_html(Conf::$recapt_pub,null,true); ?> 
		</div> 
  
        </div>

    <div class="form-group">
                
                <div class="col-lg-offset-2 col-lg-10">
                
		<input type="submit" class="btn btn-success btn-lg" value="<?php echo $tv['g_signup'] ;?>">
	         </div> 
  
        </div>
        
</form>

