<?php

  // retrieve session information
  session_start();
	echo $_SESSION['email']; 
  // if no username set, then redirect to login
  if(!isset($_SESSION['email'])){
    header("location:index.html");
    exit;
  }  
  //Try to prevent session stealing
  if ($_SESSION['ip'] <> $_SERVER['REMOTE_ADDR']){
    header("location:logout.php");
    exit;
  }
  // if not admin then you can't be on the roster page.
  if ($_SESSION['isAdmin'] == 0){
    header("location:dash.php");
    exit;
  }else{
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
	rosterPretty: null,
	ui:function(){
		html = XU.el('rosterHTML').innerHTML;
		draw.rosterPretty = XM.static({title: 'roster management', body: html, left: 'center', top: 100, width: 500});
		XU.el('rosterHTML').innerHTML = "";
	},
	reposition:function(){
		XM.setPosition(draw.rosterPretty, {top: 100, left: 'center'});
	},
	go:function(param){
		document.location.href = param;
	},
	ini:function(){
		draw.ui();
	},
	validateForm:function(){
		emails = document.forms['rosterForm']['emails'].value;
		if (!emails) return;
	
		emailregex = new RegExp("^[cC][0-9][0-9][a-zA-Z-]+.[a-zA-Z-]+(.[a-zA-Z-]+@usafa.edu|@usafa.edu)$");
		emailArray = (emails.indexOf(';') != -1) ? emails.split(';') : new Array(emails);
		firstName = new Array();
		lastName = new Array();
		classYear = new Array();
		error = false;

		for (i = 0; i < emailArray.length; i++) {
			emailArray[i] = emailArray[i].trim();
			if (emailArray[i]){
				if (emailArray[i].indexOf('<') != -1) emailArray[i] = emailArray[i].split('<')[1];
				if (emailArray[i].indexOf('>') != -1) emailArray[i] = emailArray[i].split('>')[0];
				if (!emailregex.test(emailArray[i])){
					error = true;
					XM.alert({title: 'email format error', 
						body: '<font color="red">error: </font><font color="#0099ff">malformed email</font><br> ' + emailArray[i] + '<br><br><font color="#0099ff">Proper Format: </font><br>c##fname.lname@usafa.edu', 
						centered: true, screen: true});
					break;
				}
			}
		}

		if (!error){
			for (i = 0; i < emailArray.length; i++) {
				firstName[i] = emailArray[i].split('@')[0];
				classYear[i] = firstName[i].substring(1, 3);
				firstName[i] = firstName[i].substring(3, firstName[i].length);
				lastName[i] = firstName[i].split('.')[1];
				firstName[i] = firstName[i].split('.')[0];
			}

			//Print results - debug
			msg = '<br><br><table>';
			cols = 3;
			for (i = 0; i < emailArray.length; i++) {
				if (emailArray[i]){
					msg += (i%cols == 0) ? "<tr>" : "";
					msg += '<td style="font-size:xx-small;">' + emailArray[i] + " | " + classYear[i] + " | " + firstName[i] + " | " + lastName[i] + "</td>";
					msg += (i%cols == (cols - 1)) ? "</tr>" : "";
				}
			}	
			msg += '</table>';

			form = document.forms["rosterForm"];
			form['firstNameField'].value = JSON.stringify(firstName);
			form['lastNameField'].value = JSON.stringify(lastName);
			form['classYearField'].value = JSON.stringify(classYear);
			form['emailField'].value = JSON.stringify(emailArray);
			form.submit();
		}
	}
};
</script>
</head>

<body onload="draw.ini()" onresize="draw.reposition()">

<center>
	<h1>easySupt</h1>
</center>

<span id="rosterHTML" style="display:none;">
	<form name="rosterForm" method="post" action="updateRoster.php">
		emails:<br>
		<textarea name="emails" class="txt" style="height:300;"></textarea><br><br>
		<input type="button" value="back" class="btn" onclick="draw.go('dash.php')"> <input type="button" value="update" class="btn" onclick="draw.validateForm()"><br><br>
		*semicolon seperated values
		<input type="hidden" name="firstNameField">
		<input type="hidden" name="lastNameField">
		<input type="hidden" name="classYearField">
		<input type="hidden" name="emailField">
	</form>
</span>

</body>
</html>