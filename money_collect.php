<?php session_start();?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="AJ/event_confirmation.css">
		<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
		<script src="AJ/event_confirmation.js"></script>
		<script>
			function collectmoney(collmoney,totalcoll,comment){
				var r = confirm("Do You Want To Collect This Money?");
				if (r == true) {
					changemoney(collmoney,totalcoll,comment);
					window.location.href='money_collect.php';
				}
			}

			function changemoney(collmoney,totalcoll,comment){
			$.ajax({
				type: "POST",
				url: "collectmoney.php",
				data: { 'collmoney' : collmoney ,
						'totalcoll' : totalcoll	,
						'comment' : comment}
				}).done(function(data){
					alert(data);
					});
			}
		</script>
	</head>
	<body>
			<a class="button" href="event_confirmation.php" id="back">Back</a>
				<a class="button" href="logout.php" id="log_out">Log out</a>
			<div class="labelo" id="Username_display">Username</div>
		<div id='main_head'>Account details</div>
		<img id="tathva" src="AJ/tathva.png">
	</body>
</html>


<?php
	require 'connectDatabase.php';
	$collmoney = trim(mysqli_real_escape_string($mysql_conn , $_POST['collmoney']));
	$comment = trim(mysqli_real_escape_string($mysql_conn , $_POST['comment']));
	$query = "SELECT SUM( RegMoney ) FROM Participants";
	$query_run = mysqli_query($mysql_conn,$query);
	$query_row = mysqli_fetch_array($query_run,MYSQLI_NUM);
	$query1 = "SELECT SUM( MoneyCollected ) FROM Accounts";
	$query_run1 = mysqli_query($mysql_conn,$query1);
	$query_row1 = mysqli_fetch_array($query_run1,MYSQLI_NUM);
	$username = " ".$_SESSION['username'];
	$superadmin = $_SESSION['superadmin'];
	echo "<script>updatename(\"$username\")</script>";
	if(strcmp($username," ") == 0) {?>
		<script>window.location.href="action_post.php"</script><?php
	}
	if($superadmin == 0){
		?><script>window.location.href="action_post.php"</script>
		<?php
	}
	if((($query_row1[0] + $collmoney) > $query_row[0]) && isset($_POST['Submit']) && !empty($collmoney) && $collmoney > 0)
		echo "<script>alert(\"Invalid Money\")</script>";
	else if(isset($_POST['Submit']) && !empty($collmoney) && $collmoney <= 0)
		echo "<script>alert(\"Invalid Money\")</script>";
	else if(isset($_POST['Submit']) && !empty($collmoney) && $collmoney > 0){
		$totmoney = $query_row1[0] + $collmoney;
		echo "<script>collectmoney($collmoney,$totmoney,\"$comment\")</script>";
	}
	$diff = $query_row[0] - $query_row1[0];
	echo "<div class='alerter' id='alerter_sp2'><form id='moneycollectform' action='money_collect.php' method='post'></form>";
	echo "<center><div class='labelo'>Total Money Acquired: $query_row[0]<br><br>";
	echo "Total Money Collected: $query_row1[0]<br><br>";
	echo "Money Left To Be Collected: $diff<br><br>";
	echo "Money Collecting:</div>";
	echo "<input type='number' name='collmoney' value='$diff' form='moneycollectform' class='them_boxes'/><br><br>";
	echo "<div class='labelo'>Comment: </div>";
	echo "<textarea name='comment' form='moneycollectform' style='width:400px;'></textarea><br><br>";
	echo "<input type='submit' name='Submit' form='moneycollectform' class='button'/><br><br></div>";
?>