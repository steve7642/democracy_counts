<?php 
		           /*
				unregister.php  
			     */ 


include "header.php"; 

//find all devices. 


	

?> 

<?php  include 'header2.php'; ?>		
		
		<table> 
		<?php      include "menu.php"; 
		    
		    echo "<td style='padding-top:20px; padding-left:20px; ' >
		                  &nbsp;  "; 

		    $out = "<form method=post name=ff > 
		           <table><tr><td>  <strong>Precinct=</strong>".$precinct. "  "; 
/*
listType = precinct 
f1 = precinct
f2 = xname
f3 = auditor name 
*/ 		    

				if( isset( $_POST ) && is_array($_POST['m_'])) { 
					
					if( !empty( $_POST['m_'] )){ 
						$m_ = $_POST['m_'];
					} 
								 
					while( list($key, $value) = each( $_POST ) ){
	//echo '<br>key='.$key.'<br>'; 
							$pos = strpos($key,'m_'); 
	//echo '<br>precint recid='.$value; 						
								while( list($ckey, $cvalue) = each( $value ) ){
									//echo '<br> precinct rec id=' . $cvalue; 
									/*	
							    $sql = " select  id, f1, f2, f3 from generic_list where listType ='precinct' and f2='".$cvalue."'";
									$get = mysqli_query( $currentDB, $sql );
									while ( $row = mysqli_fetch_array($get) ) { 
										              echo '<br>='.$row['f3'];
								  } 
								  */ 
							    $sql = " delete from generic_list where listType ='precinct' and f2='".$cvalue."'";
//echo '<br>sql='.$sql; 							    
							    mysqli_query( $currentDB, $sql );
						   } 	
						   
				    }
				     
		  }
		  
		  //echo '<br>sql='.$sql; 
		   
		    $widg = "<table><tr style='background-color:lightblue;'>
		               <td> Select devices to unregister "; 
		               
		    $sql = " select  id, f1, f2, f3 from generic_list where listType ='precinct' and f1='".$precinct."'";
				$get = mysqli_query( $currentDB, $sql );
				while ( $row = mysqli_fetch_array($get) ) { 
						$xid = $row['id']; 
						$machine = $row['f2']; 
						
						 $widg .= "<tr> <td> <input " .$selectStyle. " type=checkbox name=m_[] id=m_".$machine." value='".$machine."'> ".$row['f3'];   
				}
 
	    if( !empty( $m_ ) )  { 
				while( list($key, $value) = each( $m_ ) ){ 
					$widg .= "<script>var xNode = document.getElementById('m_" . $machine ."'); 
					           xNode.checked=true;</script>"; 
	        }
	    } 
 
		    
		    

			$out .= $widg. "<tr><td><input ".$submitStyle." type=button value='Unregister' onclick='xmit();'>";
			$out .="</table></form> "; 
			echo $out; 
		?>
	  </table>
	  <script> 
	  	function xmit(){ 
	  		//if( document.ff.userLevel.value == '' ) { alert( "Choose User Type"); return; }
	  		
	  		document.ff.submit(); 
	  	}
	  	
	  </script>
</table> </body> </html> 

 