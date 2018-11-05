<?php 
	$pageAlways ='1'; 
	include "header.php"; 	
?> 

<?php  include 'header2.php'; ?>  
  <form method=post name=ff > 
  	<?php 
  	  //require pass= qhomep to access home page. 
  	  /*
  	  if ( $_SESSION['userLevel'] == 1 ) {
  	  	if( empty( $_POST['sendpass'])  || $_POST['sendpass'] != 'qhomep'  ){
  	  		echo "Home page password = <input type=password name=sendpass " .$inputStyle." id=sendpass > 
  	  		      <input ".$submitStyle." type=button value=Submit onclick='document.ff.submit();'> ";
  	  		      $notLogged=1; 
  	  	}
  	  }
  	  */
  	?> 		
		<table><tr>   
		<?php  
 		  // coa520.com/voter/export1.php   
		   	echo "<td style='padding-top:20px; padding-left:20px; ' > Export domain and precincts ";  
		   	
		   	$sql = "select listtype,lastpdate,f1 from generic_list where listtype='domain_list' or listtype='precinct_list'"; 
				//	$sql = "select id, f1, f2 from generic_list where listType='random out' and f1='" .$code."'"; 
					$get = mysqli_query( $currentDB, $sql );
					$trackId =''; 
					while ( $row = mysqli_fetch_array($get) ) { 
						$f1 = $row['f1']; 
						$listType = $row['listtype']; 
						
						echo "<br>insert into generic_list( f1, listtype ) values ('".$f1."','".$listType."');";  
						
					}
		   	
		   	
		   	     
		?>
	  </table>
	</form>
 
</table> </body> </html> 

 



