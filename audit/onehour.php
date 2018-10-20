<?php //onehour.php 
$sqlformat = "Y-m-d H:m:s"; 
	echo 'date=' . date($sqlformat,time());
	echo '<br>one hour=' . date($sqlformat,( time()-3600));

?> 