<?php session_start();
error_reporting(E_ALL); 
  $host = $_SERVER['HTTP_HOST'];
  
 if( $_SERVER['REMOTE_ADDR'] == '72.214.70.71') { //test server
 	   include "../setDB.php"; 
 }  
$currentDB = mysqli_connect(getenv('DBHOST'),getenv('DBUSER'),getenv('DBPASS'),getenv('DBDATABASE'));


	if( isset( $_POST['password'] )   &&  isset($_POST['username'])    ){ 
		$userAuthorized=false;
		$username = $_POST['username']; 
		$password = md5($_POST['password']); 
		$sql = " SELECT * FROM mgt_users
				WHERE  username = '" . $username. "'
				AND password = '" . $password. "'" ; 

 

		$get = mysqli_query( $currentDB, $sql );
		while ( $row = mysqli_fetch_array($get) ) { 
			$userId = $row['id']; 
			$first = $row['firstname'];
			$last  = $row['lastname'];
			$userLevel  = $row['userLevel'];
			$userAuthorized=true;
		}

/*
$myFile = "out.htm";
$fh = fopen($myFile, 'a') or die("can't open file");
fwrite($fh, '<br>checkLogin sql='.$sql );
fclose($fh);
*/ 


		if( $userAuthorized) { 
			$_SESSION['userid'] = $userId; 
			$_SESSION['username'] =  $username; 
			$_SESSION['userLevel'] =  $userLevel;  
			$_SESSION['authorized'] ="YES";
			$_SESSION['userGivenName'] = $first.' ' . $last;
			$_SESSION['loggedout']=""; 

//die( 'username='. $_SESSION['username']);
 /*
 		    if(  !empty($_SESSION['root_redirect_url'] )  ) {
		    	header("location:" . $_SESSION['root_redirect_url'] );
		    
		    } else { 
				  header( "location:index.php"); 
			  }
 */   			  
			  
			header( "location:index.php");
			
		} else { 
				$_SESSION['notlogged'] = "<span style='color:red;'> Login failed, try again.</span>"; 
					header("location:login.php" ); 
		}
	}	
		
 
?> 



