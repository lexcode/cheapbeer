<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script>
$.getJSON("http://api.openbeerdatabase.com/v1/beers.json?callback=?", function(response) {
  $(response.breweries).each(function() {
    $("#example-breweries").append($("<li>", { text : this.name }));
  });
});
</script>
<script type="text/javascript" src="http://localhost/cheaperBeer/js/signup.js"></script>

<div id="example-breweries"></div>
<div class="page-header">
	<h2>Edit your beer list</h2>
</div>	
<?php echo $this->Form->create(array('style'=>'hoz','id'=>'form_1','action'=>'users/company_info')) ;?>

   
     <div class="form-group " id="startd1">   
    <label class="col-lg-2 control-label" for="inputdd1">Monday Cheapest Beer</label>
					<div class="col-lg-10">
                                            <div class="row">
    <div class="col-lg-4">
        <input type="text" class="form-control" placeholder="name" name="MO_beer" value="<?php echo $company->MO_beer ;  ?>"/>
	
    </div>
                                                
  <?php $price[0]='free beer'; for($i=1;$i<50;$i++):  ?>
        <?php $price[$i]=($i*0.5).' €' ; ?>                                     
 <?php endfor  ?>
    <div class="col-lg-4">
        <select id="inputdd1" name="MO_price" class="input-small form-control" >
	   <?php foreach($price as $k=>$v): ?>
            <option value="<?php echo $v ;?>" <?php if($v==$company->MO_price){ echo 'selected';}  ?>><?php echo $v ;?></option>
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
        <input type="text" class="form-control" placeholder="name" name="TU_beer" value="<?php echo $company->TU_beer ;  ?>"/>
	
    </div>
    <div class="col-lg-4">
        <select id="inputdd1" name="TU_price" class="input-small form-control" >
	   <?php foreach($price as $k=>$v): ?>
            <option value="<?php echo $v ;?>" <?php if($v==$company->TU_price){ echo 'selected';}  ?>><?php echo $v ;?></option>
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
        <input type="text" class="form-control" placeholder="name" name="WE_beer" value="<?php echo $company->WE_beer ;  ?>"/>
	
    </div>
    <div class="col-lg-4">
        <select id="inputdd1" name="WE_price" class="input-small form-control" >
	   <?php foreach($price as $k=>$v): ?>
            <option value="<?php echo $v ;?>" <?php if($v==$company->WE_price){ echo 'selected';}  ?>><?php echo $v ;?></option>
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
        <input type="text" class="form-control" placeholder="name" name="TH_beer" value="<?php echo $company->TH_beer ;  ?>"/>
	
    </div>
    <div class="col-lg-4">
        <select id="inputdd1" name="TH_price" class="input-small form-control" >
	   <?php foreach($price as $k=>$v): ?>
            <option value="<?php echo $v ;?>" <?php if($v==$company->TH_price){ echo 'selected';}  ?>><?php echo $v ;?></option>
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
        <input type="text" class="form-control" placeholder="name" name="FR_beer" value="<?php echo $company->FR_beer ;  ?>"/>
	
    </div>
    <div class="col-lg-4">
        <select id="inputdd1" name="FR_price" class="input-small form-control" >
	   <?php foreach($price as $k=>$v): ?>
            <option value="<?php echo $v ;?>" <?php if($v==$company->FR_price){ echo 'selected';}  ?>><?php echo $v ;?></option>
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
        <input type="text" class="form-control" placeholder="name" name="SA_beer" value="<?php echo $company->SA_beer ;  ?>"/>
	
    </div>
    <div class="col-lg-4">
        <select id="inputdd1" name="SA_price" class="input-small form-control" >
	   <?php foreach($price as $k=>$v): ?>
            <option value="<?php echo $v ;?>" <?php if($v==$company->SA_price){ echo 'selected';}  ?>><?php echo $v ;?></option>
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
        <input type="text" class="form-control" placeholder="name" name="SU_beer" value="<?php echo $company->SU_beer ;  ?>"/>
	
    </div>
    <div class="col-lg-4">
        <select id="inputdd1" name="SU_price" class="input-small form-control" >
	   <?php foreach($price as $k=>$v): ?>
            <option value="<?php echo $v ;?>" <?php if($v==$company->SU_price){ echo 'selected';}  ?>><?php echo $v ;?></option>
            <?php endforeach ;?>
	</select>
    </div>
        </div>
                                        </div>
</div>
    

    <div class="form-group">
                
                <div class="col-lg-offset-2 col-lg-10">
                
		<input type="submit" class="btn btn-success btn-block" value="UPDATE">
	         </div> 
  
        </div>
        
</form>

