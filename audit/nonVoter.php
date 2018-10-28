<?php 
$page='nonVoter'; 
include "header.php"; 	//=> $xmachine 
  
	// UPDATE section 	
	
	
			
 		 	
		 	if (!empty( $_POST['provision'] ) && false) {
		 	
		 				//$nonvoterId = $_POST['nonvoterId'];
		 				$sql = "update generic_list set f5='".$_POST['provision']."' where 
		 				         id=" .$nonvoterId; 
//echo '<br>provision sql='.$sql; 
		 				         
		 				mysqli_query( $currentDB, $sql );          

		 	}
 			// different update listtype in vote.php 
 			 
 			if( isset( $_POST['age'] )){ // questionnaire insert...........
 					
	 					$age = $_POST['age'];
	 					$race = $_POST['race'];
	 					$gender = $_POST['gender'];
		 				$nonvoterId = $_POST['nonvoterId'];
		 				$sql = " update generic_list 
		 				          set f21='".$age."', f22='".$race."', f23='".$gender."' 
		 				            where id = ".$nonvoterId ;
//echo '<br>questionnaire sql='.$sql; 
		 				         
		 				mysqli_query( $currentDB, $sql );          
 				
 			}
		 	
		 	if (!empty( $_POST['whynotreg'] ) && false ) {
		 	
		 				//$nonvoterId = $_POST['nonvoterId'];
		 				$not_registered = $_POST['not_registered'];
		 				$whyNotRegtxt = $_POST['whyNotRegtxt'];
		 				$m_ = $_POST['m_'];
		 				$reson = ''; 
						while( list($k, $v) = each( $m_ ) ){
							$reson.= $v.", "; 
						}
		 				$reson = substr( $reson,0, strlen($reson)-2 ); 
		 				
		 				$sql = "update generic_list set 
		 				          f6='".$not_registered. "',
		 				          f7='" . ($whyNotRegtxt) ."', 
		 				          f8='" . $reson . "' where id=" .$nonvoterId; 
		 				mysqli_query( $currentDB, $sql );          
		 	}
		 	
		 	if (!empty( $_POST['notvotewhy'] ) && false) { // registered but did not vote, why? 
		 				$nonvoterId = $_POST['nonvoterId'];
		 				$r_ = $_POST['r_'];
//echo '<br>r_='.$r_.' nonvoterId='.$nonvoterId ; 
		 				
		 				$reson = ''; 
						while( list($k, $v) = each( $r_ ) ){
							$reson.= $v.", "; 
						}
		 				$reson = substr( $reson,0, strlen($reson)-2 ); 
		 				
		 				$sql = "update generic_list set 
		 				          f3='" . $reson . "' where id=" .$nonvoterId; 
//echo '<br>not vote why sql='.$sql; 
		 				          
		 				mysqli_query( $currentDB, $sql );   //other reason in f4...       
		 	}
		 	 	
		 	if (!empty( $_POST['prv'] )) {
		 				$demog_id = $_POST['demog_id'];
		 				$sql = "update generic_list set f6='".$_POST['prv']."' where 
		 				         id=" .$demog_id; 
	//echo '<br>prov reason sql=' .$sql; 
		 				mysqli_query( $currentDB, $sql );          
		 		
		 	}
		  if (!empty( $_POST['pother'] )) {
		 				$demog_id = $_POST['demog_id'];
		 				$sql = "update generic_list set f7='".$_POST['pother']."' where 
		 				         id=" .$demog_id; 
	//echo '<br>prov other  sql=' .$sql; 
		 				mysqli_query( $currentDB, $sql );          
		 		  
		 	}
			if( !empty( $_POST['hvote'] )){
//echo '<br>hvote'; 				
				  //echo 'update action ballot nonvoter'; 
				  $nonvoterId = $_POST['nonvoterId'];
					$post = $_POST; 
					if( is_array($post) ){ 
						while( list($xname, $cid) = each( $post ) ){
							$pos = strpos($xname,'v_');
							if( is_numeric($pos)  && !empty($cid)  ){ 
								
								$xid = substr($xname,2);

								$sql = "insert into generic_list( listType, f1, f2 , f3, f9  ) values ( 'nonvotes', 
								         '".$xid."','".$cid. "','". $nonvoterId. "','" .$userid. "')";
//echo '<br>hvote sql='.$sql;				select f1, f2 from generic_list where listType='nonvotes' and f3='23877'  				           
								mysqli_query( $currentDB, $sql );     
							}
						}
					}    
			}

?> 

<?php  
    include 'header2.php'; 
    // updates specific to nonVoter
    
?>  
		<form method=post name=ff  > 
				  <input type=hidden name=flag1 id=flag1   > 

		<table><tr>    
		<?php  
		  //pass thru nonvoterId
		  echo "<input type=hidden name=nonvoterId id=nonvoterId>"; 
		  if( !empty($_POST['nonvoterId'])){
		  		$nonvoterId = $_POST['nonvoterId']; 
		  }
		  if( !empty($nonvoterId)){
		  		echo "
		  				<script> document.getElementById('nonvoterId').value = '"
		  				         .$nonvoterId."'; </script> "; 
		  }
//echo '<br>nonvoterId='.$nonvoterId.'*'; 
		  
	    include "menu.php";  
	    
	    echo "<td style='padding-top:20px; padding-left:20px;  ' > ";
		    
		  $out0 = "<table id=novoteContainer > 
		  	 <tr><td > <strong>I came to this polling precinct to vote, <br> 
		  	                     But I did not vote.  </strong>  
		  	                     <br><br> 
		  	                     Please select the reason or reasons you did not vote. 
		  	                     
		  	            <!-- <input type=hidden name=areyoureg value=1>      --> 
		  	                
         <tr><td > <!-- add from header2 $novote --> ".$novote. "
             
		  </table> 
		  <input type=hidden name=regval id=regval >  <!-- Yes No Maybe --> 
		      ";
		  
		  $outWhyNot = "<table><tr><td> Why didn't you register?  <br> "; 
		  
		  $outWhyNot .= "<input type=hidden name=whynotreg value=1> ";
			$outWhyNot .= "<tr> <td   > 
			              <input type=checkbox   " .$selectStyle."   name=m_[] id='m_Too lazy' value='Too lazy'> Too Lazy" ;
			              
			$outWhyNot .= "<tr> <td> <input type=checkbox   " .$selectStyle."  name=m_[] id='m_Felony' value='Felony'> Felony " ;
			$outWhyNot .= "<tr> <td> <input type=checkbox   " .$selectStyle."  name=m_[] id='m_Other' value='Other'> Other " ;

      $outWhyNot .= "<tr> <td><br> Did you attempt to register? ";
      $outWhyNot .= "<tr> <td> <input type=radio  " .$selectStyle."  name=not_registered id=not_registeredYes value=Yes> Yes";
      $outWhyNot .= "<tr> <td> <input type=radio  " .$selectStyle."  name=not_registered id=not_registeredNo  value=No> No";

      $outWhyNot .= "<tr> <td> <br> Please explain your response: ";
      $outWhyNot .= "<tr> <td> <textarea name=whyNotRegtxt id=whyNotRegtxt rows=5 cols=50 ></textarea>  ";
       
			$outWhyNot .= "<tr><td>  &nbsp; <input type=button ".$submitStyle .
			                   " value='Next' onclick='done1(5);'> 
		         	</table> "; 
	  
	  
		  // 
		  // $outProvisional, $out2, $ballot in header2
	  
		  
		  if( empty( $_POST)   ){  //first entry   
		 		  echo $out0; 
		 		  
		 		  
		 		  
		 	} else if (  $_POST['flag1'] == '8' ){  //questionnaire determine short or long
		 			if( true ) { //short
		 				   echo $outQ0."</table> <input type=button ".$submitStyle." value=Submit onclick=done1(99); "; 
		 			} else { //long
		 				   echo $outQ0.$outQ1."</table>"; 
		 			}
		 		  
		 	} else if (  $_POST['flag1'] == '4' ){
		 		 echo $afterVote; 
		 		 
		 	} else if ( $_POST['provision']=='provisional' ){
		 		 echo $out2; 
		 		 
		 	} else if (  $_POST['provision']=='regular' ){
		 		
		 		 echo "OBSOLETE?<br><br>". 
		 		             $ballot;                              
		 		 echo "<script>  document.getElementById('flag1').value='8'; </script> ";
		 		 
		 	} else if (  $_POST['regval'] == 'Yes' ){
		 		 echo $notVoteWhy;  //multi checkbox input page in header2
			    if( !empty( $r_ ) )  { // is check setting ever used?   
					while( list($key, $value) = each( $r_ ) ){ 
						echo "<script>var xNode = document.getElementById('r_" . $value ."'); 
						           xNode.checked=true;</script>"; 
			        }
			    } 
		 		 
		 	} else if (  $_POST['regval'] == 'No' || $_POST['regval'] == 'Maybe' ){
		 		 echo $outWhyNot;  
		 		 
		 	} else if (  $_POST['flag1'] == '5' ||  $_POST['flag1'] == '3'   ){
		 		 echo "Had you voted, who would you have voted for?<br><br>"; 
		 		        echo $ballot; 
		 		        // go to questionnair..
		 		 echo "<script> document.getElementById('flag1').value='8'; </script> ";

		 	} else if (  $_POST['flag1'] == '99' ){
				 		 echo "Thank you for participating!  ";
				 		 echo '<br><br> Now return this device to the auditor.';
		 	}
		?>
		  
		  
	  </table>
	  
		</form>
<script>
	 function extend(o, exit=0){ 
	 	//if exit==1 confirm go to next page
	 	  var e = document.getElementById('e'+o.id); 
	 	  //var r = document.getElementById('r'+o.value); 
	 	  if( o.checked ) { 
	 	  	
	 	  	  e.style.position = 'relative'; 
	 	  	  e.style.top  = '0px'; 
	 	  	  e.style.left = '40px'; 
	 	  	  //e.style.fontSize = r.style.fontSize; 
	 	  			
	 	  } else { //unchecked remove extension
	 	  	  e.style.position = 'absolute'; 
	 	  	  e.style.top  = '-999px'; 
	 	  	  e.style.left = '0px'; 
	 	  	  
	 	  }
	 	}
</script>

	  <script>
	     function isreg(o){ 
	     		document.getElementById('regval').value = o.value; 
	     		document.ff.submit(); 
	     }
			function countKeys(obj) {
			    return Object.keys(obj).length;
			}	
	     
	  	function done1(d){
	  		//alert( 'd='+d ); 
	  	  document.getElementById('flag1').value= ''+d;
	  	    
	  	  //CONSTRAINTS
	  	  if( d== '0' ){ 
	  	  	//
	  	  	
	  	 	} else if (d=='5')  {  //validation for why not registered. 
	  	 		// m_ (multi check),  not_registered Yes or No ,   whyNotRegtxt textarea     
						
						var txt = document.getElementById('whyNotRegtxt').value;
						var yn  = document.getElementById('not_registered');
//	alert( 'x' ); 
						
						/*
	  	 		  for( var k=0; k < yn.length; k++) { 
	  	 		  	  if( yn[k].checked) {
	  	 		  	  	    alert('v=' + yn[k].value); 
	  	 		  	  
	  	 		  	  }
	  	 		  }
	  	 		   */ 
	  	 		
	  	 	} else if (d=='2')  {  
	  	 		var o =document.getElementById('provision'); if(o.value == ''){o.focus(); alert( 'Select Ballot type'); return false;  }
	  	 	
	  	 	
	  	 	
	  	 	} else if (d=='3')  {  //if pass, show ballot nonvoter 
	  	 		                    //Must have some input, page at header2 $novote
	  	 		  var otherVal = document.getElementById('f16').value; 
	  	 		  var nc=0;
	  	 		  if( otherVal != ''){
	  	 		  	  nc=1; 
	  	 		  } else { 
			  	      var inobj  = (document.getElementById('novoteContainer')).getElementsByTagName('input');  
		   	      	var nc = 0; 
		   	      	 
			  	      for(var k=0; k<inobj.length; k++) {  
			  	      		if ( inobj[k].checked ){
			  	      				nc = 1; 
			  	      		}
			  	      }
	  	 		  }
	  	 		
						if(nc==0) { 
	  	      	 alert('You must select at least one item or enter Other Reason'); 
	  	      	 return false; 
						}
	  	 	
	  	 	} else if (d=='4')  { //ballot nonVoter 
	  	      var inobj  = (document.getElementById('reasonContainer')).getElementsByTagName('input');  
	  	      var cnt = new Object(); 
	  	      var xname = new Object();   
   	      	 
	  	      for(var k=0; k<inobj.length; k++) {  
	  	      		var xn = inobj[k].name; 
	  	      		xname[xn] = 1; 
	  	      		nChoices += 1; 
	  	      		if ( inobj[k].checked ){
	  	      				cnt[xn] = 1; 
	  	      		}
	  	      }
	  	      var nChoices = countKeys(xname); 
	  	      var found = 0; 
	  	      for( var xn in xname ) { 
							   //alert( xn+' ' + xname[xn] ); 
							   if( cnt[xn]){
							   	  found += 1;  
							   }
						}
						if(nChoices > found) { 
	  	      	 if ( confirm ('You have not completed the ballot !  Continue anyway? ')){
	  	      	 	   
	  	      	 } else {
	  	      	 	  return false; 
	  	      	 }
						}
	  	 		   
	  	 	} else if (d=='99')  { //confirm questionnaire, another script for voter
              //var o = document.getElementById('age'); 
              //if( o && ( isNaN(o.value) || o.value=='' ) ) { alert('Age must be a number'); o.focus(); return false; }

	   	 		   
	  	 	}
	  	 	
	  	  document.ff.submit(); 
	  	  
	  }
	  
	  
    hideMenu();
	function imgRedirect(){

	 		if( logoLink &&  logoLink=='1'){ location.href = 'index.php';}

	}	  
	  
	  	</script>
 
</table> </body> </html> 

 



