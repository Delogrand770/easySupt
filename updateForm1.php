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
	$presentArray = json_decode($_POST['presentField']);
	$formID = stripslashes($_POST['formIDField']);
	$formID = $db->real_escape_string($formID);

	//Delete existing formID entries
	$checkQuery = "DELETE FROM ATTEND WHERE formID = ?";
	$checkStmt = $db->prepare($checkQuery);
	$checkStmt->bind_param("i", $formID);
	$checkStmt->execute();
	$checkStmt->store_result();
  $checkStmt->close(); 

	//loop until there a no more emails
	$checkQuery = "INSERT INTO ATTEND VALUES(?, ?)";
	$checkStmt = $db->prepare($checkQuery);
	for ($i = 0; $i < count($presentArray); $i++){
		$presentArray[$i] = stripslashes($presentArray[$i]);
		$presentArray[$i] = $db->real_escape_string($presentArray[$i]);
		echo $formID;
		//Update Form Status
		if (!$presentArray[$i]){
			$cadetID = $i+1;
			$checkStmt->bind_param("ii", $cadetID, $formID);
			$checkStmt->execute();
			$checkStmt->store_result();
		}
	}
	$checkStmt->close();  // deallocate the Prepared Statement
	$db->close(); 

	header("location:form1_view.php?form=".$formID);
?>