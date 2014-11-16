<div class="row">
  <?php if(isset($tags)): ?>
<table class="table span5 table-bordered">
    <tr>
        <th>Tag</th>
        <th>Date</th>
        <th>Action</th>
      
    </tr>
    
    <?php foreach($tags as $k=>$v): ?>

    <tr>
        <td>
           <a href="<?php echo Router::url('users/index/'.$v->id_tag); ?>"><?php echo $v->name ;?></a> 
        </td>
        <td>
            <?php echo date("M j, H:i",$v->created) ;?>
        </td>
        <?php if($own===true): ?>
        <td>
            <a href="<?php echo Router::url('categories/delete_tag/'.$v->id); ?>"><i class="icon-remove"></i></a>
        </td>
        <?php else: ?>
        <td>
         <a href="<?php echo Router::url('categories/tag/'.$v->id); ?>"><i class="icon-circle-arrow-down"></i></a>
        </td>
        <?php endif ;?>
        
        
    </tr>    
    
    <?php endforeach;?>
</table>
    

<?php endif; ?>
<div class="col-md-4">

    <?php $mynterest=$this->allinteres() ;?>
              <?php
              $mint='';
              foreach( $mynterest as $k=>$v){
                  $mint.='   <a class="btn btn-info" title="'.$tv['add_tag'].'" href="'.Router::url('categories/tag/'.$v->id).'">'.$v->name.'<i class="icon-arrow-down icon-white"></i></a> ';
              } 
              echo $mint;
              ?>
</div>  
</div>


