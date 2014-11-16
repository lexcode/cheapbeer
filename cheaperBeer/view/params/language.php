<?php $title_for_layout = $tv['cpa_title_language']; ?>
<?php 
$lang_opt= array( 
        /***LISTE DE LANGUE
*
*
**/
  
'da'=>$tv['da'],
'de'=>$tv['de'],
'en'=>$tv['en'],
'fr'=>$tv['fr'],
'ko'=>$tv['ko'],
'pt'=>$tv['pt'],
'ru'=>$tv['ru'],
//FIN LISTE DE LANGUE
)
;?>
<ul class="nav nav-tabs" id="myj">
     
            <li><a href="<?php echo Router::url('params/index'); ?>" class="active"><?php echo $tv['cpa_general'] ;?></a></li>
            <li><a href="<?php echo Router::url('params/notification'); ?>"><?php echo $tv['cpa_notification'] ;?></a></li>
            <li><a href="<?php echo Router::url('params/privacy'); ?>"><?php echo $tv['cpa_privacy'] ;?></a></li>
            <!--  <li class="well"><a href="#secu">SECURITY</a></li>
            <li class="well"><a href="#paym">PAYMENT</a></li> -->
            <li class="active"><a href="#language"><?php echo $tv['cpa_language'] ;?></a></li>
</ul>
    
<div class="row">
    
  

<div class="col-md-12">


<div class="page-header">
	<h2><?php echo $tv['cpa_editlanguage'] ;?></h2>
</div>

<?php echo $this->Form->create(array('style'=>'inline','action'=>'params/language'),true, 'DoN@tienne') ;?>

    <fieldset>
      
<?php echo $this->Form->input('lang',$tv['cpa_enterlanguage'],array('options'=>$lang_opt)); ?> 
        
        

       
        <div class="actions">
		<input type="submit" class="btn primary" value="<?php echo $tv['g_select'] ;?>">
	</div> 
        
        </fieldset>
</form>

</div>
    </div>