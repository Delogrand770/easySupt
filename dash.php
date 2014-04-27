<?php

  // retrieve session information
  session_start();
	echo $_SESSION['email']; 
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
  if ($_SESSION['isAdmin'] == 1){
  	echo " - admin";
  }
?>
<html>
<head>
<title>easySupt</title>

<link rel=StyleSheet href="style.css" type="text/css">
<script src="gaia.js"></script>
<script>
var draw = {
	buttonPretty: null,
	historyPretty: null,
	confirmBtn: null,
	ui:function(){
		html = XU.el('buttonHTML').innerHTML;
		draw.buttonPretty = XM.static({title: "control panel - cs<?php print $_SESSION['squadNum'] ?>", body: html , top: 100, left: 'center', width: 500});
		XU.el('buttonHTML').innerHTML = "";

		html = XU.el('historyHTML').innerHTML;
		draw.historyPretty = XM.static({title: 'form-1 history', body: html , width: 500, top: 250, left: 'center'});
		XU.el('historyHTML').innerHTML = "";
	},
	reposition:function(){
		XM.setPosition(draw.buttonPretty, {top: 100, left: 'center'});
		XM.setPosition(draw.historyPretty, {top: 250, left: 'center'});
	},
	go:function(param){
		document.location.href = param;
	},
	delete:function(formID){
		form = document.forms['formDelete']['fid'].value = formID;
		draw.confirmBtn = XM.confirm({
			title:'delete?', 
			body:'<center>are you sure you want to delete this form-1 forever?</center>', 
			width:400,
			screen:true,
      callback:function(result){
      	if (result == 'true'){
					form = document.forms['formDelete'].submit();
      	}
      }
		});
	},
	ini:function(){
		draw.ui();
	}
};
</script>
</head>

<body onload="draw.ini()" onresize="draw.reposition()">

<form name="formDelete" method="post" action="deleteForm1.php" style="display:none;">
	<input type="textarea" name="fid">
</form>

<center>
	<h1>easySupt</h1>
	<span style="font-size: medium;">Welcome <?php echo $_SESSION['email']; ?></span>
</center>

<span id="buttonHTML" style="display:none;">
	<center>
	<table class="table">
		<tr>
			<?php
				if ($_SESSION['isAdmin'] == 1){
					print '<td><input type="button" value="new from-1" class="btn" onclick="draw.go(\'form1_create.php\')"></td>';
					print '<td><input type="button" value="cadet roster" class="btn" onclick="draw.go(\'manageRoster.php\')"></td>';
				}
			?>
			<td><input type="button" value="logout" class="btn" onclick="draw.go('logout.php')"></td>
		</tr>
	</table>
	</center>
</span>

<span id="historyHTML" style="display:none;">
	<center>
	<table class="table" cellpadding=5>
		<?php
			@ $db = new mysqli('LOCALHOST', 'root', 'secret', 'easysupt');

			// Check if there were error and if so, report and exit
	  	if (mysqli_connect_errno()){ 
	    	echo 'ERROR: Could not connect to database, error is '.mysqli_connect_error();
	    	exit;
	  	}

			// run the SQL query to retrieve the service partner info
			$results = $db->query('SELECT * FROM EVENT NATURAL JOIN FORM1 WHERE squadNum = '.$_SESSION['squadNum']);
		?>
		<tr>
			<td><u>date</u></td>
			<td><u>event</u></td>
			<td></td>
		</tr>
			<?php
				foreach ($results as $r) {
					if ($r['fauxDeleted']==0){
						print '<tr class="dash_tr">';
						print '<td onclick="draw.go(\'form1_view.php?form='.$r['eventID'].'\')">'.$r['eventDate'].'</td>';
						print '<td onclick="draw.go(\'form1_view.php?form='.$r['eventID'].'\')">'.$r['eventName'].'</td>';
						if ($_SESSION['isAdmin'] == 1){
							print '<td><input type="button" value="delete" class="btnDelete" onclick="draw.delete('.$r['eventID'].')""></td>';
						}
						print '</tr>';
					}
				}
			?>
	</table>
	</center>
</span>


	<?php
		// deallocate memory for the results and close the database connection
		$results->free();
		$db->close();
	?>
</body>
</html>