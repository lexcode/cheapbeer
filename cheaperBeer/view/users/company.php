
<script type="text/javascript" src="http://localhost/cheaperBeer/js/signup.js"></script>

<div class="page-header">
	<h2><?php echo $tv['vu_Signup'] ;?></h2>
</div>	
<?php echo $this->Form->create(array('style'=>'hoz','id'=>'form_1','action'=>'users/company_edit'),true, '1987paka','777kikju') ;?>

        <?php echo $this->Form->input('company_name','Company name'); ?>
<?php echo $this->Form->input('adress','Address'); ?>
        

               
        
    <div class="form-group" id="localisation" >
            <label class="col-lg-2 control-label" for="inputdd1"><?php echo $tv['vu_geolocation'] ;?></label>
                <div class="col-lg-2">
                    <button class="btn btn-info" id="geoloc"><i class="icon-screenshot"></i></button>
                </div>

        </div>
     
    
     <div class="form-group " id="startd1">   
    <label class="col-lg-2 control-label" for="inputdd1">Monday Cheapest Beer</label>
					<div class="col-lg-10">
                                            <div class="row">
    <div class="col-lg-4">
        <input type="text" class="form-control" placeholder="name" name="MO_beer"/>
	
    </div>
                                                
  <?php $price[0]='free beer'; for($i=1;$i<50;$i++):  ?>
        <?php $price[$i]=($i*0.5).' €' ; ?>                                     
 <?php endfor  ?>
    <div class="col-lg-4">
        <select id="inputdd1" name="MO_price" class="input-small form-control" >
	   <?php foreach($price as $k=>$v): ?>
            <option value="<?php echo $k ;?>"><?php echo $v ;?></option>
            <?php endforeach ;?>
	</select>
    </div>
        </div>
                                        </div>
</div>
 <div class="form-group " id="startd1">   
    <label class="col-lg-2 control-label" for="inputdd1">Tuesday Cheapest Beer</label>
					<div class="col-lg-10">
                                            <div class="row">
    <div class="col-lg-4">
        <input type="text" class="form-control" placeholder="name" name="TU_beer"/>
	
    </div>
    <div class="col-lg-4">
        <select id="inputdd1" name="TU_price" class="input-small form-control" >
	   <?php foreach($price as $k=>$v): ?>
            <option value="<?php echo $k ;?>"><?php echo $v ;?></option>
            <?php endforeach ;?>
	</select>
    </div>
        </div>
                                        </div>
</div>
 <div class="form-group " id="startd1">   
    <label class="col-lg-2 control-label" for="inputdd1">Wednesday Cheapest Beer</label>
					<div class="col-lg-10">
                                            <div class="row">
    <div class="col-lg-4">
        <input type="text" class="form-control" placeholder="name" name="WE_beer"/>
	
    </div>
    <div class="col-lg-4">
        <select id="inputdd1" name="WE_price" class="input-small form-control" >
	   <?php foreach($price as $k=>$v): ?>
            <option value="<?php echo $k ;?>"><?php echo $v ;?></option>
            <?php endforeach ;?>
	</select>
    </div>
        </div>
                                        </div>
</div>
 <div class="form-group " id="startd1">   
    <label class="col-lg-2 control-label" for="inputdd1">Thursday Cheapest Beer</label>
					<div class="col-lg-10">
                                            <div class="row">
    <div class="col-lg-4">
        <input type="text" class="form-control" placeholder="name" name="TH_beer"/>
	
    </div>
    <div class="col-lg-4">
        <select id="inputdd1" name="TH_price" class="input-small form-control" >
	   <?php foreach($price as $k=>$v): ?>
            <option value="<?php echo $k ;?>"><?php echo $v ;?></option>
            <?php endforeach ;?>
	</select>
    </div>
        </div>
                                        </div>
</div>
 <div class="form-group " id="startd1">   
    <label class="col-lg-2 control-label" for="inputdd1">Friday Cheapest Beer</label>
					<div class="col-lg-10">
                                            <div class="row">
    <div class="col-lg-4">
        <input type="text" class="form-control" placeholder="name" name="FR_beer"/>
	
    </div>
    <div class="col-lg-4">
        <select id="inputdd1" name="FR_price" class="input-small form-control" >
	   <?php foreach($price as $k=>$v): ?>
            <option value="<?php echo $k ;?>"><?php echo $v ;?></option>
            <?php endforeach ;?>
	</select>
    </div>
        </div>
                                        </div>
</div>
 <div class="form-group " id="startd1">   
    <label class="col-lg-2 control-label" for="inputdd1">Saturday Cheapest Beer</label>
					<div class="col-lg-10">
                                            <div class="row">
    <div class="col-lg-4">
        <input type="text" class="form-control" placeholder="name" name="SA_beer"/>
	
    </div>
    <div class="col-lg-4">
        <select id="inputdd1" name="SA_price" class="input-small form-control" >
	   <?php foreach($price as $k=>$v): ?>
            <option value="<?php echo $k ;?>"><?php echo $v ;?></option>
            <?php endforeach ;?>
	</select>
    </div>
        </div>
                                        </div>
</div>
 <div class="form-group " id="startd1">   
    <label class="col-lg-2 control-label" for="inputdd1">Sunday Cheapest Beer</label>
					<div class="col-lg-10">
                                            <div class="row">
    <div class="col-lg-4">
        <input type="text" class="form-control" placeholder="name" name="SU_beer"/>
	
    </div>
    <div class="col-lg-4">
        <select id="inputdd1" name="SU_price" class="input-small form-control" >
	   <?php foreach($price as $k=>$v): ?>
            <option value="<?php echo $k ;?>"><?php echo $v ;?></option>
            <?php endforeach ;?>
	</select>
    </div>
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
  

    <div class="form-group">
                
                <div class="col-lg-offset-2 col-lg-10">
                
		<input type="submit" class="btn btn-success btn-block" value="GET IN THERE">
	         </div> 
  
        </div>
        
</form>

