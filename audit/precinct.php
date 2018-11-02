<?php 
$pageAlways ='1'; 

include "header.php"; 	// returns query for $precinctId, $precinct, $domain, $auditname,  and calculation for $xmachine 


		
		//domain options
		$optionDomain='<option value="">Choose'; 
		$sql = "select f1 from generic_list where listType='domain_list'";
		$get = mysqli_query( $currentDB, $sql );
		while ( $row = mysqli_fetch_array($get) ) { 
				$optionDomain .= "<option value='".$row['f1']."'>".$row['f1'];
		}

		if( !empty( $_POST['precinct'] )      ){

					if( !empty( $_POST['setc']) && !empty($precinct)){
							
							$lat0  = $_POST['currentLat'];
							$long0 = $_POST['currentLong'];
							$deactivate = $_POST['deactivate'];

//echo '<br>POST currentLat lat0='.$lat0; 
							
							// set the machine holding center location. f2=lat, f3=long, f1=precinctId , f4=active range
							$sql = "select id  from generic_list where listType='center machine' 
							           and f1='". $precinct. "'";
							$get = mysqli_query( $currentDB, $sql );
							while ( $row = mysqli_fetch_array($get) ) { 
									$centerid = $row['id'];
									$sql = "update generic_list set f2='" .$lat0. "', f3='". $long0. "', f7='" .$deactivate."'  
									          where id='" .$centerid. "'";
					    		mysqli_query( $currentDB, $sql );
//echo '<br> update sql='.$sql; 
					    }
					    if( empty($centerid)){ 
					    		$sql = "insert into generic_list ( listType,f1,f2,f3,f4 ) values ('center machine', '" 
					    		        .$precinct. "','" . $lat0. "','". $long0 ."','". $activeRange ."')"; 
echo '<br> insert sql='.$sql; 
					    		mysqli_query( $currentDB, $sql );
					    		$centerid = getNewId($currentDB,   'center machine' );        
					    }
//echo '<br>update ins centerid='.$centerid; 
	   		  }
	   		  
	   		  //get the center data by $precinct.. 
	   		     
								$sql = " select id, f1, f2, f3, f4,f5, f7 from generic_list where listType='precinct' and f2='".$xmachine."'"; 
								$get = mysqli_query( $currentDB, $sql );
								while ( $row = mysqli_fetch_array($get) ) { 
										$precinctId = $row['id']; 
										$precinct = $row['f1']; 
										$auditname = $row['f3']; 
										$domain = $row['f5']; 
										//$xmachine = $row['f2'];   
									  
									  //get center  and radius... 
									  $sql = "select f2,f3,f4,f7 from generic_list where listType='center machine' and f1='" .$precinct. "'";
										$get2 = mysqli_query( $currentDB, $sql );
										while ( $row2 = mysqli_fetch_array($get2) ) { 
												$centerLat  = $row2['f2']; 
												$centerLong = $row2['f3'];
												$deactivate  = $row['f7']; 
												 
										}
								}
   		  
	   		  
						$precinct = $_POST['precinct'];
						$domain    = $_POST['domain'];
						$auditname = $_POST['auditname'];
						//put updatable single record for machine id and precinct dode
	
// select id, f1,f2,f3,f4,f5 from generic_list where listtype='precinct' 			f13 for email. 		
// select * from generic_list where listtype='precinct' 					
 
						if( empty( $precinctId )) { 
								$sql = " insert into generic_list( listType, f5, f1, f2, f3 ) 
								            values ('precinct', '". $domain ."','". $precinct."','". $xmachine . "','".$auditname. "')"; 
						} else {  
								$sql = " update generic_list set f1 ='".$precinct."', f5='" .$domain. "',
							          	f3='". $auditname."', f2='".$xmachine."'  where id=".$precinctId; 
						}
			       mysqli_query( $currentDB, $sql );
					     
		} 
		
	
?> 

<?php  include 'header2.php'; ?>  
  <form method=post name=ff > 		
  	
<!-- current position set from location script with delay -->
		<input type=hidden  name=glat0 id=glat0 >  
		<input type=hidden  name=glong0 id=glong0 > 
		<input type=hidden  name=currentLat id=currentLat >  
		<input type=hidden  name=currentLong id=currentLong > 

		<table><tr>   
		<?php  
		    include "menu.php"; 
		   
		    echo "<td style='padding-top:20px; padding-left:20px; ' >"; 
		                  

//wierd situation 
//echo "<br>princinct=". $precinct; 

		$optionP = '<option value="">Choose'; 
		
		$sql = "select f1 from generic_list where listType='precinct_list'";
		$get = mysqli_query( $currentDB, $sql );
		while ( $row = mysqli_fetch_array($get) ) { 
				$xp = $row['f1'];
				if( $xp != $precinct ) {
					  $optionP .= "<option value='".$xp."'>".$xp;
				} else {
					  $optionP .= "<option selected value='".$xp."'>".$xp;
				}
				
		}

		               
		    $out = "<form method=post name=ff > 
		           <table>
		               <tr><td colspan=2> <strong> Device Registration </strong> 
		               <tr><td>Precinct  Code:  <td><select  " .$dropStyle. "          
		                     name=precinct id='precinct' > " .$optionP ."</select> 
		               <tr><td>Auditor Name:    <td><input " .$inputStyle." name=auditname id=auditname> 
		               <tr><td>Current Domain:   <td><select ".$inputStyle. " name=domain id=domain> " .$optionDomain ."</select>  ";
		    
 
		    // get center 
				$sql = "select id,f1,f2,f3,f4,f7 from generic_list where listType='center machine' 
				           and f1='". $precinct. "'";
				           
				$get = mysqli_query( $currentDB, $sql );
				while ( $row = mysqli_fetch_array($get) ) { 
						 $glatd = $row['f2'];
						 $glongd = $row['f3']; 
						 $notactive=''; 
						 if( !empty( $row['f7'])){
						 	   $notactive = ' checked '; 
						 }
		    }

		    $out.= "  <tr><td > Current Position:<td> <p id='geoloc'></p> "; 
		    

		    		$out.=" <!-- theis values are set from the location script -->
		    
		              <tr><td>  <a href='javascript:setcenter();'> Set-Reset Center   </a> 
		               
		                       <br> <input ".$selectStyle." type=checkbox name=deactivate id=deactivate ".$notactive." value=1> 
		                           <span style='font-size:18px;'> Deactivate </span> 
                  <input type=hidden name=setc id=setc >
                        
		                           <td> <input readonly " .$inputStyle. " name=glatd id=glatd 
		                                value='".$glatd."' 
		                           >  

		                          <br> <input readonly " .$inputStyle. " name=glongd id=glongd 
		                                value='".$glongd."' 
		                           >   
			          <script> 
								   var geoloc = document.getElementById('geoloc');
								   
								   
								   var glat0 = document.getElementById('currentLat');
								   var glong0 = document.getElementById('currentLong');
			             
			             function setcenter(){
			                 document.getElementById('setc').value='1'; 
			                 document.ff.submit(); 
			             }
			          </script> ";
			          
			          
			          
		    
		    $out.=  "<tr><td colspan=2>Machine id:   ".   $xmachine; 

		               
		    $out.=  "<tr><td colspan=2>
		    <input ".$submitStyle." type=button value='Register this Device' onclick='xmit();'>  ";       
		    
				$out .= "</table></form> "; 
				
				if( !empty($precinct )){   //Assign page values 
					$out .= "<script> 
					            var o = document.getElementById('precinct');
					            o.value ='" .$precinct."';
//alert('precinct=' + '". $precinct. "');					            
//alert( o.value ); 					            
					            var o = document.getElementById('auditname');
					            o.value ='" .$auditname."';
					            var o = document.getElementById('domain');
					            o.value ='" .$domain."';
					            var o = document.getElementById('activerange');
					            if(o){ o.value ='" .$activerange."'; }
					         </script>"; 
				}
				
						echo $out; 
				 
		     

		?>
	  </table>
	</form>
 	  <script> 
	  	function xmit(){ 
	  		if( document.ff.precinct.value == '' ) { alert( 'Enter precinct'); return; }
	  		if( document.ff.auditname.value == '' ) { alert( 'Enter auditor name'); return; }
	  		if( document.ff.domain.value == '' ) { alert( 'Enter domain name'); return; }
	  		
	  		document.ff.submit(); 
	  	}
	  </script>
			          
<?php include 'location.js'; ?> 
			          

</table> </body> </html> 

 



