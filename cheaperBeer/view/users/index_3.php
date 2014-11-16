
<div class="jumbotron">
    <button type="button" class="close" aria-hidden="true" id="close_jumbro">×</button>
      <div class="container">
        
        <h1><?php echo $tv['welcome_title'] ;?></h1>
        <h3>Dublin <br><?php  echo date('l jS F Y') ;  ?> </h3>
        <p><?php echo $tv['welcome_sentence'] ;?></p>
        </div>
    </div>


               
                    <table class="table table-striped">
                        <thead>
                            <tr>
                            <td>Pubs</td>
                        <td>Beer</td>
                        <td>Price</td>
                        <td>Atmospher</td>
                        <td>Going Tonight</td>
                        <td>Info</td>
                        </tr>
                        </thead>
                        <tbody>
                            <?php if($beer_of_day):  ?>
                            <?php foreach($beer_of_day as $j=>$k):  ?>
                             <tr>
                            <td><a href="#" data-toggle="modal" data-target="#company<?php echo $j ;  ?>"><?php echo $k->company_name ;  ?></a></td>
                        <td><?php echo $k->beer ;  ?></td>
                        <td><?php echo $k->price ;  ?></td>
                        <td><?php echo $k->rate ;  ?></td>
                        <td><?php echo $k->attendee ;  ?></td>
                        <td><?php $tim= date('G');  ?>
                            <?php if($tim>20||$tim<6):  ?>
                            <a href="#" data-toggle="modal" data-target="#rate<?php echo $j ;  ?>">I'm in the place</a>
                            <?php else:  ?>
                            <a href="<?php echo Router::url('users/going/'.$k->id); ?>" >I go Tonight</a>
                            <?php endif ;  ?>
                        </td>
                             </tr>  
                                 <?php endforeach ;  ?>
                            <?php  endif; ?>
                        </tbody>
                        
                        
                    </table>
               
<?php if($beer_of_day):  ?>
<?php foreach($beer_of_day as $x=>$y): ?>
    <div id="company<?php echo $x ;  ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h1 id="banner_Modal_title" style="text-align: center;"><?php echo $y->company_name.'  ';  ?> <p class="pull-right"><i class="icon-star"></i><?php echo $y->rate;  ?></p></h1>
  </div>
   <div class="modal-body">
       
       <div class="row">
           <div class="col-lg-3" style="text-align: center; padding-top:30px;">
               <img src="http://localhost/cheaperBeer/beer.png" alt="" />
           </div>
           <div class="col-lg-9" style="text-align: center;">
               <h2>Beers List</h2>
        <p><h3><?php echo 'Monday   -'.ucfirst($y->MO_beer).'-   '.$y->MO_price.' ';  ?></h3></p>
           <p><h3><?php echo 'Tuesday   -'.ucfirst($y->TU_beer).'-   '.$y->TU_price.' ';  ?></h3></p>
           <p><h3><?php echo 'Wednesday   -'.ucfirst($y->WE_beer).'-   '.$y->WE_price.' ';  ?></h3></p>
           <p><h3><?php echo 'Thursday   -'.ucfirst($y->TH_beer).'-   '.$y->TH_price.' ';  ?></h3></p>
           <p><h3><?php echo 'Friday   -'.ucfirst($y->FR_beer).'-   '.$y->FR_price.' ';  ?></h3></p>
           <p><h3><?php echo 'Saturday   -'.ucfirst($y->SA_beer).'-   '.$y->SA_price.' ';  ?></h3></p>
           <p><h3><?php echo 'Sunday   -'.ucfirst($y->SU_beer).'-   '.$y->SU_price.' ';  ?></h3></p>
           </div>
       </div>
       
       
   </div>	
  </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div id="rate<?php echo $x ;  ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h1 id="banner_Modal_title" style="text-align: center;">RATE</h1>
  </div>
   <div class="modal-body">
       
       <div class="row">
           <div class="col-lg-offset-1 col-lg-2" style="text-align: center; padding-top:30px;">
               <a href="<?php echo Router::url('users/vote/'.$y->id.'/1') ;?>" title="PRETTY BORED !"><img src="http://localhost/cheaperBeer/img/b1.png" alt="" class="img-responsive"/></a>
           </div>
           <div class="col-lg-2" style="text-align: center; padding-top:30px;">
               <a href="<?php echo Router::url('users/vote/'.$y->id.'/2') ;?>" title="NOT 2 BAD !"><img src="http://localhost/cheaperBeer/img/b2.png" alt="" class="img-responsive"/></a>
           </div>
           <div class="col-lg-2" style="text-align: center; padding-top:30px;">
               <a href="<?php echo Router::url('users/vote/'.$y->id.'/3') ;?>" title="ENJOYING"><img src="http://localhost/cheaperBeer/img/b3.png" alt="" class="img-responsive"/></a>
           </div>
           <div class="col-lg-2" style="text-align: center; padding-top:30px;">
               <a href="<?php echo Router::url('users/vote/'.$y->id.'/4') ;?>" title="HAPPIER THAN YOU"><img src="http://localhost/cheaperBeer/img/b4.png" alt="" class="img-responsive"/></a>
           </div>
           <div class="col-lg-2" style="text-align: center; padding-top:30px;">
               <a href="<?php echo Router::url('users/vote/'.$y->id.'/5') ;?>" title="CRAZY DRUNK"><img src="http://localhost/cheaperBeer/img/b5.png" alt="" class="img-responsive"/></a>
           </div>
       </div>
       
   </div>	              
  	
  </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endforeach ;  ?>

<?php endif;  ?>

<script type="text/javascript">
    $('#close_jumbro').click(function(){
        $('.jumbotron').toggle('fast');
    });
    
    $('.ttab a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
})

</script> 
