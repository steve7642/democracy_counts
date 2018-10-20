<?php //reports.php   
include "header.php"; 	
?> 

<?php  include 'header2.php';   
		$offices = array(); 
		$sql = " SELECT id,f1  FROM generic_list where listType='offices' order by id  "; 
		$get = mysqli_query( $currentDB, $sql );
		while ( $row = mysqli_fetch_array($get) ) { 
				$offices[ $row['id']] = $row['f1'] ;
		}
		//update
		if( !empty( $_POST['rtype'])){
				$rtype = $_POST['rtype'];
				
		}
		
		
?>
  <form method=post name=ff > 	
  	<input type=hidden name=reportType value=''>	
		<table><tr>   
		<?php  
		    include "menu.php"; 
		   	echo "<td style='padding-top:20px; padding-left:20px; ' > <strong> REPORTS </strong> 
		   	
		   	<br>Each report has an CSV output file which can be read and reviewed with Excel or any editor of your choice. 
		   	
		   	<br><br> The Vote tally is displayed on the page with a CSV output link at the bottom.  
		   	          The other reports only have a CSV file link.   
		   	
		   	<br><br> As of Oct 14, the Analytics reports use the ancillary data (eg, reasons for not voting, questionnaire ). 
		   	 These ancillary data
		   	   MUST be provided prior to the first real audit.   
		   	   Immediately prior to the first audit, the audit data will be erased by the master administrator. <br>
		   	      
 			   <select name=rtype  style=' height:36; width:400px; font-size:26px; '   id=rtype onchange='xrpt();'	  > 
 			      <option value=''> Choose Report. 
 			      <option value=tally> Vote tally
 			      <option value=analytics> Voting Analytics
 			      <option value=intake> Intake
 			      <option value=nonvoter> Non Voter Analytics
 			   </select> 
 			       
			   	      <script>
			   	      	function xrpt(o){
			   	      	     document.ff.submit(); 
			   	      	} 
	   	         </script> 
		   	   "; 

					if( !empty($rtype)){
							echo "<script>document.getElementById('rtype').value='" .$rtype. "'; </script>" ;
							
							if($rtype=='tally') {
				// SELECT f1,f2,f3 p from generic_list where listType='votes'
									$sql = "SELECT f1,f2,f3, count(*) cnt from generic_list2 where listType='votes' group by f1, f2, f3 ";
									$rawCnt = array(); 
									$get = mysqli_query( $currentDB, $sql );
									while ( $row = mysqli_fetch_array($get) ) { 
										$rawCnt [$row['f3']] [$row['f1']]  [$row['f2']]   = $row['cnt']; 
									}
									
									// $offices[ $xid] = $row['f1'] ;
									// $officer_names [$xid][$row['id']] =  $row['f1'];
									// get totals for all precincts. 
									$ptotal = array(); 
									while( list($p, $a) = each( $rawCnt ) ){
										while( list($id1, $aa) = each( $a ) ){
											while( list($id2, $cnt) = each( $aa ) ){
											   if( empty($ptotal[$id1][$id2])){
											   	  $ptotal[$id1][$id2]  = $cnt; 
											   } else {
											   	  $ptotal[$id1][$id2]  += $cnt; 
											   }
											 }  
										}
									}
									
									$tab = "<table>";
									reset($rawCnt); 
									
									$xfile='"Precinct","Office","Candidate","Votes"' ."\r\n";
									writeFile($xfile, 'tally.csv', 'w');
									$xfile=""; 
									
									while( list($p, $a) = each( $rawCnt ) ){
										$tab .= "<tr style='background-color:lightgrey;' ><td colspan=3>Precinct=" .$p; 
										 
										while( list($id1, $aa) = each( $a ) ){
											$tab .= "<tr><td colspan=3>"   .$offices[ $id1] ;
											
											while( list($id2, $cnt) = each( $aa ) ){
											   $tab .= "<tr><td> &nbsp; &nbsp; <td> ". $officer_names [$id1] [$id2] ."<td>". $cnt;
											  
											   $xfile .= '"' .$p. '","'. $offices[ $id1] .'","'. 
											             $officer_names [$id1] [$id2] . '","'. $cnt. '"' ."\r\n"; 
											}  
										}
									}
								
									$tab .= "<tr><td colspan=3 style='background-color:lightgrey;' >All Precincts ";
									while( list($id1, $a) = each( $ptotal ) ){
										$tab .= "<tr><td colspan=3>".$offices[ $id1];
										while( list($id2, $cnt) = each( $a ) ){
											$tab .= "<tr><td>  &nbsp; &nbsp; <td> "   .$officer_names [$id1] [$id2] ."<td>".$cnt;   
											   $xfile .= '"total","'. $offices[ $id1] .'","'. $officer_names [$id1] [$id2] . '","'. $cnt. '"' ."\r\n"; 
										}
									}
									echo $tab ."</table>"; 
									
									writeFile($xfile, 'tally.csv', 'a');
						   	 	echo "<br><a target=_blank href='https://coa520.com/audit/out_csv/tally.csv' > Tally CSV </a><br><br>"; 
								
							} else if( $rtype=='nonvoter'){  /////////////////////////////////////////////////
								
								   echo "<br> This report needs program data, ie questionnaire, to be done ";
								   
								   
								   
 								  
							} else if( $rtype=='intake'){  /////////////////////////////////////////////////
 								  
								  $csv = '"Precinct","Full Name","Street Address","Zip Code","Email","Phone","City and State","Signature"' ."\r\n"; 
								  writeFile($csv, 'intake.csv', 'w');
								  
								  
								  
								  $sql = "select * from generic_list where listType='voterdemog'";
									$get = mysqli_query( $currentDB, $sql );
									  
									while ( $row = mysqli_fetch_array($get) ) { 
										   $csv = '"'. $row['f10']  . '","' . 
										           $row['f1']   . '","' . 
										           $row['f2']   . '","' . 
										           $row['f3']   . '","' . 
										           $row['f4']   . '","' . 
										           $row['f5']   . '","' . 
										           $row['f6']   . '","' . 
										           $row['f11']   . '"' . "\r\n";    
										           
								       writeFile($csv, 'intake.csv', 'a');
									}
							   	 	echo "<br><a target=_blank href='https://coa520.com/audit/out_csv/intake.csv' > Intake CSV </a><br><br>"; 
							  
							} else if( $rtype=='analytics'){  /////////////////////to modify when list is in if ever ! //////////////////////////////////////////////////
	
								   echo "<br> This report needs program data, ie questionnaire, to be completed ";
	
								
							    $analyticsOut ='"Precinct","BallotType","Reason for Provisional ballot","Age","Gender","Race';
							    // "'.  "\r\n"; 
							    $vsectionA = array(); 
									while( list($officeId, $office_name) = each( $offices ) ){
											$analyticsOut .= '","'. $office_name; 
											$vsectionA[$officeId] = ''; //empty values in order of header
									}
									
							    $analyticsOut .= '"'."\r\n";
							                        
									writeFile($analyticsOut, 'analytics.csv', 'w');

								 	$sql = "select * from generic_list where listType='voter track' and f10='close' order by f4 ";
									$get = mysqli_query( $currentDB, $sql );
									$analytics=''; 
									while ( $row = mysqli_fetch_array($get) ) { 
										
										 	$trackId = $row['id']; 
											$sql = "SELECT * from generic_list2 where listType='votes' and f4='".$trackId."' order by id desc ";
											$get2 = mysqli_query( $currentDB, $sql );
					
				         //$vsectionA[$officeId] = '""'; //empty values in order of header  "xy","ab","","","","x" 
										  reset( $vsectionA); 
										  while( list($k, $v) = each( $vsectionA ) ){
										  			$vsectionA[$k] = ''; 
										  }
										  reset( $vsectionA ); 
										  
											while ( $row2 = mysqli_fetch_array($get2) ) { 
														 $officeId = $row2['f1'];
														 $cid = $row2['f2'];  // candidate id    
														 $vsectionA[$officeId]  =  $officer_names[ $officeId ] [ $cid ] ;  //candidate name. 
//echo '<br>track='.$trackId.' vsection id='.$officeId.' cid='.$cid.' name='. 	 $officer_names[ $officeId ] [ $cid ] ;													 
//	SELECT * from generic_list2 where listType='votes' and f4='22686'													 
											}
										  $vsection = ''; 
										  while( list($k, $v) = each( $vsectionA ) ){
												  $vsection .= '"'.$v . '",'; 
											}
											$vsection = substr( $vsection,0, strlen($vsection)-1 ); 
//	echo '<br>vsection='.$vsection; 									 
										 
										 $p = $row['f1']; //precinct description
										 $ballotType = $row['f5']; // provisional, regular 
										 $reasonFor  = $row['f6']; 
									   $ot = $row['f7'];
									   if( !empty($ot)){
									   	  $reasonFor .= '<br>Other:'.$ot;
									   }    
									    //CSV output. 
									    
									    //quetionnaire
									    $age = $row['f11']; 
									    $gender = $row['f12'];
									    $race = $row['f13']; 
									    
									    //line by line write
									    $analytics = '"'. $p .
									                 '","'. $ballotType. 
									                 '","'. $reasonFor .
									                 '","'. $age .  
									                 '","'. $gender .  
									                 '","'. $race . 
									                 '",'. $vsection.  "\r\n"; 
									                 
									                 
									    writeFile($analytics, 'analytics.csv', 'a');
									}
									
									echo "<br><br><a target=_blank href='https://coa520.com/audit/out_csv/analytics.csv' > Analytics CSV </a>"; 
									
							} else if( $rtype=='?'){
								
								
								
							}
							
							
					}
		   	   
		   	   
	 
           
		   	

		?>
	  </table>
	</form>
 
</table> </body> </html> 

 



