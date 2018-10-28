<?php 
      
// php -q /home3/steve/public_html/voter/runScheduler.php
   $currentDB = mysqli_connect("localhost","steve_520coa","vernon9!","steve_520coa");      
		
		$sql = "select id, f2 from generic_list where listType='schedTask'"; 
		$get = mysqli_query( $currentDB, $sql );
		while ( $row = mysqli_fetch_array($get) ) { 
			 $xid  = $row['id']; 
			 $task  = $row['f2']; 
    }
    //if( !empty($task)){
    	  //include "tally.php"
    	  $sql = "insert into generic_list ( listtype ) values ( 'testSched') "; 
    	  mysqli_query( $currentDB, $sql );
   //}
		
		
?> 

