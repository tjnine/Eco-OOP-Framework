<?php
require_once 'core/front_init.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    if(isset($_POST['first_name'], $_POST['last_name'], $_POST['email'])) {

        $first = $_POST['first_name'];
        $last = $_POST['last_name'];
        $email = $_POST['email'];

        $stmt = $dbc->prepare("INSERT INTO newsletter (first_name, last_name, email) VALUES (:first_name, :last_name, :email)");

        $stmt->bindParam(':first_name', $first);
        $stmt->bindParam(':last_name', $last);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $stmt->closeCursor();
        Redirect('index.php');
        exit();
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
    <title><?php echo $general['home']['title']; ?></title>

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
        <h2>PHP/EmberJS/Bootstrap Small-Mid Client Package</h2>
            <p>
                This is a bootstrap/ember/php package for managing small websites while still keeping future standards and tightened security. 
            </p>
        </div>

        <div class="row">
            <div class="col-md-4">
            <h4>Features</h4>
                <ul class="list-group">
                    <li class="list-group-item">User/Roles/Permisssions <i class="glyphicon-th-list
glyphicon glyphicon-ok"></i> </li>
                    <li class="list-group-item">Waiting List <i class="glyphicon-th-list
glyphicon glyphicon-ok"></i> </li>
                    <li class="list-group-item">Contact & Newsletter <i class="glyphicon-th-list
glyphicon glyphicon-ok"></i></li>
                    <li class="list-group-item">Blog</li>
                    <li class="list-group-item">Image Gallery</li>
                    <li class="list-group-item">Social Media Profiles & Feeds</li>
                    <li class="list-group-item">Api Consumptions</li>
                    <li class="list-group-item">more to come....</li>
                </ul>
            </div>
            <div class="col-md-4">
                <h4>Who Can Use This Package?</h4>
                <ul class="list-group">
                    <li class="list-group-item">Photographers</li>
                    <li class="list-group-item">Small businesses</li>
                    <li class="list-group-item">Small websites</li>
                    <li class="list-group-item">Bloggers</li>
                    <!-- <li class="list-group-item"></li> -->
                </ul>
            </div>
            <div class="col-md-4">
            <h4>Specs</h4>
                <ul class="list-group">
                    <li class="list-group-item">https/http2</li>
                    <li class="list-group-item">node 6.4 via NVM</li>
                    <li class="list-group-item">EmberJS 2.7</li>
                    <li class="list-group-item">PHP 5.6 || 7</li>
                    <li class="list-group-item">AES & Mcrypt Encryption</li>
                    <!-- <li class="list-group-item"></li> -->
                </ul>
            </div>
        </div>

    <div class="row">
        <div class="col-sm-8"></div>
        <div class="col-sm-4">
            
              <h4>Sign Up for our Newsletter</h4>

               <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                   <div class="form-group">
                       <label for="first_name">First Name</label>
                       <input type="text" name="first_name" id="first_name" placeholder="First Name" class="form-control" value="<?php echo $first; ?>">
                   </div>

                   <div class="form-group">
                       <label for="last_name">Last Name</label>
                       <input type="text" name="last_name" id="last_name" placeholder="Last Name" class="form-control" value="<?php echo $last; ?>">
                   </div>
                   <div class="form-group">
                       <label for="last_name">Email</label>
                       <input type="email" name="email" id="email" placeholder="Email" class="form-control" value="<?php echo $email; ?>">
                   </div>

                   <button type="submit" class="btn btn-primary">Submit</button>
               </form>

        </div>
    </div>

    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  </body>
</html>
