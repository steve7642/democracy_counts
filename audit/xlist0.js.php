 
<?php //find intake auditors in last hour

    $sqlformat = "Y-m-d H:m:s"; 
	  $onehourago = date($sqlformat,( time()-3600));

		$auditorNameJs = "var auditorName = new Array(); \r\n";
		 
		$sql = "select f20, f3 from generic_list where listType = 'voter track' and f10='pending' and lastpdate > '".$onehourago."'";
//echo '<br>sql='.$sql; 
		
		$get = mysqli_query( $currentDB, $sql );
		while ( $row = mysqli_fetch_array($get) ) { 
			 $auditorNameJs .= "auditorName[" .$row['f20'].  "]='". $row['f3']. "';"; 
		}
		
    $submitNodeHtml =   '"' ."<input type=button ".$submitStyle. " value='Vote Now' onclick='done1(1);' >" .'"';
     
    
echo $submitNodeHtml;    
    
		echo "<script>" .$auditorNameJs."
		    function checkan(xn){
		    		if ( auditorName[xn] ){
		    				// add page objects for vote now
		    				var submitHtml = " .$submitNodeHtml. ";
		    				var nameNodeHtml = "Intake by " + auditorName[xn] + "<br><br>";
		    				
		    				return true; 
		    		}
		    		return false; 
		    }
		    function vmit(){
		    		var xn = document.getElementById('transfer_code').value; 
		    		
		    		if ( checkan(xn)){ 
		    				//put objects on page 
		    				alert('test ok');  
		    				var submitHtml =  ''   ; 
		    				  
		    				 
		    		} else { 
		    				alert('Voter code not found, try again');
		    				return false; 
		    		}
		    }
		</script>"; 
		
		// 122
?> 
        
Enter Vote Code: 
<input style=' height:36; width:55px; font-size:26px; ' name=transfer_code id=transfer_code
    onchange = 'vmit();' > 

  
