<?php

	//  Purpose	: 	Input money collected data into database
	//	Input  	:	Collected amount,Total collected amount and comment as post  

	require 'connectDatabase.php';
	$collmoney = trim(mysqli_real_escape_string($mysql_conn , $_POST['collmoney']));
	$totalcoll = trim(mysqli_real_escape_string($mysql_conn , $_POST['totalcoll']));
	$comment = trim(mysqli_real_escape_string($mysql_conn , $_POST['comment']));
	$query = "INSERT INTO `Accounts` (`id`, `Time`, `MoneyCollected`, `TotalMoneyCollected`, `Comment`) VALUES (NULL, CURRENT_TIMESTAMP, '$collmoney', '$totalcoll', '$comment')";
	if($query_run = mysqli_query($mysql_conn,$query)){
		echo json_encode("Success");
	}
	else
		echo json_encode("Failure");
?>