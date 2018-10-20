<?php 
   ////////////////  xlist 		  
		  $now = time(); 
		  $timeLimit =$timeLimit*60; 
		  $trackA = array(); 
		  $TDIF = array(); 
		  
		  //all voters pending for the precinct. inserted by Intake $out0 previosly. 
		  $sql =  " select * from generic_list where listType='voter track' 
		               and ( f10='pending' )  and f1='".$precinct."'"; 
		  $get = mysqli_query( $currentDB, $sql );
		  while ( $row = mysqli_fetch_array($get) ) { 
		  		$_trackId = $row['id'];  
		  		$auditorname = $row['f2'] ; 
		  		$t0 = $row['f4'] ;
		  		$tlim = $t0 + $timeLimit; 
		  		$tdif = $now - $t0; 
		  		
		  		if( $_SESSION['userLevel'] == 1 ){ //auditor
		  			if( $now < $tlim || true ) {
				  		$trackA[$_trackId] = $_trackId; 
				  		
				  		$min = floor( $tdif/60);
				  		$sec = $tdif - 60.*$min; 
				  		$msg = $min.' mins  '.$sec.' secs';
				  		$TDIF[$_trackId] = $msg; 
		  			}
		  		}  else {  
			  		$trackA[$_trackId] = $_trackId; 
			  		$TDIF[$_trackId] =  'yyy'.floor($tdif/60); 
		  		}
		  		
		  }
		  $idList=''; 
		  $xlist= '';   
		  if(!empty($trackA)){
		  	 $idList = implode(',', $trackA); 
		  }
		  $xlist .= "<table><tr style='background-color:lightblue;' >
		                 <td> Select <td align=center> Intake by <td> Elapsed time since Intake   ";

		  if( empty($idList)){
		  	$xlist .= "<tr><td colspan=3><br><br> NO UNUSED INTAKE RECORDS !<br>  
		  	           <script> var logoLink= '1'; </script>"; //unused. 
		  	   
		  } else { 
				  // find auditor names
				  $sql = "select id, f3 auditName from generic_list where id in ( " .$idList .")" ; 
		//echo '<br>tracksql='.$sql; 
				  
				  $get = mysqli_query( $currentDB, $sql );
				  while ( $row = mysqli_fetch_array($get) ) { 
				  	 $trackA[$row['id']] = $row['auditName']; 
				  }
				  //choose track record, post, set status to 'holding' in 'voter track'  and invoke vote screen with $_trackId
				                   
				                  
			  	while( list($xid, $vname) = each( $trackA ) ){
					  		$widg = "<input type=radio style='height:35px; width:35px; vertical-align: middle;' 
					  		      name=getvote value=".$xid." onclick='notpending(this);'  >"; 
								// echo "<br>vname=".$vname;  
								 $xlist.= "<tr  style='height:55px;' ><td  > "   .  $widg  ." <td  > ".
								                              $vname."<td   align=center>". $TDIF[$xid]; //mins, secs   
					}
		  } 
 			$xlist  = $xlist."</table>"; 
?>