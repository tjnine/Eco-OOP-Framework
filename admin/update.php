<?php 
require_once '../core/init.php';

$user = new User;

	if(!$user->isLoggedIn()){
		Redirect::to('index.php');
	}

	if(Input::exists()){
		if(Token::check(Input::get('token'))){

			$validate = new Validate;
			$validation = $validate->check($_POST, [
				'name' => [
					'required'	=>	true,
					'min'		=>	2,
					'max'		=>	50
				]
			]);
	
			if($validation->passed()){

				try{
					$user->update([
						'name'	=>	Input::get('name')
					]);
				}catch(Exception $e){
					die($e->getMessage());
				}
			}else{
				foreach($validation->errors() as $error){
					echo $error . '<br>';
				}
			}

			if(Session::flash('update', 'Your details have been updated successfully.')){
				Redirect::to('index.php');
		
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

            if($user->isLoggedIn()){
echo <<<END
        <li><a href="index.php">Dashboard</a></li>
        <li><a href="profile.php">Profile</a></li>    
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Settings <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="update.php">Update Profile</a></li>
            <li><a href="changepassword.php">Change Password</a></li>
            <li><a href="#">Something else here</a></li>
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
  	<div class="col-md-4 col-md-offset-4 bg-info" style="padding:20px;">
    	<h4 style="text-align:center">Update Profile</h4>
  	   <form action="" method="POST">
  			<div class="form-group">
				<label for="name"><i class="text-primary">Name</i></label>
	            <input type="text" name="name" id="name" class="form-control" placeholder="name" autocomplete="off" value="<?php echo escape($user->data()->name); ?>">
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
