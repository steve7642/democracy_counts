<?php // https://coa520.com/audit/tallyrun.php   
include "header.php"; 	
?> 

<?php  include 'header2.php';   
		$offices = array(); 
		$sql = " SELECT id,f1  FROM generic_list where listType='offices' order by id  "; 
		$get = mysqli_query( $currentDB, $sql );
		while ( $row = mysqli_fetch_array($get) ) { 
				$offices[ $row['id']] = $row['f1'] ;
		}
//$tab		 
		if( empty( $_POST['rtype'])    ) {  // writer ccurrent tally report html to database .. 
// SELECT f1,f2,f3 p from generic_list where listType='votes'
				$sql = "SELECT f1,f2,f3, count(*) cnt from generic_list2 where listType='votes' group by f1, f2, f3 ";
				$rawCnt = array(); 
				$get = mysqli_query( $currentDB, $sql );
				while ( $row = mysqli_fetch_array($get) ) { 
					$rawCnt [$row['f3']] [$row['f1']]  [$row['f2']]   = $row['cnt']; 
				}
				
				$ptotal = array(); 
				while( list($p, $a) = each( $rawCnt ) ){
					while( list($id1, $aa) = each( $a ) ){
						while( list($id2, $cnt) = each( $aa ) ){
						   if( empty($ptotal[$id1][$id2])){
						   	  $ptotal[$id1][$id2]  = $cnt; 
						   } else {
						   	  $ptotal[$id1][$id2]  += $cnt; 
						   }
						 }  
					}
				}
				
				$tab = "<table>";
				reset($rawCnt); 
				
				$xfile='"Precinct","Office","Candidate","Votes"' ."\r\n";
				//writeFile($xfile, 'tally.csv', 'w');
				$xfile=""; 
				
				while( list($p, $a) = each( $rawCnt ) ){
					$tab .= "<tr style='background-color:lightgrey;' ><td colspan=3>Precinct=" .$p; 
					 
					while( list($id1, $aa) = each( $a ) ){
						$tab .= "<tr><td colspan=3>"   .$offices[ $id1] ;
						
						while( list($id2, $cnt) = each( $aa ) ){
						   $tab .= "<tr><td> &nbsp; &nbsp; <td> ". $officer_names [$id1] [$id2] ."<td>". $cnt;
						  
						   $xfile .= '"' .$p. '","'. $offices[ $id1] .'","'. 
						             $officer_names [$id1] [$id2] . '","'. $cnt. '"' ."\r\n"; 
						}  
					}
				}
			
				$tab .= "<tr><td colspan=3 style='background-color:lightgrey;' >All Precincts ";
				while( list($id1, $a) = each( $ptotal ) ){
					$tab .= "<tr><td colspan=3>".$offices[ $id1];
					while( list($id2, $cnt) = each( $a ) ){
						$tab .= "<tr><td>  &nbsp; &nbsp; <td> "   .$officer_names [$id1] [$id2] ."<td>".$cnt;   
						   $xfile .= '"total","'. $offices[ $id1] .'","'. $officer_names [$id1] [$id2] . '","'. $cnt. '"' ."\r\n"; 
					}
				}
				$tab =  $tab ."</table>"; 
		 
				$xtab = str_replace( "'", "\'", $tab );
				 
				$sql = "insert into generic_list ( listType, area ) values ( 'tallyReport', '".$xtab."')"; 
				mysqli_query( $currentDB, $sql );
			
		}		
			$rtype= $_POST['rtype'];
?>
  <form method=post name=ff > 	
  	<input type=hidden name=firstpass value=''>	
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
					    echo $tab; 	
					}

		?>
	  </table>
	</form>
 
</table> </body> </html> 

 



