<?php
require_once '../core/init.php';
include 'includes/info.php';
include 'includes/header.php';
?>


        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header"><?php echo $general['login']['title'];  ?></h1>
            
            <p>
            <h4 class="sub-header">Sign Up Today!</h4>
            <?php 
                 if(Input::exists()){
                   if(Token::check(Input::get('token'))){

                   		$validate = new Validate;
                   		$validation = $validate->check($_POST, [
                   			'username' => [
                   				'required'	=>	true,
                   				'min'		=>	2,
                   				'max'		=>	20,
                   				'unique'	=>	'users'
                   			],
                   			'password' => [
                   				'required'	=>	true,
                   				'min'		=> 	'6'                 			
                   			],
                   			'password_again' => [
                   				'required'	=>	true,
                   				'matches'	=>	'password'
                   			],
                   			'name' => [
                   				'required'	=>	true,
                   				'min'		=>	2,
                   				'max'		=>	50
                   			]
                   		]);

	                   	if($validation->passed()) {
                        $user = new User;
                        $salt = Hash::salt(32); 
         
                        try{
                          $user->create([
                            'username'  =>  Input::get('username'),
                            'password'  =>  Hash::make(Input::get('password'), $salt),
                            'salt'      =>  $salt,
                            'name'      =>  Input::get('name'),
                            'joined'    =>  date('Y-m-d H:i:s'),
                            'group'     =>  1
                            ]);

                          Session::flash('success', 'You have been registered and can now log in.');
                          Redirect::to('login.php');
                          ob_end_flush();
                        }catch(Exception $e){
                          die($e->getMessage());
                        }

	                   	} else {
  	                   		foreach($validation->errors() as $error){
  	                   			echo "{$error} <br>"; 
  	                   		}
	                   	}
                   }
                }   

            ?>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
              <div class="form-group">
                <label for="username">Username</label>
                <input type="email" class="form-control" id="username" name="username" placeholder="Username" value="<?php echo escape(Input::get('username')); ?>">
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="">
              </div>
              <div class="form-group">
                <label for="password_again">Confirm Password</label>
                <input type="password" class="form-control" id="password_again" name="password_again" placeholder="Confirm Password" value="">
              </div>
	          <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" value="<?php echo escape(Input::get('name')); ?>">
              </div>
                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

                <button type="submit" class="btn btn-primary">Register</button>
            </form>
            </p>
       

          
          
        </div>
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