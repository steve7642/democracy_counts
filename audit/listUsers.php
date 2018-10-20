<?php 
     
    include "header.php"; 	//no output above. 

		//delete action
		if( !empty( $_POST['deleteId'])){
			$id = $_POST['deleteId'];
			$sql = "delete from mgt_users where id = ".$id; 
//echo 'sql='.$sql; 

			mysqli_query( $currentDB, $sql );
		}
 
		$post = $_POST; 
		if( is_array($post) ){ 
			while( list($xname, $value) = each( $post ) ){

				$pos = strpos($xname,'pass_');
	 		
				$value = str_replace("'","''",$value);  
				$value = str_replace("\r","",$value); 
				$value = str_replace("\n","",$value); 
				
					 if( is_numeric($pos)  && !empty($value)  ){ 
							$uid = substr($xname,5);
							$val = md5($value); 
							$sql = "update mgt_users set password ='". $val.
							       "' where id = ".$uid; 
//echo '<br>sql='.$sql .' uid='.$uid; 							 
							mysqli_query( $currentDB, $sql );
			     }
		     
			     				
			}}
 

	
//  http://coa520.com/audit/listUsers.php     
// super / auditadmin
  
?> 

<?php  include 'header2.php'; ?>		
		
		<table> 
		<?php      include "menu.php"; 
		    
		    echo "<td style='padding-top:20px; padding-left:20px; ' >
		               USERS  &nbsp; <input type=button value='Submit password changes' onclick='xmit();'> "; 
		               
		               
		    $out = "<form method=post name=ff > 
		           <table><tr style='background-color:lightblue'> <td> Name <td> Username <td> Reset Pass <td>Type  <td> Delete ";
				$sql = " SELECT * FROM mgt_users "; 
				$get = mysqli_query( $currentDB, $sql );
				while ( $row = mysqli_fetch_array($get) ) { 
					$userId = $row['id']; 
					$first = $row['firstname'];
					$last  = $row['lastname'];
					$username  = $row['username'];
					$userLevel  = $row['userLevel'];
					if($userLevel==0){ 
						$utype = 'supervisor';
					}
					if($userLevel==1){ 
						$utype = 'auditor';
					}
					if($userLevel==2){ 
						$utype = 'master';
					}
					
					$out .= "<tr><td>". $last.", ". $first. "<td>". $username. "<td><input size=10 name=pass_" .$userId." >  
					                       <td> ".$utype. "<td> "   ;
					
					if (   $username != 'master' ){ 
						  $out .= "<a  href='javascript:xdelete(".$userId."); '> delete </a> "; 
					}
				
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