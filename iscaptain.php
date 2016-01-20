<?php
	require_once('connectDatabase.php');
	require_once("includes_php/functions.php");

	$CaptainID=string_prepare($_GET["CaptainID"]);
	$EventID=string_prepare($_GET["EventID"]);
	$TathvaID=string_prepare($_GET["TathvaID"]);


	$query ="Select * from Registration ";
	$query.="WHERE ";
	$query.="TathvaID ='$TathvaID' AND ";
	$query.="EventCode ='$EventID'";
	$query_run = mysqli_query($mysql_conn,$query);

	$row=mysqli_fetch_assoc($query_run);

	if(!$_SESSION["superadmin"] && $row["Participating"]){
		echo json_encode(
				array(
					"iscaptain" => 0
					,"message2" => "Normal User cant change confirmed captain id"
					)
		); 		
		
		die();
	}


	if($CaptainID==$TathvaID){
		
		$query12 ="update Registration ";
		$query12.="SET ";
		$query12.="CaptainID = '$TathvaID' WHERE ";
		$query12.="TathvaID ='$TathvaID' AND ";
		$query12.="EventCode ='$EventID'";
	
		$query12_run = mysqli_query($mysql_conn,$query12);
		
		echo json_encode(
		  array("iscaptain" => 1, 
		  "message2" => "Successfully Yourself captain")
		);
		die(); 	
	}



	$query1 ="Select * from Registration ";
	$query1.="WHERE ";
	$query1.="TathvaID ='$CaptainID' AND ";
	$query1.="CaptainID ='$CaptainID' AND ";
	$query1.="EventCode ='$EventID' AND ";
	$query1.="Participating=1";
	$query1_run = mysqli_query($mysql_conn,$query1);

	if(mysqli_num_rows($query1_run)==0){
		echo json_encode(
				array(
					"iscaptain" => 0
					,"message2" => "Sorry cant change captain.He is not a captain"
					)
		); 		

		die();
	}






	$query2 ="Select * from Registration ";
	$query2.="WHERE ";
	$query2.="TathvaID !='$TathvaID' AND ";
	$query2.="CaptainID ='$TathvaID' AND ";	
	$query2.="EventCode ='$EventID' AND ";
	$query2.="Participating =1";
	$query2_run = mysqli_query($mysql_conn,$query2);

	if(mysqli_num_rows($query2_run)>0){
		echo json_encode(
				array(
					"iscaptain" => 0
					,"message2" => "Sorry cant change CaptainID.You are a captain of some team"
					)
		); 		

		die();
	}

		

	$query_run = mysqli_query($mysql_conn,$query);
	if(mysqli_num_rows($query_run)>0){

		$query ="update Registration ";
		$query.="SET ";
		$query.="CaptainID = '$CaptainID' WHERE ";
		$query.="TathvaID ='$TathvaID' AND ";
		$query.="EventCode ='$EventID'";
	
		$query_run = mysqli_query($mysql_conn,$query);

		echo json_encode(
		  array("iscaptain" => 1, 
		  "message2" => "Successfully updated captain")
		); 
	}
	else{
		echo json_encode(
				array(
					"iscaptain" => 0
					,"message2" => "Sorry Captain found not registered for this event"
					)
		); 
	}
	
?>