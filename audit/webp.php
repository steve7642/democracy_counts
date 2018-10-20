<?php // no output above 
/*
http://coa520.com/audit/webp.php 

$get = mysql_query( $sql, $currentDB );
while ( $row = mysql_fetch_array($get) ) { 

}

while( list($sym, $sym  ) = each( $symA ) ){

}
*/ 

?> 
<style>
div.ex1 {
    overflow: scroll;
}
  td {
    border: 1px solid black;
}
</style> 

 
<?php
   $currentDB = mysql_connect('localhost','steve_520coa','vernon9!');
   $conn = mysql_select_db('steve_520coa',  $currentDB ); 
   
/*
      
*/
 
 
echo $tab. "<br>OK webp"; 

?>
	<script>
		document.loginForm.username.focus(); 
		function resetPassword(){ 
			parentNode.appendChild(childNode); 
			
		}
		function resetp(){ 
			var e = document.getElementById('reset_email'); 
			var ev = e.value; 
			ev = ev.toUpperCase(); 
			if(ev==''){ alert('Enter your email address in the input block provided'); return; } 
			
			if( !(ev in jsemail)  ) { // not allowed 
				alert('Email you entered is not registered with Merco, try again'); return; 
			}
			document.loginForm.action = ""; 
			document.loginForm.submit(); 
		}
		var parentNode = document.getElementById('resetblock'); 
		var childNode = document.getElementById('emailreset'); 
		parentNode.removeChild(childNode); 
		
	</script>
	
