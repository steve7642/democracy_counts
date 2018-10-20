<?php 
      // scheduled.php 
// php -q /home3/steve/public_html/audit/runScheduler.php


	$pageAlways ='1'; 
	include "header.php"; 	
?> 


<?php  include 'header2.php'; ?>  
  <form method=post name=ff > 
  	 
		<table><tr>   
		<?php  
		  function getsetSched( $task, $v, $currentDB ){ 
		  	
		  	  //$taskA = array('intake','tally'); 
		  	  
		  	  $sql = "select id, f2 from generic_list where listType='schedTask' and f2 ='".$task."' "; 
		  	  
//		  select id, f1, f2 from generic_list where listType='schedTask' and f2 ='tally'	  
//echo 'sql='.$sql; 		  	  
					$get = mysqli_query( $currentDB, $sql );
					while ( $row = mysqli_fetch_array($get) ) { 
						 $xid  = $row['id']; 
			    }
			    if( empty( $xid )){  //no storage.... 
				    	  $sql = "insert into generic_list ( listType, f2 ) values ('schedTask','".$task."') "; 
				    	  mysqli_query( $currentDB, $sql );
				    	  $newid  = getNewId($currentDB,   $listType );
				    	  
						    $sql = "update generic_list set f2='".$task."', f1='".$v."' where id=".$newid; 
						    mysqli_query( $currentDB, $sql );
				    	  
			    } else { // not empty $xid
						    $sql = "update generic_list set f2='".$task."', f1='".$v."' where id=".$xid; 
						    mysqli_query( $currentDB, $sql );
			    }
					    
			    return 'ok'; 
		  }
		  
 		  $isCheckedtally=''; 
		  if( !empty( $_POST['tally'])){
		  	  $isCheckedtally = 1; 
		  	  getsetSched( 'tally', 1, $currentDB );
		  } else if (   !empty( $_POST['tallyhold']) ){
		  	  $sql = "update generic_list set f1='' where listType='schedTask' and f2='tally'"; 
		  	  mysqli_query( $currentDB, $sql );
		  
		  } else {
		  	 // check db value is checked. . 
		  	 $sql = "select id from generic_list where listtype='schedTask' and f2='tally' and f1='1' "; 
					$get = mysqli_query( $currentDB, $sql );
					while ( $row = mysqli_fetch_array($get) ) { 
						  $isCheckedtally = 1; 
					}
		  	  
		  }
		  
		  
		  
		  if( empty($notLogged)){
		    include "menu.php"; 		  
		   	echo "<td style='padding-top:20px; padding-left:20px; ' > Scheduled tasks, 5 minutes repeat  ";       
		  } 
		    
		?>
		   <input type=hidden name=tallyhold value=1 > 
			 <br><br>  <input type=checkbox <?php echo $selectStyle; ?> name=tally id=tally value=tally onclick='document.ff.submit();'
			       <?php if ( !empty($isCheckedtally) ){
			       	     echo ' checked '; 
			       	  }  
			       ?> 
			   > Tally on checked / off unchecked
			   
			
		</td></tr>
	  </table>
	   
	</form>
 
</table> </body> </html> 

 



