<!DOCTYPE html>

<html> 
<style> 
	 td { font-family:arial; font-size:26px; }
	 div { font-family:arial; font-size:26px; }
	 body { font-family:arial; font-size:26px; }
</style>
<body> 

	<?php
	//echo 'userLevel='.$_SESSION['userLevel'];// if empty=>admin role. 
	   if( empty($_SESSION['userLevel']) ||   $_SESSION['userLevel']=='2'      ) { //0,2
	   		//$xlogo = ' <a href="index.php"><img width="600px;" align=left src="votingLogo.png"></a>';
	   } else {
	   	  //$xlogo = ' <img width="600px;" align=left src="votingLogo.png" usemap="#logomap" >';
	   }
 echo ' <a href="index.php"><img width="600px;" align=left src="votingLogo.png"   ></a> ';	   
//k=HTTPS v=on
	   
	   
	?> 
<map name="logomap">
  <area shape="circle" coords="426,46,10" href="index.php" alt="Logo">
</map>	
	 
	
<table cellpadding=0 cellspacing=0 align=center style='background-color:white; width:95%;'>
<tr><td style="height:85px;padding-left:0px;" >  
	<script> 
	  function hideMenu(){
	  	return; /////////////////// remove to hide /////////////////////////////////
	  	
	  	var o = document.getElementById('menu');
	  	 o.style.visibility='hidden';
	  }
		
  </script> 
		<?php 
			if( $userLevel=='0' ) { 
				$bgcolor=' background-color:lightblue; '; 
			} else if ($userLevel=='1' ) { 
				$bgcolor=' background-color:lightgreen; '; 
			} else { 
				$bgcolor=' background-color:lightgrey; '; 
			}
		?> 
		<div 
		style="float:left; color:#008080; font-weight:normal; padding-bottom:8px; padding-right:8px; padding-left:20px; <?php echo $bgcolor;?>"> 
			<?php echo '<br>'. $_SESSION['userGivenName'];?> <br> is logged in 
			    <div id=precinct></div>
			          
								<script>
									  var op = document.getElementById('precinct');
									      op.innerHTML = "<?php echo 'Precinct='.$precinct; ?> ";
									function distanceCenter(lat1,lon1, lat2, lon2){
										/*
										var φ1 = lat1.toRadians(), φ2 = lat2.toRadians(), Δλ = (lon2-lon1).toRadians(), R = 6371e3; // gives d in metres
										var d = Math.acos( Math.sin(φ1)*Math.sin(φ2) + Math.cos(φ1)*Math.cos(φ2) * Math.cos(Δλ) ) * R;
										*/ 
										alert ( 'lat1='+ lat1/57.3 );
										//return ''; 
										
										var phi1 = lat1/57.3, phi2 = lat2/57.3, delta = (lon2-lon1)/57.3, 
										R = 6371e3; // gives d in metres
										var distanceToCenter = Math.acos( Math.sin(phi1)*Math.sin(phi2) + Math.cos(phi1)*Math.cos(phi2) * Math.cos(delta) ) * R;
										
										document.getElementById('dist').innerHTML =  ''+distanceToCenter; 
										
										//return d; 
									}
									
									
								</script>
			          
			           
			<?php
				if( empty( $_SESSION['userGivenName'] )){ 
					echo "<br>Your session has stopped. You must login again. &nbsp;<br> Please <a href='logout-page.php'> CLICK HERE </a>  "; 
				}
			?> 
		</div> 
	<tr>  
		
		
<?php 
// OUTPUT SHARED ON VOTER AND NON VOTER PAGES. /////////////////////////////////////////////////////
		  $outProvisional = "Do you vote with a regular or provisional ballot? <br><br> 
		                  <select ".$dropStyle." name=provision id=provision onchange='done1(1);'><option value=''>Choose
		                     <option value=regular>Regular 
		                     <option value=provisional >Provisional 
		                   </select> 
		           ";
		           
		           
			$provReasons = array(); 
			$provReasons[1] = "Change of address"; 
			$provReasons[2] = "Wrong polling place"; 
			$provReasons[3] = "Incorrect I.D."; 
			$provReasons[4] = "No I.D."; 
			$provReasons[5] = "Mail-in voter, didn't have ballot that was mailed to voter"; 
			$provReasons[6] = "Incorrect party preference stated (primaries only)"; 
			
			$ropts='';  
			while( list($k, $v) = each( $provReasons ) ){
				 $ropts .= "&nbsp; &nbsp; <input ".$selectStyle." type=radio name=prv id=prv" .$k." value='" .$v. "'>" .$v. " <br>"; 
			}

             
		   $out2 = "What reason was given for requiring you to vote with a provisional ballot? <br> <br> "; 
		  
		               // &nbsp; &nbsp; <input ".$selectStyle."type=radio name=prv id=prv1 value='Black skin'>Black skin<br> 
		               // &nbsp; &nbsp; <input ".$selectStyle."type=radio name=prv id=prv2 value='Overweight'>Overweight<br><br>  
		   $out2 .= $ropts;           
		              
		   $out2 .="       <br>       &nbsp;   &nbsp;  Enter other reasons here, if any: <br>
		               &nbsp;   &nbsp;  <input ".$inputStyle." name=pother id=pother > <br><br>
		               <input type=button value=Next ".$submitStyle." onclick='done1(3); '> <br><br>   
		  
		  ";


		  $out5 = "Would you answer a few additional questions? 
		                 <br><br>   &nbsp; &nbsp;  <input ".$selectStyle." type=radio name=queryOption id=queryOption0 value=Yes onclick='extraq(this);'> Yes
		                 <br><br>   &nbsp; &nbsp;  <input ".$selectStyle." type=radio name=queryOption id=queryOption1 value=No onclick='extraq(this);'> No
		                   <script>
		                   		function extraq(o){
		                   				if( o.value=='Yes'){
		                   						document.getElementById('flag1').value='8'; 
		                   						document.ff.submit();     
		                   				
		                   				}
		                   				if( o.value=='No'){//not 
		                   						document.getElementById('flag1').value='99'; 
		                   						document.ff.submit();     
		                   				}
		                   		}
		                   </script> 
		           ";
		   
		   $outQ0 = "<strong>QUESTIONAIRE</strong>
		               <table> 
		                <tr><td>What is your age? 
		                    <td><input ".$inputStyle." name=age id=age >
		                <tr><td>What is your gender? 
		                    <td><select  ".$dropStyle." name=gender id=gender > 
		                            <option value='male'>Male
		                            <option value='female'>Female
		                            <option value=other> Other
		                          </select> 
		                
		                <tr><td> What is your race?  
		                    <td> <select ".$dropStyle." name=race id=race > 
		                          <option value=white>White
		                          <option value=black>Black
		                          <option value=red>Red
		                          <option value=yellow>Yellow
		                          <option value=green> Extraterrestrial 
		                        </select> 
		             ";
		             
		     $outQ1 = "<tr><td> Additional questions to be provided
		                   <td> ?? "; 




			if( is_array( $offices)) {   //build ballot............
				
	 		  $out3 = " <strong> BALLOT </strong> ";
			  
			  $tab ='<input type=hidden name=hvote value=1> 
			  <table>'; 
				while( list($xid, $vname) = each( $offices ) ){
						$tab .= "<tr><td colspan=2> &nbsp; <tr><td colspan=2>".$vname; 
						while( list($cid, $name) = each( $officer_names[$xid] ) ){
							 $tab .= "<tr><td> &nbsp; &nbsp; <td> <tr><td> &nbsp; &nbsp; <td> 
							   <input ".$selectStyle." type=radio value=".$cid." name=v_".$xid.">".$name; 
						}
				}
				$out3 .= $tab. "</table><br><br><input " .$submitStyle." type=button value=VOTE onclick='done1(4); '> "; 
				
			}
 
  
?> 