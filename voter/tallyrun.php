<?php // coa520.com/voter/tallyrun.php  PUBLIC VIEW   
// all votes public report at precinct???  

include "header.php"; 	
?> 

<?php  include 'header2.php';   
		
			$rtype= $_POST['rtype'];//id of record with html
?>
  <form method=post name=ff > 	
		<table><tr>   
		<?php  
		    //include "menu.php"; 
		    $opts = "<option value=''>  ";
		    $sql = "select lastpdate, id, area from generic_list where listType = 'tallyReport' order by lastpdate desc "; 
				$get = mysqli_query( $currentDB, $sql );
				while ( $row = mysqli_fetch_array($get) ) { 
					 $opts .= "<option value='" .$row['id'] ."'>" . $row['lastpdate']; 
		    }
		    
		   	echo "<td style='padding-top:20px; padding-left:20px; ' > <strong> Choose from Tally Report History </strong> 
 			   <br><select name=rtype  style=' height:36; width:400px; font-size:26px; '   id=rtype onchange='xrpt();'	  > 
 			      " .$opts. "
 			   </select> 
 			       
			   	      <script>
			   	      	function xrpt(o){
			   	      	     document.ff.submit(); 
			   	      	} 
	   	         </script> 
		   	   "; 

					if( !empty($rtype)){
							echo "<script>document.getElementById('rtype').value='" .$rtype. "'; </script>" ;
							// get html and display it....
							$sql = "select area from generic_list where id=" .$rtype; 
							$get = mysqli_query( $currentDB, $sql );
							while ( $row = mysqli_fetch_array($get) ) { 
								 $xhtml = $row['area'];    
					    }
					    echo $xhtml;     
					} else { 
					     
					}

		?>
	  </table>
	</form>
 
</table> </body> </html> 

 



