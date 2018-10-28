<?php 
// https://coa520.com/audit/purgeDB.php 

  $currentDB = mysqli_connect("localhost","steve_520coa","vernon9!","steve_520coa");      
/* 
   $sql = "delete from generic_list2 where listType='votes'"; 
   mysqli_query( $currentDB, $sql );
   
   $sql = "delete from generic_list where listType='voterdemog'"; 
   mysqli_query( $currentDB, $sql );
   
   $sql = "delete from generic_list where listType='voter track'"; 
   mysqli_query( $currentDB, $sql );
   
   $sql = "delete from generic_list where listType='random out'"; 
   mysqli_query( $currentDB, $sql );
   
   $sql = "delete from generic_list where listType='nonvotes'"; 
   mysqli_query( $currentDB, $sql );
   
   $sql = "delete from generic_list where listType='nonvoter'"; 
   mysqli_query( $currentDB, $sql );
*/ 
   
   $sql = "delete from generic_list where listType='tallyReport'"; 
   mysqli_query( $currentDB, $sql );
 
  
//   
   echo 'OK'; 
   

?> 