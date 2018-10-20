<?php 
	/// https://coa520.com/voter/index.php  or voterCheck.php 
	include "header.php"; 	
?> 

<?php 
    include 'header2.php'; 
    
    
    if( !empty($_POST['getcode'] )  &&   !empty($_POST['code'] ) ){
    		$code = $_POST['code']; 
					$sql = "select id, f1, f2 from generic_list where listType='random out' and f1='" .$code."'"; 
					$get = mysqli_query( $currentDB, $sql );
					$trackId =''; 
					while ( $row = mysqli_fetch_array($get) ) { 
						$trackId = $row['f2']; 
					}
					
					if( !empty($trackId)){ //number good
							$ballotR = ""; 	
							$sql = "SELECT * from generic_list2 where listType='votes' and f4='".$trackId."' order by id desc ";
							$get = mysqli_query( $currentDB, $sql );
	
	//echo '<br>sql='.$sql; 					
	//5914636		4108079 			
							$xnames = '' ; 
							while ( $row = mysqli_fetch_array($get) ) { 
								     $cid = $row['f2']; 
								     $p = $row['f3']; 
								     $xn = $candidates[$cid]; 
								     $xnames .= "<br> &nbsp; &nbsp; ".$xn;
							}
							
							echo "<br><br>You voted in ".$p."<br><br>Your vote was:" .$xnames; 
								
          } else {
          	  echo " Voter code has no match, try again";  
          }
     }

?> 
  <script>  
  	function getit(){ 
  			document.getElementById('getcode').value='1'; 
  			document.ff.submit(); 
  	}
  </script> 
  <form method=post name=ff > 
 	<table><tr><td>   
 		<input type=hidden name=getcode id=getcode> 
  	<?php 
  	  if ( empty($p)){
 		  	   echo "Enter vote code: <input ".$inputStyle." name=code id=code  size=10 > 
		  	   <input ".$submitStyle." type=button value='Get your Votes' onclick='getit();'> ";
 	  	
  	  }
  	  
  	?> 		
	  </table>
	</form>
 
</table> </body> </html> 
 