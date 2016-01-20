<?php  

	//  This page is used to check if the a particular event is a team event or not
	//	Input 	: Event Code as post variable EventCode
	//	Output  : Yes/No

	require "connectDatabase.php";
	$EventCode = trim(mysqli_real_escape_string($mysql_conn , strtoupper($_POST['EventCode'])));
	$query = "SELECT Team FROM Events WHERE EventCode = '$EventCode'";
	$query_run = mysqli_query($mysql_conn,$query);
	$query_row = mysqli_fetch_array($query_run,MYSQLI_NUM);
	echo json_encode($query_row[0]);
?>
