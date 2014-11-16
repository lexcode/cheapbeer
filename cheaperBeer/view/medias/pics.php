<?php $title_for_layout = $tv['media_title_pics'];  ?>
<?php $permission1=array(1=>$tv['public'], 2=>$tv['private'],3=>$tv['friend']);?>
<?php if(isset($me)&&($me===true)): ?>

   <?php echo $this->Form->create(array('style'=>'hoz','id'=>'form_1','action'=>((isset($id_e)&&isset($id_etyp))?'albums/add_album/'.$id_e.'/'.$id_etyp:'albums/add_album')),true, 'DoN@tella') ;?>

<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
     <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel"><?php echo $tv['add_an_album'] ;?></h3>
  </div>
   
  <div class="modal-body">
    
	<?php echo $this->Form->input('name',$tv['g_title']); ?>
        <?php echo $this->Form->input('level',$tv['g_access'],array('options'=>$permission1)); ?> 

  </div>
    
  <div class="modal-footer">
    <input type="submit" value="<?php echo $tv['g_add'] ;?>" class="btn btn-success btn-lg">
    <button class="btn btn-lg" data-dismiss="modal" aria-hidden="true"><?php echo $tv['g_close'] ;?></button>
   </div>
    </div>
      
</div>  
</div>
  </form>
<?php endif ;?>

<style>
         div.pf_pics { display:inline-block ;  width:220px ; }
	 div.pf_pics>div{ display:block ;  width:200px ; text-align:center ;}
</style>



<ul class="nav nav-tabs" id="myj">
    <li><a href="<?php echo Router::url('users/view/id:'.$user_id); ?>"><i class="icon-user"></i><span class="hidden-xs"> <?php echo $tv['g_profile'] ;?></span></a></li>
 <?php if($me===true): ?>
  <li><a href="<?php echo Router::url('users/edit'); ?>"><i class="icon-pencil"></i><span class="hidden-xs"> <?php echo $tv['g_edit'] ;?></span></a></li>
                        <li class="active"><a href="<?php echo Router::url('medias/pics'); ?>"><i class="icon-picture"></i><span class="hidden-xs"> <?php echo $tv['g_picture'] ;?></span></a></li>
                        <li><a href="<?php echo Router::url('users/taglist'); ?>"><i class="icon-tags"></i><span class="hidden-xs"> <?php echo $tv['g_tag'] ;?></span></a></li>
                        <li><a href="#myModal" data-toggle="modal"><i class="icon-picture"></i><span class="hidden-xs"> <?php echo $tv['addalbum'] ;?></span></a>
</li>
                        <?php else: ?>
                        <li><a href="<?php echo Router::url('messages/write/id:'.$user_id); ?>"><i class="icon-edit"></i><span class="hidden-xs"> <?php echo $tv['g_message'] ;?></span></a></li>
                        <li class="active"><a href="<?php echo Router::url('medias/pics/id:'.$user_id); ?>"><i class="icon-picture"></i><span class="hidden-xs"> <?php echo $tv['g_picture'] ;?></span></a></li>
                        <li><a href="<?php echo Router::url('interactions/blacklist/id:'.$user_id); ?>"><i class="icon-ban-circle"></i><span class="hidden-xs"> <?php echo $tv['g_blocked'] ;?></span></a></li>
                        <li><a href="<?php echo Router::url('interactions/abuse/id:'.$user_id); ?>"><i class="icon-flag"></i><span class="hidden-xs"> <?php echo $tv['g_report'] ;?></span></a></li>
                        
                        <?php endif ;?>
   
</ul>
<?php foreach ($album as $l => $m): ?>
<div class="first-header">
    <div class="row">
        <div class="col-md-4">
          <h1><?php echo $m->name; ?></h1>  
        </div>
        <div class="span5">
         <?php  if(isset($me)&&($me===true)): ?>

 <a href="#myModalAlbum<?php echo $m->id_alb ; ?>" data-toggle="modal" class="btn"><i class="icon-camera"></i><?php echo $tv['add_pics'] ;?></a>

<a href="<?php echo Router::url('albums/album_rename/'.$m->id_alb); ?>" class="btn"><i class="icon-edit"></i><?php echo $tv['g_rename'] ;?></a>
<?php if($m->level==7): ?>
<a href="<?php echo Router::url('albums/album_unlock/'.$m->id_alb); ?>" class="btn"><i class="icon-folder-open"></i><?php echo $tv['g_unlock'] ;?></i></a>
<?php else: ?>
<a href="<?php echo Router::url('albums/album_private/'.$m->id_alb); ?>" class="btn"><i class="icon-lock"></i><?php echo $tv['g_lock'] ;?></a>
<?php endif ;?>
<a href="<?php echo Router::url('albums/album_delete/'.$m->id_alb); ?>" class="btn"><i class="icon-trash"></i><?php echo $tv['g_delete'] ;?></a>
<?php endif ;?>   
            
            
            
        </div>
    </div>
	
</div>
                <?php if(($m->level==7)&&($m->auth==0)): ?>
                  <div class="pf_pics">
                    <div class="pcs"><img src="<?php echo Router::webroot('img/locked-alb.png'); ?>" /></div>
                </div>
<a href="<?php echo Router::url('albums/ask_unlock/'.$m->id_alb); ?>" class="btn"><i class="icon-folder-open"></i><?php echo $tv['alb_ask_open'] ;?></a>

                <?php else:?>
	        <div class="row">
                <?php $nbpics=count($images[$m->id_alb]) ;
                $pic_list=array_map('current',$images[$m->id_alb]);
               
                $slike=$this->stillike1($m->id_owner,10,$pic_list) ;
             //   debug($slike);
                  ?>
                    <?php for($gcol=0;$gcol<3;$gcol++): ?>
                    <div class="col-md-4">
                      <?php for($k=$gcol;$k<$nbpics;$k=$k+3):?>
                        <?php $v=$images[$m->id_alb][$k] ;?>
                        <div class="panel panel-atttune">
                            <div class="panel-body">
                            <a href="<?php echo Router::webroot('img/'.$v->file); ?>" class="zoombox zgallery1"><img src="<?php echo Router::webroot('img/'.$v->file_large); ?>" class="img-responsive"/></a>
                            
                            <div class="clearfix"></div>
                             <?php if($slike[$v->id]==0):?>
                    <a  class="btn  btn-success  btn-xs"  href="<?php echo Router::url('medias/like_picture/user:'.$v->user_id.'/id:'.$v->id); ?>" title="like"><i class="icon-heart"></i></a>
                    <?php elseif($slike[$v->id]==1): ?>
                    <a  class="btn  btn-success  btn-xs"  href="<?php echo Router::url('medias/like_picture/user:'.$v->user_id.'/id:'.$v->id); ?>" title="unlike"><i class="icon-remove-sign"></i></a>
                    <?php endif ;?>
                    
                    <?php if((!isset($user_id))||($me==1)): ?>
                   <a  class="btn  btn-success  btn-xs"  href="<?php echo Router::url('medias/pics_delete/id:'.$v->id); ?>"><i class="icon-trash"></i></a>
                   <a  class="btn  btn-success  btn-xs"  href="<?php echo Router::url('medias/pics_main/id:'.$v->id); ?>"><i class="icon-smile"></i></a>
                    <?php endif ;?>
                            </div>
                            
                   <div class="panel-footer" id="texta">
                   <form class="formMessage" data-u-id="<?php echo $v->id; ?>">
                     <textarea class="input messageTextarea" placeholder="<?php echo $tv['placeh_comment'] ;?>" name="message"></textarea>
                   </form>
                   </div>
                            
                    
                     
                   </div>
                    <?php endfor ;?>
                    </div>
                    <?php endfor ;?>
                    
                    
             
                       </div>
                <?php endif ; ?>



                  
<div class="first-header"></div>
<?php if(isset($me)&&($me===true)): ?>
<?php echo $this->Form->create(array('style'=>'hoz','id'=>'form_1','file'=>'ok','action'=>'medias/add_pics/'.$m->id_alb),true, 'DoN@tienne','kuhj'.$m->id_alb) ;?>

<div id="myModalAlbum<?php echo $m->id_alb ; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel"><?php echo $tv['add_pic_to'] ;?><?php echo $m->name; ?></h3>
  </div>
   <div class="modal-body">
    
	<?php echo $this->Form->input('file','',array('type'=>'file_multiple')); ?>
  </div>
  <div class="modal-footer">
    <input type="submit" value="<?php echo $tv['g_add'] ;?>" class="btn btn-success btn-lg">
    <button class="btn btn-lg" data-dismiss="modal" aria-hidden="true"><?php echo $tv['g_close'] ;?></button>
    </div>
       </div>
        
</div>    
</div> 

</form>
<?php endif ;?>
<?php endforeach ?>

<script type="text/javascript" src="http://localhost/cheaperBeer/zoombox.js"></script>
  <script type="text/javascript">
        jQuery(function($){
            $('a.zoombox').zoombox();

        });
        </script>