<!DOCTYPE html>
<html> 
<head> 
	<style> 
		 td { font-family:arial; font-size:26px; }
		 div { font-family:arial; font-size:26px; }
		 body { font-family:arial; font-size:26px; }
		 
	input[type=text], select {
    /* width: 100%; */ 
    width: 305px;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    font-size:26px;
    font-family:arial;
}
	 
		 
	</style>
</head> 
<!-- 
                 coa520.com/audit/test1.php
-->
<body> 
<form name=ff method=post>
<table>     
	<?php   //build questions from list and add associated extensions from extension html
	        //  store the whole thing as $allq when $_POST is empty.  
	if( empty( $_POST)   ){  //first entry   
		 
		
	}
	
	
	?>    
	   <tr>  <td><input type=checkbox value=1 name=r1 id=r1 onclick='extend(this,1);'> R1 xx xx xx xx xxx xx xxx xx 
	   	 	   
	              <div id=e1 style='position:absolute; top:-260px; left:5px;'> <input name=e1  > </div> 
	   
	   <tr>  <td><input type=checkbox value=2 name=r2 onclick='extend(this,1);'> R2 xx xx xx xx xxx xx xxx xx 
	   	 	   
</table> 
<script>
	 function extend(o, exit=0){ 
	 	if( exit==0){ 
	 		 alert('exit ok'); 
	 		 
	 	}
	 	  var e = document.getElementById('e'+o.value); 
	 	  var r = document.getElementById('r'+o.value); 
	 	  if( o.checked ) { 
	 	  	
	 	  	  e.style.position = 'relative'; 
	 	  	  e.style.top  = '0px'; 
	 	  	  e.style.left = '40px'; 
	 	  			
	 	  } else { //unchecked remove extension
	 	  	  e.style.position = 'absolute'; 
	 	  	  e.style.top  = '-330px'; 
	 	  	  e.style.left = '0px'; 
	 	  	  
	 	  }
	 	}
</script>
</form></body></html> 


