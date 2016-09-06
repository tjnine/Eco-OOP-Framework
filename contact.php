<?php 
include 'info.php';
include 'settings.php';
include 'helpers.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        //Minimal Form Validation
        if(isset($_POST['first_name'], $_POST['last_name'], $_POST['email'])){

            $first = $_POST['first_name'];
            $last = $_POST['last_name'];
            $email = $_POST['email'];
            
            $stmt = $dbc->prepare("INSERT INTO contact (first_name, last_name, email) VALUES (:first_name, :last_name, :email)");
            $stmt->bindParam(':first_name', $first);
            $stmt->bindParam(':last_name', $last);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            // $stmt->closeCursor();
            Redirect('index.php');
            // header("Location: index.php");
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
    <title> <?php echo $general['contact']['title']; ?> </title>

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
  <?php include 'nav_menu.php'; ?>
    
    <div class="container">
        <div class="jumbotron">
        <h2>Contact Page</h2>
            <p>
                This is the contact page using <st>js</st> EmberJS for client side validation using computed properties. Server side validation and sanitization is vanilla php. 
            </p>
        </div>

        <div class="row">
           <div class="col-md-6 col-md-offset-3">
           <i><? echo $general['contact']['description']; ?></i>

               <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                   <div class="form-group">
                       <label for="first_name">First Name</label>
                       <input type="text" name="first_name" id="first_name" placeholder="First Name" class="form-control" value="<? echo $first; ?>">
                   </div>

                   <div class="form-group">
                       <label for="last_name">Last Name</label>
                       <input type="text" name="last_name" id="last_name" placeholder="Last Name" class="form-control" value="<? echo $last; ?>">
                   </div>
                   <div class="form-group">
                       <label for="last_name">Email</label>
                       <input type="email" name="email" id="email" placeholder="Email" class="form-control" value="<? echo $email; ?>">
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
