<?php 
		           /*	addPrecincts.php	*/    
include "header.php"; 	
$ins = '1'; 
   if( !empty( $_POST['precinct'] )){
	  //echo 'update action'; 
	  
					$precinct = $_POST['precinct'];
					//check dupl precinct
					$sql = " SELECT * FROM generic_list where listType='precinct_list' and f1='".$precinct."'"; 
					$get = mysql_query( $sql, $currentDB );
					$ok = ''; 
					while ( $row = mysql_fetch_array($get) ) { 
						$ok="<span style='color:red;'> precinct already in use, try again</span>" ;
					}
					if( empty($ok)  ){ 
						  $ins =''; 
							$sql = "insert into generic_list ( listType, f1 ) values ( 'precinct_list','"   
							            .$precinct. "' )"; 
							              
							mysql_query( $sql, $currentDB );  
					}
   }

 // precinct 
?> 

<?php  include 'header2.php'; ?>		
		
		<table> 
		<?php      include "menu.php"; 
		    
		    echo "<td style='padding-top:20px; padding-left:20px; ' >
		                  &nbsp; <input type=button value='Add Precinct' onclick='xmit();'> "; 
		    if( empty($ins)  ){  
		    	echo "<br><span style='color:red;' > New Precinct added </span> "; 
		    }       
		               
		    $out = "<form method=post name=ff > 
		           <table>
		               <tr><td> <input name=precinct id=precinct> Precinct"; 
		    
		    if( !empty($ok ) ) { 
		    	  $out .= $ok; 
		    }           

			$out .= "</table></form> "; 
			echo $out; 
		?>
	  </table>
	  <script> 
	  	function xmit(){ 
	  		if( document.ff.precinct.value == '' ) { alert( "Enter precinct"); return; }
	  		document.ff.submit(); 
	  	}
	  	
	  </script>
</table> </body> </html> 

 