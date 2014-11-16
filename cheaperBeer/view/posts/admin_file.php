<div class="row">
    <div class="col-md-12">
       <h1>List files</h1>
       <table class="table">
           <?php foreach ($files as $k=>$v): ?>
           <tr>
                    <td><?php echo $v->id ;?></td>
                    <td><?php echo $v->id_client ;?></td>
                    <td><?php echo $v->name ;?></td>
                    <td><?php echo $v->location ;?>nb items</td>
                    <td><?php echo $v->id_jobs ;?> last connexion</td>
                    <td><?php echo $v->id_joblists ;?> </td>
                    <td><?php echo $v->date ;?> </td>
                    <td>voir profil</td>
                    <td>voir jobs</td>
                    <td>ecrire message</td>
                </tr>
           <?php endforeach ;  ?>
       </table> 
        
    </div>
</div>