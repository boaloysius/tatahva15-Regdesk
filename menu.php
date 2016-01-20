<?php
	session_start();
?>

<html>
	<head>

			<link rel="stylesheet" type="text/css" href="AJ/main.css">
		<link rel="stylesheet" type="text/css" href="AJ/event_confirmation.css">
			<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="AJ/main.js"></script>

	</head>
	<body>
		<div class="labelo" id="Username_display">Username</div>
		<div class="button" id="log_out">Log out</div>
		<img id="tathva" src="AJ/tathva.png">
	</body>
</html>

<?php
	$username = " ".$_SESSION['username'];
	$superadmin = $_SESSION['superadmin'];
	echo "<script>updatename(\"$username\")</script>";
	if(strcmp($username," ") == 0){
		header("Location:action_post.php");
	}
?>
		<div id="alerter">
			<center>
            	<div id="main_head">Menu</div>
            </center><br>
            
			<div>	<a id="part" class="menu_button button" href="event_confirmation.php">Participant Registration</a></div>
				<br>	
<?php 	if($superadmin == 1){ ?>
        	<a id="acc_details" class="menu_button button" href="money_collect.php">Account Details</a>
<?php }?>
        </div>
	