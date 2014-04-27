<?php
  // checklogin.php - 3/24/2011 - Steve Hadfield 
  // Shows how to check a login username and password 

  session_start();  // link to session info

  // check if username and password were sent
  if ( (isset($_POST['email'])) && (isset($_POST['password'])) ){ // authentication check

    // open connection to the database on LOCALHOST with 
    // userid of 'root', password of 'secret', and database 'csl'

    @ $db = new mysqli('LOCALHOST', 'root', 'secret', 'easysupt');

    // Check if there were error and if so, report and exit
    if (mysqli_connect_errno()){ 
      echo 'ERROR: Could not connect to database, error is '.mysqli_connect_error();
      exit;
    }

    // sanitize the input from the form to eliminate possible SQL Injection
    $email = stripslashes($_POST['email']);
    $email = $db->real_escape_string($email);

    $password = stripslashes($_POST['password']);
    $password = $db->real_escape_string($password);

    // encrypt the password with MD5
    $password = md5($password);

    // check that username / password pair exists
    $checkQuery = "SELECT * FROM CADET WHERE (email = ?) AND (password = ?)";
    $checkStmt = $db->prepare($checkQuery);
    $checkStmt->bind_param("ss", $email, $password);
    $checkStmt->execute();
    $checkStmt->store_result();


    // check for SQL error or if username/password pair does not exist
    if ( ($checkStmt->errno <> 0) || ($checkStmt->num_rows == 0) ){
      $checkStmt->close();
      header("location:index.html?error=1");
      exit;
    }

    //Get isAdmin and squadNum
    $checkQuery = "SELECT isAdmin, squadNum FROM CADET WHERE (email = ?) AND (password = ?)";
    $checkStmt = $db->prepare($checkQuery);
    $checkStmt->bind_param("ss", $email, $password);
    $checkStmt->execute();
    $checkStmt->bind_result($isAdmin, $squadNum);
    $checkStmt->fetch();
    $isAdmin = $isAdmin;
    $squadNum = $squadNum;


    // login was successful
    $checkStmt->close();


    // set session variable for email and isAdmin
    $_SESSION['email']=$_POST['email'];
    $_SESSION['squadNum']=$squadNum;
    $_SESSION['isAdmin']=$isAdmin;
    $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
    header("location:dash.php"); 
    exit;
  } else { // username and/or password were not sent
    header("location:index.html?error=2");
    exit;
  }
  $db->close(); 
?>