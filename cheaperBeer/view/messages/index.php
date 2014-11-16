<?php $title_for_layout = $tv['msg_title_index']; ?>

<ul class="nav nav-tabs" id="myj">
  <li <?php if($unrd==1):?> class="active" <?php endif ;?>><a href="<?php echo Router::url('messages/index'); ?>"><i class="icon-inbox"></i> <?php echo $tv['g_all'] ;?></a></li>
  <li <?php if($unrd==0):?> class="active" <?php endif ;?>><a href="<?php echo Router::url('messages/index/347'); ?>"><?php echo $tv['g_unread'] ;?></a></li>
</ul>
<div class="row">
           <?php if(isset($messages)&&!empty($messages)): ?>
                    <div class="col-md-4">
                    <ul class="media-list">
                     <?php foreach ($messages as $k => $v): ?>
                
                        <?php   $col=0;
                             if($uid===($v->id_my))
                                { $a=$v->id_other ; $col=1 ; }
                              else
                                 {$a=$v->id_my ; $col=2 ;}?>
                        <li class="media " <?php if(($col==2)&&($v->view==0)):?>style="background-color:#D5E1E3; border-radius:7px;"<?php endif ;?>>
                       <a href="<?php echo Router::url('messages/write/id:'.$a); ?>" class="pull-left">
                          
                            <?php 
                            $img='';
                            if($uinfo[$a]->img!='def.png')
                            {$img = str_replace('xlarge', 'sq_mini50', $uinfo[$a]->img) ;
                            }else
                            {$img ='defmini.png';
                            }
                             ?>
                       <img src="<?php echo Router::webroot('img/'.$img) ;?>" class="media-object img-rounded"/>
                        
                       </a>
                            <a href="<?php echo Router::url('messages/write/id:'.$a); ?>" >
                        
                       <div class="media-body">
                          <h5 class="media-heading"><?php echo ucfirst($uinfo[$a]->pseudo); ?></h5>
                          <p><?php echo ' '.$v->message; ?></p>
                       
                       </div>
                            </a> 
                            
                            </li>
         <hr class="small">
		<?php endforeach ?>   
                        
                    </ul>
		
    </div> 
            <?php endif ;?>
  
	
	
</div>



  <ul class="pagination">
  <?php for($i=1; $i <= $page; $i++): ?>
    <li <?php if($i==$this->request->page) echo 'class="active"'; ?>><a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
  <?php endfor; ?>
  </ul>
