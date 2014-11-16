<?php $title_for_layout = $tv['media_title_view_pics']; ?>
<style type="text/css">
    .pas_copier {
	height:<?php echo $yy ;?>px;
	width:<?php echo $xx ;?>px;
	background:url('<?php echo Router::webroot('img/'.$img_adress);?>') center center no-repeat ;
}
</style>
<?php if(empty($_SERVER['HTTP_X_REQUESTED_WITH'])): ;?>
<a href="<?php echo Router::url('medias/pics/id:'.$user_id); ?>" class="btn"><i class="icon-arrow-left"></i><?php echo $tv['g_back'] ;?></a>
<?php endif ;?>

<div class="page-header">
	<h1><?php echo $tv['g_show_pics'] ;?></h1>
</div>

<a href="<?php echo Router::url('medias/view_pics/user:'.$user_id.'/id:'.$prev); ?>" class="btn"><i class="icon-chevron-left"></i><?php echo $tv['g_previous'] ;?></a>
<a href="<?php echo Router::url('medias/view_pics/user:'.$user_id.'/id:'.$next); ?>" class="btn"><?php echo $tv['g_next'] ;?><i class="icon-chevron-right"></i></a>

<div class="pict" id="photoHolder">
    <a href="<?php echo Router::url('medias/view_pics/user:'.$user_id.'/id:'.$next); ?>"  />
    <img src="<?php echo Router::webroot('img/pic.gif'); ?>"  class="pas_copier" />
</a>
</div>

<?php $slike=$this->stillike($user_id,10,$thid) ;?>
                    <?php if(empty($slike)||($slike==0)):?>
                    <a href="<?php echo Router::url('medias/like_picture/user:'.$user_id.'/id:'.$thid); ?>" class="btn"><i class="icon-heart"></i><?php echo $tv['g_like'] ;?></a>
                    <?php else: ?>
                    <a href="<?php echo Router::url('medias/like_picture/user:'.$user_id.'/id:'.$thid); ?>" class="btn"><i class="icon-remove-sign"></i><?php echo $tv['g_unlike'] ;?></a>
                    <?php endif ;?>
<a href="<?php echo Router::url('interactions/abuse/user:'.$user_id.'/id:'.$thid); ?>" class="btn"><i class="icon-flag"></i><?php echo $tv['g_report'] ;?></a>
                    
     
<?php $com=$this->display_comment($user_id,$thid,$this->request->page) ;?>

<?php if(isset($com['messages'])&&!empty($com['messages'])): ?>
<div class="page-header"></div>
  <?php if($com['page']>1): ?>
    
  <ul class="pagination">
  <?php for($i=1; $i <= $com['page']; $i++): ?>
    <li <?php if($this->request->page==0){if($i==$com['page']) echo 'class="active"';}else{if($i==$this->request->page) echo 'class="active"';} ?>><a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
  <?php endfor; ?>
  </ul>
 
  <?php endif ;?>
         
            
            <div id="comment">
		<?php  foreach ($com['messages'] as $k => $v): ?>
                 
                     <div class="row">
                    <div class="col-md-1">
                        
                        <a href="<?php echo Router::url('users/view/id:'.$v->id_owner); ?>" >
                          
                            <?php 
                            $img='';
                            if($com['uinfo'][$v->id_owner]->img!='def.png')
                            {$img = str_replace('xlarge', 'sq_mini50', $com['uinfo'][$v->id_owner]->img) ;
                            }else
                            {$img ='defmini.png';
                            }
                             ?>
                       <img src="<?php echo Router::webroot('img/'.$img) ;?>" class="img-rounded"/>
                        
                       </a>
                      <?php if(!empty($v->img)):?>
                        
                       <img src="<?php echo Router::webroot('img/'.$v->img) ;?>" class="img-rounded"/>
                        <?php endif ;?>
                       
                    </div>
                    <div class="col-md-4"><?php echo $v->message; ?><br></div>
                    <span style="color:#cccccc; font-size:10px;">
                        <?php echo date("M j,H:i",$v->date); ?>
                    </span>	
                 </div>
                <br>
		<?php endforeach ?>
            </div>

 <?php endif ;?>
<?php echo $this->Form->create(array('style'=>'form','id'=>'form_1','action'=>'medias/comment/'.$user_id.'/'.$thid),true,'DoN@tienne') ;?>

        <?php echo $this->Form->input('message',$tv['g_comment'],array('type'=>'textarea')); ?> 
        <div class="actions">
	<input type="submit" class="btn primary" value="<?php echo $tv['g_send'] ;?>">
	</div> 
        </form>

       
     