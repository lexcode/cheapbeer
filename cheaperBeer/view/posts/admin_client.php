
<div class="row">
    <div class="col-md-12">
       <h1>Liste de clients</h1>
       <table class="table">
           <?php foreach ($clients as $k=>$v): ?>
           <tr>
                    <td><?php echo $v->id ;?></td>
                    <td><?php echo $v->pseudo ;?></td>
                    <td><?php echo $v->expense ;?></td>
                    <td><?php echo $v->id ;?>nb items</td>
                    <td><?php echo $v->id ;?> last connexion</td>
                    <td><?php echo $v->created ;?> </td>
                    <td><a href="<?php echo Router::url('admin/posts/viewclient/'.$v->id); ?>"><i class="icon-user"></i> Client Profil</a></td>
                    <td>voir jobs</td>
                    <td><a  class="btn  btn-info  btn-xs" href="javascript:void(0)" onclick="chatWith('<?php echo $v->id.'\',\''.$v->pseudo ; ?>')"><i class="icon-comment icon-white"></i> Write message</a></td>
                </tr>
           <?php endforeach ;  ?>
       </table> 
        
    </div>
</div>