<?php
	// open connection to the database on LOCALHOST with 
	// userid of 'root', password of 'secret', and database 'csl'
	session_start();

	if ($_SESSION['isAdmin'] == 0){
    header("location:dash.php");
    exit;
  }

	@ $db = new mysqli('LOCALHOST', 'root', 'secret', 'easysupt');

	// Check if there were error and if so, report and exit
	if (mysqli_connect_errno()){ 
		echo 'ERROR: Could not connect to database, error is '.mysqli_connect_error();
		exit;
	}

	// sanitize the input from the form to eliminate possible SQL Injection
	$firstNameArray = json_decode($_POST['firstNameField']);
	$lastNameArray = json_decode($_POST['lastNameField']);
	$classYearArray = json_decode($_POST['classYearField']);
	$emailArray = json_decode($_POST['emailField']);

	$password = "qweep";
	$password = md5($password);
	// print $_SESSION['squadNum'];
	// $squadNum = $_SESSION['squadNum'];

	//loop until there a no more fnmaes, should be equal to lname, emails, etc...
	for ($i = 0; $i < count($firstNameArray); $i++){
		$firstNameArray[$i] = stripslashes($firstNameArray[$i]);
		$firstNameArray[$i] = $db->real_escape_string($firstNameArray[$i]);

		$lastNameArray[$i] = stripslashes($lastNameArray[$i]);
		$lastNameArray[$i] = $db->real_escape_string($lastNameArray[$i]);

		$classYearArray[$i] = stripslashes($classYearArray[$i]);
		$classYearArray[$i] = $db->real_escape_string($classYearArray[$i]);

		$emailArray[$i] = stripslashes($emailArray[$i]);
		$emailArray[$i] = $db->real_escape_string($emailArray[$i]);

		//Check for already existing user
		$checkQuery = "SELECT * FROM CADET WHERE (email = ?)";
		$checkStmt = $db->prepare($checkQuery);
		$checkStmt->bind_param("s", $emailArray[$i]);
		$checkStmt->execute();
		$checkStmt->store_result();

		if ( ($checkStmt->errno <> 0) || ($checkStmt->num_rows <> 0) ){
			$checkStmt->close();

			$query = "UPDATE CADET SET firstName = ?, lastName = ?, classYear = ?, squadNum = ? WHERE email = ?";  // question marks are parameter locations            
			$stmt = $db->prepare($query);  // creates the Prepared Statement
			$stmt->bind_param("ssiis", $firstNameArray[$i], $lastNameArray[$i], $classYearArray[$i], $_SESSION['squadNum'], $emailArray[$i]);
		}else{
			$query = "INSERT INTO CADET (email, firstName, lastName, classYear, password, squadNum) 
			VALUES ( ?, ?, ?, ?, ?, ?)";  // question marks are parameter locations    
			$stmt = $db->prepare($query);  // creates the Prepared Statement
			$stmt->bind_param("sssisi", $emailArray[$i], $firstNameArray[$i], $lastNameArray[$i], $classYearArray[$i], $password, $_SESSION['squadNum']);
		}

		$stmt->execute();  // runs the Prepared Statement query

		//echo $stmt->affected_rows.' records inserted.<br/><br/>';  // report results
		$stmt->close();  // deallocate the Prepared Statement
		header("location:dash.php");
	}
	$db->close(); 
?>