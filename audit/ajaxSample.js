   	if(use==1){ //from Norfolk Court....
   		document.genericForm.testResponse.value ='startajax'; 
   		var ischecked=0;
	   	if( o.checked ){ 
	   		ischecked=1;
	   	}
			var ajaxRequest;  // The variable that makes Ajax possible!
			try{
				// Opera 8.0+, Firefox, Safari
				ajaxRequest = new XMLHttpRequest();
			} catch (e){
				// Internet Explorer Browsers
				try{
					ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try{
						ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e){
						// Something went wrong
						alert("Your browser is broken!");
						return false;
					}
				}
			}
			// Create a function that will receive data sent from the server
			ajaxRequest.onreadystatechange = function(){
				if(ajaxRequest.readyState == 4){
					document.genericForm.testResponse.value = ajaxRequest.responseText;
//alert('response has been sent from the server'); 
				}
			}
 
			var xval = o.value
			xval = xval.replace(/#/g,"%23");
			var ajaxAction = "http://www.norfolkrocs.com/ajaxUpdate.php?value=" +xval
			                   + "&wtype="+ wtype 
			                   + "&nrepeat=" +nrepeat
			                   + "&attrid=" +attrid
			                   + "&instanceId=" +instanceId
			                   + "&clientid=" +clientid
			                   + "&ischecked=" +ischecked
			                   + "&fset="+document.genericForm.fset.value;
//alert(ajaxAction);

			ajaxRequest.open("GET", ajaxAction, true);
			ajaxRequest.send(null); 
			
   	}
   	if(use==1){ 
   		document.genericForm.testResponse.value ='startajax'; 
   		var ischecked=0;
	   	if( o.checked ){ 
	   		ischecked=1;
	   	}
			var ajaxRequest;  // The variable that makes Ajax possible!
			try{
				// Opera 8.0+, Firefox, Safari
				ajaxRequest = new XMLHttpRequest();
			} catch (e){
				// Internet Explorer Browsers
				try{
					ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try{
						ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e){
						// Something went wrong
						alert("Your browser is broken!");
						return false;
					}
				}
			}
			// Create a function that will receive data sent from the server
			ajaxRequest.onreadystatechange = function(){
				if(ajaxRequest.readyState == 4){
					document.genericForm.testResponse.value = ajaxRequest.responseText;
//alert('response has been sent from the server'); 
				}
			}
 
			var xval = o.value
			xval = xval.replace(/#/g,"%23");
			var ajaxAction = "http://www.norfolkrocs.com/ajaxUpdate.php?value=" +xval
			                   + "&wtype="+ wtype 
			                   + "&nrepeat=" +nrepeat
			                   + "&attrid=" +attrid
			                   + "&instanceId=" +instanceId
			                   + "&clientid=" +clientid
			                   + "&ischecked=" +ischecked
			                   + "&fset="+document.genericForm.fset.value;
//alert(ajaxAction);

			ajaxRequest.open("GET", ajaxAction, true);
			ajaxRequest.send(null); 
			
   	}
