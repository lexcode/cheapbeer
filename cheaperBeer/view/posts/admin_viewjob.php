
<div class="row">
    <div class="col-md-12">
       <h1>Liste de jobs</h1>
       <table class="table">
           <?php foreach ($jobs as $k=>$v): ?>
           <tr>
                    <td><?php echo $v->id ;?></td>
                    <td><?php echo $v->id_client ;?></td>
                    <td><?php echo $v->discount ;?></td>
                    <td><?php echo $v->nb_item ;?></td>
                    <td><?php echo $v->price ;?></td>
                    <td><?php echo $v->title ;?> </td>
                    <td><?php echo $v->description ;?></td>
                    <td><?php echo $v->statut ;?></td>
                    <td><?php echo $v->delay ;?></td>
                    <td><?php echo $v->date ;?></td>
                    <td><a  class="btn  btn-info  btn-xs" href="javascript:void(0)" onclick="chatWith('<?php echo $v->id_client.'\',\''.$this->get_user_pseudo($v->id_client) ; ?>')"><i class="icon-comment icon-white"></i> Write message</a></td>
                    <td>voir jobs</td>
                    <td>ecrire message</td>
                </tr>
           <?php endforeach ;  ?>
       </table> 
        
    </div>
    <div class="col-md-12">
    <div class="row">
                <div class="col-md-8">
       <h1>Liste de items</h1>
       <table class="table">
           <?php foreach ($jobitems as $k=>$v): ?>
           <tr>
                    <td><?php echo $v->id ;?></td>
                    <td><?php echo $v->id_job ;?></td>
                    <td><?php echo $v->id_client ;?></td>
                    <td><?php echo $v->id_article;?></td>
                    <td><?php echo $v->name ;?></td>
                    <td><?php echo $v->id_applicant ;?> </td>
                    <td><?php echo $v->statut ;?></td>
                    <td><?php echo $v->date ;?></td>
                    <td>ecrire message</td>
                    <td>Send to Odesk</td>
                </tr>
           <?php endforeach ;  ?>
       </table> 
        
    </div>
                <div class="col-md-4">
         <h1>List files</h1>
       <table class="table">
           <?php foreach ($files as $k=>$v): ?>
           <tr>
                    <td><?php echo $v->id ;?></td>
                    <td><a href="http://localhost/cheaperBeer/img/upload/<?php echo $v->name ;?>" target="_blank"><?php echo $v->name ;?></a></td>
                    <td><?php echo $v->id_joblists ;?> </td>
                    <td><?php echo $v->date ;?> </td>
                </tr>
           <?php endforeach ;  ?>
       </table> 
        
    </div>
    </div>
        </div>
</div>