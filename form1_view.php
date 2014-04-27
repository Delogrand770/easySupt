<?php

  // retrieve session information
  session_start();
	echo $_SESSION['email']; 
	$formID = $_GET['form'];
  // if no username set, then redirect to login
  if (!isset($_SESSION['email'])){
    header("location:index.html");
    exit;
  }
  //Try to prevent session stealing
  if ($_SESSION['ip'] <> $_SERVER['REMOTE_ADDR']){
    header("location:logout.php");
    exit;
  }
  // if not admin then you can't be on the form-1 creation page.
  if ($_SESSION['isAdmin'] == 0){
  }else{
  	echo " - admin";
  }
?>
<html>
<head>
<title>easySupt</title>

<link rel=StyleSheet href="style.css" type="text/css">
<script src="gaia.js"></script>
<?php
  // open connection to the database on LOCALHOST with 
  // userid of 'root', password of 'secret', and database 'csl'

  @ $db = new mysqli('LOCALHOST', 'root', 'secret', 'easysupt');

  // Check if there were error and if so, report and exit
  if (mysqli_connect_errno()){ 
    echo 'ERROR: Could not connect to database, error is '.mysqli_connect_error();
    exit;
  }

// run the SQL query to retrieve the service partner info
$results = $db->query('SELECT * FROM CADET');

// determine how many rows were returned
$num_results = $results->num_rows;

?>
<script>
	now = new Date();
	year = now.getFullYear();
	month = now.getMonth();
	//Debug to test begining of 1st semester
	//year = 2012;
	//month = 7;
	year = (month > 6) ? year - 1999 : year - 2000;
	firstName = new Array();
	lastName = new Array();
	classYear = new Array();
	email = new Array();
	present = new Array();
	<?php
		// loop through each row building the table rows and data columns
		$i = 0;
		foreach ($results as $r) {
			if ($r['classYear']){
				echo "firstName[$i]='".$r['firstName']."';\n";
				echo "lastName[$i]='".$r['lastName']."';\n";
				echo "email[$i]='".$r['email']."';\n";
				echo "classYear[$i]=".$r['classYear'].";\n";
				echo "present[$i]=true;\n";
			}
		  $i++;
		}		
		// deallocate memory for the results and close the database connection
		$results->free();

		//Get Form Info
		$checkQuery = "SELECT cadetID FROM ATTEND WHERE (formID = ?)";
    $checkStmt = $db->prepare($checkQuery);
    $checkStmt->bind_param("i", $formID);
    $checkStmt->execute();
    $checkStmt->bind_result($cadetID);
    $checkStmt->store_result();
    $rows = $checkStmt->num_rows;
		while ($checkStmt->fetch()) {
			$cadetID = $cadetID;
			echo "present[".($cadetID-1)."]=false;\n";
		}
		$checkStmt->close();

	$checkQuery = "SELECT eventName, eventDate FROM EVENT NATURAL JOIN FORM1 WHERE (formID = ?)";
  $checkStmt = $db->prepare($checkQuery);
  $checkStmt->bind_param("i", $formID);
  $checkStmt->execute();
  $checkStmt->bind_result($eventName, $eventDate);
  $checkStmt->fetch();
  $eventNames = $eventName;
  $eventDates = $eventDate;
  $db->close();

	?>
</script>

<script>
var draw = {
	infoPretty: null,
	onePretty: null,
	confirmBtn: null,
	months: new Array("Janurary", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"),
	ui:function(){
		html = XU.el('infoHTML').innerHTML;
		draw.infoPretty = XM.static({title: 'info', body: html , top: 60, left: 'center'});
		XU.el('infoHTML').innerHTML = "";

		html = XU.el('oneHTML').innerHTML;
		draw.onePretty = XM.static({title: 'form-1', body: html , width: 800, top: 280, left: 'center'});
		XU.el('oneHTML').innerHTML = "";
	},
	reposition:function(){
		XM.setPosition(draw.infoPretty, {top: 60, left: 'center'});
		XM.setPosition(draw.onePretty, {top: 280, left: 'center'});
	},
	go:function(param){
		document.location.href = param;
	},
	delete:function(){
		draw.confirmBtn = XM.confirm({title: 'easySupt', body: '<center>Are you sure you want to delete this forever?</center>', screen: true});
	},
	ini:function(){
		draw.ui();
		error = draw.getURLParameter('error');
		if (error){
			XM.alert({title: 'error', body: '<center>event with the exact name and date already exists</center>', centered: true, screen: true,});
		}
	},
	status:function(){
		index = event.target.getAttribute('index');
		//alert(firstName[index] + ',' + lastName[index] + ',' + classYear[index] + ',' + present[index]);
		present[index] = !present[index];
		event.target.className = (!present[index]) ? "f1_td_selected" : "f1_td_default";
	},
	insertRoster:function(offset){
		for (i = 0; i < firstName.length; i++){
			if (classYear[i] == year + offset){
				myClass = (present[i]) ? "f1_td_default" : "f1_td_selected";
				document.write('<tr><td class="' + myClass + '" onclick="draw.status()" index=' + i + '>' + firstName[i] + ' ' + lastName[i] + '</td></tr>');
			}
		}
	},
	validate:function(){
		form = document.forms['datePicker'];
		form['formIDField'].value = <?php echo $formID ?>;
		form['presentField'].value = JSON.stringify(present);
		form.submit();
	},
	requestExcusals:function(){
		form      = document.forms['datePicker'];
		eventName = form['event'].value;
		eventDate = form['date'].value.split('-')[1] + ' ' + draw.months[parseInt(form['date'].value.split('-')[2])];
		subject   = "Excusal Request - " + eventName;
		emailBody = "You are currently marked absent for the " + eventName + " that occured on " + eventDate 
										+ ".%0D%0APlease email your excusal to the squadron superintendent.%0D%0A%0D%0ASent by easySupt";

		//Create a email list of the people marked absent
		mailList = "";
		for (i = 0; i < email.length; i++) {
			mailList += (!present[i]) ? email[i] + ";" : "";
		}

		mailtoLink = 'mailto:' + mailList + '?subject=' + subject + '&body=' + emailBody;

		//Triggers the mailto link by opening a new window with the mailto as the address.
		mailtoWindow = window.open(mailtoLink, 'mailto');

		//Closes the new window because the default mail client will have taken over by this point.
		mailtoWindow.close();
	}
};
</script>



</head>

<body onload="draw.ini()" onresize="draw.reposition()">

<center>
	<h1>easySupt</h1>
</center>
<span id="infoHTML" style="display:none;">
	<center>
	<form name="datePicker" method="post" action="updateForm1.php">
		<table>
			<tr>
				<td colspan=2><input type="text" name="event" class="txt" style="width:162;text-align:center;background-Color:transparent;" value="<?php echo $eventNames ?>" readonly></td>
			</tr>
			<tr>
				<td colspan=2><input type="text" name="date" class="txt" style="width:162;text-align:center;background-Color:transparent;" value="<?php echo $eventDates ?>" readonly></td>
			</tr>
		</table>
		<input type="hidden" name="formIDField">
		<input type="hidden" name="presentField">
	</form>
	<table>
		<tr>
			<td colspan=2>
				<input type="button" value="back" class="btn" onclick="draw.go('dash.php')">
				<?php 
					if ($_SESSION['isAdmin']){ 
						print '<input type="button" value="save" class="btn" onclick="draw.validate()">';
					} 
				?>
			</td>
		</tr>
		<tr>
			<td colspan=2>
				<center>
					<?php 
						if ($_SESSION['isAdmin']){ 
							print '<input type="button" value="request excusals" class="btn" onclick="draw.requestExcusals()">';
						} 
					?>
				</center>
			</td>
		</tr>
	</table>
	</center>
</span>

<span id="oneHTML">
	<center>
		<table border="0">
		<tr>
			<td style="color:#0099ff;"><h1><script>document.write('20' + year)</script></h1></td>
			<td style="color:#0099ff;"><h1><script>document.write('20' + (year + 1))</script></h1></td>
			<td style="color:#0099ff;"><h1><script>document.write('20' + (year + 2))</script></h1></td>
			<td style="color:#0099ff;"><h1><script>document.write('20' + (year + 3))</script></h1></td>
		</tr>
		<tr>
			<td style="vertical-align:top;">
				<table cellpadding=0 cellspacing=0>
					<script>draw.insertRoster(0);</script>
				</table>
			</td>
			<td style="vertical-align:top;">
				<table cellpadding=0 cellspacing=0>
					<script>draw.insertRoster(1);</script>
				</table>
			</td>
			<td style="vertical-align:top;">
				<table cellpadding=0 cellspacing=0>
					<script>draw.insertRoster(2);</script>
				</table>
			</td>
			<td style="vertical-align:top;">
				<table cellpadding=0 cellspacing=0>
					<script>draw.insertRoster(3);</script>
				</table>
			</td>
		</tr>
   </table>
   </center>
	</span>
</body>
</html>