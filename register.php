<html>
<head>
<title>easySupt</title>

<link rel=StyleSheet href="style.css" type="text/css">
<script src="gaia.js"></script>
<script>
var draw = {
  resultPretty: null,
  ui:function(){
    html = XU.el('resultHTML').innerHTML;
    draw.resultPretty = XM.static({title: 'registration status', body: html , centered: true, width: 500});
    XU.el('resultHTML').innerHTML = "";
  },
  reposition:function(){
    XM.reCenter(draw.resultPretty);
  },
  go:function(param){
    document.location.href = param;
  },
  ini:function(){
    draw.ui();
  }
};
</script>
</head>

<body onload="draw.ini()" onresize="draw.reposition()">

<center>
  <h1>easySupt</h1>
</center>

<span id="resultHTML" style="display:none;">
  <?php 
    // register.php - Steve Hadfield - 3/24/2011
    // open connection to the database on LOCALHOST with 
    // userid of 'root', password 'secret', and database 'easysupt'
    @ $db = new mysqli('LOCALHOST', 'root', 'secret', 'easysupt');

    // Check if there were error and if so, report and exit
    if (mysqli_connect_errno()){ 
      echo 'ERROR: Could not connect to database, error is '.mysqli_connect_error();
      exit;
    }

    // sanitize the input from the form to eliminate possible SQL Injection
    $email = stripslashes($_POST['email']);
    $email = $db->real_escape_string($email);

    //Check for already registered email
    $checkQuery = "SELECT * FROM CADET WHERE (email = ?)";
    $checkStmt = $db->prepare($checkQuery);
    $checkStmt->bind_param("s", $email);
    $checkStmt->execute();
    $checkStmt->store_result();
    if ( ($checkStmt->errno <> 0) || ($checkStmt->num_rows <> 0) ){
      $checkStmt->close();
      header("location:register.html?error=1");
      exit;
    }

    $password = stripslashes($_POST['password']);
    $password = md5($password);
    $password = $db->real_escape_string($password);

    $squadron = stripslashes($_POST['squadron']);
    $squadron = $db->real_escape_string($squadron);

    //Check if the user is the first to register for a squadron and determine admin role
    $isAdmin = 0;
    $checkQuery = "SELECT * FROM CADET WHERE (squadNum = ?)";
    $checkStmt = $db->prepare($checkQuery);
    $checkStmt->bind_param("i", $squadron);
    $checkStmt->execute();
    $checkStmt->store_result();
    if ( ($checkStmt->errno <> 0) || ($checkStmt->num_rows == 0) ){
      $checkStmt->close();
      $isAdmin = 1;
    }


    // set up a prepared statement to insert the volunteer info
    $query = "INSERT INTO cadet (email, password, squadNum, isAdmin) 
             VALUES ( ?, ?, ?, ?)";  // question marks are parameter locations

    $stmt = $db->prepare($query);  // creates the Prepared Statement

    // binds the parameters of Prepared Statement to corresponding variables
    // first argument, "sssiss", gives the parameter data types of 3 strings, an int, 2 strings
    $stmt->bind_param("ssii", $email, $password, $squadron, $isAdmin);

    $stmt->execute();  // runs the Prepared Statement query

    //echo $stmt->affected_rows.' records inserted.<br/><br/>';  // report results
    $stmt->close();  // deallocate the Prepared Statement
    $db->close();    // close the database connection
  ?>
  <center>
    The email <font color="#0099ff"><?php echo $email; ?></font> was successfully registered to <font color="#0099ff">squadron <?php echo $squadron; ?></font>
    <br><br>
    <a href="index.html" style="color: #0099ff;">Click Here</a> to return to login.
  </center>
</span>

</body>
</html>