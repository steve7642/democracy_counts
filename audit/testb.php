<?php 
/*HANDLE CHECKBOXES  coa520.com/audit/testb.php     */
$extq = array(); 
$extWidg = array(); 
$convertq = array("The lines are too long, I cannot wait",
                  "I was told by a poll official that I didn't have the right ID so I wasn't allowed to vote."); 
$questions=''; 
while( list($k, $v) = each( $convertq ) ){
	  $questions .= "<input type=checkbox name=nonV_reason[] id=nonV_reason_".$k." value=".$k.">".$v; 
}

/*
	<input type=checkbox name=nonV_reason[] id=nonV_reason_1 value='1'>one
	<input type=checkbox name=nonV_reason[] id=nonV_reason_2 value='2'>two
*/

$extq[1] = "Did you know the person who told you this? <br>"; 

$extWidg[1] ="&nbsp; &nbsp; <input type=radio name=ext0   value='Yes' > Yes <br>
              &nbsp; &nbsp; <input type=radio name=ext0   value='No' > No <br>   ";


if( isset( $_POST ) ) { 
	$dval = serialize($_POST['nonV_reason'] );
	// listType='nonvoter'  
  echo ' <br>'.$dval.'<br>'; 
  
	if( !empty( $_POST['nonV_reason'] )){ 
		$nonV_reason = $_POST['nonV_reason'];
		while( list($key, $value) = each( $_POST['nonV_reason']  ) ){
			echo '<br>k='.$key.' v='.$value;
			
			
			
		}
	} 
echo '<br>********'; 
	
	while( list($key, $value) = each( $_POST ) ){
		echo '<br>key='.$key.'<br>'; 
		$pos = strpos($key,'cboxName_'); 
		
		if( is_numeric($pos) ){ 
			$pos = strpos( $key, '_' ); 
			$attrId = substr( $key, $pos+1, strlen($key)-$pos ); 
			while( list($ckey, $cvalue) = each( $value ) ){
				echo '<br>For DB insert:  value='.$cvalue. '   attrId=' . $attrId; 	
			} 
		} 
	} 	
} 


?>
<form method=post name=ff >
	 
	<input type=checkbox name=nonV_reason[] id=nonV_reason_1 value='1'>one
	<br> <input type=checkbox name=nonV_reason[] id=nonV_reason_2 value='2'>two
	<?php 
	    if( !empty( $nonV_reason ) )  { 
			while( list($key, $value) = each( $nonV_reason ) ){ 
				echo "<script>var xNode = document.getElementById('nonV_reason_" . $value ."'); 
				           xNode.checked=true;</script>"; 
	        }
	    } 
	?> 
  <br> <input name=other id=other>Other-use format. 
    <input type=hidden name=flag1 id=flag1 > 
    
	<br><input type=button value=submit onclick='done1(7);'>
</form>
<script>
	function done1(n){ 
		  document.getElementById('flag1').value= ''+n;  
			if( n== 7){
				 // one check box or other to pass. 
				  var boxesEL = document.getElementsByName("nonV_reason[]"); 
				 
				  for(var x=0; x < boxesEL.length; x++){
				  	if( boxesEL[x].checked) { 
					     alert( boxesEL[x].value );
					   }
					}
				   
				 
			} else if( n==8){
				
				
			}
			document.ff.submit(); 
		
	}
</script>