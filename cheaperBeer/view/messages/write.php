<?php $title_for_layout = $tv['msg_title_write'].$e->pseudo; ?>
<?php $b=$this->message_list() ;?>


<ul class="nav nav-tabs" id="myj">
  <li <?php if($b['unrd']==1):?> class="active" <?php endif ;?>><a href="<?php echo Router::url('messages/index'); ?>"><i class="icon-inbox"></i> <span class="hidden-xs"> <?php echo $tv['g_all'] ;?></span></a></li>
  <li <?php if($b['unrd']==0):?> class="active" <?php endif ;?>><a href="<?php echo Router::url('messages/index/347'); ?>"><span class="hidden-xs"> <?php echo $tv['g_unread'] ;?></span></a></li>
</ul>

<div class="row">
    
         
             
                
             
             <div class="col-md-4">
                
                 <?php if(isset($b['messages'])&&!empty($b['messages'])): ?>
                  <ul class="media-list">
             <?php foreach ($b['messages'] as $k => $v): ?>
                
                        <?php if($b['uid']===($v->id_my)){ $a=$v->id_other ; $col=1 ; }else{$a=$v->id_my ; $col=2 ;}
                              
                            ?>
                 <li class="media" <?php if(($col==2)&&($v->view==0)):?>style="background-color:#D5E1E3; border-radius:7px;"<?php endif ;?>>
                       <a href="<?php echo Router::url('messages/write/id:'.$a); ?>" class="pull-left">
                          
                             <?php 
                            $img='';
                            if($b['uinfo'][$a]->img!='def.png')
                            {$img = str_replace('xlarge', 'sq_mini50', $b['uinfo'][$a]->img) ;
                            }else
                            {$img ='defmini.png';
                            }
                             ?>
                       <img src="<?php echo Router::webroot('img/'.$img) ;?>" class="media-object img-rounded"/>
                        
                       </a>
                            <a href="<?php echo Router::url('messages/write/id:'.$a); ?>" >
                        
                       <div class="media-body">
                         <h5 class="media-heading"><?php echo ucfirst($b['uinfo'][$a]->pseudo); ?></h5>
                         <p><?php echo ' '.$v->message; ?></p>
                       
                       </div>
                            </a> 
                           
                            </li>
                       <hr class="small">
                 
		<?php endforeach ?>
                  </ul>
             <?php endif ;?>
         </div>
    
    
	<div class="col-md-8 ">
		
            
         <?php if(isset($messages)&&!empty($messages)):?>
   

  <ul class="pagination">
  <?php for($i=1; $i <= $page; $i++): ?>
    <li <?php if($i==$this->request->page) echo 'class="active"'; ?>><a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
  <?php endfor; ?>
  </ul>

         
            
            <div id="messg">
		<?php  foreach ($messages as $k => $v): ?>
            
		<div class="row">
                    <div class="col-md-2">
                      <?php if(!empty($v->img)):?>
                       <?php if($v->id_my==$this->Session->User('id') ): ?>
                        <img src="<?php echo Router::webroot('img/'.$v->img) ;?>" class="img-rounded"/>
                        <?php else: ?>
                        <a href="<?php echo Router::url('users/view/id:'.$v->id_my); ?>">
                       <img src="<?php echo Router::webroot('img/'.$v->img) ;?>" class="img-rounded"/>
                        </a>
                        <?php endif ;?>
                       <?php else: ?>
                        <?php if($v->id_my==$this->Session->User('id') ): ?>
                        <img src="<?php echo Router::webroot('img/defmini.png') ;?>" class="img-rounded"/>
                        <?php else: ?>
                        <a href="<?php echo Router::url('users/view/id:'.$v->id_my); ?>">
                       <img src="<?php echo Router::webroot('img/defmini.png') ;?>" class="img-rounded"/>
                        </a>
                       <?php endif ;?>
                        <?php endif ;?>
                    </div>
                    <div class="col-md-8"><?php echo nl2br($v->message); ?><br></div>
                    <span style="color:#cccccc; font-size:10px;">
                        <?php echo date("M j,H:i",$v->created); ?>
                    </span>	
                 </div>
                <br>
		<?php endforeach ?>
            </div>
                <?php endif ;?>
 
      <div class="well  clearfix">     
          <?php echo $this->Form->create(array('id'=>'form_1','action'=>'messages/write/id:'.$t)) ;?>
      
 <textarea name="message" class="form-control"  rows="5" placeholder="<?php echo $tv['g_message'] ;?>"></textarea>
        
            <input type="submit" class="btn btn-default primary pull-right" value="<?php echo $tv['g_send'] ;?>">
	
        </form>
       </div> 
	</div>
	
</div>

<script type="text/javascript">


$(document).ready(function(){
    
var lastid=<?php echo $lid; ?>;
var rqp=<?php echo $rqp; ?>;
if(rqp==2){var timer = setInterval(nMess,5000);}
$("div#messg").scrollTop($("div#messg")[0].scrollHeight);
    
    $("form#form_1").submit(function(){
       
        var message = $("#form_1 textarea").val();
        clearInterval(timer);
        message=$.trim(message);
        if(message.length>0){
         $.ajax({ url:"<?php echo Router::url('messages/write/id:'.$t); ?>",
        type:"POST",
        dataType:"json",
        data: {"message":message,"lastid":lastid},
        success : function(data){
            if(rqp!=2){location.replace("<?php echo Router::url('messages/write/id:'.$t); ?>");}
            getMess(data);
            $("div#messg").scrollTop($("div#messg")[0].scrollHeight);
            $("form#form_1 textarea").val("");
            timer = setInterval(nMess,5000);
        }
            });   
        }
        
        return false;
    })
});

function nMess(){
   // var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&'); ;
    //alert(hashes);
     $.post("<?php echo Router::url('messages/write/id:'.$t); ?>",{lastid:lastid},function(data){getMess(data);},"json");
        return false;
 }          

function getMess(data){
          if(data.result.length>0){
              $("div#messg").append(data.result);
          }
            data.result='';
            lastid=data.lastid;
            
           }
           

</script>