<?php 
require_once 'core/front_init.php';


$waitingList = new WaitingList;

if($_SERVER['REQUEST_METHOD'] == "POST"){
   $waitingList->signUp([
    'first_name'  =>  Input::get('first_name'),
    'last_name'   =>  Input::get('last_name'),
    'phone'       =>  Input::get('phone'),
    'email'       =>  Input::get('email')
  ]);
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
       		<h2>Mailing List</h2>
            <p>
                Sign up for the mailing list and reserve your spot in line. 
            </p>
        </div>

        <div class="row">
        	<div class="col-sm-4 col-sm-offset-4">
        		<form action="" method="POST">
        			<div class="form-group">
        				<label for="first_name">First Name</label>
                       <input type="text" name="first_name" id="first_name" placeholder="First Name" class="form-control" value="">
        			</div>
        			<div class="form-group">
        				<label for="last_name">Last Name</label>
                       <input type="text" name="last_name" id="last_name" placeholder="Last Name" class="form-control" value="">
        			</div>
        			<div class="form-group">
        				<label for="phone">Phone</label>
                       <input type="text" name="phone" id="phone" placeholder="Phone" class="form-control" value="">
        			</div>
        			<div class="form-group">
        				<label for="email">Email</label>
                       <input type="email" name="email" id="email" placeholder="First Name" class="form-control" value="">
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
