<?php // coa520.com/voter/tally.php   
/* 
   this is the scheduled task. .. it creates and saves the HTML produced by the supervisor report program..
   need include file.......................

*/
include "header.php"; 	
?> 

<?php  include 'header2.php';   
		$offices = array(); 
		$sql = " SELECT id,f1  FROM generic_list where listType='offices' order by id  "; 
		$get = mysqli_query( $currentDB, $sql );
		while ( $row = mysqli_fetch_array($get) ) { 
				$offices[ $row['id']] = $row['f1'] ;
		}
 
				// SELECT f1,f2,f3 p from generic_list where listType='votes'
			$sql = "SELECT f1,f2,f3, count(*) cnt from generic_list2 where listType='votes' group by f1, f2, f3 ";
			$rawCnt = array(); 
			$get = mysqli_query( $currentDB, $sql );
			while ( $row = mysqli_fetch_array($get) ) { 
				$rawCnt [$row['f3']] [$row['f1']]  [$row['f2']]   = $row['cnt']; 
			}
			
			// $offices[ $xid] = $row['f1'] ;
			// $officer_names [$xid][$row['id']] =  $row['f1'];
			// get totals for all precincts. 
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
			
			$dq = '"'; 
			//  change ' ->      ".$dq."
			
			while( list($p, $a) = each( $rawCnt ) ){
				$tab .= "<tr style=".$dq."background-color:lightgrey;".$dq." ><td colspan=3>Precinct=" .$p; 
				 
				while( list($id1, $aa) = each( $a ) ){
					$tab .= "<tr><td colspan=3>"   .$offices[ $id1] ;
					
					while( list($id2, $cnt) = each( $aa ) ){
								if( !is_numeric($id2)){
									  $candidateName = $id2; 
								}	else { 
									  $candidateName = $officer_names [$id1] [$id2];
								}
							  $tab .= "<tr><td> &nbsp; &nbsp; <td> ".$candidateName  ."<td>". $cnt;
					}  
				}
			}
		
			$tab .= "<tr><td colspan=3 style=".$dq."background-color:lightgrey;".$dq." >All Precincts ";
			while( list($id1, $a) = each( $ptotal ) ){
				$tab .= "<tr><td colspan=3>".$offices[ $id1];
				while( list($id2, $cnt) = each( $a ) ){
								if( !is_numeric($id2)){
									  $candidateName = $id2; 
								}	else { 
									  $candidateName = $officer_names [$id1] [$id2];
								}
							  $tab .= "<tr><td> &nbsp; &nbsp; <td> ".$candidateName  ."<td>". $cnt;
				}
			}
			//echo $tab ."</table>"; 
			
			$sql = "insert into generic_list ( listType, area ) values ('tallyReport', '". $tab. "</table>')"; 
			mysqli_query( $currentDB, $sql );
			
			//writeFile($xfile, 'tally.csv', 'a');
   	 	//echo "<br><a target=_blank href='https://coa520.com/audit/out_csv/tally.csv' > Tally CSV </a><br><br>"; 
		

 
 
?>
 
</table> </body> </html> 

