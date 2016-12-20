<?php 
require_once '../core/init.php';

if($_SERVER["REQUEST_METHOD"] == 'POST') {



     $uploads_dir = './uploads';
        foreach ($_FILES["pictures"]["error"] as $key => $error) {
           if ($error == UPLOAD_ERR_OK) {
            $tmp_name = $_FILES["pictures"]["tmp_name"][$key];
            // basename() may prevent filesystem traversal attacks;
            // further validation/sanitation of the filename may be appropriate
            $name = "uploads/" . $_FILES["pictures"]["name"][$key];
            move_uploaded_file($tmp_name, $name);
             }
        }
}

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>PHP Eco Dashboard</title>

    <!-- Bootstrap core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!-- <link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet"> -->

    <!-- Custom styles for this template -->
    <link href="../assets/css/dashboard.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
  <!--   <script src="../../assets/js/ie-emulation-modes-warning.js"></script> -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="http://localhost:8888/Vanilla/">View Site</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
          <?php 
             $user = new User;
            if($user->isLoggedIn()){
echo <<<END
        <li><a href="index.php">Dashboard</a></li>
        <li><a href="blog.php">Blog</a></li>
        <li><a href="profile.php">Profile</a></li>    
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Settings <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="update.php">Update Profile</a></li>
            <li><a href="changepassword.php">Change Password</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </li>
        <li><a href="logout.php" id="logout">Logout</a></li>
      </ul>
END;
            } else{
              Redirect::to('login.php');
            }
          ?>
         
        
        </div>
      </div>
    </nav>

<div style="margin-top:50px;">
    <div class="col-md-10 col-md-offset-1 bg-info" style="padding:20px;">
        <div class="col-md-8 col-md-offset-2">
            <h4 style="text-align:center">Upload Images</h4>
             <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                <label for="title"><i class="text-primary">Title</i></label>
                <input type="text" name="title" id="title" class="form-control" value="">
                </div>  

                <div class="form-group">
                <label for="exampleInputFile">File input</label>
                <input name="pictures[]" type="file" id="exampleInputFile">
                <p class="help-block">Example block-level help text here.</p>
                </div>

                <div class="form-group">
                <label for="metadata"><i class="text-primary">SEO Meta Data</i></label>
                <input type="metadata" name="metadata" id="metadata" class="form-control" value="">
                </div>  
                

                <button type="submit" class="btn btn-primary center-block">Create</button> 
             </form>
        </div>  
    </div>
</div>
 <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea' });</script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
   <!--  <script src="../../assets/js/vendor/holder.min.js"></script> -->
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!-- <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script> -->
  </body>
</html>