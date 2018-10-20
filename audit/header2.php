<!DOCTYPE html>

<html> 
<head> 
	<style> 
		 td { font-family:arial; font-size:26px; }
		 div { font-family:arial; font-size:26px; }
		 body { font-family:arial; font-size:26px; }
		 
	input[type=text], select {
    /* width: 100%; */ 
    width: 80%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    font-size:26px;
    font-family:arial;
}
	</style>
</head> 

<body> 
<table cellpadding=0 cellspacing=0 align=center    style=' background-color:white; width:98%;'>
<tr><td style=" padding-left:0px; width:600px; " >  

<?php	 
//echo 'userlevel='.  $_SESSION['userLevel'] ; 
	   if( $_SESSION['userLevel']  !=   '1'      ) {
	   		$xlogo = ' <a href="index.php"><img width="600px;" align=left src="votingLogo.png"></a>';
	   		
	   } else { //audit
	   	  $xlogo = ' <a href="index.php"><img width="600px;" align=left src="votingLogo.png" usemap="#logomap" ></a>';
	   }
	   
	   echo $xlogo; 
	   
?> 
	 
	 
<map name="logomap">
  <area shape="circle" coords="426,46,10" href="index.php" alt="Logo">
</map>	
  
	<script> 
		function deleteAllChildren( xnode ) {
			var c = xnode.childNodes;
			for( var k=0;  k< c.length; k++ ) {
				var x = c[k].parentNode.removeChild( c[k] );
				deleteAllChildren( x ); 	
			}	
		}
	  function hideMenu(){
	  	 /// return; //////////////// remove to hide /////////////////////////////////
	  	var o = document.getElementById('menu');
/*	  	
	  	deleteAllChildren(o); 
	  	o.style.minWidth = '10px;';    
	  	var o = document.getElementById('menuTitle');
	  	if(o) { o.parentNode.removeChild(o); }
*/ 	  	 
	  	 o.style.visibility='hidden';
	  }
	function beep() {
    var snd = new Audio("data:audio/wav;base64,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qJrx4KOQjahZxWbcZgztj2c49nKmkId44S71j0c8eV9yDK6uPRzx5X18eDvjvQ6yKo9ZSS6l//8elePK/Lf//IInrOF/FvDoADYAGBMGb7FtErm5MXMlmPAJQVgWta7Zx2go+8xJ0UiCb8LHHdftWyLJE0QIAIsI+UbXu67dZMjmgDGCGl1H+vpF4NSDckSIkk7Vd+sxEhBQMRU8j/12UIRhzSaUdQ+rQU5kGeFxm+hb1oh6pWWmv3uvmReDl0UnvtapVaIzo1jZbf/pD6ElLqSX+rUmOQNpJFa/r+sa4e/pBlAABoAAAAA3CUgShLdGIxsY7AUABPRrgCABdDuQ5GC7DqPQCgbbJUAoRSUj+NIEig0YfyWUho1VBBBA//uQZB4ABZx5zfMakeAAAAmwAAAAF5F3P0w9GtAAACfAAAAAwLhMDmAYWMgVEG1U0FIGCBgXBXAtfMH10000EEEEEECUBYln03TTTdNBDZopopYvrTTdNa325mImNg3TTPV9q3pmY0xoO6bv3r00y+IDGid/9aaaZTGMuj9mpu9Mpio1dXrr5HERTZSmqU36A3CumzN/9Robv/Xx4v9ijkSRSNLQhAWumap82WRSBUqXStV/YcS+XVLnSS+WLDroqArFkMEsAS+eWmrUzrO0oEmE40RlMZ5+ODIkAyKAGUwZ3mVKmcamcJnMW26MRPgUw6j+LkhyHGVGYjSUUKNpuJUQoOIAyDvEyG8S5yfK6dhZc0Tx1KI/gviKL6qvvFs1+bWtaz58uUNnryq6kt5RzOCkPWlVqVX2a/EEBUdU1KrXLf40GoiiFXK///qpoiDXrOgqDR38JB0bw7SoL+ZB9o1RCkQjQ2CBYZKd/+VJxZRRZlqSkKiws0WFxUyCwsKiMy7hUVFhIaCrNQsKkTIsLivwKKigsj8XYlwt/WKi2N4d//uQRCSAAjURNIHpMZBGYiaQPSYyAAABLAAAAAAAACWAAAAApUF/Mg+0aohSIRobBAsMlO//Kk4soosy1JSFRYWaLC4qZBYWFRGZdwqKiwkNBVmoWFSJkWFxX4FFRQWR+LsS4W/rFRb/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////VEFHAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAU291bmRib3kuZGUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAMjAwNGh0dHA6Ly93d3cuc291bmRib3kuZGUAAAAAAAAAACU=");  
    snd.play();
}	
  </script> 
		<?php  $bgcolor=' background-color:lightgrey; '; ?> 
		<td> <div style="color:#008080; font-weight:normal; padding-bottom:8px; padding-top:8px; padding-right:8px; padding-left:20px; <?php echo $bgcolor;?>"> 
			<?php echo  $_SESSION['userGivenName'];?>  is logged in 
			    <span id=precinct></span>
			          
								<script>
									  var op = document.getElementById('precinct');
									      op.innerHTML = "<?php echo 'Precinct='.$precinct; ?> ";
									function distanceCenter(lat1,lon1, lat2, lon2){
										alert ( 'lat1='+ lat1/57.3 );
										
										var phi1 = lat1/57.3, phi2 = lat2/57.3, delta = (lon2-lon1)/57.3, 
										R = 6371e3; // gives d in metres
										var distanceToCenter = Math.acos( Math.sin(phi1)*Math.sin(phi2) + Math.cos(phi1)*Math.cos(phi2) * Math.cos(delta) ) * R;
										
										document.getElementById('dist').innerHTML =  ''+distanceToCenter; 
									}
									
									
								</script>
			          
			           
			<?php
				if( empty( $_SESSION['userGivenName'] )){ 
					echo "<br>Your session has stopped. You must login again. &nbsp;<br> Please <a href='logout-page.php'> CLICK HERE </a>  "; 
				}
			?> 
		</div> 
	<tr>   <td colspan=2>   
		
		
<?php 

/*
1. I was told by someone that I didn't have the right ID so I didn't go to the polls and try to vote.
            a. Did you know the person who told you this? y/n
                     If yes, how well? 
            b. Why did you believe him/her? _____________
2. I was told by a poll official that I didn't have the right ID so I wasn't allowed to vote.
3. I was told that I wasn't on the voter list and I couldn't vote at that polling place. 
           a. Did you believe that you were at the correct polling place? 
                        I. If yes, why did you believe you were in the right place?
                              A. I received an official mailer with the address
                              B. I received a mailer that looked official with the address
                              C. I was told the address by ___________.
                              D. Other _____________
           b. Were you sent to another polling place? y/n
                        I. If so, how many polling places did you visit? /__/
4.  I went to the polling place but the lines were so long that I couldn't stay.
5.  I went to the polling place but they told me 
           a. The machines weren't working
           b. They had run out of ballots
6. I went to the polling place on the wrong day because ______________________.
7. I was prevented from getting to the polling place and this is what happened: ______________________
8. I mis-marked my ballot and they wouldn't give me a new one.
9. I was told that I might be arrested.
             By whom? ______________
10. I was scared. 
             Why? _____________
11. I never received a notice telling me where I should vote.
12. I checked before the election and found that I wasn't registered to vote.
              Have you voted before?
                        If not, did you register to vote? y/n
                                       If yes, about when? _________
                                                 With whom? __________
                        If yes, about how many times? ____


*/ 
// OUTPUT SHARED ON VOTER AND NON VOTER PAGES. /////////////////////////////////////////////////////

	  /////// registered but did not vote, why? 
		  $notVoteWhy = "<table id=noVoteWhyTab ><tr><td>Why didn't you vote?   "; 
		  $notVoteWhy .= "<input type=hidden name=notvotewhy value=1>  "; 
		  
			$notVoteWhy .= "<tr> <td> <input type=checkbox  " 
			  .$selectStyle." name=r_[] id=r_1 value='reason 1'> reason 1" ;
			$notVoteWhy .= "<tr> <td> <input type=checkbox  " 
			  .$selectStyle." name=r_[] id=r_2 value='reason 2'> reason 2 " ;
			$notVoteWhy .= "<tr> <td> <input type=checkbox  " 
			  .$selectStyle." name=r_[] id=r_3 value='Other'> Other " ;

			$notVoteWhy .= "<tr><td>  &nbsp; <input type=button value='Next' ".$submitStyle." 
			           onclick='done1(3);'> 
		         	</table> ";
		         	
//////////////////////////////////////

		  $outProvisional = "Do you vote with a regular or provisional ballot? <br><br> 
		                  <select ".$dropStyle." name=provision id=provision onchange='done1(2);'><option value=''>Choose
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

             
		   $outReason = "What reason was given for requiring you to vote with a provisional ballot? <br> <br> "; 
		  
		   $outReason .= $ropts;           
		              
		   $outReason .="       <br>       &nbsp;   &nbsp;  Enter other reasons here, if any: <br>
		               &nbsp;   &nbsp;  <input ".$inputStyle." name=pother id=pother > <br><br>
		               <input type=button value=Next ".$submitStyle." onclick='done1(3); '> <br><br>   
		  
		  ";


		  $afterVote = "Would you answer a few additional questions?  
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
		                          <option value=black>Black or African American
		                          <option value=asian>Asian
		                          <option value='native american'>American Indian and Alaska Native
		                          <option value='pacific islander'> Native Hawaiian and Other Pacific Islander 
		                        </select> 
		             ";
		             
		     $outQ1 = "<tr><td> Additional questions to be provided
		                   <td> ?? "; 

		  $out0 = "<table>    
		    <tr><td> <strong> Intake for Voting Audit </strong>
		      <tr><td> <input type=text placeholder='Full Name' name=fullname id=fullname >     
		      <tr><td> <input type=text placeholder='Street Address' name=address id=Fulladdressname > 
		      <tr><td> <input type=text placeholder='City and State' name=citystate id=citystate > 
		      <tr><td> <input type=text placeholder='Zip code' name=zip id=zip >   
		      <tr><td> <input type=text placeholder='Email address' name=email id=email >  
		      <tr><td> <input type=text placeholder='Phone' name=phone id=phone >  
 	      
	      <tr><td style='max-width:80%;   '>   
		    I do hereby affirm that I participate voluntarily in the 2018 election audit being conducted by Democracy 
		        Counts and that I chose the same candidate(s) as I voted for in the election.  I further affirm that any and all other 
		        questions I chose to answer herein are truthful. <br>
		        Enter your name to affirm you agree: <input ".$inputStyle." name=agreement id=agreement size=20 > 
		        
		         <!-- </div>-->
        <tr><td><input ".$submitStyle." type=button value=DONE onclick='done1(99); '>  <br><br><br>	
		  </table> 
		  <script>
		  
		  </script> 
		  
		  ";



			if( is_array( $offices)) {   //build ballot............
				
	 		  $ballot = " <strong> BALLOT </strong> ";
			  
			  $tab ='<input type=hidden name=hvote value=1>  
			  <table id=reasonContainer >'; 
				while( list($xid, $vname) = each( $offices ) ){
						$tab .= "<tr><td colspan=2> &nbsp; <tr><td colspan=2>".$vname; 
						while( list($cid, $name) = each( $officer_names[$xid] ) ){
							 $tab .= "<tr><td> &nbsp; &nbsp; <td> <tr><td> &nbsp; &nbsp; <td> 
							   <input ".$selectStyle." type=radio value=".$cid." name=v_".$xid.">".$name; 
						}
				}
				$ballot .= $tab. "</table><br><br><input " .$submitStyle." type=button value='Audit Vote' onclick='done1(4); '> "; 
				
			}
 
  
?> 