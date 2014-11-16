
<?php $modal=array() ;?>
<script type="text/javascript" src="http://localhost/cheaperBeer/js/cart.js"></script>

<div class="jumbotron">
      <div class="container">
        <h1><?php echo $tv['welcome_client'] ;?></h1>
        <p><?php echo $tv['sentence_client'] ;?></p>
        <p class="visible-xs"><a class="btn btn-success btn-lg" role="button" href="#start_p"><?php echo $tv['go_signup'] ;?></a>    <a class="btn btn-primary btn-lg" role="button" href="#LoginModal" data-toggle="modal"><?php echo $tv['go_signin'] ;?></a></p>
      </div>
    </div>
<div class="row">
    <div class="col-lg-3">
        
        <div class="col-md-12">
          <h2><?php echo $tv['user_info'] ;?></h2>
          
          <p>NAME SECOND NAME<BR>
              www.simplewebagency.com<br>
              contry</p>
          
        </div>
        <div class="col-md-12">
          <h2>7DAYS / MAX</h2>
          <p><?php echo $tv['p_improve'] ;?></p>
        </div>
    </div>
        
    <div class="col-lg-5" >
        <div class="col-md-12">
          <h2><?php echo $tv['messages'] ;?></h2>
         
          </div>
        
        <div class="col-md-12">
		
            
         <?php if(isset($messages)&&!empty($messages)):?>
   
<?php if(isset($page)&&($page>0)):?>
  <ul class="pagination">
  <?php for($i=1; $i <= $page; $i++): ?>
    <li <?php if($i==$this->request->page) echo 'class="active"'; ?>><a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
  <?php endfor; ?>
  </ul>
<?php endif ;?>
         
            
            <div id="messg">
		<?php  foreach ($messages as $k => $v): ?>
            
		<div class="row">
                    
                    <div class="col-md-8"><?php echo nl2br($v->message); ?><br></div>
                    <span style="color:#cccccc; font-size:10px;">
                        <?php echo date("M j,H:i",$v->created); ?>
                    </span>	
                 </div>
                <br>
		<?php endforeach ?>
            </div>
                <?php endif ;?>
 
      </div>     
          <?php echo $this->Form->create(array('id'=>'form_1','style'=>'hoz' ,'action'=>'messages/write/id:7514263')) ;?>
      
        
<div class="form-group">
    <div class="col-lg-10">
    <textarea  class="input-large form-control" id="inputmy_tags" name="message" placeholder="<?php echo $tv['vu_description'] ;?>" rows="5" ></textarea>
    </div>
 </div> 
  
        
<div class="form-group">
                
                <div class=" col-lg-8">
                
		<input type="submit" class="btn btn-success btn-lg btn-block" value="<?php echo $tv['g_send'] ;?>">
	         </div> 
    <div class="col-lg-2"  id="container" >
                    <a class="btn btn-primary" id="add_files" href="javascript:;"> <i class="icon icon-paperclip"></i></a> 
                </div>
                
  
        </div>
        
</form>
    </div>
    
    <div class="col-lg-4">
        <div class="col-md-12">
          <h2><?php echo $tv['jobs_list'] ;?></h2>
        </div>
        <div class="col-md-12">
            <?php if(isset($job)&&!empty($job)): ?>
          <?php   foreach($job as $k=>$v): ?>
          <h4 class="advanced_search_link" id="<?php echo $v->id; ?>" style="cursor:pointer;"><?php echo $v->title.' '.$v->id.' '.$v->nb_item.' '.$v->price.' ';?></h4>
          <div id="advanced_search_fields<?php echo $v->id; ?>">
             <?php foreach($joblist[$v->id] as $x=>$y): ?>
                    <h5><?php echo $y->name.'  '.$y->statut.'  '.$y->date ;?>   <a class="info_modal" role="button" href="#<?php echo urlname($y->name) ;?>_Modal" data-item_name="<?php echo $y->name ;?>" data-id="<?php echo $y->id ;?>" data-toggle="modal"> <i class="icon icon-info"></i></a>
                   </h5>
            <?php if(($y->statut==0)&&!in_array(urlname($y->name),$modal)) $modal[]=urlname($y->name) ;?>
               <?php endforeach ;?> 
          </div>
              
          <?php endforeach ;?>
          <?php else: ?>
              <h4><?php echo $tv['no_job'] ;?></h4>      
          <?php endif ;?>
        </div>
          
           <div class="col-md-12">
          <h2><?php echo $tv['files_list'] ;?></h2>
        </div>  
        
        <div  class="col-md-12">
        <?php if(isset($files_list)&&!empty($files_list)): ?>
            <?php foreach($files_list as $k=>$v): ?>
            <div id="<?php echo 'file_'.$v->id ;?>"><a href="http://localhost/cheaperBeer/img/upload/<?php echo $v->name ;?>" target="_blank"><?php echo $v->name ;?></a><b></b></div>
            <?php endforeach ;?>
        <?php endif ;?>
       </div>
        <div  class="col-md-12" id="files_bucket">
        
       </div>
    </div>

</div>
<?php if(!empty($modal)):
    foreach($modal as $v):
    require ROOT . DS . 'view' .DS.'form'.DS.$v.'.php';
    endforeach;
endif;
?>
<script type="text/javascript">


$(document).ready(function(){
    
    $('.info_modal').click(function(){
        var href= $(this).attr('href');
        var id= $(this).attr('data-id');
        var item= $(this).attr('data-item_name');
        $(href+'_title').text(item+' #'+id);
       // alert(href+'  '+id+'  '+title);
    });
    
var lastid=<?php echo $lid; ?>;
var rqp=<?php echo $rqp; ?>;
if(rqp==2){var timer = setInterval(nMess,5000);}
$("div#messg").scrollTop($("div#messg")[0].scrollHeight);
    
    $("form#form_1").submit(function(){
       
        var message = $("#form_1 textarea").val();
        clearInterval(timer);
        message=$.trim(message);
        if(message.length>0){
         $.ajax({ url:"<?php echo Router::url('messages/write/id:7514263'); ?>",
        type:"POST",
        dataType:"json",
        data: {"message":message,"lastid":lastid},
        success : function(data){
            if(rqp!=2){location.replace("<?php echo Router::url('messages/write/id:7514263'); ?>");}
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
     $.post("<?php echo Router::url('messages/write/id:7514263'); ?>",{lastid:lastid},function(data){getMess(data);},"json");
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

<script type="text/javascript">

// Custom example logic

var uploader = new plupload.Uploader({
	runtimes : 'html5,flash,silverlight,html4',
	browse_button : 'add_files', // you can pass in id...
	container: document.getElementById('container'), // ... or DOM Element itself
	url : 'http://localhost/cheaperBeer/users/upload/<?php echo $uid ; ?>',
	flash_swf_url : '../js/Moxie.swf',
	silverlight_xap_url : '../js/Moxie.xap',
	
	filters : {
		max_file_size : '10mb',
		mime_types: [
			{title : "Image files", extensions : "jpg,gif,png"},
			{title : "Zip files", extensions : "zip"}
		]
	},

	init: {
		PostInit: function() {
			document.getElementById('files_bucket').innerHTML = '';

			document.getElementById('uploadfiles').onclick = function() {
				uploader.start();
				return false;
			};
		},

		FilesAdded: function(up, files) {
			plupload.each(files, function(file) {
				document.getElementById('files_bucket').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
			});
                        uploader.start();
				return false;
		},

		UploadProgress: function(up, file) {
			document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
		},

		Error: function(up, err) {
			document.getElementById('console').innerHTML += "\nError #" + err.code + ": " + err.message;
		}
	}
});

uploader.init();

</script>