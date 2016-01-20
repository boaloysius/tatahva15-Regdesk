<?php
	session_start();
	require 'connectDatabase.php';
	$TathvaID = trim(mysqli_real_escape_string($mysql_conn , strtoupper($_POST['TathvaID'])));
	$CaptainID = trim(mysqli_real_escape_string($mysql_conn , strtoupper($_POST['CaptainID'])));
	$EventCode = trim(mysqli_real_escape_string($mysql_conn , $_POST['EventCode']));
	if(empty($TathvaID)){
		$TathvaID = trim(mysqli_real_escape_string($mysql_conn , strtoupper($_GET['TathvaID'])));
	}
	if(empty($TathvaID)){
	?><script>window.location.href="event_confirmation.php"</script>
		<?php die();
	}

?>

<html>
<head>
	<link rel="stylesheet" type="text/css" href="AJ/event_confirmation.css">
	<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="AJ/event_confirmation.js"></script>
</head>
	<body>
		<a class="button" href="<?php  echo "event_confirmation.php?TathvaID=$TathvaID"; ?>">Back</a>
		<div class="labelo" id="Username_display">Username</div>
		<div class="button" id="log_out">Log out</div>
		<div id="main_head">Event Registration</div>
		<div class="alerter">
			<form action = 'event_user_reg.php' method = 'POST' >
						<div class="labelo">TathvaID:</div><?php echo "<input type='text' value='$TathvaID' name='TathvaID' class='them_boxes' readonly><br>"; ?>
						<br>
						<div class="labelo">Select An Event:</div>
						<select class='showcid' name = 'EventCode' id="drop_down">
							<option value = "" selected></option>
							<?php
								require 'connectDatabase.php';
								$query = "SELECT * FROM Events ORDER BY EventName ASC";
								if($query_run = mysqli_query($mysql_conn,$query)){
									while($query_row = mysqli_fetch_array($query_run,MYSQLI_NUM)){
										echo "<option value = '$query_row[2]'>$query_row[1]</option>";
									}
								}
							?>
						</select><br>

						<!--<div class="labelo">CaptainID:</div><input type='text' name='CaptainID' class='them_boxes'>-->
						<input id="sub" type="submit" value="Register" class="button">
					</form></div>
	</body>
</html>

<?php
	$username = " ".$_SESSION['username'];
	echo "<script>updatename(\"$username\")</script>";
	if(strcmp($username," ") == 0){
		?><script>window.location.href="action_post.php"</script>
		<?php
		die();
	}
	$flag = 0;

	if(empty($TathvaID)){
		echo "<script>alert('Provide tathva id you fucker');</script>";		
		?><script>window.location.href="action_post.php"</script>
		<?php
		die();	
	}
	
	if(!isset($_POST['EventCode'])){
		die();
	}
	
	if(empty($EventCode)){
		echo "<script>alert('Provide an event code to procede')</script>";
		die();		
	}


	$query = "SELECT * FROM Events WHERE  EventCode = '$EventCode'";
	if(($query_run = mysqli_query($mysql_conn,$query)) && (mysqli_num_rows($query_run)==0)){
		echo "<script>alert('Invalid Event');</script>";
		?><script>window.location.href="action_post.php"</script>
		<?php
		die();	
	}
		
	$query = "SELECT * FROM Participants WHERE  TathvaID = '$TathvaID'";
	if(($query_run = mysqli_query($mysql_conn,$query)) && (mysqli_num_rows($query_run)==0)){
		echo "<script>alert('Invalid Tathva ID');</script>";
		?><script>window.location.href="action_post.php"</script>
		<?php
		die();
	}
			
	$query = "SELECT * FROM Registration WHERE  TathvaID = '$TathvaID' AND EventCode='$EventCode'";
		if(($query_run = mysqli_query($mysql_conn,$query)) && mysqli_num_rows($query_run)!=0){
			echo "<script>alert('You Are Already Registered For This Event');</script>";
			die();
		}

	if(empty($CaptainID)){
		echo "<script>alert('About to register a captain');</script>";
		$query = "INSERT INTO Registration (EventCode, TathvaID, CaptainID) VALUES ('$EventCode' ,'$TathvaID' ,  '$TathvaID')";
		if($query_run = mysqli_query($mysql_conn,$query)){
			echo "<script>alert('Congratulation You Registered For The Event');</script>";
			?><script>window.location.href="event_confirmation.php?TathvaID=<?php echo $TathvaID ?>"</script>
		<?php
			die();
		}
		echo "<script>alert('Failure');</script>";
		die();
		
	}
	

	$query = "SELECT * FROM Registration WHERE  TathvaID = '$CaptainID' AND EventCode = '$EventCode'";
	if(($query_run = mysqli_query($mysql_conn,$query)) && (mysqli_num_rows($query_run)==0)){
		echo "<script>alert('Sorry Captain Not Registered For The Event');</script>";
		die();
	}

	/*$query = "SELECT * FROM Registration WHERE  TathvaID = '$CaptainID' AND CaptainID='$CaptainID' AND EventCode = '$EventCode' AND Participating=1";
	if(($query_run = mysqli_query($mysql_conn,$query)) && (mysqli_num_rows($query_run)==0)){
		echo "<script>alert('Please ask your team captain to confirm his captancy for this event before your registration');</script>";
		die();
	}*/
					
	$query = "INSERT INTO Registration (EventCode, TathvaID, CaptainID) VALUES ('$EventCode' ,'$TathvaID' ,  '$CaptainID')";
	if($query_run = mysqli_query($mysql_conn,$query)){
		echo "<div class='extra' onclick='hide_extra_c2()'>Congratulation You Registered For The Event</div>";
		?><script>window.location.href="event_confirmation.php?TathvaID=<?php echo $TathvaID ?>"</script>
		<?php
		die();
	}
					
	
?>