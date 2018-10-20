<?php 

include "header.php"; 	
//=> $xmachine, $precinctId, $precinct, $auditname, $domain


  		if( !empty( $_POST['fullname']) && empty($_POST['demog_id'])){ 
		 		  // name update page, do inserts, maybe change later to insert/update logic. 
		 		  $fullname = trim($_POST['fullname']); 
		 		  
		 		  //check previous submission. 
					$sql = "select id from generic_list where listType='voterdemog' 
					     and f1='" .$fullname. "' and f4='".trim($_POST['email'])."'";

					if( isNotDupl( $currentDB, $sql) ) {
				 		  $sql = "insert into generic_list (listType, f10, f1,f2,f3,f4, f5, f9, f11 )
				 		         values ('voterdemog','" .
				 		           $precinct . "','" .
				 		           $fullname . "','" .
				 		           trim($_POST['address']). "','" .
				 		           trim($_POST['zip']). "','" .
				 		           trim($_POST['email']). "','" .
				 		           trim($_POST['phone']). "','" .
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
				 		    
				 		    $demogPending='1'; 
			 		    
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
	//echo '<br>ins vote='.$sql; 
		                mysqli_query( $currentDB, $sql );
		                
		                // get id for the vote and associate to random number.
		                $xvoteId = getNewId2 ($currentDB,   $listType='votes' );
		               // $voterCode = getVoterNumber($currentDB, $xvoteId );
		                
										
										$sql = "update generic_list set f10='close' where id = " .$trackId;
										mysqli_query( $currentDB, $sql ); 
							}
						}
					}
				}    
		}

?> 

<?php  include 'header2.php'; 
	//echo 'userid='. $_SESSION['userid'] ; 
	
	/*  track fields.      
	
	  f5    provision        provisional,regular
	  f6    prv            provisional reason (multipe?)
	  f7    pother         other prov reasons
	  
	  f14   queryOption    questionnaire Yes,No
	  f11   age           questionnaire
	  f12   gender
	  f13   race
	      
	      
	     
	
	*/ 
	
	//echo '<br>cneterLat='.$centerLat;
	
	// get center position
	/*
							$sql = "select id,f1,f2,f3 from generic_list where listType='center machine' 
							           and f1='". $precinct. "'";
							$get = mysqli_query( $currentDB, $sql );
							while ( $row = mysqli_fetch_array($get) ) { 
								   $centerLat =$row['f2'];
								   $centerLong =$row['f3'];
							}
echo '<br>top php centerLat='.$centerLat;
*/ 

?>  
	
		
		<form method=post name=ff  > 
		<input type=hidden  name=trackId id=trackId >
		   <?php 
		   			if (!empty($_POST['trackId'])){ //redundant
			   				$trackId =   $_POST['trackId']; 
			   				echo "<script> document.getElementById('trackId').value = '" .$_POST['trackId']. "'; </script>"; 
		   			} else if ( !empty( $trackId)){
		   					echo "<script> document.getElementById('trackId').value = '" .$trackId. "'; </script>"; 
		   			}
		   ?> 
		
		
		<input type=hidden name=flag1 id=flag1  >
		   <?php 
echo '<br>post flag1=' . 		$_POST['flag1'];
  
		   			if (!empty($_POST['flag1'])){
		   				echo "<script> document.getElementById('flag1').value = '".$_POST['flag1']."'; </script>"; 
		   			}
		   ?> 
		
		 

		<input type=hidden  name=geoloc id=geoloc > 
		<input type=hidden name=demog_id id=demog_id >  
		<input type=hidden  name=vote_id id=vote_id > 
		 
		<input type=hidden  name=currentLat id=currentLat >  
		<input type=hidden  name=currentLong id=currentLong > 

		<table><tr>    
		<?php  
		  $page='vote'; 
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
		  
		  if ( !empty($_POST['trackId'])) {
		  	$trackId = $_POST['trackId']  ; 
		  }
 		  
//echo '<br>PRECINCT='. $precinct   ;		
      // check device in range. 
        
	    include "menu.php"; 
	     
	    echo "<td style='padding-top:20px; padding-left:20px;  ' > ";
		    
		  $out0 = "<table>    
		  	 <tr><td colspan=2  > <strong>Voter Intake</strong>            
		     <tr><td style='min-width:160px; '> Full name:               <td> <input ".$inputStyle."
		                 name=fullname id=fullname >     
		      <tr><td style='min-width:160px; '> Full street address:    <td> <input ".$inputStyle." name=address id=Fulladdressname > 
		      <tr><td style='min-width:160px; '> Zip code:               <td> <input ".$inputStyle." name=zip id=zip >   
		      <tr><td style='min-width:160px; '> Email:                  <td> <input ".$inputStyle." name=email id=email >  
		      <tr><td style='min-width:160px; '> Phone:                  <td> <input ".$inputStyle." name=phone id=phone >  
	      
	      <tr><td align=right style='min-width:160px;   '>  <td>
		    I do hereby affirm that I participate voluntarily in the 2018 election audit being conducted by Democracy 
		        Counts and that I chose the same candidate(s) as I voted for in the election.  I further affirm that any and all other 
		        questions I chose to answer herein are truthful. <br>
		        Enter your name to affirm you agree: <input ".$inputStyle." name=agreement id=agreement size=20 > 
		        
		         <!-- </div>-->
        <tr><td   style='min-width:120px;   '> <input ".$submitStyle." type=button value=DONE onclick='done1(99); '>  <td>		
		  </table> 
		  <script>
		  
		  </script> 
		  
		  ";

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
		  		$trackId = $row['id'];  
		  		$auditorname = $row['f2'] ; 
		  		$t0 = $row['f4'] ;
		  		$tlim = $t0 + $timeLimit; 
		  		$tdif = $now - $t0; 
//echo "<br>Trackid=".$trackId." tdif=".$tdif." tlim=".$tlim ; 		  		
		  		
		  		if( $_SESSION['userLevel'] == 1 ){ //auditor
		  			if( $now < $tlim ) {
				  		$trackA[$trackId] = $trackId; 
				  		
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
				  	 //pending tracking id. pick one to set it to holding 

				  }
				  //choose track record, post, set status to 'holding' in 'voter track'  and invoke vote screen with $trackId
				  
				  $xlist .= "<script> 
				                 function notpending(o){ 
				                     document.getElementById('trackId').value = o.value ;   
				                    // alert( o.value );  
				                     document.location='vote.php';
				                     document.ff.submit(); 
				                 } </script>   ";
				                  
			  	while( list($xid, $vname) = each( $trackA ) ){
					  		$widg = "<input type=radio style='height:35px; width:35px; vertical-align: middle;' 
					  		      name=getvote value=".$xid." onclick='notpending(this);'  >"; 
								// echo "<br>vname=".$vname; 
								 $xlist.= "<tr  style='height:55px;' ><td  > "   .  $widg  ." <td  > ".
								                              $vname."<td   align=center>". $TDIF[$xid]; //mins, secs   
					}
		  } 
 			$xlist  = $xlist."</table>"; 
 			
 			$xlist .= "   <script> document.getElementById('flag1').value='1';</script> "; 	
///end xlist............ 
 			
 					
		  if (empty($outOfRange)){ 
		  	  $postFlag = $_POST['flag1'];
$zflag = ' zflag=' .$_POST['flag1'] . '<br>' ; 		    	
				  if( empty( $_POST['flag1'])  && empty($xvote) ){  //Intake
				 		  echo $out0; 
				 		  
				 	} else if (  ( !empty($xvote) && empty($track_id) && empty( $_POST['provision'] ) 
				 	                   && $_POST['flag1'] != '3'  && $_POST['flag1'] != '4'  
				 	                   && $_POST['flag1'] != '99' && $_POST['flag1'] != '1'
				 	                    && $_POST['flag1'] != '8'  && $_POST['flag1'] != '5'    )   
				 	                      ||
				 	                   !empty($voteRec ) ){         //xlist
				 	                   	
			 				if ( !empty($voteRec ))		{ 
			 					  $xlist = 'The voter you selected was processed before you got to it<br><br>'.
			 					            $xlist;  
			 				} 	                   	
			 		 		echo $zflag.   $xlist; 

				 	} else if ( $_POST['provision']=='provisional' ){ // reason was given for requiring you to vote with a provisional ballot
				 		 echo $zflag.   $out2; // done1(3) 
				 		 
				 	} else if (  $_POST['provision']=='regular' ){ //ballot, out3
				 		 echo $out3; //ballot
				 		    echo " <script>document.getElementById('flag1').value='4'; </script>  ";
			 		    
				 	} else if (  $_POST['flag1'] == '3' ){ //ballot
				 		 echo $out3; //ballot
				 		    echo " <script>document.getElementById('flag1').value='4'; </script>  ";
				 		    // going to $out5, do you mind doing questionnaire? 
				 		    
				 	} else if (  $_POST['flag1'] == '8' ){  //determine short or long questionnaire by system 
				 			if( true ) { //short
				 				   echo $outQ0."</table> 
				 				   <input type=button " .$submitStyle." value=Done onclick=done1(99); "; 
				 			} else { //long
				 				   echo $outQ0.$outQ1."</table>"; 
				 			}
				 	} else if (  !empty($trackId)  && empty( $demogPending ) 
				 	                                && $_POST['flag1'] != '4'
				 	                                && $_POST['flag1'] == '1' 
				 	                                && $_POST['flag1'] != '99' ){ // reg or provisional? 
				 		 
				 		 
				 		 echo  $zflag.  $outProvisional;//Do you vote with a regular or provisional ballot? 
				 		 
				 	} else if (  $_POST['flag1'] == '4' ){  //after vote, additional questions $out5 
				 		
				 		$voteCode = getVoterNumber($currentDB, $xvoteId );
				 		$txt = "Your vote is counted !  <br><br> ". $voteCode. " is your secret vote code. 
				 		 Write it down and you can confirm your vote from your phone or computer. <br><br> ";
				 		
				 		 echo $txt.$out5; //Would you answer a few additional questions
				 		 
				 	} else if (  $_POST['flag1'] == '99' ){  //thank you last step on all v=1 paths. 
				 		 echo "Thank you for participating!  ";
				 		 echo '<br><br> Now return this device to the auditor.';
				 	}
		  }
		 	
		 	
		?>
		  
		  
	  </table>
	   
	  <?php 
	  		if( !empty( $demog_id )) {
	  			 $h_demog_id = $demog_id; 
	  		} else if (!empty($_POST['demog_id'])) {    
	  			 $h_demog_id = $_POST['demog_id']; 
	  		}
	  		if( !empty( $h_demog_id )){
	  			$demog_id = $h_demog_id; 
	  			echo "<input type=hidden name=demog_id id=demog_id value='".$demog_id."'>"; 
	  		}
	  ?>

		</form>
	  <script>
	  	function done1(d){
	  alert( 'd='+d ); 
	  	  document.getElementById('flag1').value= ''+d;  
	  	    
	  	  //constraints
	  	  if( d== '0' ){ 
	  	  	alert('d is zero');
	  	  	
	  	 	} else if (d=='1')  {  
	  	 	     
	  	 	} else if (d=='2')  {  
	  	 		var o =document.getElementById('provision'); if(o.value == ''){o.focus(); alert( 'Select Ballot type'); return false;  }
	  	 	
	  	 	} else if (d=='3')  {  
	  	 			// radio = 'prv'
/* editing checkbox single check box or radio *** */
//alert('d3'); 
						var iNode = document.ff.prv;
					 
							var pother = document.getElementById('pother'); 
							if( pother && pother.value == ''){
 						
								var iNode = document.ff.prv;
								var ischeck = false; 
								for ( var k=0; k<iNode.length; k++) { 
 
									
									if( iNode[k].checked ) { 
									  ischeck = true; 
									}
								}
								if( !ischeck ) { alert('You must select a reason or write in other reason'); return false;  }
								
							}
 				  	  document.ff.submit(); 

	  	 	
	  	 	} else if (d=='4')  { 
	  	 		
	  	 	} else if (d=='99')  { 
	  	  	
	  	 		var o =document.getElementById('fullname'); if(o && o.value == ''){o.focus(); alert( 'Enter value for Full Name'); return false;  }
	  	 		var o =document.getElementById('Fulladdressname'); if(o && o.value == ''){o.focus(); alert( 'Enter value for Full street address'); return false;  }
	  	 		var o =document.getElementById('zip'); if(o && o.value == ''){o.focus(); alert( 'Enter value for Zip code'); return false;  }
	  	 		var o =document.getElementById('email'); 
						if(o && o.value == ''){
							o.focus(); alert( 'Enter value for Email'); return false;  
						}
						if(o &&  !o.value.match(/.+@.+\..+/)  ) {
							alert(' Email format required');
							o.focus(); 			return false; 
						}
	  	 		   
	  	 		var o =document.getElementById('phone'); if(o && o.value == ''){o.focus(); alert( 'Enter value for Phone'); return false;  }
	  	 		var o =document.getElementById('agreement'); if(o && o && o.value == ''){o.focus(); alert( 'Enter your name to agree'); return false;  }
	  	 	     //document.getElementById('flag1').value='99'; 
	  	 	}
	  	 	
	  	  document.ff.submit(); 
	  	  
	    }
	  
	  
      hideMenu();

			function imgRedirect(){ 

			 		if( logoLink &&  logoLink=='1'){ location.href = 'index.php';}

			}	  
	  	</script>
	  	
<?php include 'location.js'; ?> 
 
</table> </body> </html> 

 



