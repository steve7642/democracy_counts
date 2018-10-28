<?php 
include "header.php"; 	
$sql = " select id, f1 from generic_list where listType='precinct' and f2='" .$xmachine. "'"; 

	$get = mysqli_query( $currentDB, $sql );
	while ( $row = mysqli_fetch_array($get) ) { 
		$xid = $row['id']; 
		$precinct = $row['f1']; 
	}
	
	//get voters have not voted for X minutes. 
	
?> 

<?php  include 'header2.php'; ?>  
  <form method=post name=ff > 		
		<table><tr>   
		<?php  
		    include "menu.php"; 
		   
		    echo "<td style='padding-top:20px; padding-left:20px; ' >
		                  &nbsp; <input type=button value='Update' onclick='xmit();'> "; 
		               
		    $out = "<form method=post name=ff > 
		           <table>
		               <tr><td>Precinct  Code:  " .$precinct ; 
		    
				$out .= "</table></form> "; 
				
				      
				echo $out; 
		     

		?>
	  </table>
	</form>
 	  <script> 
	  	function xmit(){ 
	  		document.ff.submit(); 
	  	}
	  	
	  </script>

</table> </body> </html> 

 



