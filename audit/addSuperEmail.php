<?php 
		           /*	addSuperEmail.php	*/    
include "header.php"; 	
$ins = '1'; 
   if( !empty( $_POST['domain'] )){
	  //echo 'update action'; 
	  
					$domain = $_POST['domain'];
					//check dupl domain
					$sql = " SELECT * FROM generic_list where listType='superemail' and f1='".$domain."'"; 
					$get = mysqli_query( $currentDB, $sql );
					$ok = ''; 
					while ( $row = mysqli_fetch_array($get) ) { 
						$ok="<span style='color:red;'> domain already in use, try again</span>" ;
					}
					if( empty($ok)  ){ 
						  $ins =''; 
							$sql = "insert into generic_list ( listType, f1 ) values ( 'superemail','"   
							            .$domain. "' )"; 
							              
							mysqli_query( $currentDB, $sql );  
					}
   }

 // domain 
?> 

<?php  include 'header2.php'; ?>		
		
		<table> 
		<?php      include "menu.php"; 
		    
		    echo "<td style='padding-top:20px; padding-left:20px; ' >
		                  &nbsp; <input type=button value='Add domain' onclick='xmit();'> "; 
		    if( empty($ins)  ){  
		    	echo "<br><span style='color:red;' > New domain added </span> "; 
		    }       
		               
		    $out = "<form method=post name=ff > 
		           <table>
		               <tr><td> <input name=domain id=domain> domain"; 
		    
		    if( !empty($ok ) ) { 
		    	  $out .= $ok; 
		    }           

			$out .= "</table></form> "; 
			echo $out; 
		?>
	  </table>
	  <script> 
	  	function xmit(){ 
	  		if( document.ff.domain.value == '' ) { alert( "Enter domain"); return; }
	  		document.ff.submit(); 
	  	}
	  	
	  </script>
</table> </body> </html> 

 