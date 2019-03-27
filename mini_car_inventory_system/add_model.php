<?php
	session_start();
	include_once('connection.php');

	if(isset($_POST['add'])){
		$database = new Connection();
		$db = $database->open();
		try{

			//make use of prepared statement to prevent sql injection
			$stmt = $db->prepare("INSERT INTO model (model_name,manufacturer_name,color,	manufacturing_year,registration_number,note,count,picture_1,picture_2) VALUES (:model_name,:manufacturer_name,:color,:manufacturing_year,:registration_number,:note,:count,:picture_1,:picture_2)");
			//if-else statement in executing our prepared statement
			$_SESSION['message'] = ( $stmt->execute(array(':model_name' => $_POST['model_name'],':manufacturer_name' => $_POST['manufacturer_name'],':color' => $_POST['color'],':manufacturing_year' => $_POST['manufacturing_year'],':registration_number' => $_POST['registration_number'],':note' => $_POST['note'],':count' => $_POST['count'],':picture_1' => $_FILES['picture_1']['name'],':picture_2' => $_FILES['picture_2']['name'])) ) ? 'Model added successfully' : 'Something went wrong. Cannot add model';	
	    
		}
		catch(PDOException $e){
			$_SESSION['message'] = $e->getMessage();
		}

		//close connection
		$database->close();
	}

	else{
		$_SESSION['message'] = 'Fill up add model form first';
	}

	header('location: index.php');
	
?>