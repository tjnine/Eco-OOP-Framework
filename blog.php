<?php 
require_once 'core/front_init.php';

// include 'includes/info.php';
// $user = DB::getInstance()->get('users', ['username', '=', 'tj']);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title> <?php echo $general['blog']['title']; ?> </title>

    <!-- Bootstrap -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  <?php include 'includes/nav_menu.php'; ?>
    
    <div class="container">
        <div class="jumbotron">
        <h2>Welcome to the blog yo!</h2>
            <p>
                <?php echo $general['blog']['description']; ?>
            </p>
        </div>

        <div class="row">
           <div class="col-md-10 col-md-offset-1">
<?php

    //$blogPosts = DB::getInstance()->query("SELECT * FROM blog");
    $blog = new Blog;
    $blogPosts = $blog->getAll("SELECT * FROM blog");
    $results = $blogPosts->results();
     foreach($results as $k){
echo <<<END
            <div class="panel panel-default">
            <div class="panel-heading"><a href="">{$k->title}</a></div>
            <div class="panel-body">
              <p>{$k->text}</p>
            <p><small>Posted on <b>{$k->posted}</b></small></p>
            </div>
             </div>
END;
     }      
?>
              
           </div>
        </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  </body>
</html>