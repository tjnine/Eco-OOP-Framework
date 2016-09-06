<?php 

require_once '../core/init.php';
// include 'includes/info.php';

if(Input::exists()) {
  if(Token::check(Input::get('token'))) {

	$validate = new Validate;
	$validation = $validate->check($_POST, [
	 		'username' => [
				'required'	=>	true
			],
			'password' => [
				'required'	=>	true		
			]
	]);
  	if($validation->passed()){
	  	$user = new User;
      $remember = (Input::get('remember') === 'on') ? true : false;
	  	$login = $user->login(Input::get('username'), Input::get('password'), $remember);

  		if($login){
  			// echo "<p>success</p>";
        Session::flash('home', 'You have successfully logged in ' . $user->data()->username . '.');
        Redirect::to('index.php');
       
  		}else {
  			echo "<div class=\"alert alert-warning\">There was an issue logging in, please try again.</div>";
  		}
	}else {
  		foreach($validation->errors() as $error){
  			echo "<div class=\"alert alert-warning\">{$error}</div>";
  		}
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
<!--             <li><a href="index.php">Dashboard</a></li>
            <li><a href="#">Settings</a></li>
            <li><a href="#">Profile</a></li> -->
            <li><a href="register.php">Register</a></li>
          </ul>
        
        </div>
      </div>
    </nav>

<div style="margin-top:50px;">


  	<div class="col-md-4 col-md-offset-4 bg-info" style="padding:20px;">
  	<h3 style="text-align:center">Log In</h3>
  	<form action="" method="POST">
  			<div class="form-group">
				<label for="username"><i class="text-primary">Username</i></label>
	            <input type="text" name="username" id="username" class="form-control" placeholder="username" autocomplete="off">
  			</div>
           <div class="form-group">
	           	 <label for="password"><i class="text-primary">Password</i></label>
	            <input type="password" name="password" id="password" class="form-control" placeholder="password" autocomplete="off">
           </div>
    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
		
             <div class="checkbox">
                <label>
                  <input type="checkbox" name="remember" id="remember"> Remember Me
                </label>
             </div>

            <button type="submit" class="btn btn-primary center-block">Log In</button> 
          </form>
  		</div>
  	</div>

  </body>
</html>
 