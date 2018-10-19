<?php 
 if(!isset($_SESSION)){ session_start(); }

// http://coa520.com/audit/checkAuthorized.php 
	/*no previous output allowed*/ 
	/* no blank link before top php tag allowed!*/ 
		$host = $_SERVER['HTTP_HOST'];
		$uriPrefix =   $_SERVER['REQUEST_URI']; 
		$uriRedirect = $httpPrefix. $host . $uriPrefix;
		$loginPage =  $httpPrefix. $host ."/". $realRootPathExt."/login.php";
		
		if(  !isset( $_SESSION['root_redirect_url'] )       ){ 
			
		    $_SESSION['root_redirect_url'] =$uriRedirect; //not used.
			  header("location:".$loginPage   );  
		}
 
		
//  	
?>