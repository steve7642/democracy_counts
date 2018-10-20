<?php 	
/* ABOVE THE BODY TAG */ 
//no login required.. 

    $realRootPathExt = 'audit'; 
    $httpPrefix="https://"; 

  	$realRoot = realpath(""); //no trailing slash, 
 	$realRootPath = $realRoot."\\"; 
	$rootUri =    $httpPrefix . $_SERVER['HTTP_HOST']   ; //NO TRAILING SLASH 
	$rootUri .= "/".$realRootPathExt; 


   // require_once "checkAuthorized.php"; //starts session

if ( empty($_SERVER['HTTPS'])){
	   //header("location:https://coa520.com/voter/index.php"  );   
}
     
   $currentDB = mysqli_connect("localhost","steve_520coa","vernon9!","steve_520coa");      

						 
						$submitStyle = " style='font-size:24px; font-weight:bold; background-color:lightgreen; padding:5px; ' "; 
						
						$selectStyle = " style='height:45px; width:45px; vertical-align: middle;' ";   //checks and radio 
						
						$dropStyle = " style=' height:36; width:200px; font-size:26px; '  ";  //dropdowns
						
						$inputStyle = " style=' height:36; width:305px; font-size:26px; '  "; //text input boxes
		 		      
						$timeLimit =33333; //minutes for list availability
						
/*						
						//get vote from selection 
						if( !empty($_POST['getvote'])){
							  $track_id  =$_POST['getvote']; 
							  // check that record is still pending. 
							  $sql = "select f10 from generic_list where id=".$track_id; 
echo '<br>header getvote sql='.$sql; 							  
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
*/

						
			$offices = array(); 
			$officer_names = array(); 
			$candidates = array(); 
			$sql = " SELECT id,f1  FROM generic_list where listType='offices' order by id  "; 
			$get = mysqli_query( $currentDB, $sql );
			while ( $row = mysqli_fetch_array($get) ) { 
					$xid = $row['id']; 
					$offices[ $xid] = $row['f1'] ;
		 		  $sql = " SELECT id,f1,f2  FROM generic_list where listType='officer_names' 
		 		              and  f2='". $xid. "'";  
					$get2 = mysqli_query( $currentDB, $sql );
					while ( $row = mysqli_fetch_array($get2) ) { 
							$officer_names [$xid][$row['id']] =  $row['f1'];
							$candidates[$row['id']] = $row['f1']; 
					}
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

		function getVoterNumber($currentDB, $trackId ){
			
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
    function writeFile($data, $fname, $mode){
    	
				$myFile = "out_csv/".$fname; 

				$fh = fopen($myFile, $mode) or die("can't open file");
				fwrite($fh, $data);
				fclose($fh);
				
    }

?>