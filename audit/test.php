<body> 
	
<form method=post name=ff > 
	<input type=button value=go onclick='xmit();' > 
	<br> 
	<input type=checkbox name=xc id=xc value=1>
	<?php 
				if ( !empty( $_POST['xc'])){
					  
					   echo "<script>document.getElementById('xc').checked = true; </script> ";
					
				} 
// coa520.com/audit/test.php 
				
							    $sqlformat = "Y-m-d H:i:s"; 
							  $onehourago = date($sqlformat,( time()-3600));
			
				echo "onehourago=" .$onehourago; 
	echo '<br>sql timestamp='.$timestamp; 
echo '<br> current time=' .date('Y-m-d H:i:s', (time()));
			
				
	?> 
	
	</form> 
 <div id=dd></div> 
<script>
	
	var o = document.getElementById('dd'); 
	
var now = new Date();
//alert( now ); // shows current date/time
	
	var txt = document.createTextNode(now )
	
	o.appendChild(  txt   );
	
	
function xmit(){ 
   document.ff.submit(); 
}



</script> 
<?php 
//setTimeout("xmit();",4000); 
$timestamp = date('Y-m-d G:i:s');

$date = (new \DateTime())->modify('-1 hours');

date("Y-m-d h:i:sa", $d);


//date('Y-m-d H:i:s', time());
?> 

</body> 
