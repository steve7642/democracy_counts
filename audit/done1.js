<script> 

 /* used only by vote.php !! */   
	 
	
	function done1(d){
	 
	//alert( 'd='+d ); 
	  document.getElementById('flag1').value= ''+d;  
	  //page validation done by case on d
	  if( d=='1'){
	  	 		var o =document.getElementById('transfer_code'); if(o.value == ''){o.focus(); alert( 'Enter Vote code'); return false;  }
		
		} else if( d=='5') { // validation for not voting reasons. 
			
			  
			
		} else if( d=='99') { //from Intake
			
	  	 		var o =document.getElementById('fullname'); if(o && o.value == ''){o.focus(); alert( 'Enter your Full Name'); return false;  }
	  	 		//var o =document.getElementById('Fulladdressname'); if(o && o.value == ''){o.focus(); alert( 'Enter your Full street address'); return false;  }
	  	 		//var o =document.getElementById('zip'); if(o && o.value == ''){o.focus(); alert( 'Enter your Zip code'); return false;  }
	  	 		var o =document.getElementById('email'); 
						if(o && o.value == ''){
							o.focus(); 
							alert( 'Enter your Email address'); 
							return false;  
						}
						if(o &&  !o.value.match(/.+@.+\..+/)  ) {
							alert(' Email format required');
							o.focus(); 			return false; 
						}
	  	 		   
	  	 		//var o =document.getElementById('phone'); if(o && o.value == ''){o.focus(); alert( 'Enter your Phone number'); return false;  }
	  	 		//var o =document.getElementById('citystate'); if(o && o.value == ''){o.focus(); alert( 'Enter your City and State'); return false;  }
	  	 		var o =document.getElementById('agreement'); if(o && o && o.value == ''){o.focus(); alert( 'Enter your name to agree'); return false;  }
	 
	  }  else if( d=='3' ){
	  	        //alert('check reasons for provisionl'); 
	  	        
	  	 
					var iNode = document.ff.prv;
					var pother = document.getElementById('pother'); 
					if( pother && pother.value == ''){
						var iNode = document.ff.prv;
						var ischeck = false; 
						for ( var k=0; k<iNode.length; k++) { 
							if( iNode[k].checked ) { 
							  ischeck = true; 
							}
						}
						if( !ischeck ) { 
							alert('You must select a reason or write in other reason'); return false;  
						}
					}
	  	 
	  	
	  }  else if( d=='4' ){  
	  	 // alert( 'check ballot');  
	  	   ///////////alert on ballot
	  	   // <input type=radio 
	  	   ////////  
	  	   
	  	      var inobj  = (document.getElementById('reasonContainer')).getElementsByTagName('input');  
	  	      var cntResponses = 0;  
	  	      var xname = new Object();   
   	      	var nChoices =Object();  
   	      	var writeInCheck = false; 
   	      	
	  	      for(var k=0; k<inobj.length; k++) {  
	  	      		
	  	      		var xn = inobj[k].name; 
	  	      		var xtype = inobj[k].type; 
	  	      		if( xtype=='radio'){ 
	  	      			 nChoices[xn] = ''; // one for each office. 
	  	      		}
	  	      		xname[xn] = 1; 
	  	      		var xv = inobj[k].value;
	  	      		if ( inobj[k].checked ){
	  	      				cntResponses += 1; 
	  	      		}
	  	      		if( isNaN(xv) && xv != '') { 
	  	      			//confirm no candidate for this office is checked 
	  	      				var radName = 'v_' +  xn.substring(8);
	  	      				for(var kk=0; kk<inobj.length; kk++) {  
//alert ( 'radName='+radName + '* boxname=' + inobj[kk].name +'*'); 	  	      					
	  	      					if (inobj[kk].name == radName ){
//alert( 'isequal'); 
						  	      		if ( inobj[kk].checked ){
//alert ('checked'); 					
                              writeInCheck = true; 	  	      			
						  	      				inobj[kk].checked = false;  
						  	      		}
	  	      					}
	  	      				}
					
	  	      			  cntResponses += 1;
	  	      			  
	  	      		}
	  	      }
	  	     
//alert('nc='+countKeys(nChoices)); 
	  	      nCandidates = countKeys(nChoices);

  //alert( 'ncandidates='+nCandidates+' cntResponses=' + cntResponses);			
			
						if(nCandidates > cntResponses    ) { 
							 if( cntResponses == 0 ) { 
							 	  alert( 'Indicate who you voted for');
							 	  return false; 
							 }
	  	      	 if ( confirm ('You have not completed the ballot !  This is how I actually voted, press OK to submit this ballot. ')){
	  	      	 	   ///////////////
	  	      	 } else {
	  	      	 	  return false; 
	  	      	 }
						} else if ( writeInCheck ){
							   alert( 'You have provided a write-in candidate and checked one as well, correct and continue')
	  	      	 	  return false; 
							
						}
//alert( ' this will continue'); 						
//return false; 	  	    
	  	
	  } else {
	  	
	  }
	  	  
	  
	  ////////////////////////////
	  document.ff.submit();
	}
	
  hideMenu();

	function notpending(o){
         document.getElementById('trackId').value = o.value ;   
         document.getElementById('flag1').value ='1' ;   
         document.location='test1.php?v=1';
         document.ff.submit(); 
		
	}
</script>
