<?php
	session_start();
	include_once('connection.php');

	if(isset($_POST['add'])){
		$database = new Connection();
		$db = $database->open();
		try{
			//make use of prepared statement to prevent sql injection
			$stmt = $db->prepare("INSERT INTO manufacturer (manufacturer_name) VALUES (:manufacturer_name)");
			echo "INSERT INTO manufacturer (manufacturer_name) VALUES (:manufacturer_name)";
			//if-else statement in executing our prepared statement
			$_SESSION['message'] = ( $stmt->execute(array(':manufacturer_name' => $_POST['manufacturer_name'])) ) ? 'Manufacturer  added successfully' : 'Something went wrong. Cannot add manufacturer';	
	    
		}
		catch(PDOException $e){
			$_SESSION['message'] = $e->getMessage();
		}

		//close connection
		$database->close();
	}

	else{
		$_SESSION['message'] = 'Fill up add form first';
	}

	header('location: index.php');
	
?>