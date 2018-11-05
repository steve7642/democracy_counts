<?php 
     
    include "header.php"; 	//no output above. 
    
    //isactive checkbox 
		if( !empty( $_POST['isactive'])){
			
			  // clear for new value. ADD PRECINCT LATER. 
		    $sql = " delete from  FROM generic_list where listType='domain_list'   "; 
				mysqli_query( $currentDB, $sql );
				
				$active_id = $_POST['isactive'];
				$sql = "update generic_list set f2='".$active_id."' where id=".$active_id; 
				mysqli_query( $currentDB, $sql );
				
		}  else { // get current value 
			  $sql = " SELECT id,f1,f2  FROM generic_list where listType='domain_list' and f2 !='' and f2 is not null "; 
				$get = mysqli_query( $currentDB, $sql );
				while ( $row = mysqli_fetch_array($get) ) { 
					  $active_id = $row['id']; //same as id..
				}

		}
		 

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
		             <strong>  DOMAINS </strong>   "; 
		               
		               
		    $out = "<form method=post name=ff > 
		           <table><tr style='background-color:lightblue'> <td> Domain <td> Active  <td> Delete ";
				$sql = " SELECT id,f1,f2  FROM generic_list where listType='domain_list' "; 
				$get = mysqli_query( $currentDB, $sql );
				while ( $row = mysqli_fetch_array($get) ) { 
					$xid = $row['id']; 
					$domain = $row['f1'];
					$isactive = $row['f2'];  
					
					$out .= "<tr><td>". $domain;
					
					$out .= "<td><input type=radio onclick='document.ff.submit();' 
					                  name=isactive id=isactive".$xid." value=".$xid.">"; 
					if( !empty($active_id) && $active_id == $xid ) {
							$out .="<script> document.getElementById( 'isactive".$active_id."').checked=true;</script> "; 
					}
					
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