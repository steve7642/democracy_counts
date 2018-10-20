		
		<script>
			function deg2rad(deg) {
			  return deg * (Math.PI/180)
			}			
			
      function findDistance  (lat1,lon1,  lat2,lon2) {   //off the page from stackoverflow. 
			  var R = 6371; // Radius of the earth in km
			  var dLat = deg2rad(lat2-lat1);  // deg2rad below
			  var dLon = deg2rad(lon2-lon1); 
			  var a = 
			    Math.sin(dLat/2) * Math.sin(dLat/2) +
			    Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * 
			    Math.sin(dLon/2) * Math.sin(dLon/2)
			    ; 
			  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
			  var d = R * c * 1000.0 ; // Distance in meters. 
			  return d;
			}
		
		  
			<?php  
/*
2.  Geolocation test:    You can use one or two devices, it gets about the same results.  First you use a device to set a center point by using Administrator "Register this device" then click on "Set-reset Center".  The current point is set in the database as the center point of the current precinct.   If you are using two devices, then as Administrator "Register this device"  on the second device.  This will cause the second device to get the center point from the database.. then logout and back in as an auditor
*/ 			
			if( $page=='vote' || true ){
			    $js = ''; 
					if( !empty($centerLat) ){
						$js .=  "   centerLat = '" .$centerLat. "';"; 
						$js .=  "   centerLong = '" .$centerLong. "';"; 
						$js .=  "   deactivate = '" .$deactivate. "';"; 

   $msg = "The device is out or range, you will logged out.  Return to audit area to contine. "; 	
 					  $js .= " var distance = findDistance  (centerLat,centerLong,  currentLat, currentLong); 
 					               
 					            if( distance >  0  && deactivate=='' && "  .$_SESSION['userLevel'].  " == 1   ) { 
  					             if( confirm(".'"'.$msg. '"'.  ")){ 
 					                    document.location='logout-page.php';
 					               }

 					            }      
 					                   ";   
					}
			}
			?>					
								function getLocation() {
								    if (navigator.geolocation) {
								        navigator.geolocation.getCurrentPosition(showPosition);
								    } else { 
								        geoloc.innerHTML = "Geolocation is not supported by this browser.";
								    }
								}
								
								var deactivate =null; 
								var currentLat = null; 
								var currentLong= null; 
								var centerLat = null; 
								var centerLong= null; 
								
								function showPosition(position) {
						        currentLat = position.coords.latitude;
						        currentLong = position.coords.longitude; 
									if( geoloc ) {
								    geoloc.innerHTML = "Latitude: " + position.coords.latitude + 
								    "<br>Longitude: " + position.coords.longitude;
									}
						        //send to page for vote.php and precinct.php   
				            document.getElementById('currentLat').value =  currentLat; 
			              document.getElementById('currentLong').value =  currentLong; 
			              
							}
							getLocation(); 
	 				
							function waitForGeo(){ //assigning currentLat and currentLong after delay. 
								
								 if (typeof(currentLat) != 'undefined' && currentLat != null){
								 	  
								 	  <?php 
								 	  		 echo $js; // get distance and compare to range when deactivate=='' 
								 	  ?>
 								 	 //alert( ' currentLat='+ ' '+  Number(currentLat) +' centerLat=' + centerLat + ' difLat=' + difLat  );
								 	  clearInterval(myvar); 
								 }
							}
							
							var myvar = setInterval("waitForGeo();", 1000); 
								

		</script>
			<?php  
			
//echo "<br>END"; 
?>
