<?php session_start();?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="AJ/event_confirmation.css">
		<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
		<script src="AJ/event_confirmation.js"></script>
	</head>
	<body>
		<a class="button" id="back3" href="event_confirmation.php" >Back</a>
		<div class="labelo" id="Username_display">Username</div>
		<a class="button" id="log_out" href="logout.php">Log out</a>
		<div id="main_head">Participant Registration</div>
	</body>
</html>


<?php
	require_once 'connectDatabase.php';
	$Name = trim(mysqli_real_escape_string($mysql_conn , $_POST['Name']));
	$College = trim(mysqli_real_escape_string($mysql_conn , $_POST['College']));
	$Department = trim(mysqli_real_escape_string($mysql_conn , $_POST['Department']));
	$RollNumber = trim(mysqli_real_escape_string($mysql_conn , strtolower($_POST['RollNumber'])));
	$Email = trim(mysqli_real_escape_string($mysql_conn , strtolower($_POST['Email'])));
	$PhoneNumber = trim(mysqli_real_escape_string($mysql_conn , $_POST['PhoneNumber']));
	$flag = 0;


	$username = " ".$_SESSION['username'];
	echo "<script>updatename(\"$username\")</script>";
	if(strcmp($username," ") == 0){?>

		<script>window.location.href="action_post.php"</script><?php
	}

	if(!isset($_POST['MadeID'])){
		echo "<html>
					<div id='alerter_sp'>
					<form action = 'participant_reg.php' method = 'POST' >
						<div class='m_labelo'>Name:</div><input type='text' name='Name' class=\"them_boxes\"><br>
						<div class='m_labelo'>College:</div><input type='text' name='College' class=\"them_boxes\"><br>
						<div class='m_labelo'>Phone Number:</div><input type='number' name='PhoneNumber' maxlength = '10' class=\"them_boxes\"><br>
						<div class='m_labelo'>Department:</div><input type='text' name='Department' class=\"them_boxes\"><br>
						<div class='m_labelo'>Roll Number:</div><input type='text' name='RollNumber' class=\"them_boxes\"><br>
						<div class='m_labelo'>Email:</div><input type='text' name='Email' class=\"them_boxes\"><br>
						<input type='submit' name = 'MadeID' value = 'Submit' class=\"button\">
					</form></div>";
	}

	if(empty($PhoneNumber) && isset($_POST['MadeID'])){
		echo "<div class=\"extra\" onclick='hide_extra_c()'>Phone Number Not Set</div>";
		$flag =1;
	}
	else if(!(ctype_digit($PhoneNumber) && strlen($PhoneNumber) == 10 ) && isset($_POST['MadeID'])  ){
		echo "<div class=\"extra\" onclick='hide_extra_c()'>Invalid Phone Number</div>";
		$flag=1;
	}

	if(empty($Name) && isset($_POST['MadeID'])){
		echo "<div class=\"extra\" onclick='hide_extra_c()'>Name Not Set</div>";
		$flag =1;
	}

	if(empty($College) && isset($_POST['MadeID'])){
		echo "<div class=\"extra\" onclick='hide_extra_c()'>College Not Set</div>";
		$flag =1;
	}

	if(isset($_POST['MadeID']) && $flag != 1){
		$query = "SELECT TathvaID , Timestamp FROM Participants WHERE  PhoneNumber = '$PhoneNumber'";
		if(($query_run = mysqli_query($mysql_conn,$query)) && (mysqli_num_rows($query_run)!=0)){
			$query_row = mysqli_fetch_array($query_run,MYSQLI_NUM);
			echo "<div class=\"extra\" onclick='hide_extra_c()'>You are already registered with TathvaID $query_row[0] at $query_row[1]</div>";
		}
		else{
			$TathvaNo = 10000;
			$query = "SELECT SNo FROM Participants ORDER BY SNo DESC LIMIT 1";
			if(($query_run = mysqli_query($mysql_conn,$query)) && (mysqli_num_rows($query_run)!=0)){
				$query_row = mysqli_fetch_array($query_run,MYSQLI_NUM);
				$TathvaNo += $query_row[0];
			}
			$TathvaNo += 1;
			$TathvaID = "TID".strval($TathvaNo);
			$query = "INSERT INTO Participants (SNo , TathvaID, Name, Email, PhoneNumber, College, RollNumber, Department) VALUES (NULL , '$TathvaID' ,  '$Name', '$Email','$PhoneNumber', '$College', '$RollNumber' ,  '$Department')";
			$query1 = "INSERT INTO Registration (SNo , EventCode, TathvaID, CaptainID, Participating) VALUES (NULL , 'ID000' , '$TathvaID' ,  '$TathvaID' , 0)";
			if($query_run = mysqli_query($mysql_conn,$query) && $query_run1 = mysqli_query($mysql_conn,$query1)){
				?><script>window.location.href="event_confirmation.php?TathvaID=<?php echo $TathvaID ?>"</script>
		<?php
				
			}
		}
	}
?>