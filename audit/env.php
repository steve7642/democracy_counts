<?php  //environmental vars   
  //  env.php 
 //    $currentDB = mysqli_connect("localhost","steve_520coa","vernon9!","steve_520coa");      
/*
heroku config:set DBHOST=z1ntn1zv0f1qbh8u.cbetxkdyhwsb.us-east-1.rds.amazonaws.com
heroku config:set DBUSER=ew3q4xrnbeu86f64
heroku config:set DBPASS=fvep76tnsyxsz4jh
heroku config:set DBDATABASE=qlpkzcxnpeaqtxl6

mysqli___default_host
mysqli___default_user
mysqli___default_pw
mysqli___default_socket


mysqli_connect(getenv('DBHOST'),getenv('DBUSER'),getenv('DBPASS'),getenv('DBDATABASE'));

mysqli___default_user
putenv("DBHOST=".mysqli___default_user);
 
 https://coa520.com/audit/env.php 
 $_ENV["mysqli___default_port"]
*/ 
   //echo $_ENV["mysqli___default_port"] ;

  // putenv("DBHOST=mysqli___default_host");
   putenv("DBUSER=steve_520coa");
   //putenv("DBPASS=vernon9!");
   //putenv("DBDATABASE=steve_520coa");
   
  phpinfo(INFO_ENVIRONMENT) ;
  //echo $_ENV["DBUSER"];
  $aa = getenv(void ); 
  
  echo 'aa='. getenv("DBUSER" ); 
  
  /*
while( list($k, $v) = each( $aa ) ){
	echo '<br>k='.$k.' v='.$v;
}
  
  */ 
  
  
 
 echo '<br>OK'; 
 
?> 