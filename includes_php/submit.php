<?php

		$TathvaID = string_prepare(strtoupper($_POST['TathvaID']));
		$Name = string_prepare($_POST['Name']);
		$College = string_prepare($_POST['College']);
		$Department = string_prepare($_POST['Department']);
		$RollNumber = string_prepare(strtolower($_POST['RollNumber']));
		$Email = string_prepare(strtolower($_POST['Email']));
		$RegMoney = string_prepare($_POST['totalmoney']);
		$PhoneNumber = string_prepare($_POST['PhoneNumber']);
		$Comments = string_prepare($_POST['Comments']);

			$query="SELECT TathvaID FROM Participants WHERE PhoneNumber='$PhoneNumber'";
			$query_run = mysqli_query($mysql_conn,$query);
			$row=mysqli_fetch_assoc($query_run);
			if($row['TathvaID'] != $TathvaID){
				header("Location:event_confirmation.php?TathvaID={$TathvaID}");
				die();	
			}
			

			$query ="UPDATE Participants SET ";
			$query.="Name = '$Name' ,";
			$query.="College = '$College',";
			$query.="Department = '$Department' ,";
			$query.="RollNumber = '$RollNumber' ,";
			$query.="Email = '$Email' ,";
			$query.="PhoneNumber = '$PhoneNumber' ,";
			$query.="Verified = 1,";
			$query.="RegMoney = RegMoney + $RegMoney ,";
			$query.="Comments = '$Comments' ";
			$query.="WHERE TathvaID =  '$TathvaID'";
			
			//die($query);
			
			$query_run = mysqli_query($mysql_conn,$query);
		

		
			for($id=1;isset($_POST["event".$id]);$id++){
				//echo $id;
				
				if(!isset($_POST["captain".$id])){ die("Sorry some wrong smelling");}
				
				else{
					
					$Captain=$_POST["captain".$id];
					$EventCode=$_POST["event".$id];
					
					if(!$_SESSION['superadmin'] && !$_POST["check".$id]){
						continue;	
					}
					elseif($_POST["check".$id]){
						$Participating=1;	
					}else{
						if(!isset($_SESSION['superadmin'])){
							die("Smelling Some Trouble");
						}
						$Participating=0;
					}
					
					$query1  ="UPDATE Registration SET ";
					
					if($Participating==0){
						$query1 .="CaptainID = '$TathvaID' ,";
					}
					else{
						$query1 .="CaptainID = '$Captain' ,";
					}
					$query1 .="Participating = {$Participating} WHERE ";
					$query1 .="TathvaID =  '$TathvaID' ";
					$query1	.="AND EventCode='$EventCode'";
					$query_run1 = mysqli_query($mysql_conn,$query1);
				}	
					//echo $query1;
					
			}
?>
			<script>window.location.href="event_confirmation.php?TathvaID=<?php echo $TathvaID?>"</script>
<?php
			die();
?>