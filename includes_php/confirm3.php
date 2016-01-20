<?php

		$query ="SELECT ";
		
		$query.="Registration.EventCode as eventcode,";
		$query.="Events.EventName as eventname,";
		$query.="Registration.CaptainID as captainid,";
		$query.="Participants.Name as captainname,";
		$query.="Registration.Participating as isparticipating,";
		$query.="Events.Team as isteam,";
		$query.="Events.Price as price,";
		$query.="Events.Workshop as isworkshop ";
		
		$query.="FROM Registration ,Events ,Participants ";
		$query.="WHERE ";

		$query.="Registration.EventCode =  Events.EventCode ";
		$query.="AND ";

		$query.="Registration.CaptainID =  Participants.TathvaID ";
		$query.="AND ";

		$query.="Registration.TathvaID = '$TathvaID' ";
		$query.="ORDER BY Registration.SNo";
		
		$query_run = mysqli_query($mysql_conn,$query);
		
?>

		<table class='Table'>
			<tr>
				<th>SNo</th>
				<th>Event Name</th>
				<th>Is Event?</th>
				<th>Captain ID</th>
				<th>Type</th>
				<th>Price</th>
				<th>Confirmed</th>
			</tr>
<?php	
			$id = 1;
			while($query_row = mysqli_fetch_assoc($query_run)){
				$checkboxname = "check" . strval($id);
				$captainname = "captain".strval($id);
				$eventname= "event".strval($id);
?>
			<tr id="<?php echo $query_row['eventcode']."_a";?>">
					<td><?php echo $id ?></td>
					<td><a href="display_team.php?EventID=<?php echo $query_row['eventcode'];?>&TathvaID=<?php echo $TathvaID;?>" target="_blank"><?php echo $query_row['eventname'].'('.$query_row['eventcode'].')'?></a></td>
                    
                    <td><?php if($query_row['isworkshop']){echo 'Workshop';}else{echo 'Event';} ?></td>
                   
					<?php if($query_row['isteam']){?>

					<td style="display:none;"><center><?php echo $query_row['captainname']."<span>(".$query_row['captainid'].")</span>"?></center></td>

                    <td>
                    	<center>
                        	<input type='text' 
                            name='<?php echo $captainname?>' 
                            value='<?php echo $query_row['captainid']?>' 
                            form='tableform' 
                            class="unseeables captain_id"/>
                        </center>
                    </td>

                    <td style="display:none;">
                    	<center>
                        	<input type='text' 
                            name='<?php echo $eventname;?>' 
                            value='<?php echo $query_row['eventcode']?>' 
                            form='tableform' 
                            class="unseeables"/>
                        </center>
                    </td>
                   
					<td>Team Event</td>

					<?php }else{?>
                    
					<td>
                    	<center>N.A</center>
                    </td>
                    
                    <td style="display:none;">
                    	<center>
                        	<input type='text' 
                            name='<?php echo $captainname?>' 
                            value='<?php echo $TathvaID?>' 
                            form='tableform' 
                            class="unseeables"/>
                        </center>
                    </td>

                    <td style="display:none;">
                    	<center>
                        	<input type='text' 
                            name='<?php echo $eventname;?>' 
                            value='<?php echo $query_row['eventcode']?>' 
                            form='tableform' 
                            class="unseeables"/>
                        </center>
                    </td>                    
                    
                    
                    
					<td>
                    	<center>Individual Event</center>
                    </td>
					
					<?php }?>
                    
					<td><?php  echo $query_row['price']?></td>
                    
					<?php if($query_row['isparticipating'] == 0){?>

                            <td>
                                <center>
                                    <input type='checkbox' 
                                    class='cb' 
                                    id='<?php echo $query_row['eventcode']?>' 
                                    onchange='changemoney("<?php echo $query_row['eventcode']?>")' 
                                    name='<?php echo $checkboxname?>' 
                                    form='tableform' 
                                    />
                                </center>
                            </td>

					<?php }	else if($_SESSION["superadmin"]){?>
					
                    <td>
                    	<center>
                        	<input type='checkbox'
                            class='cb' 
                            id='<?php echo $query_row["eventcode"]?>' 
                            onchange='changemoney("<?php echo $query_row['eventcode']?>")' 
                            name='<?php echo $checkboxname?>' 
                            form='tableform' 
                            checked/>
                            
                           
                         </center>
                    </td>
			
            		<?php }else{?>
				
                	<td>
                    	<center>Confirmed</center> 
                     </td>
					<?php }?>
                    
               </tr>
             <?php	$id += 1;}?>
		</table>
        <br>

		<a href='event_user_reg.php?TathvaID=<?php echo $TathvaID?>'>
        	<img src='AJ/add.png' id="add_icon">
        </a>
		<center>
        	<input type='submit' name='eventVerification' form='tableform' class="button"/>
        </center>


