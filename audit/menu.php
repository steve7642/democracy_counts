<?php    /*MENU*/ 
		
    if( empty( $outOfRange ))	{
    	
		   	if( $_SESSION['userLevel'] == 0 ){ // supervisor 
		   		 echo "<td style='padding-top:20px; width:225px; ' > <strong> Supervisor Menu </strong> "; 
		   		 echo " <div style='padding-left:12px; padding-top:18px; padding-bottom:8px; background-color:lightblue; ' > 
					   		    <div style='  padding-top:1px; '>  <a href='/audit/instructions.php'> Instructions </a></div> 
					   		    <div style='  padding-top:18px; '>  <a href='/audit/reports.php'> Reports </a></div> 
					   		    <div style='  padding-top:18px; '>  <a href='/audit/precinct.php'> Register this device</a></div> 
					   		    <div style='  padding-top:18px; '>  <a href='/audit/unregister.php'> Unregister devices </a></div> 
					   		    <div style='  padding-top:18px; '>  <a href='/audit/holding.php'> List Voters with expired voting codes</a></div> 
					   		    <div style='  padding-top:18px; '> <a href='/audit/logout-page.php'> Logout </a> </div> 
		   		        </div> 
		   		 ";
	   		 
		   	} else if ( $_SESSION['userLevel'] == 1 ) { //auditor, remove this menu for Intake and for Vote page. 
		   		
		   		
			   		  echo "<td id=menu style='padding-top:20px;  min-width: 225px; ' > 
			   		                   <strong id=menuTitle>Auditor Menu </strong>"; 
	
	          		  
			   		  echo "<div style='padding-left:12px; padding-top:18px; padding-bottom:8px; background-color:lightblue; ' > 
							   		    <div style='padding-top:1px; ' > <a href='/audit/vote.php'> Intake page </a> </div>  
							   		    <div style='padding-top:18px; ' > <a href='/audit/vote.php?v=1'> Voting page </a> </div> 
							   		    <div style='padding-top:18px; ' > <a href='/audit/nonVoter.php'> Non-Voter  </a> </div> 
							   		    <div style='padding-top:18px; '> <a href='/audit/logout-page.php'> Logout </a> </div> 
			   		        </div> </td> 
			   		        
<script>	
//  var liveLinks = array( 'vote.php', 'vote.php?v=1');
  var divLinks = (document.getElementById('menu')).getElementsByTagName('a'); 
  
  for(var k=0; k<divLinks.length; k++) { 
  	if( divLinks[k].href == document.location.href ) {
  		divLinks[k].style.backgroundColor='#eeeeee'; 
  		divLinks[k].style.color='#666666';
  	   } 
  }
  
</script>

<!-- ////////////// block back?? --> 
			   		        
			   		        "; 
			   		        
		   	} else if ( $_SESSION['userLevel'] == 2 ) { //master level . 
		   		 echo "<td style='padding-top:20px; width:180px; ' > <strong> Master Menu </strong> "; 
		   		 echo " <div style='padding-left:12px; padding-top:18px; padding-bottom:8px; background-color:lightblue; ' > 
					   		    <div  >                            <a href='/audit/addUser.php'> Add User </a> </div>
					   		    <div style='  padding-top:8px; '>  <a href='/audit/listUsers.php'> List Users  </a></div> 
					   		    <div style='  padding-top:18px; '>  <a href='/audit/reports.php'> Reports </a></div> 
					   		    <div style='  padding-top:18px; '>  <a href='/audit/addPrecincts.php'> Add Precinct </a></div> 
					   		    <div style='  padding-top:8px; '>  <a href='/audit/listPrecincts.php'> List Precincts </a></div> 
					   		    <div style='  padding-top:18px; '>  <a href='/audit/addDomain.php'> Add Domain </a></div> 
					   		    <div style='  padding-top:8px; '>  <a href='/audit/listDomains.php'> List Domains </a></div> 
					   		    <div style='  padding-top:18px; '>  <a href='/audit/candidates.php'> Candidates </a></div> 
					   		    <div style='  padding-top:18px; '>  <a href='/audit/scheduled.php'> Scheduled Task on-off </a></div> 
					   		    <div style='  padding-top:18px; '> <a href='/audit/logout-page.php'> Logout </a> </div> 
		   		        </div> 
		   		 ";
		   		
		   		
		   	} else if ( $_SESSION['userLevel'] == 3 ) { // incidents
		   		 echo "<td style='padding-top:20px; width:180px; ' > <strong> Incidents </strong> "; 
		   		 echo " <div style='padding-left:12px; padding-top:18px; padding-bottom:8px; background-color:lightblue; ' > 
					   		    <div style='  padding-top:18px; '> <a href='/audit/logout-page.php'> Logout </a> </div> 
		   		        </div> 
		   		 ";
		   		
		   		
		   		 echo "<td style='padding-top:20px; width:180px; ' > <strong> Master Menu </strong> "; 
		   		 echo " <div style='padding-left:12px; padding-top:18px; padding-bottom:8px; background-color:lightblue; ' > 
					   		    <div  >                            <a href='/audit/addUser.php'> Add User </a> </div>
					   		    <div style='  padding-top:8px; '>  <a href='/audit/listUsers.php'> List Users  </a></div> 
					   		    <div style='  padding-top:18px; '>  <a href='/audit/candidates.php'> Candidates </a></div> 
					   		    <div style='  padding-top:18px; '>  <a href='/audit/reports.php'> Reports </a></div> 
					   		    <div style='  padding-top:18px; '>  <a href='/audit/addPrecincts.php'> Add Precinct </a></div> 
					   		    <div style='  padding-top:8px; '>  <a href='/audit/listPrecincts.php'> List Precincts </a></div> 
					   		    <div style='  padding-top:18px; '>  <a href='/audit/addDomain.php'> Add Domain </a></div> 
					   		    <div style='  padding-top:8px; '>  <a href='/audit/listDomains.php'> List Domains </a></div> 
					   		    <div style='  padding-top:18px; '> <a href='/audit/logout-page.php'> Logout </a> </div> 
		   		        </div> 
		   		 ";
			   		        
		   		
		   	} else { 
		   		 echo '?'; 
		   	}

    }  else {
    	  echo "<td style='padding-top:20px; width:180px; ' > <strong> Device out of range !  </strong> "; 
    }
		    
		    
		?> 
	  <input type=hidden name=checkin id=checkin   > 
	  <input type=hidden name=checkout id=checkout   > 

		<script> 
			function checkIn(){
	  		 document.ff.checkin.value='1'; 
	  		 document.ff.submit(); 
	  	}
			function checkOut(){
	  		 document.ff.checkout.value='1'; 
	  		 document.ff.submit(); 
	  	}

		</script> 
	
	<?php 
	  if( empty($pageAlways ) && 
	      empty($precinct)){  //not page always. 
	  	 // check machine registration. 
	  	 	  die( '<td><span style="color:red;"> This machine is not registered, <br>You must "Register this device" 
	  	 	     to use any other menu functions </span> ');
	  } 
	  
	?> 	