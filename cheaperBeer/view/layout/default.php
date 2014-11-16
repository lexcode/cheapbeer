<?php 


$lg=array('en','fr') ; //,'de','es','pt','it','ja','hi','ko','zh','ru') ;
    
$llg=loadLang();
$uuid=$this->Session->User('id');    
$rqc=$this->request->controller;
$rqa=$this->request->action;
$rqp=$this->request->params;
?>
<!DOCTYPE html> 
<html xmlns="https://www.w3.org/1999/xhtml" xmlns:fb="http://ogp.me/ns/fb#" xml:lang="fr" lang="fr"> 
    <head> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    
 <meta name="description" content="<?php echo isset($desc_for_layout)?$desc_for_layout: $this->s['l_description'] ; ?>" />
    <meta name="keywords" content="<?php echo isset($keyw_for_layout)?$keyw_for_layout: $this->s['l_keywords'] ; ?>" />
    
    <title><?php echo isset($title_for_layout)?$title_for_layout: $this->s['l_title'] ; ?></title> 
    <link href="http://localhost/cheaperBeer/css/font-awesome.css" rel="stylesheet">
    <link href="http://localhost/cheaperBeer/fa/css/font-awesome.css" rel="stylesheet">
    <link href="http://localhost/cheaperBeer/css/icon-hover.css" rel="stylesheet">
    <link href="http://localhost/cheaperBeer/css/i-hover.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    
    <link rel="stylesheet" href="http://localhost/cheaperBeer/bootstrap/theme/flatly.css"/>
    <link rel="stylesheet" href="http://localhost/cheaperBeer/css/main_1.css"/>
  <link rel="icon" type="image/png" href="http://localhost/cheaperBeer/beer.png" />


    
    <!--[if IE]><link rel="shortcut icon" type="image/x-icon" href="<?php echo Router::webroot('favicon.ico'); ?>" /><![endif]-->

    <script type="text/javascript" src="http://localhost/cheaperBeer/js/jqr.js"></script>
    <script type="text/javascript" src="http://localhost/cheaperBeer/js/plupload.full.min.js"></script>
    <script type="text/javascript" src="http://localhost/cheaperBeer/js/main.js"></script>
    <script type="text/javascript" src="http://localhost/cheaperBeer/bootstrap/js/bootstrap3.min.js"></script>
   </head> 
    
    
    <body >  
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '858274290870795',
      xfbml      : true,
      version    : 'v2.2'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>


       
<!-- <div class="navbar" style="position:static" >-->
     <nav class="navbar navbar-default navbar-static-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header" id="thenavbar">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo Router::url('users/index'); ?>">Cheapest Beer</a>
        </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
        <?php if(isset($_SESSION['User']->id) ): ?>        
              <ul class="nav navbar-nav">
                    <li><a href="<?php echo Router::url('users/index'); ?>" class="ajax" title="<?php echo $this->s['title_home'] ;?>"><i class="icon-home icon-white icon-hover-flip"></i><?php echo $this->s['l_home'] ;?></a></li> 
                   <li><a href="<?php echo Router::url('users/company_login'); ?>" title="<?php echo $this->s['title_messages'] ;?>"><i class="icon-user icon-white icon-hover-flip"></i>Your a Company</a></li>      
              </ul>
              <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a  href="<?php echo Router::url('users/logout') ;?>" title="<?php echo $this->s['title_logout'] ;?>"><i class="icon-off"></i><?php echo $this->s['l_logout'] ;?></a>
                      </li>
                </ul>
                
        <?php else: ?> 
        <ul class="nav navbar-nav">
                    <li><a href="<?php echo Router::url('users/index'); ?>" title="<?php echo $this->s['title_home'] ;?>"><i class="icon-home icon-white icon-hover-flip"></i><?php echo $this->s['l_home'] ;?></a></li> 
                   
        </ul>
             <ul class="nav navbar-nav navbar-right">
                 <?php if($this->Session->isLoggedCompany()):  ?>
                 <li class="dropdown">
        <a href="<?php echo Router::url('users/logout') ;?>"><i class="icon-signin icon-white icon-hover-flip"></i> Logout</a>
      </li>
      <?php endif  ?>
          
           
                 
      <li class="dropdown">
                 <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo  $this->s['l_language'] ;?> <i class="icon-globe icon-white icon-hover-flip"></i><span class="caret"></span></a>
  
      <ul class="dropdown-menu pull-rigth" role="menu" aria-labelledby="dLabel" id="settingpanel">
          <?php foreach($lg as $k=>$v):?>
       <li id="lg-<?php echo $k ;?>">
        <a href="<?php echo Router::url('users/language/'.$k) ;?>" ><?php echo $this->s[$v] ;?></a>
    </li>
        <?php endforeach ;?>
    </ul> 
          
      </li>

    </ul>
               
    <?php endif ;?>

      </li>
    </ul>
  </div><!-- /.navbar-collapse -->
</nav>

          <?php  if(isset($this->Session->read('User')->id) ){$ok=true;} else{$ok=false;} ?> 
            <div class="container">
        
                    
            <?php echo $this->Session->flash(); ?>
            
            
            
         
                <div id="content_ly">
        <?php echo $content_for_layout; ?>
            </div> 
        
          
      </div>
      
<?php if(!$this->hr_cache->start('footerSo'.$llg)): ?>
          
          <hr>
<div class="container-sn" style="width:100%; text-align:center;" id="like_bar">
    <div class="row">
        <span  style="display: inline-block;">
        <span class="col-md-4 col-xs-4"><div class="fb-like" data-href="http://localhost/cheaperBeer" data-width="450" data-layout="box_count" data-show-faces="true" data-send="false"></div></span>
     <span class="col-md-4 col-xs-4"><a href="https://twitter.com/share" class="twitter-share-button" data-url="http://localhost/cheaperBeer" data-via="atttune" data-lang="en" data-count="vertical">Tweet</a></span>
     <span class="col-md-4 col-xs-4"><div class="g-plusone" data-size="tall"></div></span>  
      
        </span>
      </div>
     
</div>
      
      <div class="first-header"></div>
      <div class="footer" style="width:100%; text-align:center;" id="footer_bar">
          
        
        <ul class="nav nav-pills" style="display: inline-block;">   
            
                   <li><a href="<?php echo Router::url('posts/about'); ?>" title="<?php echo $this->s['l_abtus'] ;?>">CheaperBeer &copy; 2014</a></li>
                    <li><a href="https://atttune.uservoice.com" target="_blank" ><?php echo $this->s['l_feedback'] ;?></a></li>
                    <li><a href="<?php echo Router::url('posts/term'); ?>" ><?php echo $this->s['l_term'] ;?></a></li> 
                    <li><a href="<?php echo Router::url('posts/privacy'); ?>"><?php echo $this->s['l_privacy'] ;?></a></li> 
                    <li><a href="<?php echo Router::url('posts/contact'); ?>">Contact</a></li>
                    <li class="dropup">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo  $this->s['l_language'] ;?> <span class="caret"></span></a>
                                    
                                    <ul class="dropdown-menu pull-rigth" role="menu" aria-labelledby="dLabel" id="settingpanel">
                                        <?php foreach ($lg as $k => $v): ?>
                                            <li id="lg-<?php echo $k; ?>">
                                                <a href="<?php echo Router::url('users/language/' . $k); ?>" ><?php echo $this->s[$v]; ?></a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul> 
                                    
                                </li>
                   
        </ul> 
          <a href="#nav-head" class="btn btn-lg btn-inverse" id="scrollToTop"><i class="icon-chevron-up icon-white"></i></a>
      </div>

    </div>
    <?php $this->hr_cache->end() ;?>
    <?php endif ;?><!-- /container -->
 

 <!--------QUICK LAUNCH--------------------------------------------------------------------> 


<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
     
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>


    <div id="droper" style="position:absolute; right:0px; width:5%; color:grey; border:black; z-index:100;">

</div>
    </body> 

</html>