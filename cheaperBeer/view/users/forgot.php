<?php $title_for_layout = $tv['g_forgot_title']; ?>


<?php if(empty($_SERVER['HTTP_X_REQUESTED_WITH'])): ;?>
<a href="<?php echo Router::url('users/index'); ?>" class="btn"><i class="icon-arrow-left"></i><?php echo $tv['g_back'] ;?></a>
<?php endif ;?>

<div class="page-header">
<h4><?php echo $tv['g_forgot'] ;?></h4>
</div>

<?php echo $this->Form->create(array('style'=>'inline','id'=>'form_1','action'=>'users/forgot'),true, 'DoN@tienne') ;?>

    <fieldset>
        

<?php echo $this->Form->input('email',$tv['forgot_pass'], array('class'=>'input-xlarge')); ?> 


     
        <div class="actions">
            <input type="submit" class="btn btn-warning" value="<?php echo $tv['g_newpass'] ;?>">
	</div> 
        
        </fieldset>
</form>
<script type="text/javascript">
$("#inputpseudo").keyup(function(){
                        var psd = $(this).val() ;
                        var isuse = 'pseudo='+psd ;
                        console.log(psd);
                        if(psd.length>6){
                            $.ajax({
                                type : "GET",
                                url : "/rosskis/users/signup",
                                data : isuse ,
                                success : function(data){

                                if(data=='used'){

                                $("#inputpseudo").parent().parent().addClass("error");
                                $("#errorpseudo").remove();
                                $("#inputpseudo").after('<span class="help-inline" id="errorpseudo"><?php echo $tv['fgt_pseudo_used'] ;?></span>');
                            }else{
                                $("#inputpseudo").parent().parent().removeClass("error");
                                $("#errorpseudo").remove();
                                }
                                     }
                                });
                               
                            }});

$("#inputemail").blur(function(){
                                
                                var email = $(this).val() ;
                                if(email==''){
                                    $("#erroremail").remove();
                                    $("#inputemail").parent().parent().removeClass("error");
                                }
                                else{
                                if (!(/^[a-z0-9._-]+@[a-z0-9._-]+\.[a-z]{2,6}$/.test(email))){
                                    $("#inputemail").parent().parent().addClass("error");
                                    $("#erroremail").remove();
                                    $("#inputemail").after('<span class="help-inline" id="erroremail"><?php echo $tv['invalid_email'] ;?></span>');
                                
                                }else{
                                    var isno = 'email='+email ;
                                    $.ajax({
                                type : "GET",
                                url : "/atttune/users/forgot",
                                data : isno ,
                                success : function(data){

                                if(data=="not"){

                                $("#inputemail").parent().parent().addClass("error");
                                $("#erroremail").remove();
                                $("#inputemail").after('<span class="help-inline" id="erroremail"><?php echo $tv['fgt_email_absent'] ;?></span>');
                            }else{
                                $("#inputemail").parent().parent().removeClass("error");
                                $("#erroremail").remove();
                                }
                                     }
                                });
                                    
                                }
                                }
                                
                                });

</script>