<?php 
	$pageAlways ='1'; 
	include "header.php"; 	
?> 

<?php  include 'header2.php'; ?>  
  <form method=post name=ff > 
  	<?php 
  	
  	  $sql = "delete from generic_list2 where listType='votes'; "; 
			mysqli_query( $currentDB, $sql );
  	  $sql = "delete from generic_list where listType='voterdemog';"; 
			mysqli_query( $currentDB, $sql );
  	  $sql = "delete from generic_list where listType='voter track'; "; 
			mysqli_query( $currentDB, $sql );
  	  $sql = " delete from generic_list where listType='random out'; "; 
			mysqli_query( $currentDB, $sql );
  	  $sql = "delete from generic_list where listType='nonvotes'; "; 
			mysqli_query( $currentDB, $sql );
  	  $sql = "delete from generic_list where listType='nonvoter'; "; 
			mysqli_query( $currentDB, $sql );

  	?> 		
		<table><tr>   
		<?php  
		  if( empty($notLogged)){
		    include "menu.php"; 		  
		   	echo "<td style='padding-top:20px; padding-left:20px; ' > Audit data has been cleared  ";       
		  }     
		?>
	  </table>
	</form>
 
</table> </body> </html> 

 



