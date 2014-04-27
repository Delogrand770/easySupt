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
	$formID = stripslashes($_POST['fid']);
	$formID = $db->real_escape_string($_POST['fid']);

	//Ensure event isnt already submitted
  $checkQuery = "UPDATE FORM1 SET fauxDeleted = 1 WHERE formID = ?";
  $checkStmt = $db->prepare($checkQuery);
  $checkStmt->bind_param("i", $formID);
  $checkStmt->execute();
  $checkStmt->bind_result();
  $checkStmt->store_result();
	$checkStmt->close();  // deallocate the Prepared Statement
	$db->close(); 

	header("location:dash.php");
?>