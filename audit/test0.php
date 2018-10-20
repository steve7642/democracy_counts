<?php

						//reverse hold from selection 
						if( !empty($_POST['reverse'])){
							  $track_id  =$_POST['reverse']; 
							  // check that record is still pending. 
							  $sql = "select f10 from generic_list where id=".$track_id; 
echo '<br>reversing   sql='.$sql; 							  
								$get = mysql_query( $sql, $currentDB );
								while ( $row = mysql_fetch_array($get) ) { 
									  $stat = $row['f10']; 
								}
								 
								if( !empty($stat) && $stat=='holding'){
									  // replace status with  pending and current time
									  $sql = "update generic_list set f10='pending', f4='".time()."' where id=".$track_id;  
									  mysql_query( $sql, $currentDB );
									  
								} else {
									 // no longer vailabel 
									 $voteRec = 'Record no longer available'; 
									 
								}
								 
						}

////////////////// header 




		  $now = time(); 
		  $timeLimit =12*60; 
		  
		  //all voters holding for the precinct. 
		  $sql =  " select * from generic_list where listType='voter track' 
		               and ( f10='holding' )  and f1='".$precinct."'"; 

//echo '<br>sql='.$sql; 
	
		  $trackA = array(); 
		  $TDIF = array(); 
		  
		  //time limit is 12 munites.. make large for testing then change duh
		  $timeLimit = 999999; //secs
		  $get = mysql_query( $sql, $currentDB );
		  while ( $row = mysql_fetch_array($get) ) { 
		  		$trackId = $row['id'];  
		  		$auditorname = $row['f3'] ; 
		  		$t0 = $row['f4'] ;
		  		$tlim = $t0 + $timeLimit; 
		  		$tdif = $now - $t0; 
//echo "<br>Trackid=".$trackId." tdif=".$tdif." tlim=".$tlim ; 		  		
		  		
		  		if( $_SESSION['userLevel'] == 0 ){ //supervisor
//	echo '<br>* trackA='.$trackId. 'tlimit='. $timeLimit. ' now='.$now.' t0='. $t0.' tlim='.$tlim . ' dif='. ( $tlim-$now);    				  		
	  			
		  			if( $now < $tlim ) {
				  		$trackA[$trackId] = $trackId; 
//echo '<br>*** trackA='.$trackId; 				  		
				  		$min = floor( $tdif/60);
				  		$sec = $tdif - 60.*$min; 
				  		$msg = $min.' mins  '.$sec.' secs';
				  		$TDIF[$trackId] = $msg; 
		  			}
		  		}  else {  
			  		$trackA[$trackId] = $trackId; 
			  		//$trackAname[$trackId] = $auditorname; 
			  		$TDIF[$trackId] =  'yyy'.floor($tdif/60); 
		  		}
		  		
		  }
		  $idList=''; 
		  $xlist= '';   
		  if(!empty($trackA)){
		  	 $idList = implode(',', $trackA); 
		  }
		  $xlist .= "<table><tr style='background-color:lightblue;' ><td> Select <td align=center>Intake by <td> Elapsed time since Intake   ";

		  if( empty($idList)){
		  	$xlist .= "<tr><td colspan=3><br><br> No Records in hold";  
		  	   
		  } else { 
				  // find auditor names
				  $sql = "select id, f3 auditName from generic_list where id in ( " .$idList .")" ; 
//echo '<br>id list tracksql='.$sql; 
				  
				  $get = mysql_query( $sql, $currentDB );
				  while ( $row = mysql_fetch_array($get) ) { 
				  	 $trackA[$row['id']] = $row['auditName']; 
				  	 //holding tracking id. pick one to set it to holding 

				  }
				  //choose track record, post, set status to 'holding' in 'voter track'  and invoke vote screen with $track_id
				  
				  $xlist .= "<input type=hidden name=trackId id=trackId> <input type=hidden name=reverse id=reverse >  <script> 
				                 function notholding(o){ 
				                     document.getElementById('reverse').value = o.value ;   
				                     document.location='holding.php';
				                     document.ff.submit(); 
				                 } </script>   ";
				                  
			  	while( list($xid, $vname) = each( $trackA ) ){
			  		
					  		$widg = "<input type=radio style='height:35px; width:35px; vertical-align: middle;' 
					  		             name=reverseHold value=".$xid." onclick='notholding(this);'  >"; 
								// echo "<br>vname=".$vname; 
								 //$xlist.= "<tr><td colspan=2 style='height:5px; '> &nbsp; ";
								 $xlist.= "<tr  style='height:55px;' ><td  > "   .  $widg  ." <td  > ".
								         $vname."<td   align=center>". $TDIF[$xid]; //mins, secs   
						 
					}
		  	
		  } 
		  
 			$xlist  = $xlist."</table>"; 	
 			
 			echo $xlist; 
 					
		  if (empty($outOfRange)){ 
		  	
		  		if( !empty( $_POST[reverseHold])){		  		
		  		    $xid =  $_POST[reverseHold]; 
echo '<br>xid='.$xid; 		  		    
		  		
		  		
		  		}

				 	
		  }


?>
