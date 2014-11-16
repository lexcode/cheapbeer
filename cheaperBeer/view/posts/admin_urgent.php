    <div class="col-md-12">
       <h1>List of priority</h1>
       <table class="table">
           <?php foreach ($priorities as $k=>$v): ?>
           <tr>
                    <td><?php echo $v->id ;?></td>
                    <td><?php echo $v->pseudo ;?></td>
                    <td><?php echo $v->expense ;?></td>
                    <td><?php echo $v->id ;?>nb items</td>
                    <td><?php echo $v->id ;?> last connexion</td>
                    <td><?php echo $v->created ;?> </td>
                    <td>voir profil</td>
                    <td>voir jobs</td>
                    <td>ecrire message</td>
                </tr>
           <?php endforeach ;  ?>
       </table> 
        
    </div>