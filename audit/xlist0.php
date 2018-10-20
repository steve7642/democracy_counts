 
<?php  
		// 201        624
		
		if( !empty( $badTransfer)){
				if( $badTransfer == '1' ) { 
					  echo "<span style='color:red;' >  Voter Code has been used  </span> <br><br>";
				} else if( $badTransfer == '2') { 
					  echo "<span style='color:red;' >  Voter Code has timed out</span> <br><br>";
				} else if( $badTransfer == '3') { 
					  echo "<span style='color:red;' >  Voter Code not found, try again</span> <br><br>";
				}
			  
		}

//echo $zmsg; 
		
?> 
        
Enter Voter Code: 
<input style=' height:36; width:55px; font-size:26px; ' name=transfer_code id=transfer_code > 
<input type=button <?php echo $submitStyle; ?>   value='Vote Now' onclick='done1(1);' > 
  
