<?php 
  // https://coa520.com/audit/test1.php?v=1

  include "header.php"; 	 //=> $xmachine, $precinctId, $precinct, $auditname, $domain


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


  
	if( isset( $_GET['v']	) ){
		$xvote = $_GET['v']	;	 
	}


      include "header2test.php"; 
      
      include "xlist.php";  // computer list for anonymouse voters available. 
      
?>
<form method=post name=ff id=ff>   
		<input type=hidden name=flag1 id=flag1 
		  value="<?php $flag =  $_POST['flag1']; echo $flag; ?>"	 >
		<input type=hidden  name=trackId id=trackId  
		  value="<?php $trackId = $_POST['trackId']; echo $trackId; ?>"	 > 

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
		  
	    include "menu.php"; 
	     
	    echo "<td style='padding-top:20px; padding-left:20px;  ' > ";
		    

  if( empty( $flag )  && empty($xvote) ){  //Intake
		echo $out0; //from header2 
	
	} else {  //voting sequence 

echo 'Trackid='. $trackId. ' flag='.$flag.'<br>'; 
					
				if ( empty($flag)) {
					echo $xlist; 
					
				} else if ( $flag=='1'){
					echo  $outProvisional; 
					
				} else if ( $flag=='2'  && $_POST['provision'] == 'provisional'  ){
					echo $outReason;  
					
				} else if ( $flag=='2'){
					echo $ballot;
					
				} else if ( $flag=='3'){
					echo $afterVote; 
					
				} else if ( $flag=='4'){
					
				} else if ( $flag=='99'){
					 echo 'All done!'; 
					
				}
	
		
	}


echo "<br>OK"; 
?> 

<script> 
	function done1(d){
	  //alert( 'd='+d ); 
	  document.getElementById('flag1').value= ''+d;  
	  //page validation done by case on d
	  	  
	  
	  ////////////////////////////
	  document.ff.submit();
	}

	function notpending(o){
         document.getElementById('trackId').value = o.value ;   
         document.getElementById('flag1').value ='1' ;   
         document.location='test1.php?v=1';
         document.ff.submit(); 
		
	}
</script>




</form></body></html> 


