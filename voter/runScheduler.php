<?php 
      
// php -q /home3/steve/public_html/voter/runScheduler.php
/*
/opt/cpanel/ea-php56/root/usr/bin/php /home3/steve/public_html/voter/runScheduler.php

/opt/cpanel/ea-php56/root/usr/bin/php /home/username/public_html/cron.php

php /home3/steve/public_html/voter/runScheduler.php

php/home3/steve/public_html/voter/runScheduler.php

/home3/steve/public_html/voter/testb.php

To create a cron job:

/opt/cpanel/ea-php70/root/usr/bin/php /home3/steve/public_html/voter/runScheduler.php

Command to run a PHP 5.6 cron job:

/opt/cpanel/ea-php56/root/usr/bin/php /home3/steve/public_html/voter/runScheduler.php

Command to run a PHP 5.5 cron job:

/opt/cpanel/ea-php55/root/usr/bin/php /home3/steve/public_html/voter/runScheduler.php


Click Add New Cron Job.
/opt/cpanel/ea-php70/root/usr/bin/php /home3/steve/public_html/voter/runScheduler.php (?) 

php -q /home3/steve/public_html/voter/runScheduler.php  (good 5 minutes ) 


    https://coa520.com/voter/runScheduler.php 
    
    coa520.com/voter/runScheduler.php 
    
    
    // this code works but will is not planned to be used.. scheduled task at server on and off.. 
    
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
//		coa520.com/voter/runScheduler.php 

   include "tally.php";	//voter directory 
		
?> 

