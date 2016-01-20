<?php
	require_once('connectDatabase.php');
	require_once("includes_php/functions.php");
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="AJ/event_confirmation.css">
		<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
		<script src="AJ/event_confirmation.js"></script>
	</head>
	<body>
		<a class="button" id="back" href="menu.php">Back</a>
		<div class="labelo" id="Username_display">User:<?php echo $username ?></div>
		<a class="button" id="log_out" href="logout.php">Log out</a>
		<div id="main_head">Participant Verification</div>

<?php

	$TathvaID = string_prepare(strtoupper($_POST['TathvaID']));
	$PhoneNumber = string_prepare($_POST['PhoneNumber']);
	
	if(empty($TathvaID)){
		$TathvaID = string_prepare(strtoupper($_GET['TathvaID']));
		
	}
	

        if(!empty($PhoneNumber)){
		$query = "SELECT * FROM Participants WHERE PhoneNumber = '$PhoneNumber'";
		$query_run = mysqli_query($mysql_conn,$query);
		if(mysqli_num_rows($query_run)==0){
			echo "<a id='extra' href='event_confirmation.php'> No ID With This Tathva ID Found.</a>";
			die();
		}
		$query_row = mysqli_fetch_array($query_run,MYSQLI_NUM);
		$TathvaID=$query_row[1];
		
	}
	else if(!empty($TathvaID)){
		$query = "SELECT * FROM Participants WHERE TathvaID = '$TathvaID'";
		$query_run = mysqli_query($mysql_conn,$query);
		if(mysqli_num_rows($query_run)==0){
			echo "<a id='extra' href='event_confirmation.php'> No ID With This Tathva ID Found.</a>";
			die();
		}
		$query_row = mysqli_fetch_array($query_run,MYSQLI_NUM);
		$TathvaID=$query_row[1];
	}



	if(empty($TathvaID)){
		require_once("includes_php/confirm1.php");
		die();
	}

	if(isset($_POST['eventVerification'])){require_once("includes_php/submit.php"); }

	require_once("includes_php/confirm2.php");
	require_once("includes_php/confirm3.php");

		


?>

	</body>
</html>