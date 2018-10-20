<script> 

 /* used only by vote.php !! */   
	 
	function countKeys(obj) {
	    return Object.keys(obj).length;
	}	
	  
	
	function done1(d){
	 
	//alert( 'd='+d ); 
	  document.getElementById('flag1').value= ''+d;  
	  //page validation done by case on d
	  if( d=='1'){
	  	 		var o =document.getElementById('transfer_code'); if(o.value == ''){o.focus(); alert( 'Enter Vote code'); return false;  }
		
		} else if( d=='5') { // validation for not voting reasons. 
			
			  
			
		} else if( d=='99') { //from Intake
			
	  	 		var o =document.getElementById('fullname'); if(o && o.value == ''){o.focus(); alert( 'Enter your Full Name'); return false;  }
	  	 		var o =document.getElementById('Fulladdressname'); if(o && o.value == ''){o.focus(); alert( 'Enter your Full street address'); return false;  }
	  	 		var o =document.getElementById('zip'); if(o && o.value == ''){o.focus(); alert( 'Enter your Zip code'); return false;  }
	  	 		var o =document.getElementById('email'); 
						if(o && o.value == ''){
							o.focus(); alert( 'Enter your Email address'); return false;  
						}
						if(o &&  !o.value.match(/.+@.+\..+/)  ) {
							alert(' Email format required');
							o.focus(); 			return false; 
						}
	  	 		   
	  	 		var o =document.getElementById('phone'); if(o && o.value == ''){o.focus(); alert( 'Enter your Phone number'); return false;  }
	  	 		var o =document.getElementById('citystate'); if(o && o.value == ''){o.focus(); alert( 'Enter your City and State'); return false;  }
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
	  	      var cnt = new Object(); 
	  	      var xname = new Object();   
   	      	 
	  	      for(var k=0; k<inobj.length; k++) {  
	  	      		var xn = inobj[k].name; 
	  	      		xname[xn] = 1; 
	  	      		nChoices += 1; 
	  	      		if ( inobj[k].checked ){
	  	      				cnt[xn] = 1; 
	  	      		}
	  	      }
	  	      var nChoices = countKeys(xname); 
	  	      var found = 0; 
	  	      for( var xn in xname ) { 
							   //alert( xn+' ' + xname[xn] ); 
							   if( cnt[xn]){
							   	  found += 1;  
							   }
						}
						if(nChoices > found) { 
	  	      	 if ( confirm ('You have not completed the ballot !  Continue anyway? ')){
	  	      	 	   
	  	      	 } else {
	  	      	 	  return false; 
	  	      	 }
						}
	  	    
	  	
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
