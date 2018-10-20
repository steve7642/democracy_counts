<?php 
// listSuperEmails.php
     
    include "header.php"; 	//no output above. 

		//delete action
		if( !empty( $_POST['deleteId'])){
			$id = $_POST['deleteId'];
			$sql = "delete from generic_list where id = ".$id; 
			mysqli_query( $currentDB, $sql );
		}
 
		$post = $_POST; 

?> 

<?php  include 'header2.php'; ?>		
		
		<table> 
		<?php      include "menu.php"; 
		    
		    echo "<td style='padding-top:20px; padding-left:20px; ' >
		             <strong>  Supervisor Email List </strong>   "; 
		               
		               
		    $out = "<form method=post name=ff > 
		           <table><tr style='background-color:lightblue'> <td> Domain <td> Delete ";
				$sql = " SELECT id,f1,f2 FROM generic_list where listType='superemail' "; 
				$get = mysqli_query( $currentDB, $sql );
				while ( $row = mysqli_fetch_array($get) ) { 
					$xid = $row['id']; 
					$domain = $row['f1'];
					
					$out .= "<tr><td>". $domain;
					
					$out .= "<td><a  href='javascript:xdelete(".$xid."); '> delete </a> "; 
				
			}

			$out .= "		<input type=hidden name=deleteId id=deleteId> 
                             </table></form> "; 
			echo $out; 
		?>
		
	  </table>
	  <script> 
	  	function xmit(){ 
	  		 
	  		document.ff.submit(); 
	  		
	  	}
	  	function xdelete(o){ 
	  		 
	  		 if( confirm('Are you sure you want to delete ')) {  
	  		 		document.getElementById('deleteId').value = '' + o; 
		  			document.ff.submit(); 
		  		
		  	 }
	  		
	  	}
	  	
	  </script>
</table> </body> </html> 