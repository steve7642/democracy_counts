<?php 

include "header.php"; 

		$page = 'candidates'; 
		
		if( !empty( $_POST['addc'] )){
			  //echo 'add action'; 
							$sql = "insert into generic_list(listType) value ('offices') ";             
							mysqli_query( $currentDB, $sql );         
		}
		
		if( !empty( $_POST['addname'] )){
			        $parentId = $_POST['addname'];
							$sql = "insert into generic_list(listType, f2) 
							values ('officer_names', '".$parentId."') ";             
							mysqli_query( $currentDB, $sql );         
		}
		
		if( !empty( $_POST['deletec'] )){
			  //echo 'delete action'; 
							$sql = "delete from generic_list where id=". $_POST['deletec'] ;             
							mysqli_query( $currentDB, $sql );         
		}
		if( !empty( $_POST['udpatec'] )){
			  //echo 'update action'; 
				$post = $_POST; 
				if( is_array($post) ){ 
					while( list($xname, $value) = each( $post ) ){
						$pos = strpos($xname,'c_');
						$value = str_replace("'","''",$value);$value = str_replace("\r","",$value); $value = str_replace("\n","",$value); 
						if( is_numeric($pos)  && !empty($value)  ){ 
							$uid = substr($xname,2);
							$sql = "update generic_list set f1='" .$value. "' where id=" .$uid; 
							mysqli_query( $currentDB, $sql );     
						}
						// officer names n_ 
						$pos = strpos($xname,'n_');
					               	$value = str_replace("'","''",$value);$value = str_replace("\r","",$value); $value = str_replace("\n","",$value); 
						if( is_numeric($pos)  && !empty($value)  ){ 
							$uid = substr($xname,2);
							$sql = "update generic_list set f1='" .$value. "' where id=" .$uid; 
							mysqli_query( $currentDB, $sql );     
						}
					}
				}    
		}
		
		//read action 
		$offices = array(); 
		$sql = " SELECT id,f1  FROM generic_list where listType='offices' order by id  "; 
		$get = mysqli_query( $currentDB, $sql );
		while ( $row = mysqli_fetch_array($get) ) { 
				$offices[ $row['id']] = $row['f1'] ;
		}
 
?> 

<?php  include 'header2.php'; ?>		
		
		<table> <form method=post name=ff > 
		<?php      include "menu.php"; 
		    
		    $out =  "<td style='padding-top:20px; padding-left:20px; ' >  
		                    <input type=hidden name=addc id=addc > 
		                    <input type=hidden name=deletec id=deletec > 
		                    <input type=hidden name=udpatec id=updatec > 
		                    <input type=hidden name=addname id=addname > 
		         <div style='color:red;'> 
		                       Do not change this page after the start of the audit, else data will be lost! </div>             
		                  &nbsp; <input type=button value='Add Candidate type ' onclick='xmit();'> 
		                  &nbsp; <input type=button value='Add Office' onclick='xmit();'> 
		                  &nbsp; <input type=button value='Update Page' onclick='xmitp();'> 
		                  "; 
		               
		    $out .= " <table>   "; 
		    
				$officerNames = array(); 
				reset($offices); 
				   
				while( list($idx, $v) = each( $offices ) ){
					$out .= "<tr><td><input name=c_".$idx." value='". $v. "'>
					             <td> 
					             <a href='javascript:addNames(".$idx." );'>Add Names</a>  
					             <a href='javascript:xdelete(".$idx." );'>delete</a>  "; 
					             
					$sql = "select id, f1 from generic_list where 
					    listType='officer_names' and f2='".$idx."'";          
					$get = mysqli_query( $currentDB, $sql );
					while ( $row = mysqli_fetch_array($get) ) { 
							$idname = $row['id']; 
							$out .= "<tr><td colspan=2 style='padding-left:15px; ' > 
							          <input name=n_".$idname. " value='". $row['f1']. "'>"; 
					}
				}
		           

			$out .= "</table></form> "; 
			echo $out; 
		?>
	  </table>
	  <script> 
	  	function addNames(id){ 
	  		document.ff.addname.value = ''+id; 
	  		document.ff.submit(); 
	  	}
	  	function xmit(){ 
	  		//if( document.ff.f5.value == '' ) { alert( "Enter f5"); return; }
		  		document.ff.addc.value = '1';
  				document.ff.submit(); 
	  	}
	  	function xdelete(id){ 
	  		document.ff.deletec.value = ''+id; 
	  		document.ff.submit(); 
	  	}
	  	function xmitp(){ 
	  		document.ff.udpatec.value = '1';  
	  		document.ff.submit(); 
	  	}
	  	
	  </script>
</table> </body> </html> 

 