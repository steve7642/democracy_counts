<?php 
		           /*		*/    


include "header.php"; 	

$ins = '1'; 
	
if( !empty( $_POST['lastname'] )){
	  //echo 'update action'; 
	  
					$first = $_POST['firstname'];
					$last  = $_POST['lastname'];
					$username  = $_POST['username'];
					$userLevel  = $_POST['userLevel'];
					
					$password = md5($_POST['password']);
	
	//echo 'p='.$password;   
					//check dupl username
					$sql = " SELECT * FROM mgt_users where username='". $username. "'"; 
					$get = mysqli_query( $currentDB, $sql );
					$ok = ''; 
					while ( $row = mysqli_fetch_array($get) ) { 
						$ok="<span style='color:red;'> Username already in use, try again</span>" ;
					}
					if( empty($ok)  ){ 
						  $ins =''; 
							$sql = "insert into mgt_users ( firstname, lastname, username, userLevel, password ) values ( '"   
							            .$first. "','"   
							            .$last. "','"   
							            .$username. "','"   
							            .$userLevel. "','"   
							            .$password. "')" ;  
							              
							mysqli_query( $currentDB, $sql );  
						
					}
	
}

  
?> 

<?php  include 'header2.php'; ?>		
		
		<table> 
		<?php      include "menu.php"; 
		    
		    echo "<td style='padding-top:20px; padding-left:20px; ' >
		                  &nbsp; <input type=button value='Add User' onclick='xmit();'> "; 
		    if( empty($ins)  ){  
		    	echo "<br><span style='color:red;' > New User added </span> "; 
		    }       
		               
		    $out = "<form method=post name=ff > 
		           <table>
		               <tr><td> <input name=lastname id=lastname> Last name
		               <tr><td> <input name=firstname id=firstname> First name
		               <tr><td> <input name=username id=username> User name "; 
		    
		    if( !empty($ok ) ) { 
		    	  $out .= $ok; 
		    }           
		               
		    $out .="
		               <tr><td> <input    name=password id=password> Password 
		               <tr><td> <select name=userLevel id=userLevel > <option value=''> </option> 
		                            <option value=0> Supervisor </option> 
		                            <option value=1> Auditor </option> 
		                            <option value=2> Master administrator </option> 
		                            <option value=3> Incident Reports </option> 
		                            </select> 
		                           User Type
		           
		           "; 
		           

			$out .= "</table></form> "; 
			echo $out; 
		?>
	  </table>
	  <script> 
	  	function xmit(){ 
	  		if( document.ff.lastname.value == '' ) { alert( "Enter last name"); return; }
	  		if( document.ff.firstname.value == '' ) { alert( "Enter first name"); return; }
	  		if( document.ff.username.value == '' ) { alert( "Enter user name"); return; }
	  		if( document.ff.password.value == '' ) { alert( "Enter password"); return; }
	  		if( document.ff.userLevel.value == '' ) { alert( "Choose User Type"); return; }
	  		
	  		document.ff.submit(); 
	  	}
	  	
	  </script>
</table> </body> </html> 

 