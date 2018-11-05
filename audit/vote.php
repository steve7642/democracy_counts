<?php 
  // https://coa520.com/audit/vote.php?v=1
  $page='vote'; 

  include "header.php"; 	 //=> $xmachine, $precinctId, $precinct, $auditname, $domain, $trackId sometime. 
  

  		if( !empty( $_POST['fullname']) && empty($_POST['demog_id'])){ 
		 		  // name update page, do inserts, maybe change later to insert/update logic. 
		 		  $fullname = trim($_POST['fullname']); 
		 		  
		 		  //check previous submission. //////////////////////////////////////////refine
					$sql = "select id from generic_list where listType='voterdemog' 
					      and f4='".trim($_POST['email'])."'";

					if( isNotDupl( $currentDB, $sql) ) {
				 		  $sql = "insert into generic_list (listType, f10, f1,f2,f3,f4, f5, f6, f9, f11 )
				 		         values ('voterdemog','" .
				 		           $precinct . "','" .
				 		           $fullname . "','" .
				 		           trim($_POST['address']). "','" .
				 		           trim($_POST['zip']). "','" .
				 		           trim($_POST['email']). "','" .
				 		           trim($_POST['phone']). "','" .
				 		           trim($_POST['citystate']). "','" .
				 		           $userid . "','" .
				 		             trim($_POST['agreement'])  . "')"; 
				 		             
		//echo '<br>name='. $sql; 
				 		   mysqli_query( $currentDB, $sql );
				 		   $demog_id = getNewId($currentDB, 'voterdemog' );
				 		   $demog_id = ''; //BREAK LINK TO INTAKE!
				 		   

				 		   // insert  voter track record to pending
				 		   $sql = "insert into generic_list ( listType, f10, f1,f2,f3,f4 ) values ( 
				 		           'voter track', 'pending', '" .$precinct. "','','". $auditname. "','". time() . "')" ;  
//echo '<br>track insert='.$sql; 
				 		    mysqli_query( $currentDB, $sql );
				 		    
				 		    $trackId = getNewId($currentDB, 'voter track' );
				 		    // get voter transfer code 
				 		    $transfer_code = getTransferCode($currentDB, $trackId, $precinct );
				 		    $sql = "update generic_list set f20='". $transfer_code. "' where id=".$trackId; 
				 		    mysqli_query( $currentDB, $sql );
				 		    
				 		    
				 		    $demogPending='1'; 
			 		    
				 	} else {
				 		 $duplIntake='1'; 
				 		 
				 	}
			}    

		 	//////////////// track UPDATES 
		 	if( empty($trackId) && !empty($_POST['trackId'])){
		 			$trackId = $_POST['trackId'] ; 
		 	}
		 	
		 	if (!empty( $_POST['provision'] )     )  {
		 				$sql = "update generic_list set f5='".$_POST['provision']."' where 
		 				         id=" .$trackId; 
	//echo '<br>provision sql=' .$sql; 
		 				mysqli_query( $currentDB, $sql );          
		 	}
		 	
		 	if (!empty( $_POST['prv'] )) {
		 				$sql = "update generic_list set f6='".$_POST['prv']."' where 
		 				         id=" .$trackId; 
	//echo '<br>prov reason sql=' .$sql; 
		 				mysqli_query( $currentDB, $sql );          
		 	}
		 	
		  if (!empty( $_POST['pother'] )) {
		 				$sql = "update generic_list set f7='".$_POST['pother']."' where 
		 				         id=" .$trackId; 
	//echo '<br>prov other  sql=' .$sql; 
		 				mysqli_query( $currentDB, $sql );          
		 	}
		 	
		//Questionnaire updates field by field 
		  if (!empty( $_POST['queryOption'] )) {
		 				$sql = "update generic_list set f14='".$_POST['queryOption']."' where 
		 				         id=" .$trackId; 
		 				mysqli_query( $currentDB, $sql );          
		 	}
		
		  if (!empty( $_POST['age'] )) {
		 				$sql = "update generic_list set f11='".$_POST['age']."' where 
		 				         id=" .$trackId; 
		 				mysqli_query( $currentDB, $sql );          
		 	}
		
		  if (!empty( $_POST['gender'] )) {
		 				$sql = "update generic_list set f12='".$_POST['gender']."' where 
		 				         id=" .$trackId; 
		 				mysqli_query( $currentDB, $sql );          
		 	}
		
		  if (!empty( $_POST['race'] )) {
		 				$sql = "update generic_list set f13='".$_POST['race']."' where 
		 				         id=" .$trackId; 
		 				mysqli_query( $currentDB, $sql );          
		 	}
		
		  if (!empty( $_POST['education'] )) { 
		 				$sql = "update generic_list set f14='".$_POST['education']."' where 
		 				         id=" .$trackId; 
		 				mysqli_query( $currentDB, $sql );          
		 	}
		
		  if (!empty( $_POST['marital'] )) {
		 				$sql = "update generic_list set f15='".$_POST['marital']."' where 
		 				         id=" .$trackId; 
		 				mysqli_query( $currentDB, $sql );          
		 	}
		
		  if (!empty( $_POST['income'] )) {
		 				$sql = "update generic_list set f16='".$_POST['income']."' where 
		 				         id=" .$trackId; 
		 				mysqli_query( $currentDB, $sql );          
		 	}
		
		  if (!empty( $_POST['citizen'] )) {
		 				$sql = "update generic_list set f17='".$_POST['citizen']."' where 
		 				         id=" .$trackId; 
		 				mysqli_query( $currentDB, $sql );          
		 	}
		
		
		
		if( !empty( $_POST['hvote'] )){    //insert votes and set f10='close' where id=trackid coming in .     
			  //echo 'update the votes action, close voter track, 
			  // set input field trackId to blank  ; 
			  // delete from generic_list where listType='votes' 
			  // select id, f1, f2, f9  from generic_list where listType='votes' order by id desc 
  ; 
				$post = $_POST;  
				if( is_array($post) ){ 
					if( empty($_POST['trackId'] )){
						die( 'problem with track id, must fix now!'); 
					} else {
						$trackId = $_POST['trackId']; 
					}
					
//echo '<br>hvote trackid='.$trackId; 					
// check trackId not in use					 

					$sql = "select id from generic_list2 where f4='".$trackId."'"; 
					if( isNotDupl($currentDB, $sql ))	{
						while( list($xname, $cid) = each( $post ) ){
							$pos = strpos($xname,'v_');
							if( is_numeric($pos)  && !empty($cid)  ){ 
									  $xid = substr($xname,2);  
		                $sql = "insert into generic_list2( listtype, f1,f2,f3,f4 ) 
		                         values ( 'votes','" .$xid. 
		                           "','".$cid."','". $precinct. "','". $trackId. "')";            
		                mysqli_query( $currentDB, $sql );
		                // get id for the vote and associate to random number.
		                $xvoteId = getNewId2 ($currentDB,   $listType='votes' );
										$sql = "update generic_list set f10='close' where id = " .$trackId;
										mysqli_query( $currentDB, $sql ); 
							} 
							
							$pos = strpos($xname,'writein_');
							if( is_numeric($pos)  && !empty($cid)  ){ 
									  $xid = substr($xname,8);  
		                $sql = "insert into generic_list2( listtype, f1,f2,f3,f4 ) 
		                         values ( 'votes','" .$xid. 
		                           "','".$cid."','". $precinct. "','". $trackId. "')";            
		                mysqli_query( $currentDB, $sql );
		                // get id for the vote and associate to random number.
		                $xvoteId = getNewId2 ($currentDB,   $listType='votes' );
										$sql = "update generic_list set f10='close' where id = " .$trackId;
										mysqli_query( $currentDB, $sql ); 
							} 
							
							
						}
					}
				}    
		}

  
	if( isset( $_GET['v']	) ){
		$xvote = $_GET['v']	;	 
	}


      include "header2.php"; 
      
      
      if( !empty($_POST['getvote']) ){ 
      	$_POST['trackId'] =  $_POST['getvote'];
      	
      }
//  echo '<br>domain='.$domain.'*'; 
     
?>
<form method=post name=ff id=ff>   
		<input type=hidden   name=flag1 id=flag1 
		  value="<?php $flag =  $_POST['flag1']; echo $flag; ?>"	 >
		<input  type=hidden   name=trackId id=trackId  
		  value="<?php
		            if( empty($trackId)){
                     $trackId = $_POST['trackId']; 
		            }
		            echo $trackId;	
		    ?>"	 > 
		  
 
		<input type=hidden  name=geoloc id=geoloc > 
		<input type=hidden name=demog_id id=demog_id >  
		<input type=hidden  name=vote_id id=vote_id > 
		 
		<input type=hidden  name=currentLat id=currentLat >  
		<input type=hidden  name=currentLong id=currentLong > 

		<table><tr>    

<?php
			if( !empty( $_POST['demog_id'])){
					$demog_id =  $_POST['demog_id']; 
			}
			if( !empty( $demog_id )){
				echo "<script>
				  document.getElementById('demog_id').value ='" .$demog_id."'; 
				</script>";
			}
		  
		  if( !empty( $_POST['vote_id'])){
		  		$vote_id =  $_POST['vote_id']; 
		  }
		  if( !empty( $vote_id )){
		  	echo "<script>
		  	  document.getElementById('vote_id').value ='" .$vote_id."'; 
		  	</script>";
		  }
		  
	    include "menu.php"; 
	     
	    echo "<td style='padding-top:20px; padding-left:20px;  ' > ";
		    

  if( empty( $flag )  && empty($xvote) ||  !empty( $duplIntake)){  //Intake
  	if(!empty( $duplIntake) ){
  		 echo "<span style='color:red;' >Your entry was a duplicate, resolve the issue with the Auditor <br></span>";
  	}
		echo $out0; //from header2 
  	if(!empty( $duplIntake) ){
  		  $xscr =  "<script>
document.getElementById('fullname').value = '". $_POST['fullname'] ."';
document.getElementById('Fulladdressname').value = '". $_POST['address'] ."';
document.getElementById('zip').value = '". $_POST['zip'] ."';
document.getElementById('citystate').value = '". $_POST['citystate'] ."';
document.getElementById('email').value = '". $_POST['email'] ."';
document.getElementById('phone').value = '". $_POST['phone'] ."';
  		  
  		  </script>";
  		  
  		  echo $xscr; 
  		  
 //writeFile($xscr, 'error.js', 'w'); 
 
  		  
  	}
	
	} else {  //voting sequence ,  

//echo 'Trackid='. $trackId. ' flag='.$flag.' voteRec='. $voteRec. '<br>'; 
//echo 'sql='.$scheck.'<br>'; 
//echo 'trackIdfirst='.$trackIdfirst.'<br>'; 

//echo 'zmsg='.$zmsg; 
					
				if ( empty($flag)  ||  (empty( $trackId) && $flag=='1')     ) {
			 				                	
					include "xlist0.php";  
					
				} else if ( $flag=='1'){
					echo  $outProvisional; 
					
				} else if ( $flag=='2'  && $_POST['provision'] == 'provisional'  ){
					echo $outReason;  
					
				} else if ( $flag=='2'){
					echo $ballot;
				} else if ( $flag=='3'){
					echo $ballot;
					
				} else if ( $flag=='8'){  //questionnaire option..........
				      echo $outQ0."</table> "; 
				      echo  "<input type=button " .$submitStyle." value=Done onclick=done1(99); >";   
				      
				   /*
				 			if( true ) { //short
				 				   echo $outQ0."</table> 
				 				   <input type=button " .$submitStyle." value=Done onclick=done1(99); "; 
				 			} else { //long
				 				   echo $outQ0.$outQ1."</table>"; 
				 			}
				   */ 
					
				} else if ( $flag=='4'){ 
				 		$voteCode = getBallotNumber($currentDB, $trackId );
				 		$txt = "Your vote is counted !  <br><br> ". $voteCode. " is your secret vote code. 
				 		 Write it down and you can confirm your vote from your phone or computer.  Use ".$domain."/voter . <br><br> ";
				 		
				 		 echo $txt.$afterVote; //Would you answer a few additional questions
					
				} else if ( $flag=='99'){
				 		 echo "Thank you for participating!  ";
				 		 
				 		 if( !empty($transfer_code) ){
				 		 	   echo ' <br><br> Now vote using your Voter code: <strong> ' .$transfer_code. '</strong>';   
				 		 } else { 
				 		 	
				 		 }
				 		 
				 		 echo '<br><br> Now return this device to the auditor.';
					   
					   echo "<script>beep();   </script>";
				}
	
		
	}

include "done1.js"; 
include "location.js"; 


$myFile = "out.htm";
$milliseconds = round(microtime(true) * 1000 );
$elapsed = $milliseconds - $milliseconds0;
$fh = fopen($myFile, 'a') or die("can't open file");
fwrite($fh, '<br>Vote Action ELAPSED  time in milliseconds=' . $elapsed );
fclose($fh);


?> 



</form></body></html> 


