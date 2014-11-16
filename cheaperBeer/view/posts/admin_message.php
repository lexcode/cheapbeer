
<div class="row">
    <div class="col-md-12">
       <h1>Liste de messages</h1>
       <table class="table">
           <?php foreach ($messages as $k=>$v): ?>
           <tr>
                    <td><?php echo $v->id ;?></td>
                    <td><?php echo $v->id_my ;?></td>
                    <td><?php echo $v->id_other ;?></td>
                    <td><?php echo $v->pseudo ;?></td>
                    <td><?php echo $v->message ;?></td>
                    <td><?php echo $v->type ;?> </td>
                    <td><?php echo $v->view ;?></td>
                    <td><?php echo $v->created ;?></td>
                    <td>voir profil</td>
                    <td>voir jobs</td>
                    <td>ecrire message</td>
                </tr>
           <?php endforeach ;  ?>
       </table> 
        
    </div>
</div>