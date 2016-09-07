<?php 

require_once '../core/init.php';
// include 'includes/info.php';

$user = new User;

if(!$user->isLoggedIn()) {
 Redirect::to('login.php');
}

if(Input::exists()) {
	if(Token::check(Input::get('token'))) {
		$validate = new Validate;
		$validation = $validate->check($_POST, [
				'password_current'	=>	[
					'required'	=>	true,
					'min'	=>	6
				],
				'password_new'	=>	[
					'required'	=>	true,
					'min'	=>	6
				],
				'password_new_again'	=>	[
					'required'	=>	true,
					'min'	=>	6,
					'matches'	=>	'password_new'
				]
		]);

			if($validation->passed()) {
				if(Hash::make(Input::get('password_current'), $user->data()->salt) !== $user->data()->password) {
					echo '<div class="alert alert-warning">The password you entered was incorrect.</div>';
				}else {
					$salt = Hash::salt(32);
					$user->update([
						'password'	=>	Hash::make(Input::get('password_new'), $salt),
						'salt'		=>	$salt
					]);
					Session::flash('home', 'Your password has been successfully changed.');
					Redirect::to('index.php');
				}

			}else {
					foreach($validation->errors() as $error) {
						echo '<div class="alert alert-warning">{$error}</div>';
					}	
			}
		

	} // end if(Token::check(Input::get('token')))
} // end if(Input::exists())

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
            }
          ?>

        
        </div>
      </div>
    </nav>

<div style="margin-top:50px;">


  	<div class="col-md-4 col-md-offset-4 bg-info" style="padding:20px;">
  	<h4 style="text-align:center">Change Password</h4>
  	<form action="" method="POST">
  			<div class="form-group">
				<label for="password_current"><i class="text-primary">Password</i></label>
	            <input type="password" name="password_current" id="password_current" class="form-control" placeholder="current password" autocomplete="off">
  			</div>
           <div class="form-group">
	           	 <label for="password_new"><i class="text-primary">New Password</i></label>
	            <input type="password" name="password_new" id="password_new" class="form-control" placeholder="new password" autocomplete="off">
           </div>
           <div class="form-group">
	           	 <label for="password_new_again"><i class="text-primary">New Password</i></label>
	            <input type="password" name="password_new_again" id="password_new_again" class="form-control" placeholder="new password" autocomplete="off">
           </div>
    			<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

            <button type="submit" class="btn btn-primary center-block">Update</button> 
          </form>
  		</div>
  	</div>
 <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
   <!--  <script src="../../assets/js/vendor/holder.min.js"></script> -->
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!-- <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script> -->
  </body>
</html>