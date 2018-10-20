<?php 	
/* ABOVE THE BODY TAG */ 
//error_reporting(0);

    $realRootPathExt = 'audit'; 
    $httpPrefix="https://"; 

  	$realRoot = realpath(""); //no trailing slash, 
 	$realRootPath = $realRoot."\\"; 
	$rootUri =    $httpPrefix . $_SERVER['HTTP_HOST']   ; //NO TRAILING SLASH 
	$rootUri .= "/".$realRootPathExt; 

$milliseconds0 = round(microtime(true) * 1000);


    require_once "checkAuthorized.php"; //starts session

if ( empty($_SERVER['HTTPS'])){
	   header("location:https://coa520.com/audit/index.php"  );   
}
     
   $currentDB = mysqli_connect("localhost","steve_520coa","vernon9!","steve_520coa");      


   
         //////////////////////////////////////////////// machine and userid
		 		      $machine = $_SERVER['HTTP_COOKIE']  ;
		 		      $pos1 = strpos( $machine, 'PHPSESSID=' );
		 		      if( is_numeric($pos1)){
		 		      	 $pos2 = strpos( $machine, ';', $pos1+1 );
		 		      	 if( is_numeric($pos2)){
		 		      	 	    $xmachine = substr( $machine,$pos1+10, $pos2-$pos1-10  );
		 		      	 } else { // my phone
		 		      	 	    $xmachine = substr( $machine,$pos1+10 );
		 		      	 	}
		 		      }
		 		      
						  if( !empty($_SESSION['userid']) ) {
						  	  $userid =  $_SESSION['userid'] ; 
						  }
         ////////////////////////////////////////////////////////		 xmachine and userid 		      
		 		      
/*		 		      
$myFile = "out.htm";
$fh = fopen($myFile, 'a') or die("can't open file");
fwrite($fh, '<br>Xmachine=' . $xmachine);
fclose($fh);
*/ 
//echo 'machinge='.$xmachine;
 
        ///////////precinct and geoloc of center
                  
								$sql = " select id, f1, f2, f3, f4,f5  from generic_list where listType='precinct' and f2='".$xmachine."'"; 
								$get = mysqli_query( $currentDB, $sql );
								while ( $row = mysqli_fetch_array($get) ) { 
										$precinctId = $row['id']; 
										$precinct = $row['f1']; 
										$auditname = $row['f3']; 
										$domain = $row['f5']; 
										//$xmachine = $row['f2'];   
									  
									  //get center  and active status... 
									  $sql = "select f2,f3,f4,f7 from generic_list where listType='center machine' and f1='" .$precinct. "'";
										$get2 = mysqli_query( $currentDB, $sql );
										while ( $row2 = mysqli_fetch_array($get2) ) { 
												$centerLat  = $row2['f2']; 
												$centerLong = $row2['f3'];
												$deactivate = $row2['f7'];   
//echo ' deactivate=' .$deactivate.'*';
//=1*											 
										}
								}
								
						
						//determin vote page
						if( isset( $_GET['v']	) ){
							$xvote = $_GET['v']	;	 
						}
						 
						$submitStyle = " style='font-size:24px; font-weight:bold; background-color:lightgreen; padding:5px; ' "; 
						
						$selectStyle = " style='height:65px; width:65px; vertical-align: middle;' ";   //checks and radio 
						
						$dropStyle = " style=' height:36; width:200px; font-size:26px; '  ";  //dropdowns
						
						$inputStyle = " style=' height:36; width:305px; font-size:26px; '  "; //text input boxes
		 		      
						$timeLimit =33333; //minutes for list availability
						
						if( isset($_SESSION['userLevel'])){
							if( $_SESSION['userLevel']=='0' ) {
								 $isAdmin = true; 
							}  else {
								 $isAdmin = false; 
							}
							
						}
						
						//get vote from selection  
						if( !empty($_POST['getvote'])){
							  $track_id  =$_POST['getvote']; 
							  // check that record is still pending. 
							  $sql = "select f10 from generic_list where id=".$track_id; 
//echo '<br>header getvote sql='.$sql; 							  
								$get = mysqli_query( $currentDB, $sql );
								while ( $row = mysqli_fetch_array($get) ) { 
									  $stat = $row['f10']; 
								}
								if( !empty($stat) && $stat=='pending'){
									  // replace status with holding
									  $sql = "update generic_list set f10='holding' where id=".$track_id;  
									  mysqli_query( $currentDB, $sql );
									  
								} else {
									 // no longer vailabel 
									 $voteRec = 'Record no longer available'; 
									 
								}
						}
							    //global 
							    $sqlformat = "Y-m-d H:i:s"; 
							  $onehourago = date($sqlformat,( time()-3600));

						//confirm valid transfer_code  
						if( !empty($_POST['transfer_code'])){
							  $trackId='';
							  $transfer_code = $_POST['transfer_code'];
						    //$sqlformat = "Y-m-d H:m:s"; 
							  //$onehourago = date($sqlformat,( time()-3600));
								$sql = "select id, f20, f3, f10, lastpdate from generic_list where listType = 'voter track'  
								          and f20='"   .$transfer_code.  "' and f1='".$precinct."'";

//echo $sql; 
//echo '<br>onehour ago='.$onehourago; 

//$scheck =$sql; // to delete								          
/*
select id, f20, f3, f10, lastpdate from generic_list where listType = 'voter track'  
								          and f20='830' 
*/ 								
								$get = mysqli_query( $currentDB, $sql );
								while ( $row = mysqli_fetch_array($get) ) { 
									
									$dt = $row['lastpdate']; 
									$stat  = $row['f10']; 
$zmsg = '<br>lastpdate='.$dt.' hourago='.$onehourago; 
 
									if( $stat=='pending') {
										  if( $dt < $onehourago ) {
										  	  $badTransfer = '2';  // timeout
										  } else { 
										  	  $trackId = $row['id'];  //ok
										  }
									} else {
										   $badTransfer = '1';//  close
									}
								} 
								if( empty($trackId) && empty($badTransfer) ) {
									 $badTransfer = '3'; //typo   
								}
							
						}

						
			$offices = array(); 
			$officer_names = array(); 
			$candidates = array(); 
			$sql = " SELECT id,f1  FROM generic_list where listType='offices' order by id  "; 
			$get = mysqli_query( $currentDB, $sql );
			while ( $row = mysqli_fetch_array($get) ) { 
					$officeId = $row['id']; 
					$offices[ $officeId] = $row['f1'] ;
		 		  $sql = " SELECT id,f1,f2  FROM generic_list where listType='officer_names' 
		 		              and  f2='". $officeId. "'";  
					$get2 = mysqli_query( $currentDB, $sql );
					while ( $row = mysqli_fetch_array($get2) ) { 
							$officer_names [$officeId][$row['id']] =  $row['f1'];
//echo '<br>Candidate refs='.$officeId.' '.$row['id'].' '.$row['f1']; 
							$candidates[$row['id']] = $row['f1']; 
					}
			}
							
    function writeFile($data, $fname, $mode){
    	
				$myFile = "out_csv/".$fname; 

				$fh = fopen($myFile, $mode) or die("can't open file");
				fwrite($fh, $data);
				fclose($fh);
				
    }

		function getNewId($currentDB,   $listType ) {
			 $sql = "select max(id) maxid from generic_list where listType = 
			          '".$listType."'"; 
				$get = mysqli_query( $currentDB, $sql );
				while ( $row = mysqli_fetch_array($get) ) { 
						$maxid = $row['maxid'] ;
				}
			  return $maxid;            
		} 		
		function getNewId2 ($currentDB,   $listType='votes' ) {
			 $sql = "select max(id) maxid from generic_list2 where listType = 
			          '".$listType."'"; 
				$get = mysqli_query( $currentDB, $sql );
				while ( $row = mysqli_fetch_array($get) ) { 
						$maxid = $row['maxid'] ;
				}
			  return $maxid;            
		} 		

		function isNotDupl($currentDB, $sql ){
			
			
				$get = mysqli_query( $currentDB, $sql );
				$xf=true; 
				while ( $row = mysqli_fetch_array($get) ) { 
					$xf=false; 
				}
				return $xf; 
			
		}	

		function getBallotNumber($currentDB, $trackId ){   
			
			while( empty($nr)) {
					$nr = rand(1000001,9999999);
					
					$sql = "select id, f1 from generic_list where listType='random out' and f1='" .$nr."'"; 
					$get = mysqli_query( $currentDB, $sql );
					$xid =''; 
					while ( $row = mysqli_fetch_array($get) ) { 
						$xid = $row['id']; 
					}
					if( empty($xid)){ //number good
						$sql = "insert into generic_list (listType,f1, f2) value ('random out', '". $nr. "','". $trackId. "')";
						mysqli_query( $currentDB, $sql );
						return $nr;     
						
					} else {
						$nr=''; 
					}

			}
			
			return 'ERROR IN random out' ;
		}
		function getTransferCode($currentDB, $trackId, $precinct ){   
			
			while( empty($nr)) {
					$nr = rand(101,999);  //use lastpdate 
					
					$sql = "select id, f1 from generic_list where listType='random track' and f1='" .$nr."'
					           and lastpdate > '" .date('Y-m-d H:i:s', (time()-3600)). "' and f10='" .$precinct."'" ; 
					$get = mysqli_query( $currentDB, $sql );
					$xid =''; 
					while ( $row = mysqli_fetch_array($get) ) { 
						$xid = $row['id']; 
					}
					if( empty($xid)){ //number good
						$sql = "insert into generic_list (listType,f1, f2, f10) value ('random track', '". $nr. "','". 
						             $trackId. "','". $precinct. "')";
						mysqli_query( $currentDB, $sql );
						return $nr;     
						
					} else {
						$nr=''; 
					}

			}
			
			return 'ERROR IN random  ' ;
		}

?>