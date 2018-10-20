<?php 
			session_start();
			$root_redirect_url  = $_SESSION['root_redirect_url'] ;
			
	// http://coa520.com/audit/login.php 
			
 $myFile = "out.htm";
$fh = fopen($myFile, 'a') or die("can't open file");
fwrite($fh, '<br>ENTER login page root_redirect_url=' .$root_redirect_url );
fclose($fh);
 
?>		
  <html>
  <body> 
 
	<table cellpadding=0 cellspacing=0 align=center style='font-family:arial; background-color:white; width:980px;'>
		<tr><td style="height:85px;padding-left:9px; border-bottom-style:solid; border-bottom-width:1px; " ><img align=left 
			                           width="300px;"       src="votingLogo.png">
 		<tr><td class=tdpad>
 			
		<FORM action="checkLogin.php" method="POST" name="loginForm">
		<input type=hidden name=sendinfo > 
		<table width=250 style="margin:10px;" >
			<tr><td>User name  
			<td><input   name="username" value=""><br> 
			<tr><td>Password 
			<td><input  type=password  name="password" value=""><br> 
			<input type=hidden name=yearid value=2013> 	
			<tr><td colspan=2><input type="Submit" value="Login">
				
		</table> 
		</form>
		</table> 
  </body>
</html> 

 