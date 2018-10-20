<!DOCTYPE html>
<html> 
<head> 
	<style> 
		 td { font-family:arial; font-size:26px; }
		 div { font-family:arial; font-size:26px; }
		 body { font-family:arial; font-size:26px; }
	</style>
</head> 
<body> 
	<?php
     echo ' <a href="index.php"><img width="600px;" align=left src="../audit/votingLogo.png"   ></a> ';	   
	?> 
<map name="logomap">
  <area shape="circle" coords="426,46,10" href="index.php" alt="Logo">
</map>	
	
	
	
	
<table cellpadding=0 cellspacing=0 align=center style='background-color:white; width:95%;'>
<tr><td style="height:85px;padding-left:0px;" >  
	
<?php  







			if( is_array( $offices)) {    
				
				
 
	 		  $ballot = " <strong> BALLOT </strong> ";
 
 
 
 
 
 



			  $tab ='<input type=hidden name=hvote value=1> 
			  <table>'; 
			  
				while( list($xid, $vname) = each( $offices ) ){
						$tab .= "<tr><td colspan=2> &nbsp; <tr><td colspan=2>".$vname; 
						while( list($cid, $name) = each( $officer_names[$xid] ) ){
							 $tab .= "<tr><td> &nbsp; &nbsp; <td> <tr><td> &nbsp; &nbsp; <td> 
							   <input ".$selectStyle." type=radio value=".$cid." name=v_".$xid.">".$name; 
						}
				}
				$ballot .= $tab. "</table><br><br><input " .$submitStyle." type=button value=VOTE 
				        onclick='done1(4); '> "; 
				
			}
 
  
?> 