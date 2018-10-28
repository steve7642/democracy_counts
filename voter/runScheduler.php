<?php 
      
// php -q /home3/steve/public_html/voter/runScheduler.php


/*

    
    
    // will not use this code.........to much trouble....................
    
    listType='schedTask'
    $currentDB = mysqli_connect("localhost","steve_520coa","vernon9!","steve_520coa");      
		$sql = "select id, f1,  f2 from generic_list where listType='schedTask'"; 
		$getz = mysqli_query( $currentDB, $sql );
		while ( $rowz = mysqli_fetch_array($getz) ) { 
			 $xid  = $rowz['id']; 
			 $task  = $rowz['f2']; 
			 $dotask  = $rowz['f1']; 
	     if( !empty($dotask)){
	    	  include $task.".php";
	     }
    }
    
*/ 
//		coa520.com/voter/runScheduler.php for test.....

   include "tally.php";	//voter directory 
		
?> 

