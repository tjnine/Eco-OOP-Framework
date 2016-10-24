<?php 
require_once 'core/front_init.php';
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $general['home']['title']; ?></title>

    <!-- Bootstrap -->
    <link href="./bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  <?php include 'includes/nav_menu.php'; ?>
    
    <div class="container-fluid">

    <div class="row">
        <div class="col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
         <div class="panel-primary">
             <div class="panel-heading">
             <h4><?php echo $_GET['title']; ?></h4>
             </div>
             <div class="panel-body">
        
             <small>Posted: <?php 
                $date = date_create($_GET['posted']);
            echo date_format($date, 'Y-m-d'); ?></small>
            <p>
                <?php echo $_GET['text']; ?>
            </p>         



            <p><a href="blog.php">Go Back</a></p>
             </div>
         </div>
        </div>
    </div>


    </div>

       <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  </body>
</html>