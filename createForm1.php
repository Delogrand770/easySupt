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
	$event = stripslashes($_POST['event']);
	$event = $db->real_escape_string($_POST['event']);

	$startDay = stripslashes($_POST['startDay']);
	$startDay = $db->real_escape_string($startDay);

	$startMonth = stripslashes($_POST['startMonth']);
	$startMonth = $db->real_escape_string($startMonth);

	$emailArray = json_decode($_POST['emailField']);
	$presentArray = json_decode($_POST['presentField']);

	$date = date('Y')."-".($startMonth+1)."-".$startDay;

	//echo $date." ".$event;

	//Ensure event isnt already submitted
  $checkQuery = "SELECT * FROM EVENT WHERE (eventName = ?) AND (eventDate = ?)";
  $checkStmt = $db->prepare($checkQuery);
  $checkStmt->bind_param("ss", $event, $date);
  $checkStmt->execute();
  $checkStmt->bind_result();
  $checkStmt->store_result();

  if ($checkStmt->num_rows == 0){
		$checkStmt->close();

		//Create Event
		$checkQuery = "INSERT INTO EVENT (eventName, eventDate) VALUES(?, ?)";
		$checkStmt = $db->prepare($checkQuery);
		$checkStmt->bind_param("ss", $event, $date);
		$checkStmt->execute();
		$checkStmt->store_result();
	} else {
		header("location:form1_create.php?error=1");
		exit;
	}

	//Get Event ID
  $checkQuery = "SELECT eventID FROM EVENT WHERE (eventName = ?) AND (eventDate = ?)";
  $checkStmt = $db->prepare($checkQuery);
  $checkStmt->bind_param("ss", $event, $date);
  $checkStmt->execute();
  $checkStmt->bind_result($eventID);
  $checkStmt->fetch();
  $eventID = $eventID;
  $checkStmt->close(); 

	//Create Form1
	$checkQuery = "INSERT INTO FORM1 (eventID, squadNum) VALUES(?, ?)";
	$checkStmt = $db->prepare($checkQuery);
	$checkStmt->bind_param("ii", $eventID, $_SESSION['squadNum']);
	$checkStmt->execute();
	$checkStmt->store_result();
  $checkStmt->close(); 

	//Get Form ID
	$checkQuery = "SELECT formID FROM FORM1 WHERE (eventID = ?) AND (squadNum = ?)";
	$checkStmt = $db->prepare($checkQuery);
	$checkStmt->bind_param("ii", $eventID, $_SESSION['squadNum']);
	$checkStmt->execute();
  $checkStmt->bind_result($formID);
  $checkStmt->fetch();
  $formID = $formID;
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

	header("location:dash.php");
?>