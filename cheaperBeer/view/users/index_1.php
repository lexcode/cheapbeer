

<script type="text/javascript" src="http://localhost/cheaperBeer/js/signup.js"></script>
<div class="jumbotron">
    <button type="button" class="close" aria-hidden="true" id="close_jumbro">×</button>
      <div class="container">
        
        <h1><?php echo $tv['welcome_title'] ;?></h1>
        <p><?php echo $tv['welcome_sentence'] ;?></p>
        <p class="visible-xs"><a class="btn btn-success btn-lg" role="button" href="#start_p"><?php echo $tv['go_signup'] ;?></a>    <a class="btn btn-primary btn-lg" role="button" href="#LoginModal" data-toggle="modal"><?php echo $tv['go_signin'] ;?></a></p>
      </div>
    </div>
<style type="text/css">
    .super-menu > div > h1
    {   margin: 25px 5px;
        text-align:center ;
        background:#0d747c ;
        padding:10px;
    }

.inl { float:left; }
.clearBoth { clear:both; }

div#rectangle {
	width: 75%;
	height: 100px;
	background: red;
         }
         
div#triangle {
	width: 0px;
height: 0px;
border-style: solid;
border-width: 50px 0 50px 50px;
border-color: transparent transparent transparent red;

             }
                </style>
            
<div class="row super-menu" >
    <div class="col-lg-3"><h1>Super Powers</h1></div>
    <div class="col-lg-5"><h1>Services</h1></div>
    <div class="col-lg-4"><h1>Order</h1></div>
</div>
<div class="row">
    <div class="col-lg-3">
        
        <div class="col-md-12 ">
          <h2><?php echo $tv['service_quality'] ;?></h2>
          <i class="icon-trophy icon-5x" style=" color:#cead00;display:inline-block;text-align: center;"></i>
          <p><?php echo $tv['txt_service_quality'] ;?></p>
          
          <h2><?php echo $tv['service_speed'] ;?></h2>
          <i class="icon-fighter-jet icon-5x" style=" color:#cead00;display:inline-block;text-align: center;"></i>
          <p><?php echo $tv['txt_service_speed'] ;?></p>
          
          <h2><?php echo $tv['service_simplicity'] ;?></h2>
          <i class="icon-key icon-5x" style=" color:#cead00;display:inline-block;text-align: center;"></i>
          <p><?php echo $tv['txt_service_simplicity'] ;?></p>
          
          <h2><?php echo $tv['service_support'] ;?></h2>
          <i class="icon-group icon-5x" style=" color:#cead00;display:inline-block;text-align: center;"></i>
          <p><?php echo $tv['txt_service_support'] ;?></p>
          
          <h2><?php echo $tv['service_money'] ;?></h2>
          <i class="icon-money icon-5x" style=" color:#4B8316;display:inline-block;text-align: center;"></i>
          <p><?php echo $tv['txt_service_money'] ;?></p>
          
        </div>
        
        
    </div>
    
    <div class="col-lg-5">
        <ul class="nav nav-tabs" id="myj">
                        <li class="active"><a class="ttab" href="#all" data-toggle="tab"><i class="icon-rocket"></i><span class="hidden-xs"></span></a></li>
                        <li><a class="ttab" href="#webdesign"  data-toggle="tab"><i class="icon-pencil"></i><span class="hidden-xs"><strong> <?php echo $tv['rub_webdesign'] ;?></strong></span></a></li>
                        <li><a class="ttab" href="#marketing" data-toggle="tab"><i class="icon-picture"></i><span class="hidden-xs"><strong> <?php echo $tv['rub_assistance'] ;?></strong></span></a></li>
                        <li><a class="ttab" href="#assistance" data-toggle="tab"><i class="icon-tags"></i><span class="hidden-xs"><strong> <?php echo $tv['rub_content'] ;?></strong></span></a></li>
                         <li><a class="ttab" href="#assistance" data-toggle="tab"><i class="icon-tags"></i><span class="hidden-xs"><strong> <?php echo $tv['rub_content'] ;?></strong></span></a></li>
   
        </ul>
        <?php $art=""; $as=array();  ?>
        <?php $art_name="" ; ?>
        
        <div class="tab-content">
            <div class="tab-pane active" id="all">
                <?php foreach($articles as $k=>$v): ?>
            <?php $art.=$v->price.' , ' ;  ?>
           <?php $art_name.='\''.$tv[urlname($v->name).'_title'].'\' , ' ;  ?>
                    <?php  $as[]=urlname($v->name) ;  ?>
        <div class="row">
       
          <h2  class="col-md-12"><?php echo $tv[urlname($v->name).'_title'].'   '.$v->price.'$' ;?></h2>
           <div class="col-md-10">
          <p><?php echo $tv['p_social'] ;?></p>
          </div>
            <div class="col-md-2">
                <a class="btn btn-info add-cart" href="#addcart<?php echo $k; ?>" role="button" data-id="<?php echo $k; ?>"><i class="icon-shopping-cart"></i>  <?php  $tv['add_cart'] ;?></a>
        
            </div>
            </div>
          <div class="row">
              <div class="col-md-12">
                  <div class="inl" id="rectangle">
                      <h2  class="col-md-12"><?php echo $tv[urlname($v->name).'_title'].'   '.$v->price.'$' ;?></h2>
                  </div>
             <div class="inl" id="triangle"></div>
             <br class="clearBoth" />
            </div>
               </div>
        <?php endforeach ;?>
            </div>
            <div class="tab-pane" id="webdesign">
        <?php foreach($articles as $k=>$v): ?>
            <?php if($v->type==1):  ?>
        <div class="row">
       
          <h2  class="col-md-12"><?php echo $tv[urlname($v->name).'_title'].'   '.$v->price.'$' ;?></h2>
           <div class="col-md-10">
          <p><?php echo $tv['p_social'] ;?></p>
          </div>
            <div class="col-md-2">
                <a class="btn btn-info add-cart" href="#addcart<?php echo $k; ?>" role="button" data-id="<?php echo $k; ?>"><i class="icon-shopping-cart"></i>  <?php  $tv['add_cart'] ;?></a>
        
            </div>
            </div>
            
            
            <?php endif ;  ?>
        <?php endforeach ;?> 
            </div>
            <div class="tab-pane" id="assistance">
                 <?php foreach($articles as $k=>$v): ?>
            <?php if($v->type==2):  ?>
        <div class="row">
       
          <h2  class="col-md-12"><?php echo $tv[urlname($v->name).'_title'].'   '.$v->price.'$' ;?></h2>
           <div class="col-md-10">
          <p><?php echo $tv['p_social'] ;?></p>
          </div>
            <div class="col-md-2">
                <a class="btn btn-info add-cart" href="#addcart<?php echo $k; ?>" role="button" data-id="<?php echo $k; ?>"><i class="icon-shopping-cart"></i>  <?php  $tv['add_cart'] ;?></a>
        
            </div>
            </div>
            <?php endif ;  ?>
        <?php endforeach ;?> 
            </div>
            <div class="tab-pane" id="marketing">
                 <?php foreach($articles as $k=>$v): ?>
            <?php if($v->type==3):  ?>
        <div class="row">
       
          <h2  class="col-md-12"><?php echo $tv[urlname($v->name).'_title'].'   '.$v->price.'$' ;?></h2>
           <div class="col-md-10">
          <p><?php echo $tv['p_social'] ;?></p>
          </div>
            <div class="col-md-2">
                <a class="btn btn-info add-cart" href="#addcart<?php echo $k; ?>" role="button" data-id="<?php echo $k; ?>"><i class="icon-shopping-cart"></i>  <?php  $tv['add_cart'] ;?></a>
        
            </div>
            </div>
            <?php endif ;  ?>
        <?php endforeach ;?> 
            </div>
</div>
    </div>
    
    <div class="col-lg-4" >
        <?php echo $this->Form->create(array('style'=>'hoz','id'=>'form_signup','action'=>'users/signup'),true, '1987paka','777kikju') ;?>
<?php $id=$this->Session->User('id') ;
if(($id=='')||!isset($id)): ?>
        <div class="form-group">
    <label class="col-lg-2 control-label" for="inputname"></label>
                <div class="col-lg-10">
                    
                        <input type="text"  class="input-large form-control" id="inputemail" name="pseudo" placeholder="<?php echo $tv['vu_first_name'].' & '.$tv['vu_second_name'] ;?>" >
                </div>
</div> 
<div class="form-group">
    <label class="col-lg-2 control-label" for="inputemail"></label>
                <div class="col-lg-10">
                    
                        <input type="text"  class="input-large form-control" id="inputemail" name="email" placeholder="<?php echo $tv['phold_email_adress'] ;?>" data-validation="email">
                </div>
</div>
 <div class="form-group">
    <label class="col-lg-2 control-label" for="inputpassword"></label>
                <div class="col-lg-10">
                    
                        <input type="password"  class="input-large form-control" id="inputpassword" name="password" placeholder="<?php echo $tv['vu_psw'] ;?>" data-validation="alphanumeric">
                </div>
</div>

<div class="form-group">
    <label class="col-lg-2 control-label" for="inputwsite"></label>
                <div class="col-lg-10">
                    
                        <input type="text"  class="input-large form-control" id="inputwsite" name="website" placeholder="<?php echo $tv['phold_website'] ;?>" data-validation="url">
                </div>
</div>
<?php endif ;?>
<div class="form-group">
    <label class="col-lg-2 control-label" for="inputtitle"></label>
                <div class="col-lg-10">
                    
                        <input type="text"  class="input-large form-control" id="inputtitle" name="title" placeholder="<?php echo $tv['phold_job_title'] ;?>">
                </div>
</div>
 <input type="hidden" name="promo" value="share">       
<div class="form-group">
    <label class="col-lg-2 control-label"></label>
    <div class="col-lg-10">
    <textarea  class="input-large form-control" id="inputmy_tags" name="description" placeholder="<?php echo $tv['vu_description'] ;?>" rows="5"  data-validation-regexp="^([a-zA-Z-9]+)$"></textarea>
    </div>
 </div> 

  
    <?php require_once LIB.DS.'captcha'.DS.'recaptchalib.php'; ?>

    <div class="form-group" id="recaptcha_div">
                
                <div class="col-lg-offset-2 col-lg-10">
                 <?php echo recaptcha_get_html(Conf::$recapt_pub,null,true); ?> 
		</div> 
  
        </div> 
        <div class="form-group">
                <div class="col-lg-offset-2 col-lg-10" id="THEcart">
                </div>
              
  
        </div>

        
<div class="form-group">
                
                <div class="col-lg-offset-2 col-lg-8">
                
		<input type="submit" class="btn btn-success btn-lg btn-block" value="<?php echo $tv['g_signup'] ;?>">
	         </div>
        </div>
        
</form>
    </div>
    
</div>
<script type="text/javascript">
    $('#close_jumbro').click(function(){
        $('.jumbotron').toggle('fast');
    });
    
    $('.ttab a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
})
var article = new Array(<?php echo $art.'0'  ?>);
var article_name = new Array(<?php echo $art_name.'\'Free\''  ?>);

</script> 
<script type="text/javascript">



</script>
<script type="text/javascript" src="http://localhost/cheaperBeer/js/cart.js"></script>
<script type="text/javascript" src="http://localhost/cheaperBeer/js/form-validator.js"></script>
