<?php
//db settings must be changed to use .ini file or private $var inside class::MyPDO
$user = 'root';
$pass = 'root';
$dbc = new PDO('mysql:host=localhost;dbname=octane',$user,$pass);

	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		//Minimal Form Validation
		if(isset($_POST['first_name'], $_POST['last_name'],$_POST['email'])){
			$stmt = $dbc->prepare("INSERT INTO waiting_list (id, first_name, last_name, email) VALUES (:id, :first_name, :last_name, :email)");
			$stmt->bindParam(':first_name', $first);
			$stmt->bindParam(':last_name', $last);
			$stmt->bindParam(':email', $email);
			$stmt->bindParam(':id', 2);
			$first = $_POST['first_name'];
			$last = $_POST['last_name'];
			$email = $_POST['email'];
			$stmt->execute();
		}
	}

?>