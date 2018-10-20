<?php //reports.php   
include "header.php"; 	
?> 

<?php  include 'header2.php';   
// update
	if( !empty($_POST['trackid'])) {
		  
		  $sql = "update generic_list set f4='" .time(). "' where id=" .$_POST['trackid']  ; 
		  echo 'sql='.$sql; 
		    
		  mysqli_query( $currentDB, $sql );
	}

?>


  <form method=post name=ff > 	
  	<input type=hidden name=reportType value=''>	
		<table><tr>   
		<?php  
		    include "menu.php"; 
		   	echo "<td style='padding-top:20px; padding-left:20px; ' > 
		   	   <strong>  Renew voting records that have timed out </strong>  "; 
  
		//  in header.............
		//	$sqlformat = "Y-m-d H:m:s"; 
		//	$onehourago = date($sqlformat,( time()-3600));
		  
		  //all voters holding for the precinct. 
		  $sql =  " select * from generic_list where listType='voter track' 
		               and ( f10='pending' ) and f1='".$precinct."'  and lastpdate < '".$onehourago."' order by f1, f20  "; 

 //echo '<br>sql='.$sql; 
	
		  $trackA = array(); 
		  
		  $zlist = "<br><br>Precinct=".$precinct."<table><tr style='background-color:lightblue;' >
		                 <td align=center> Code creation date <td> Voter code <td>Auditor  <td> Restore ";
		                 
		  $get = mysqli_query( $currentDB, $sql );
		  while ( $row = mysqli_fetch_array($get) ) { 
		  		$trackId = $row['id'];  
		  		$precinct = $row['f1']; 
		  		$auditorname = $row['f3'] ; 
		  		$t0 = $row['f4'] ;
		  		$dt = date($sqlformat, $t0);
		  		$transfer_code = $row['f20']; 
		  		
		  		$zlist  .=  "<tr> <td>" .$dt. "<td align=center>" .$transfer_code. "<td>"  .$auditorname. 
		  		                    "<td> <a href='javascript:reverse( ".$trackId. ");'> restore </a> "; 
			}		  		                   
		  echo $zlist ."</table>"; 
		  
		   	
//////////////////////////////////
		?>
	  </table>
	  <input type=hidden name=trackid id=trackid > 
	  
	</form>
  <script>
  	 function reverse(id){
  	 			document.getElementById('trackid').value = id; 
  	 			document.ff.submit();  
  	 	
  	 }
  </script>
</table> </body> </html> 

 



