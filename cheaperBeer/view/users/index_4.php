<script>

   $(document).ready(function(){
       
  $('#login_fcbk').click(function(){
      FB.login(function(response) {
             $(".loader").fadeOut("slow");
    
   if (response.status === 'connected') {
      // console.log(JSON.stringify(response));
        var tokken=response.authResponse.accessToken ;
      $.ajax({
                                type : "POST",
                                url : "http://localhost/cheaperBeer/invitations/facebook",
                                data : {"token":tokken} ,
                                beforeSend: function(){
                                $(".loader").fadeOut("slow");
                                },
                                success : function(){
                                        window.location.href = "http://localhost/cheaperBeer";
                              
                                     },
                                error : function(){
                                    alert(1);
                                }     
                                     
                                } );
   
  } else if (response.status === 'not_authorized') {
    alert(2);
  } else {
    alert(3);
  }
 }, {scope: 'public_profile,email'}); 
  });
 });
</script>

<script type="text/javascript" src="http://localhost/cheaperBeer/js/signup.js"></script>

<style type="text/css">

.jumbotron {
  background: url('http://localhost/cheaperBeer/logo.png') no-repeat top center;
  color: #18bc9c;
  //color: white;
}

</style>
<div class="jumbotron">
    <button type="button" class="close" aria-hidden="true" id="close_jumbro">×</button>
      <div class="container">
        
        <h1><?php echo $tv['welcome_title'] ;?></h1>
        <h3>Dublin <br><?php  echo date('l jS F Y') ;  ?> </h3>
        <p><?php echo $tv['welcome_sentence'] ;?></p>
        <div class="row">
    <div class="col-md-6">
        <a href="#facebook" class="btn btn-block btn-fcbk" id="login_fcbk"><i class="icon-facebook icon-hover-flip"></i>  <?php echo $tv['cnx_facebook'];  ?></a>
    </div>   
    <div class="col-md-6">  
        <a href="<?php echo Router::url('users/company_login'); ?>" class="btn btn-info btn-block">Beer Supplier</a>
    </div>
</div>
        </div>
    </div>
<br /><br />



<script type="text/javascript">
    $('#close_jumbro').click(function(){
        $('.jumbotron').toggle('fast');
    });
    
    $('.ttab a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
})

</script> 
<script type="text/javascript">



</script>
<script type="text/javascript" src="http://localhost/cheaperBeer/js/cart.js"></script>
<script type="text/javascript" src="http://localhost/cheaperBeer/js/form-validator.js"></script>
