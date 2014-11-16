<!DOCTYPE html> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr"> 
    <head> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
    <title><?php echo isset($title_for_layout)?$title_for_layout:'Administration'; ?></title> 
    <link href="http://localhost/cheaperBeer/css/font-awesome.css" rel="stylesheet">
    <link href="http://localhost/cheaperBeer/fa/css/font-awesome.css" rel="stylesheet">
    <link href="http://localhost/cheaperBeer/css/icon-hover.css" rel="stylesheet">
    <link href="http://localhost/cheaperBeer/css/i-hover.css" rel="stylesheet">
    <!-- Custom styles for this template -->
        <link rel="stylesheet" href="http://localhost/cheaperBeer/css/chat.css"/>

    <link rel="stylesheet" href="http://localhost/cheaperBeer/bootstrap/theme/simplex.css"/>
    <link rel="stylesheet" href="http://localhost/cheaperBeer/css/main_1.css"/>
  <link rel="icon" type="image/png" href="http://localhost/cheaperBeer/favswa.png" />


    
    <!--[if IE]><link rel="shortcut icon" type="image/x-icon" href="<?php echo Router::webroot('favicon.ico'); ?>" /><![endif]-->


    </head> 
    <body>       
      
     <nav class="navbar navbar-inverse navbar-static-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header" id="thenavbar">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo Router::url('users/index'); ?>">CheaperBeer</a>
        </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
              
              <ul class="nav navbar-nav"> 
                <li><a href="<?php echo Router::url('admin/posts/index'); ?>"><i class="icon-tasks icon-white  icon-hover-flip"></i> Administration</a></li>
                  <li><a href="<?php echo Router::url('admin/posts/urgent'); ?>"><i class="icon-time icon-white  icon-hover-flip"></i> Urgent</a></li>
                <li><a href="<?php echo Router::url('admin/posts/client'); ?>"><i class="icon-group icon-white  icon-hover-flip"></i> Client</a></li>
                <li><a href="<?php echo Router::url('admin/posts/job'); ?>"><i class="icon-inbox icon-white  icon-hover-flip"></i> Jobs</a></li>
                <li><a href="<?php echo Router::url('admin/posts/message'); ?>"><i class="icon-envelope icon-white  icon-hover-flip"></i> Messages</a></li>
                <li><a href="<?php echo Router::url('admin/posts/file'); ?>"><i class="icon-folder-open icon-white  icon-hover-flip"></i> Files</a></li>
                <li><a href="<?php echo Router::url('admin/posts/finance'); ?>"><i class="icon-money icon-white  icon-hover-flip"></i> Finance</a></li>
                </ul>
              <ul class="nav navbar-nav navbar-right">
                  <li><a href="<?php echo Router::url(); ?>"><i class="icon-home icon-white  icon-hover-flip"></i> Voir le site</a></li>
                <li><a href="<?php echo Router::url('users/logout'); ?>"><i class="icon-off icon-white  icon-hover-flip"></i> Se déconnecter</a></li>
              </ul>
            </div> 
         
        </nav> 
 
        <div class="container" style="padding-top:60px;">
            <?php echo $this->Session->flash(); ?>
        	<?php echo $content_for_layout; ?>
        </div>
    <script type="text/javascript" src="http://localhost/cheaperBeer/js/jqr.js"></script>
    <script type="text/javascript" src="http://localhost/cheaperBeer/js/chat.js"></script>
    <script type="text/javascript" src="http://localhost/cheaperBeer/js/plupload.full.min.js"></script>
    <script type="text/javascript" src="http://localhost/cheaperBeer/js/main.js"></script>
    <script type="text/javascript" src="http://localhost/cheaperBeer/bootstrap/js/bootstrap3.min.js"></script>
    </body> 
    
</html>