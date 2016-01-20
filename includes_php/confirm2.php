<a id="edit_button" class='button' href="menu.php">Home</a>
	<div class="alerter" id="second_card">
					              <form id='tableform' action='event_confirmation.php?TathvaID=<?php echo $TathvaID ;?>' method='post'>
              					  <div id="tathva_id_display">User Details</div>
              					    
                                    <div class="m_labelo \" >Tathva ID:</div>
                                    <div style="display:inline; position: absolute; left:550px;" class="tathva_id">
                                        <?php echo $query_row[1];?>
                                    </div>
                                    <br>


                                    
                                    <div class="m_labelo">Name:</div>
                                    <input type='text' name='Name'  value= '<?php echo $query_row[2];?>' class="them_boxes_i">
                                    <br>
                                    
                                    <div class="m_labelo">College:</div>
                                    <input type='text' name='College' value= '<?php echo $query_row[5];?>' class="them_boxes_i">
                                    <br>
                                    
                                    <div class="m_labelo">Phone Number:</div>
                                    <input type='number' name='PhoneNumber' value= '<?php echo $query_row[4];?>' maxlength = '10' class="them_boxes_i">
                                    <br>

                                    <div class="m_labelo">Email:</div>
                                    <input type='text' name='Email' value= '<?php echo $query_row[3];?>' class="them_boxes_i">
                                    <br>

                                    <div class="m_labelo">Roll Number:</div>
                                    <input type='text' name='RollNumber' value= '<?php echo $query_row[6];?>' class="them_boxes_i">
                                    <br>

                                    <input type='text' name='TathvaID'  value= '<?php echo $query_row[1];?>' class="them_boxes_i" style="display:none;" >

                                    <div class="m_labelo">Department:</div>
                                    <input type='text' name='Department' value= '<?php echo $query_row[7];?>' class="them_boxes_i">
                                    <br>

									<?php /*$query2="SELECT SUM(Events.Price) AS sum ";
										  $query2.="FROM Events,Registration ";
										  $query2.="WHERE ";
										  $query2.="Registration.EventCode=Events.EventCode AND ";
										  $query2.="Registration.CaptainID='$TathvaID'";
                                    	  $query2_run = mysqli_query($mysql_conn,$query2);
										  if(mysqli_num_rows($query2_run)==0){
												console.log($query2);
												die();
											}else{
												    $query2_row = mysqli_fetch_assoc($query2_run);
													$query2_row["sum"];
												}
											*/	
									?>
                                    
                                    <div class="m_labelo">Amount Paid:</div>
                                    <div style="display:inline; position: absolute; left:550px;"><?php echo $query_row[10];?></div>
                                    <br>
                                    
                                    <div class="m_labelo">Comments:</div>
                                    <textarea name='Comments' class="them_boxes_ide" ><?php echo $query_row[13];?></textarea>
                                    <br>
                                    
                        </form>
                        
                    <div class="m_labelo">Money To Be Paid:</div>
                    <input type='text' id='totalmoney' value=0 form='tableform' name='totalmoney' class="unseeables" style="display:inline;" readonly>
                    <br>
				</div>