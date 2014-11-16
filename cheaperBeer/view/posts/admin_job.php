
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
                    <td><a href="<?php echo Router::url('admin/posts/viewclient/'.$v->id_client); ?>"><i class="icon-user"></i> Client Profil</a></td>
                    <td><a href="<?php echo Router::url('admin/posts/viewjob/'.$v->id); ?>"><i class="icon-wrench"></i> View Job</a></td>
                    <td>ecrire message</td>
                </tr>
           <?php endforeach ;  ?>
       </table> 
        
    </div>
        <div class="col-md-12">
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
                    <td>voir profil</td>
                    <td>voir jobs</td>
                    <td>ecrire message</td>
                </tr>
           <?php endforeach ;  ?>
       </table> 
        
    </div>
</div>